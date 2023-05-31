<?php

// namespace Elementor;

if(!defined('ABSPATH')) {
    exit; //exit if accessed directly
}



class Elementor_Strativ_Custom_Card_Widget extends \Elementor\Widget_Base {

    /**
	 * Get widget name.
	 *
	 * Retrieve currency widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */

	public function get_name() {
		return 'strativ_card_widget';
	}


    /**
	 * Get widget title.
	 *
	 * Retrieve currency widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */

	public function get_title() {
		return esc_html__( 'Strativ Card', 'strativ-widget' );
	}


    /**
	 * Get widget icon.
	 *
	 * Retrieve currency widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */

	public function get_icon() {
		return 'eicon-single-post';
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
		return 'https://www.strativ.se/en';
	}


    /**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the currency widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */

	public function get_categories() {
		return [ 'basic' ];
	}


    /**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the currency widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */

	public function get_keywords() {
		return [ 'card', 'strativ' ];
	}

    /**
	 * Register currency widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
    protected function _register_controls() {

        // Content tab
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'strativ-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Post Title
        $this->add_control(
            'post_title',
            [
                'label' => __( 'Post Title', 'strativ-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Post Title', 'strativ-widget' ),
                'placeholder' => __( 'Enter your post title', 'strativ-widget' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        // Post Info alignment
        $this->add_responsive_control(
            'post_info_alignment',
            [
                'label' => __( 'Post Info Alignment', 'strativ-widget' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'strativ-widget' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'strativ-widget' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'strativ-widget' ),
                        'icon' => ' eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .post-info' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Post Date
        $this->add_control(
            'post_date',
            [
                'label' => __( 'Post Date', 'strativ-widget' ),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
                'default' => __( 'Post Date', 'strativ-widget' ),
                'placeholder' => __( 'Enter your post date', 'strativ-widget' ),
                'date_format' => __( 'Y-m-d', 'strativ-widget' ),
                'picker_options' => [
                    'dateFormat' => 'F d, Y', // Setting the date format for the datepicker
                    'timeFormat' => '', // Setting the time format for the datepicker to an empty string to hide it
                ],
            ]
        );


        // Card title
        $this->add_control(
            'card_title',
            [
                'label' => __( 'Card Title', 'strativ-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Card Title', 'strativ-widget' ),
                'placeholder' => __( 'Enter your card title', 'strativ-widget' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );



        // Card image
        $this->add_control(
            'card_image',
            [
                'label' => __( 'Card Image', 'strativ-widget' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        // Card description
        $this->add_control(
            'card_description',
            [
                'label' => __( 'Card Description', 'strativ-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Card Description', 'strativ-widget' ),
                'placeholder' => __( 'Enter your card description', 'strativ-widget' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        // Card description
        $this->add_control(
            'card_author',
            [
                'label' => __( 'Author', 'strativ-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Author', 'strativ-widget' ),
                'placeholder' => __( 'Author', 'strativ-widget' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();

        

        // STYLING TAB SETTINGS


        // style tab
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Style', 'strativ-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE
            ]
        );


        //Card bg color
        $this->add_control(
            'card_bg_color',
            [
                'label' => __( 'Card Background', 'strativ-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .card-description' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        // Card Description Padding
        $this->add_responsive_control(
            'card_description_padding',
            [
                'label' => __( 'Card Padding', 'strativ-widget' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .card-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        //POST TITLE SETTINGS

        $this->add_control(
            'title_options', [
                'label' => esc_html__('Title options', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
            );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Post Title Color', 'strativ-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .post_title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Post Info Background Color
        $this->add_control(
            'post_info_bg_color',
            [
                'label' => __( 'Post Info Background Color', 'strativ-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .post-info' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'post_title_typography', 
                'label' => __( 'Post title typography', 'strativ-widget' ),
                'selector' => '{{WRAPPER}} .post_title'
            ]
            );


        //DATE SETTINGS
        $this->add_control(
            'date_title_color',
            [
                'label' => __( 'Date Color', 'strativ-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .post_date' => 'color: {{VALUE}};',
                ],
            ]
        );



        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'date_title_typography', 
                'label' => __( 'Date typography', 'strativ-widget' ),
                'selector' => '{{WRAPPER}} .post_date'
            ]
            );

        
        // Image Style

        $this->add_control(
            'image_options', [
                'label' => esc_html__('Image options', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'image_size',
                'label' => __( 'Card Image Size', 'strativ-widget' ),
                'default' => 'medium',
            ]
        );

        // Image Style - Width
        $this->add_responsive_control(
            'image_width',
            [
                'label' => __( 'Width', 'strativ-widget' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Image Style - Background Repeat
        $this->add_control(
            'image_repeat',
            [
                'label' => __( 'Background Repeat', 'strativ-widget' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'no-repeat' => __( 'No Repeat', 'strativ-widget' ),
                    'repeat' => __( 'Repeat', 'strativ-widget' ),
                    'repeat-x' => __( 'Repeat Horizontally', 'strativ-widget' ),
                    'repeat-y' => __( 'Repeat Vertically', 'strativ-widget' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} img' => 'background-repeat: {{VALUE}};',
                ],
            ]
        );

        // Image Style - Background Size
        $this->add_control(
            'image_size_option',
            [
                'label' => __( 'Background Size', 'strativ-widget' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'cover' => __( 'Cover', 'strativ-widget' ),
                    'contain' => __( 'Contain', 'strativ-widget' ),
                    'auto' => __( 'Auto', 'strativ-widget' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} img' => 'background-size: {{VALUE}};',
                ],
            ]
        );




        // CARD TITLE STYLING
        $this->add_control(
            'card_title_options', [
                'label' => esc_html__('Card title options', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
            );

        $this->add_control(
            'card_title_color',
            [
                'label' => __( 'Card Title Color', 'strativ-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .card-title' => 'color: {{VALUE}};',
                ],
            ]
        );



        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'card_title_typography', 
                'label' => __( 'Card title typography', 'strativ-widget' ),
                'selector' => '{{WRAPPER}} .card-title'
            ]
            );




        //DESCRIPTION STYLING
        $this->add_control(
            'description_options', [
                'label' => esc_html__('Description', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
            );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Description Color', 'strativ-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .description' => 'color: {{VALUE}};',
                ],
            ]
        );



        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography', 
                'label' => __( 'Description typography', 'strativ-widget' ),
                'selector' => '{{WRAPPER}} .description'
            ]
        );



        //AUTHOR STYLING
        $this->add_control(
            'author_options', [
                'label' => esc_html__('Author', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'author_color',
            [
                'label' => __( 'Author Color', 'strativ-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .author' => 'color: {{VALUE}};',
                ],
            ]
        );



        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_typography', 
                'label' => __( 'author typography', 'strativ-widget' ),
                'selector' => '{{WRAPPER}} .author'
            ]
        );




        $this->end_controls_section();
    }


    /**
	 * Render currency widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
    protected function render() {

        // Get widget settings
        $settings = $this->get_settings_for_display();

        // Render card HTML
        echo '<div class="custom-card">';
        echo '<div class="post-info">';
        echo '<h4 style="display: inline-block;" class="post_title">' . $settings['post_title'] . '</h4>';
        echo '<p style="display: inline-block; margin-left: 10px;" class="post_date">' . $settings['post_date'] . '</p>';
        echo '</div>';
        echo '<img src="' . $settings['card_image']['url'] . '">';
        echo '<div class="card-description" style="margin-top: -8px;">';
        echo '<h3 class="card-title" style="margin: 0;">' . $settings['card_title'] . '</h3>';
        echo '<p class="description" style="margin: 10px 0;">' . $settings['card_description'] . '</p>';
        echo '<p class="author" style="margin: 10px 0;">' . $settings['card_author'] . '</p>';
        echo '</div>';
        echo '</div>';

    }
}



