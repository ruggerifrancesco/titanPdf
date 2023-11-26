<?php
if (!defined('ABSPATH')) {
    exit; // Exit if access directly!
}

/*
 * Ad Finanza Button PDF Widget
 *
 * Elementor Widget for creating a button for PDF Generation
 *
 * @since 1.0.0
 */
class TitanPDF_Button_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'pdf_button';
    }

    public function get_title() {
        return esc_html__('Ad Finanza PDF');
    }

    public function get_icon() {
        return 'fas fa-file-pdf';
    }

    public function get_custom_help_url() {
        // Define your custom help URL if needed
    }

    public function get_categories() {
        // Define the widget category
        return ['general'];
    }

    public function get_keywords() {
        // Define keywords related to your widget
        return ['pdf', 'button', 'generate', 'ad', 'finanza'];
    }

    public function get_script_depends() {
        // Define script dependencies if needed
        return [];
    }

    public function get_style_depends() {
        // Define style dependencies if needed
        return [];
    }

    protected function register_controls() {

        // ## CONTENT TAB
		$this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Button', 'textdomain' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Button Type
        $this->add_control(
            'button_type',
            [
                'label' => esc_html__( 'Type', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'predefinito', // Default value
                'options' => [
                    'predefinito' => esc_html__( 'Predefinito', 'textdomain' ),
                    // Add other button types as needed
                ],
            ]
        );

        // Button Text
        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Text', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Generate PDF', 'textdomain' ), // Default text
            ]
        );

        // Text Alignment
        $this->add_control(
            'text_alignment',
            [
                'label' => esc_html__( 'Text Alignment', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'textdomain' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'textdomain' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'textdomain' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left', // Default alignment
            ]
        );

        // Dimension Selection
        $this->add_control(
            'dimension',
            [
                'label' => esc_html__( 'Dimension', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'small' => esc_html__( 'Small', 'textdomain' ),
                    'medium' => esc_html__( 'Medium', 'textdomain' ),
                    'large' => esc_html__( 'Large', 'textdomain' ),
                ],
                'default' => 'small', // Default dimension
            ]
        );

        // Button Icon
        $this->add_control(
            'button_icon',
            [
                'label' => esc_html__( 'Icon', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => 'fas fa-file-pdf', // Default PDF (Font Awesome class)
            ]
        );

        // Icon Position
        $this->add_control(
            'icon_position',
            [
                'label' => esc_html__( 'Icon Position', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'left' => esc_html__( 'Left', 'textdomain' ),
                    'right' => esc_html__( 'Right', 'textdomain' ),
                ],
                'default' => 'left', // Default position
            ]
        );

        // Icon Spacing
        $this->add_control(
            'icon_spacing',
            [
                'label' => esc_html__( 'Icon Spacing', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10, // Default spacing size
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-pdf-button .icon-class' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        

        // ## STYLING TAB
        $this->start_controls_section(
            'styling_section',
            [
                'label' => esc_html__( 'Button Styling', 'textdomain' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .custom-pdf-button',
			]
		);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $button_text = !empty($settings['button_text']) ? $settings['button_text'] : 'Generate PDF';

        echo '<button class="custom-pdf-button ' . esc_attr($settings['dimension']) . ' ' . esc_attr($settings['icon_position']) . '" style="color: ' . esc_attr($settings['button_text_color']) . '; background-color: ' . esc_attr($settings['button_bg_color']) . ';">';

        // Render the icon based on the selected settings
        if (!empty($settings['button_icon']['value'])) {
            $icon_value = $settings['button_icon']['value'];
            $icon_position = $settings['icon_position'];

            if ($icon_position === 'left') {
                echo '<span class="icon-class ' . esc_attr($icon_value) . '"></span>';
            }

            echo esc_html($button_text);

            if ($icon_position === 'right') {
                echo '<span class="icon-class ' . esc_attr($icon_value) . '"></span>';
            }
        } else {
            // Render button text only if no icon is selected
            echo esc_html($button_text);
        }

        echo '</button>';
    }

    protected function content_template() {
        // Implement this method to define the content template for the widget
        ?>
        <# 
        // Template logic goes here
        #>
        <?php
    }
}
