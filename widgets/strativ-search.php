
<?php

if (!defined('ABSPATH')) {
    exit;
}

// Include the Elementor widget classes.
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Search Input Field Widget.
class Elementor_Strativ_Search_Widget extends Widget_Base
{
    // Widget name and title.
    public function get_name()
    {
        return 'strativ-search-widget';
    }

    public function get_title()
    {
        return __('Strativ Search', 'strativ-search-widget');
    }

    // Widget icon (optional).
    public function get_icon()
    {
        return 'eicon-search';
    }

    // Widget categories (optional).
    public function get_categories()
    {
        return ['basic'];
    }

    // Widget control settings.
    protected function _register_controls()
    {
        // Add the search input field control.
        $this->start_controls_section(
            'search_section',
            [
                'label' => __('Search', 'strativ-widget'),
            ]
        );

        $this->add_control(
            'placeholder',
            [
                'label' => __('Placeholder', 'strativ-widget'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Search...', 'strativ-widget'),
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __('Icon', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::ICON,
                'default' => 'fas fa-search',
            ]
        );


        //add color
        $this->add_control(
            'search_color',
            [
                'label' => __('Color', 'strativ-widget'),
                'type' => Controls_Manager::COLOR,
                'default' => '#393A3D',
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-input' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Add the background color control.
        $this->add_control(
            'background_color',
            [
                'label' => __('Background Color', 'strativ-widget'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-input' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Add the border control.
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __('Border', 'strativ-widget'),
                'selector' => '{{WRAPPER}} .elementor-search-input',
            ]
        );

        // Add the border radius control.
        $this->add_responsive_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'strativ-widget'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-search-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Add the typography control.
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'label' => __('Typography', 'strativ-widget'),
                'selector' => '{{WRAPPER}} .elementor-search-input',
            ]
        );

        $this->end_controls_section();
    }

    // Widget frontend rendering.
    // ...

    // Widget frontend rendering.
    protected function render()
    {
        // Get the widget settings.
        $settings = $this->get_settings();
        $search_icon_style = "position: absolute; right: 10px; top: 50%; transform: translateY(-50%); pointer-events: none;";
        $search_wrapper_style = "position: relative;";
        $search_input_style = "padding-right: 30px;";

        // Get the search query.
        $search_query = isset($_GET['strativ_search']) ? sanitize_text_field($_GET['strativ_search']) : '';

        // Output the search form.
        echo '<div class="elementor-search-wrapper" style="' . $search_wrapper_style . '">';
        echo '<form method="get" action="' . esc_url(home_url('/')) . '" class="elementor-search-form">';
        echo '<input type="text" style="' . $search_input_style . '" name="strativ_search" value="' . esc_attr($search_query) . '" class="elementor-search-input" placeholder="' . $settings['placeholder'] . '" />';
        echo '<span class="elementor-search-icon" style="' . $search_icon_style . '"><i class="' . esc_attr($settings['icon']) . '"></i></span>';
        echo '</form>';
        echo '</div>';

        // Perform the search query.
        if (!empty($search_query)) {
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                's' => $search_query,
            );

            $search_results = new WP_Query($args);

            // Display search results.
            if ($search_results->have_posts()) {
                echo '<div class="elementor-search-results">';
                echo '<h3>' . __('Search Results', 'strativ-widget') . '</h3>';

                while ($search_results->have_posts()) {
                    $search_results->the_post();

                    echo '<h4><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h4>';
                    echo '<p>' . get_the_excerpt() . '</p>';
                }

                echo '</div>';
            } else {
                echo '<p>' . __('No results found.', 'strativ-widget') . '</p>';
            }

            // Restore original post data.
            wp_reset_postdata();
        }
    }
}
