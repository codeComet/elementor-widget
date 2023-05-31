<?php

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Utils;


class Elementor_Strativ_Custom_Post_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'custom-post-widget';
    }

    public function get_title()
    {
        return 'Custom Post Widget';
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }

    public function get_categories()
    {
        return ['basic'];
    }






    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'strativ-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'post_count',
            [
                'label' => 'Number of Posts',
                'type' => Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );

        $this->add_control(
            'custom_skin',
            [
                'label' => 'Custom Skin',
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => 'Default',
                    'custom' => 'Custom',
                ],
            ]
        );

        $this->add_control(
            'post_order',
            [
                'label' => __('Post Order', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'asc' => __('Ascending', 'strativ-widget'),
                    'desc' => __('Descending', 'strativ-widget'),
                ],
                'default' => 'desc',
            ]
        );





        // Post Info alignment
        $this->add_responsive_control(
            'post_info_alignment',
            [
                'label' => __('Post Info Alignment', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'strativ-widget'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'strativ-widget'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'strativ-widget'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .post-info' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Style', 'strativ-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE
            ]
        );

        // Card background color
        $this->add_control(
            'card_bg_color',
            [
                'label' => __('Card Background', 'strativ-widget'),
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
                'label' => __('Card Padding', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .card-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Post Title settings
        $this->add_control(
            'title_options',
            [
                'label' => esc_html__('Title options', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Post Title color
        $this->add_control(
            'title_color',
            [
                'label' => __('Category Title Color', 'strativ-widget'),
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
                'label' => __('Category Info Background Color', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .post-info' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Post Title Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'post_title_typography',
                'label' => __('Post title typography', 'strativ-widget'),
                'selector' => '{{WRAPPER}} .post_title'
            ]
        );

        // Date settings
        $this->add_control(
            'date_title_color',
            [
                'label' => __('Date Color', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .post_date' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Date Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'date_title_typography',
                'label' => __('Date typography', 'strativ-widget'),
                'selector' => '{{WRAPPER}} .post_date'
            ]
        );

        // Card Title Styling
        $this->add_control(
            'card_title_options',
            [
                'label' => esc_html__('Post title options', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Card Title Color
        $this->add_control(
            'card_title_color',
            [
                'label' => __('Post Title Color', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .card-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Card Title Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'card_title_typography',
                'label' => __('Post title typography', 'strativ-widget'),
                'selector' => '{{WRAPPER}} .card-title'
            ]
        );

        // Description Styling
        $this->add_control(
            'description_options',
            [
                'label' => esc_html__('Description', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Description Color
        $this->add_control(
            'description_color',
            [
                'label' => __('Description Color', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Description Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __('Description typography', 'strativ-widget'),
                'selector' => '{{WRAPPER}} .description'
            ]
        );

        // Author Styling
        $this->add_control(
            'author_options',
            [
                'label' => esc_html__('Author', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Author Color
        $this->add_control(
            'author_color',
            [
                'label' => __('Author Color', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .author' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Author Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_typography',
                'label' => __('Author typography', 'strativ-widget'),
                'selector' => '{{WRAPPER}} .author'
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $post_count = $settings['post_count'];
        $custom_skin = $settings['custom_skin'];

        $query_args = [
            'post_type' => 'post',
            'posts_per_page' => $post_count,
            'order' => $settings['post_order'],
        ];

        $posts_query = new \WP_Query($query_args);

        if ($posts_query->have_posts()) {
            $counter = 0;
            $row_styles = 'display: flex; gap: 20px; flex-wrap: wrap; justify-content: flex-start';
            $card_width = 33; // Calculate the width of each card

            if ($custom_skin === 'custom') {
                echo '<div class="custom-post-widget">';
                echo '<div class="row" style="' . $row_styles . '">';

                while ($posts_query->have_posts()) {
                    $posts_query->the_post();

                    echo '<div class="custom-card" style="width: ' . ($card_width - 1) . '%;">';
                    echo '<div class="post-info">';
                    echo '<h4 style="display: inline-block;" class="post_title">' . get_the_category()[0]->name . '</h4>';
                    echo '<p style="display: inline-block; margin-left: 10px;" class="post_date">' . get_the_date() . '</p>';
                    echo '</div>';
                    echo '<img src="' . get_the_post_thumbnail_url() . '">';
                    echo '<div class="card-description" style="margin-top: -8px;">';
                    echo '<h3 class="card-title" style="margin: 0;">' . get_the_title() . '</h3>';
                    echo '<p class="description" style="margin: 10px 0;">' . get_the_excerpt() . '</p>';
                    echo '<p class="author" style="margin: 10px 0;">' . get_the_author() . '</p>';
                    echo '</div>';
                    echo '</div>';

                    $counter++;

                    if ($counter % $post_count === 0) {
                        echo '</div>'; // Close the row
                        echo '<div class="row" style="' . $row_styles . '">'; // Start a new row
                    }
                }

                echo '</div>'; // Close the last row
                echo '</div>'; // Close the custom-post-widget container
            } else {
                while ($posts_query->have_posts()) {
                    $posts_query->the_post();
                    echo '<article class="post">';
                    echo '<h2 class="post-title">' . get_the_title() . '</h2>';
                    echo '<div class="post-content">' . get_the_content() . '</div>';
                    echo '</article>';
                }
            }
        }
        wp_reset_postdata();
    }
}
