<?php
class TitanPDF_Posts_List_Table extends WP_List_Table {

    // Prepare items for the table
    public function prepare_items() {
        $this->_column_headers = array($this->get_columns(), array(), array());
        $this->items = $this->get_posts();
    
        $per_page = 10; // Number of items per page
        $current_page = $this->get_pagenum();
    
        $total_items = count($this->items);
        $this->set_pagination_args(array(
            'total_items' => $total_items,
            'per_page' => $per_page,
        ));
    
        $this->items = array_slice($this->items, ($current_page - 1) * $per_page, $per_page);
    }

    // Define the columns
    public function get_columns() {
        return array(
            'title' => __('Posts', 'your-text-domain'),
            'status' => __('Status', 'your-text-domain'),
            'selected_settings' => 'Settaggi Selezionati'
        );
    }

    // Get the posts
    public function get_posts() {
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'post_status' => array('publish', 'draft'),
        );

        $posts = get_posts($args);

        return $posts;
    }

    // Render each column
    public function column_default($item, $column_name) {
        switch ($column_name) {
            case 'status':
                return $this->get_status_indicator($item->ID);
            case 'selected_settings':
                return $this->display_template_settings();
            default:
                return ''; // Return empty string for other columns
        }
    }

    // Render the title column with row actions
    public function column_title($item) {
        $actions = array(
            'edit' => sprintf(
                '<a href="%s">%s</a>',
                '#',
                __('Edit template', 'your-text-domain')
            ),
            'preview_pdf' => sprintf(
                '<a href="%s">%s</a>',
                // Replace with the URL for your custom action
                '#',
                __('Preview PDF', 'your-text-domain')
            ),
            'reset_template' => sprintf(
                '<a href="%s" style="color: red !important;">%s</a>',
                // Replace with the URL for your custom action
                '#',
                __('Reset template', 'your-text-domain')
            ),
        );

        return sprintf('%1$s %2$s %3$s', '<strong>' . get_the_title($item->ID) . '</strong>', '' ,  $this->row_actions($actions));
    }

    // Get the status indicator
    private function get_status_indicator($post_id) {
        $status = get_post_status($post_id);

        if ($status === 'publish') {
            return '<span class="titanPdfStatus-pill titanPdfStatus-pill--success">' . __('Publish', 'your-text-domain') . '</span>';
        } else {
            return '<span class="titanPdfStatus-pill titanPdfStatus-pill--danger">' . __('Draft', 'your-text-domain') . '</span>';
        }
    }

    private function display_template_settings() {
        //
    }
}
