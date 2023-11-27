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

    /**
	 * Get widget name.
	 *
	 * Retrieve list widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
    public function get_name() {
        return 'pdf_button';
    }

    /**
	 * Get widget title.
	 *
	 * Retrieve list widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
    public function get_title() {
        return esc_html__('TitanPDF Button');
    }

    /**
	 * Get widget icon.
	 *
	 * Retrieve list widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
    public function get_icon() {
        return 'eicon-document-file';
    }

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
    public function get_custom_help_url() {
        // Define your custom help URL if needed
    }

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the list widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
    public function get_categories() {
        // Define the widget category
        return ['general'];
    }

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the list widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
    public function get_keywords() {
        // Define keywords related to your widget
        return ['pdf', 'button', 'generate', 'titan', 'generate'];
    }


    public function get_script_depends() {
        // Define script dependencies if needed
        return [];
    }

    public function get_style_depends() {
        // Define style dependencies if needed
        return [];
    }

	/**
	 * Register list widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
    protected function register_controls() {
    
        // ## CONTENT TAB
		$this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Button', 'yourtextdomain' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Button Text
        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Text', 'yourtextdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Generate PDF', 'yourtextdomain' ), // Default text
            ]
        );

        // Text Alignment
        $this->add_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'yourtextdomain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'yourtextdomain' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'yourtextdomain' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'yourtextdomain' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .titanpdf-widget-btn' => 'text-align: {{VALUE}};',
				],
			]
		);

        // Dimension Selection
        $this->add_control(
            'dimension',
            [
                'label' => esc_html__( 'Dimension', 'yourtextdomain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'small' => esc_html__( 'Small', 'yourtextdomain' ),
                    'medium' => esc_html__( 'Medium', 'yourtextdomain' ),
                    'large' => esc_html__( 'Large', 'yourtextdomain' ),
                ],
                'default' => 'small', // Default dimension
            ]
        );

        // Button Icon
        $this->add_control(
            'button_icon',
            [
                'label' => esc_html__( 'Icon', 'yourtextdomain' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'description' => 'test desc',
                'default' => [
					'value' => 'fas fa-file-pdf',
					'library' => 'fa-solid',
				],
            ]
        );

        // Icon Position
        $this->add_control(
            'icon_position',
            [
                'label' => esc_html__( 'Icon Position', 'yourtextdomain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'left' => esc_html__( 'Left', 'yourtextdomain' ),
                    'right' => esc_html__( 'Right', 'yourtextdomain' ),
                ],
                'default' => 'left', // Default position
            ]
        );

        // Icon Spacing
        $this->add_control(
            'icon_spacing',
            [
                'label' => esc_html__( 'Icon Spacing', 'yourtextdomain' ),
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
                    '{{WRAPPER}} .titan-pdf-button .icon-class' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

        $this->end_controls_section();

        

        // ## STYLING TAB
        $this->start_controls_section(
            'styling_section',
            [
                'label' => esc_html__( 'Button', 'yourtextdomain' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
			'style_tabs'
		);
		    $this->start_controls_tab(
		    	'style_normal_tab',
		    	[
		    		'label' => esc_html__( 'Normal', 'yourtextdomain' ),
		    	]
		    );

                $this->add_control(
                    'margin',
                    [
                        'label' => esc_html__( 'Margin', 'yourtextdomain' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 50,
                                'step' => 5,
                            ],
                            'em' => [
                                'min' => 1,
                                'max' => 5,
                                'step' => 0.5,
                            ],
                        ],
                        'default' => [
                            'top' => null,
                            'right' => null,
                            'bottom' => null,
                            'left' => null,
                            'unit' => 'px',
                            'isLinked' => true,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .titanpdf-widget-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_control(
                    'padding',
                    [
                        'label' => esc_html__( 'Padding', 'yourtextdomain' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 50,
                                'step' => 5,
                            ],
                            'em' => [
                                'min' => 1,
                                'max' => 5,
                                'step' => 0.5,
                            ],
                        ],
                        'default' => [
                            'top' => null,
                            'right' => null,
                            'bottom' => null,
                            'left' => null,
                            'unit' => 'px',
                            'isLinked' => true,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .titanpdf-widget-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_control(
                    'hr_style_1',
                    [
                        'type' => \Elementor\Controls_Manager::DIVIDER,
                    ]
                );

                $this->add_control(
                    'text_color',
                    [
                        'label' => esc_html__( 'Text Color', 'yourtextdomain' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .titanpdf-widget-btn' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Typography::get_type(),
                    [
                        'name' => 'content_typography',
                        'selector' => '{{WRAPPER}} .titanpdf-widget-btn',
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Background::get_type(),
                    [
                        'name' => 'background',
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .titanpdf-widget-btn',
                    ]
                );

                $this->add_control(
                    'hr_style_2',
                    [
                        'type' => \Elementor\Controls_Manager::DIVIDER,
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'box_shadow',
                        'selector' => '{{WRAPPER}} .titanpdf-widget-btn',
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Text_Shadow::get_type(),
                    [
                        'name' => 'text_shadow',
                        'selector' => '{{WRAPPER}} .titanpdf-widget-btn',
                    ]
                );

                $this->add_control(
                    'hr_style_3',
                    [
                        'type' => \Elementor\Controls_Manager::DIVIDER,
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Border::get_type(),
                    [
                        'name' => 'border',
                        'selector' => '{{WRAPPER}} .titanpdf-widget-btn',
                    ]
                );

                $this->add_control(
                    'border_radius',
                    [
                        'label' => esc_html__( 'Border radius', 'yourtextdomain' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 50,
                                'step' => 5,
                            ],
                            'em' => [
                                'min' => 1,
                                'max' => 5,
                                'step' => 0.5,
                            ],
                        ],
                        'default' => [
                            'top' => null,
                            'right' => null,
                            'bottom' => null,
                            'left' => null,
                            'unit' => 'px',
                            'isLinked' => true,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .titanpdf-widget-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_control(
                    'hr_style_4',
                    [
                        'type' => \Elementor\Controls_Manager::DIVIDER,
                    ]
                );

		        $this->end_controls_tab();

		    $this->start_controls_tab(
		    	'style_hover_tab',
		    	[
		    		'label' => esc_html__( 'Hover', 'yourtextdomain' ),
		    	]
		    );
                $this->add_control(
                    'margin_hover',
                    [
                        'label' => esc_html__( 'Margin', 'yourtextdomain' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 50,
                                'step' => 5,
                            ],
                            'em' => [
                                'min' => 1,
                                'max' => 5,
                                'step' => 0.5,
                            ],
                        ],
                        'default' => [
                            'top' => null,
                            'right' => null,
                            'bottom' => null,
                            'left' => null,
                            'unit' => 'px',
                            'isLinked' => true,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .titanpdf-widget-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_control(
                    'padding_hover',
                    [
                        'label' => esc_html__( 'Padding', 'yourtextdomain' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 50,
                                'step' => 5,
                            ],
                            'em' => [
                                'min' => 1,
                                'max' => 5,
                                'step' => 0.5,
                            ],
                        ],
                        'default' => [
                            'top' => null,
                            'right' => null,
                            'bottom' => null,
                            'left' => null,
                            'unit' => 'px',
                            'isLinked' => true,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .titanpdf-widget-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_control(
                    'hr_style_1_hover',
                    [
                        'type' => \Elementor\Controls_Manager::DIVIDER,
                    ]
                );

                $this->add_control(
                    'text_color_hover',
                    [
                        'label' => esc_html__( 'Text Color', 'yourtextdomain' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .titanpdf-widget-btn' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Typography::get_type(),
                    [
                        'name' => 'content_typography_hover',
                        'selector' => '{{WRAPPER}} .titanpdf-widget-btn',
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Background::get_type(),
                    [
                        'name' => 'background_hover',
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .titanpdf-widget-btn',
                    ]
                );

                $this->add_control(
                    'hr_style_2_hover',
                    [
                        'type' => \Elementor\Controls_Manager::DIVIDER,
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'box_shadow_hover',
                        'selector' => '{{WRAPPER}} .titanpdf-widget-btn',
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Text_Shadow::get_type(),
                    [
                        'name' => 'text_shadow_hover',
                        'selector' => '{{WRAPPER}} .titanpdf-widget-btn',
                    ]
                );

                $this->add_control(
                    'hr_style_3_hover',
                    [
                        'type' => \Elementor\Controls_Manager::DIVIDER,
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Border::get_type(),
                    [
                        'name' => 'border_hover',
                        'selector' => '{{WRAPPER}} .titanpdf-widget-btn',
                    ]
                );

                $this->add_control(
                    'border_radius_hover',
                    [
                        'label' => esc_html__( 'Border radius', 'yourtextdomain' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 50,
                                'step' => 5,
                            ],
                            'em' => [
                                'min' => 1,
                                'max' => 5,
                                'step' => 0.5,
                            ],
                        ],
                        'default' => [
                            'top' => null,
                            'right' => null,
                            'bottom' => null,
                            'left' => null,
                            'unit' => 'px',
                            'isLinked' => true,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .titanpdf-widget-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_control(
                    'hr_style_4_hover',
                    [
                        'type' => \Elementor\Controls_Manager::DIVIDER,
                    ]
                );

		    $this->end_controls_tab();
		$this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
	 * Render output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $text = $settings['button_text'];
        $alignment = $settings['text_align'];
        $dimension = $settings['dimension'];
        $icon = $settings['button_icon']['value'];
        $icon_position = $settings['icon_position'];
        $icon_spacing = $settings['icon_spacing']['size'];

        ?>
            <button class="titanpdf-widget-btn" style="text-align: <?php echo esc_attr($alignment); ?>;">
                <?php if ($icon_position === 'left') : ?>
                    <i class="<?php echo esc_attr($icon); ?>" style="margin-right: <?php echo esc_attr($icon_spacing); ?>px;"></i>
                <?php endif; ?>
                <?php echo esc_html($text); ?>
                <?php if ($icon_position === 'right') : ?>
                    <i class="<?php echo esc_attr($icon); ?>" style="margin-left: <?php echo esc_attr($icon_spacing); ?>px;"></i>
                <?php endif; ?>
            </button>
        <?php
    }

    /**
	 * Render output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
    protected function content_template() {
        ?>
            <button class="titanpdf-widget-btn">
                <# if (
                {{{ settings.button_text }}}
            </button>
        <?php
    }
}
