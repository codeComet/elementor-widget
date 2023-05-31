<?php

use Elementor\Widget_Base;

class Elementor_Strativ_Modal_Button_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'elementor-modal-button-widget';
    }

    public function get_title()
    {
        return __('Strativ Modal Button', 'strativ-widget');
    }

    public function get_icon()
    {
        return 'eicon-button';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'strativ-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'modal_button_text',
            [
                'label' => __('Button Text', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Open Modal', 'strativ-widget'),
            ]
        );

        $this->add_control(
            'modal_button_alignment',
            [
                'label' => esc_html__('Button Alignment', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'strativ-widget'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'strativ-widget'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'strativ-widget'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justify', 'strativ-widget'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'right',
                'toggle' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'modal_section_content',
            [
                'label' => __('Style', 'strativ-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );




        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'modal_button_typography',
                'label' => __('Button typography', 'strativ-widget'),
                'selector' => '{{WRAPPER}} .submit-btn'
            ]
        );

        $this->add_control(
            'modal_button_bg_color',
            [
                'label' => esc_html__('Background Color', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .submit-btn' => 'background-color: {{VALUE}}',
                ],

            ]
        );

        //add color
        $this->add_control(
            'modal_button_color',
            [
                'label' => __('Color', 'strativ-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#393A3D',
                'selectors' => [
                    '{{WRAPPER}} .submit-btn' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'modal_button_border',
                'selector' => '{{WRAPPER}} .submit-btn',
            ]
        );

        $this->add_control(
            'modal_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .submit-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'modal_button_padding',
            [
                'label' => esc_html__('Padding', 'elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .submit-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $justified = $settings['modal_button_alignment'] === 'justify' ? "width: 100%" : '';
        $id = mt_rand(0, 999999);

?>
        <div style="text-align: <?php echo esc_attr($settings['modal_button_alignment']); ?>;">

            <button class="elementor-modal-button submit-btn" style="<?php echo $justified; ?>;"><?php echo $settings['modal_button_text']; ?></button>
        </div>
        <div class="elementor-modal">
            <div class="elementor-modal-content">
                <span class="elementor-modal-close">&times;</span>
                <!-- <div class="elementor-modal-overlay"></div> -->
                <div class="elementor-modal-form-container">
                    <form class="elementor-modal-form" id="myForm<?php echo $id; ?>">
                        <div class="elementor-form-header">
                            <h3 class="form-title">Sugar sugar!</h3>
                            <p class="form-subtitle">Fill in your details here</p>
                        </div>

                        <div class="elementor-form-row">
                            <div class="elementor-form-field">
                                <label for="first_name">First Name:</label>
                                <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
                            </div>
                            <div class="elementor-form-field">
                                <label for="last_name">Last Name:</label>
                                <input type="text" id="last_name" name="last_name" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="elementor-form-row">
                            <div class="elementor-form-field">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="elementor-form-row">
                            <div class="elementor-form-field">
                                <label for="phone">Phone:</label>
                                <input type="tel" id="phone" name="phone" placeholder="Phone" required>
                            </div>
                        </div>
                        <div class="elementor-form-row form-footer">
                            <div class="elementor-form-field" style="text-align: right;">
                                <input type="submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Success Modal -->

        <div class="success-modal">
            <div class="elementor-modal-success-content">
                <span class="elementor-modal-close" id="close<?php echo $id; ?>" style="color: #fff">&times;</span>
                <!-- <div class="elementor-modal-overlay"></div> -->
                <div class="elementor-modal-success-container">
                    <h1 class="success-title">Let it rain!</h1>
                    <h1 class="success-text">We received your request and will be in touch shortly.</h1>
                </div>
            </div>
        </div>



        <style>
            .elementor-form-header {
                text-align: left;
                padding: 20px 40px 10px;
            }

            .form-title {
                font-family: 'Merriweather';
                font-style: normal;
                font-weight: 400;
                font-size: 28px;
                line-height: 36px;
                color: #564FC0;
                margin-bottom: 10px;
            }

            .form-subtitle {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                font-size: 18px;
                line-height: 22px;
                color: #393A3D;
            }

            .elementor-modal,
            .success-modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .elementor-modal-content,
            .elementor-modal-success-content {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: #fff;
                border-radius: 5px;
                text-align: center;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
                z-index: 9999;
            }

            .elementor-modal-close {
                position: absolute;
                top: 10px;
                right: 10px;
                font-size: 20px;
                color: #999;
                cursor: pointer;
            }

            .elementor-modal-form-container {
                margin-top: 20px;
            }

            .elementor-modal-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                /* background-color: rgba(255, 255, 255, 0.9); */
            }

            .elementor-form-row {
                display: flex;
                margin-bottom: 10px;
                padding: 15px 40px 0;
            }

            .elementor-form-row:last-child {
                padding: 0 40px;
                margin-top: 40px;
            }

            .elementor-form-field {
                flex: 1;
                margin-right: 10px;
            }

            .elementor-form-field label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
                text-align: left;
            }

            .elementor-modal-form input[type="text"],
            .elementor-modal-form input[type="email"],
            .elementor-modal-form input[type="tel"] {
                width: 100%;
                padding: 8px;
                border: 1px solid #97979740;
                border-radius: 4px;
                background-color: #BBB7FF1A;
            }

            .elementor-modal-form input[type="submit"] {
                padding: 8px 16px;
                background: transparent;
                color: #fff;
                margin: 24px 0;
                border: 1px solid #fff;
                border-radius: 22px;
                cursor: pointer;
            }


            .form-footer {
                background: linear-gradient(180deg, #8E87E1 0%, #564FC0 100%);
                margin-bottom: 0;
            }

            .success-title {
                font-family: 'Merriweather';
                font-style: normal;
                font-weight: 400;
                font-size: 28px;
                line-height: 36px;
                text-align: center;
                color: #FFFFFF;
            }

            .success-text {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                font-size: 18px;
                line-height: 22px;
                text-align: center;
                color: #BBB7FF;

            }

            .elementor-modal-success-content {
                background: linear-gradient(180deg, #8E87E1 0%, #564FC0 100%);
                padding: 50px;
            }
        </style>
        <script>
            jQuery(document).ready(function($) {
                // Open modal on button click
                $('.elementor-modal').hide();
                $('.success-modal').hide();
                $('.elementor-modal-button').on('click', function(e) {
                    e.preventDefault();
                    $('.elementor-modal').fadeIn();
                });

                // Close modal on close button click
                $('.elementor-modal-close').on('click', function(e) {
                    e.preventDefault();
                    $('.elementor-modal').fadeOut();
                    // Reset form and success message
                    $('#myForm<?php echo $id; ?>')[0].reset();
                    $('.success-modal').hide();
                });

                $('#close<?php echo $id; ?>').on('click', function(e) {
                    e.preventDefault();
                    $('.success-modal').hide();
                });

                // Form submission
                $('#myForm<?php echo $id; ?>').on('submit', function(e) {
                    e.preventDefault();

                    // Hide the form
                    $('.elementor-modal').hide();

                    // Show the success modal
                    $('.success-modal').fadeIn();
                });
            });
        </script>

<?php
    }
}
