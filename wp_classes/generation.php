<?php
add_action('wp_ajax_custom_generate_pdf', 'custom_generate_pdf');

function custom_generate_pdf() {
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $post_title = isset($_POST['post_title']) ? sanitize_title($_POST['post_title']) : 'bando_';

    // If the post ID or post title is not provided or is invalid
    if (!$post_id || !$post_title) {
        wp_die();
    }

    // Get the post content based on the post ID
    $post = get_post($post_id);
    $post_content = $post->post_content;

    // Your existing PDF generation code
    $pdf_filename = $post_title . '_' . uniqid() . '.pdf';
    $upload_dir = wp_upload_dir();

    // Include TCPDF library
    require_once(plugin_dir_path(__FILE__) . 'tcpdf/tcpdf.php');

    // Class TCPDF
    class Titan_PDF extends TCPDF {
        public function __construct() {
            parent::__construct();
            $this->setPrintHeader(false);
            $this->setPrintFooter(false);
            $this->SetFont('helvetica', '', 10, '', true);
            $this->SetMargins(20, 35, 20);
            $this->AddPage();
            $this->SetAutoPageBreak(true, 40);
            $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
        }
    }

    $pdf = new Titan_PDF();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Ad Sphera Group');

    $pdf->writeHTML($post_content);
    $pdf->Output($upload_dir['path'] . '/' . $pdf_filename, 'F');

    // URL to the PDF file
    $pdf_url = $upload_dir['url'] . '/' . $pdf_filename;
    echo esc_url($pdf_url);

    // Make sure to exit after echoing the response
    wp_die();
}
