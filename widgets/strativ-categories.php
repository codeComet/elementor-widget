<?php

if (!defined('ABSPATH')) {
    exit;
}

// Include the Elementor widget classes.
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Category List Widget.
class Elementor_Strativ_Category_Widget extends Widget_Base
{
    /**
     * Get widget name.
     *
     * Retrieve currency widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'strativ-category-widget';
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
    public function get_title()
    {
        return esc_html__('Strativ Category List', 'strativ-widget');
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
    public function get_icon()
    {
        return 'eicon-editor-list-ul';
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

    public function get_custom_help_url()
    {
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
    public function get_categories()
    {
        return ['basic'];
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

    public function get_keywords()
    {
        return ['category', 'list', 'strativ'];
    }

    // Widget control settings.
    protected function _register_controls()
    {
        $this->start_controls_section(
            'layout_section',
            [
                'label' => __('Layout', 'strativ-widget'),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('Layout', 'strativ-widget'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'vertical' => __('Vertical', 'strativ-widget'),
                    'horizontal' => __('Horizontal', 'strativ-widget'),
                ],
                'default' => 'vertical',
            ]
        );

        $this->add_responsive_control(
            'list_padding',
            [
                'label' => __('Padding', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'list_color',
            [
                'label' => __('Color', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} li a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'list_typography',
                'label' => __('List typography', 'strativ-widget'),
                'selector' => '{{WRAPPER}} li a'
            ]
        );

        $this->end_controls_section();
    }

    // Widget frontend rendering.
    protected function render()
    {

        // Get the widget settings.
        $settings = $this->get_settings();

        // Get the list of categories.
        $categories = get_terms('category', array(
            'exclude' => '1',
            'hide_empty' => false,
        ));

        // Set the list style based on the selected layout.
        $list_style = $settings['layout'] === 'horizontal' ? 'list-style-type: none;' : '';
        $orientation = $settings['layout'] === 'horizontal' ? 'display: flex; justify-content: flex-start; padding: 0' : '';

        // Output the category list.
        echo '<ul style="' . $list_style . '' . $orientation . ';">';

        foreach ($categories as $category) {
            // var_dump($category);
            $category_link = get_category_link($category->term_id); // Get the category link
            echo '<li><a href="' . $category_link . '">' . $category->name . '</a></li>';
        }
        echo '</ul>';
    }

}
