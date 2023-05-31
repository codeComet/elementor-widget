<?php

use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Embed;
use Elementor\Plugin;
use Elementor\Icons_Manager;
use Elementor\Utils;




if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor video widget.
 *
 * Elementor widget that displays a video player.
 *
 * @since 1.0.0
 */
class Elementor_Strativ_Custom_Video_Widget extends \Elementor\Widget_Base
{

	/**
	 * Get widget name.
	 *
	 * Retrieve video widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'strativ-video';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve video widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Strativ Video', 'strativ-widget');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve video widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-youtube';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the video widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['basic'];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['video', 'player', 'embed', 'youtube', 'vimeo', 'dailymotion'];
	}


	/**
	 * Change the default Elementor placeholder image.
	 *
	 * Use an image located in an external URL.
	 *
	 * @since 1.0.0
	 */
	function custom_elementor_placeholder_image()
	{
		return 'https://developers.elementor.com/path/to/placeholder.png';
	}

	/**
	 * Register video widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function register_controls()
	{
		$this->start_controls_section(
			'section_video',
			[
				'label' => esc_html__('Video', 'strativ-widget'),
			]
		);

		$this->add_control(
			'strativ_video_type',
			[
				'label' => esc_html__('Source', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'youtube',
				'options' => [
					'youtube' => esc_html__('YouTube', 'strativ-widget'),
					'dailymotion' => esc_html__('Dailymotion', 'strativ-widget'),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'strativ_youtube_url',
			[
				'label' => esc_html__('Link', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'placeholder' => esc_html__('Enter your URL', 'strativ-widget') . ' (YouTube)',
				'default' => 'https://www.youtube.com/watch?v=XHOmBV4js_E',
				'label_block' => true,
				'condition' => [
					'strativ_video_type' => 'youtube',
				],
				'frontend_available' => true,
			]
		);


		$this->add_control(
			'strativ_dailymotion_url',
			[
				'label' => esc_html__('Link', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'placeholder' => esc_html__('Enter your URL', 'strativ-widget') . ' (Dailymotion)',
				'default' => 'https://www.dailymotion.com/video/x6tqhqb',
				'label_block' => true,
				'condition' => [
					'strativ_video_type' => 'dailymotion',
				],
			]
		);

		$this->add_control(
			'strativ_insert_url',
			[
				'label' => esc_html__('External URL', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'condition' => [
					'strativ_video_type' => 'hosted',
				],
			]
		);


		$this->add_control(
			'strativ_video_options',
			[
				'label' => esc_html__('Video Options', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'strativ_video_autoplay',
			[
				'label' => esc_html__('Autoplay', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'strativ_video_show_image_overlay',
							'value' => '',
						],
						[
							'name' => 'strativ_video_image_overlay[url]',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'strativ_play_on_mobile',
			[
				'label' => esc_html__('Play On Mobile', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'condition' => [
					'strativ_video_autoplay' => 'yes',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'strativ_mute',
			[
				'label' => esc_html__('Mute', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'strativ_loop',
			[
				'label' => esc_html__('Loop', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'condition' => [
					'strativ_video_type!' => 'dailymotion',
				],
				'frontend_available' => true,
			]
		);


		$this->add_control(
			'strativ_video_controls',
			[
				'label' => esc_html__('Player Controls', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => esc_html__('Hide', 'strativ-widget'),
				'label_on' => esc_html__('Show', 'strativ-widget'),
				'default' => 'yes',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'strativ_video_showinfo',
			[
				'label' => esc_html__('Video Info', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => esc_html__('Hide', 'strativ-widget'),
				'label_on' => esc_html__('Show', 'strativ-widget'),
				'default' => 'yes',
				'condition' => [
					'strativ_video_type' => ['dailymotion'],
				],
			]
		);

		$this->add_control(
			'strativ_video_logo',
			[
				'label' => esc_html__('Logo', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => esc_html__('Hide', 'strativ-widget'),
				'label_on' => esc_html__('Show', 'strativ-widget'),
				'default' => 'yes',
				'condition' => [
					'strativ_video_type' => ['dailymotion'],
				],
			]
		);

		// YouTube.
		$this->add_control(
			'strativ_yt_privacy',
			[
				'label' => esc_html__('Privacy Mode', 'elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'description' => esc_html__('When you turn on privacy mode, YouTube/Vimeo won\'t store information about visitors on your website unless they play the video.', 'elementor'),
				'condition' => [
					'strativ_video_type' => ['youtube'],
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'strativ_lazy_load',
			[
				'label' => esc_html__('Lazy Load', 'elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'strativ_video_type',
							'operator' => '===',
							'value' => 'youtube',
						]
					],
				],
				'frontend_available' => true,
			]
		);


		$this->add_control(
			'strativ_video_color',
			[
				'label' => esc_html__('Controls Color', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'video_type' => ['dailymotion'],
				],
			]
		);

		$this->add_control(
			'strativ_video_poster',
			[
				'label' => esc_html__('Poster', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'strativ_video_type' => 'youtube',
				],
			]
		);

		$this->add_control(
			'strativ_video_view',
			[
				'label' => esc_html__('View', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'default' => 'youtube',
			]
		);


		$this->end_controls_section();



		$this->start_controls_section(
			'strativ_video_section_image_overlay',
			[
				'label' => esc_html__('Image Overlay', 'strativ-widget'),
			]
		);

		$this->add_control(
			'strativ_video_show_image_overlay',
			[
				'label' => esc_html__('Image Overlay', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => esc_html__('Hide', 'strativ-widget'),
				'label_on' => esc_html__('Show', 'strativ-widget'),
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'strativ_video_image_overlay',
			[
				'label' => esc_html__('Choose Image', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => $this->custom_elementor_placeholder_image(),
				],
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'strativ_video_show_image_overlay' => 'yes',
				],
				'frontend_available' => true,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'strativ_video_image_overlay', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_overlay_size` and `image_overlay_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
				'condition' => [
					'strativ_video_show_image_overlay' => 'yes',
				],
			]
		);

		$this->add_control(
			'strativ_video_show_play_icon',
			[
				'label' => esc_html__('Play Icon', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'strativ_video_show_image_overlay' => 'yes',
					'strativ_video_image_overlay[url]!' => '',
				],
			]
		);

		$this->add_control(
			'strativ_video_play_icon',
			[
				'label' => esc_html__('Icon', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
				'skin_settings' => [
					'inline' => [
						'none' => [
							'label' => 'Default',
							'icon' => 'eicon-play',
						],
						'icon' => [
							'icon' => 'eicon-star',
						],
					],
				],
				'recommended' => [
					'fa-regular' => [
						'play-circle',
					],
					'fa-solid' => [
						'play',
						'play-circle',
					],
				],
				'condition' => [
					'strativ_video_show_image_overlay' => 'yes',
					'strativ_video_show_play_icon!' => '',
				],
			]
		);


		$this->add_control(
			'strativ_video_lightbox',
			[
				'label' => esc_html__('Lightbox', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'label_off' => esc_html__('Off', 'elementor'),
				'label_on' => esc_html__('On', 'elementor'),
				'condition' => [
					'strativ_video_show_image_overlay' => 'yes',
					'strativ_video_image_overlay[url]!' => '',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'strativ_video_section_header',
			[
				'label' => esc_html__('Header', 'strativ-widget'),
			]
		);


		// video header
		$this->add_control(
			'video_title',
			[
				'label' => __('Video header title', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Video header title', 'strativ-widget'),
				'placeholder' => __('Enter your Video header title', 'strativ-widget'),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'video_header_alignment',
			[
				'label' => esc_html__('Align', 'strativ-widget'),
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
				],
				'default' => 'left',
				'toggle' => true,
			]
		);


		$this->end_controls_section();





		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__('Button', 'strativ-widget'),
			]
		);




		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Button Text', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Click Me', 'strativ-widget'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label' => esc_html__('Button Icon', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
			]
		);


		$this->add_control(
			'button_icon_position',
			[
				'label' => esc_html__('Icon Position', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'left' => esc_html__('Left', 'strativ-widget'),
					'right' => esc_html__('Right', 'strativ-widget'),
				],
				'default' => 'right',
			]
		);

		$this->add_control(
			'video_button_alignment',
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
				],
				'default' => 'right',
				'toggle' => true,
			]
		);



		$this->end_controls_section();


		$this->start_controls_section(
			'section_footer',
			[
				'label' => esc_html__('Footer', 'strativ-widget'),
			]
		);


		$this->add_control(
			'video_footer_title',
			[
				'label' => esc_html__('Footer Text', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Lorem Ipsum', 'strativ-widget'),
				'label_block' => true,
			]
		);

		$this->end_controls_section();









		// STYLES TAB


		$this->start_controls_section(
			'strativ_video_section_video_style',
			[
				'label' => esc_html__('Video', 'strativ-widget'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'strativ_video_aspect_ratio',
			[
				'label' => esc_html__('Aspect Ratio', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'169' => '16:9',
					'219' => '21:9',
					'43' => '4:3',
					'32' => '3:2',
					'11' => '1:1',
					'916' => '9:16',
				],
				'selectors_dictionary' => [
					'169' => '16 / 9',
					'219' => '21 / 9',
					'43' => '4 / 3',
					'32' => '3 / 2',
					'11' => '1 / 1',
					'916' => '9 / 16',
				],
				'default' => '169',
				'selectors' => [
					'{{WRAPPER}} .elementor-wrapper' => 'aspect-ratio: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .elementor-wrapper',
			]
		);

		$this->add_control(
			'play_icon_title',
			[
				'label' => esc_html__('Play Icon', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'strativ_video_show_image_overlay' => 'yes',
					'strativ_video_show_play_icon' => 'yes',
				],
				'separator' => 'before',
			]
		);


		$this->add_control(
			'strativ_video_play_icon_color',
			[
				'label' => esc_html__('Color', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-custom-embed-play i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .elementor-custom-embed-play svg' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'strativ_video_show_image_overlay' => 'yes',
					'strativ_video_show_play_icon' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'strativ_video_play_icon_size',
			[
				'label' => esc_html__('Size', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 300,
					],
				],
				'selectors' => [
					// Not using a CSS vars because the default size value is coming from a global scss file.
					'{{WRAPPER}} .elementor-custom-embed-play i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .elementor-custom-embed-play svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'strativ_video_show_image_overlay' => 'yes',
					'strativ_video_show_play_icon' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'strativ_video_play_icon_text_shadow',
				'selector' => '{{WRAPPER}} .elementor-custom-embed-play i',
				'fields_options' => [
					'text_shadow_type' => [
						'label' => esc_html_x('Shadow', 'Text Shadow Control', 'strativ-widget'),
					],
				],
				'condition' => [
					'strativ_video_show_image_overlay' => 'yes',
					'strativ_video_show_play_icon' => 'yes',
					'strativ_video_play_icon[library]!' => 'svg',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'strativ_video_section_lightbox_style',
			[
				'label' => esc_html__('Lightbox', 'strativ-widget'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'strativ_video_show_image_overlay' => 'yes',
					'strativ_video_image_overlay[url]!' => '',
					'strativ_video_lightbox' => 'yes',
				],
			]
		);

		$this->add_control(
			'strativ_video_lightbox_video_width',
			[
				'label' => esc_html__('Content Width', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 30,
					],
				],
				'selectors' => [
					'(desktop+)#elementor-lightbox-{{ID}} .elementor-video-container' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'strativ_video_lightbox_content_position',
			[
				'label' => esc_html__('Content Position', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'frontend_available' => true,
				'options' => [
					'' => esc_html__('Center', 'strativ-widget'),
					'top' => esc_html__('Top', 'strativ-widget'),
				],
				'selectors' => [
					'#elementor-lightbox-{{ID}} .elementor-video-container' => '{{VALUE}}; transform: translateX(-50%);',
				],
				'selectors_dictionary' => [
					'top' => 'top: 60px',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'strativ_video_section_header_style',
			[
				'label' => esc_html__('Header', 'strativ-widget'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_responsive_control(
			'video_header_padding',
			[
				'label' => esc_html__('Padding', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .video-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'video_info_bg_color',
			[
				'label' => __('Header Background Color', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .video-info' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'video_title_typography',
				'label' => __('Video title typography', 'strativ-widget'),
				'selector' => '{{WRAPPER}} h4'
			]
		);

		$this->add_control(
			'video_title_color',
			[
				'label' => __('Title Color', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} h4' => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'strativ_video_section_Button_style',
			[
				'label' => esc_html__('Footer', 'strativ-widget'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'video_footer_title',
				'label' => __('Footer title typography', 'strativ-widget'),
				'selector' => '{{WRAPPER}} .video_footer_title'
			]
		);

		$this->add_control(
			'video_footer_title_color',
			[
				'label' => __('Footer title Color', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .video_footer_title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'video_footer_bg_color',
			[
				'label' => esc_html__('Footer Background Color', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-footer' => 'background-color: {{VALUE}}',
				],
			]
		);



		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'video_button_typography',
				'label' => __('Button typography', 'strativ-widget'),
				'selector' => '{{WRAPPER}} .play-button'
			]
		);

		$this->add_control(
			'video_button_color',
			[
				'label' => esc_html__('Button Text Color', 'elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-button' => 'color: {{VALUE}}',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'video_button_bg_color',
			[
				'label' => esc_html__('Button Background Color', 'elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-button' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'video_button_border',
				'selector' => '{{WRAPPER}} .play-button',
			]
		);

		$this->add_control(
			'video_button_border_radius',
			[
				'label' => esc_html__('Border Radius', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .play-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'video_button_padding',
			[
				'label' => esc_html__('Button Padding', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .play-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		// Video footer padding
		$this->add_responsive_control(
			'footer_padding',
			[
				'label' => esc_html__('Footer Padding', 'strativ-widget'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .video-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();
	}


	public function print_a11y_text($image_overlay)
	{
		if (empty($image_overlay['alt'])) {
			echo esc_html__('Play Video', 'elementor');
		} else {
			echo esc_html__('Play Video about', 'elementor') . ' ' . esc_attr($image_overlay['alt']);
		}
	}

	/**
	 * Render video widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		// var_dump($settings);

		$video_url = $settings['strativ_' . $settings['strativ_video_type'] . '_url'];

		if ('hosted' === $settings['strativ_video_type']) {
			$video_url = $this->get_hosted_video_url();
		} else {
			$embed_params = $this->get_embed_params();
			$embed_options = $this->get_embed_options();
		}

		if (empty($video_url)) {
			return;
		}


		if ('youtube' === $settings['strativ_video_type']) {
			$video_html = '<div class="elementor-video"></div>';
		}

		if ('hosted' === $settings['strativ_video_type']) {
			$this->add_render_attribute('video-wrapper', 'class', 'e-hosted-video');

			ob_start();

			$this->render_hosted_video();

			$video_html = ob_get_clean();
		} else {
			$is_static_render_mode = Plugin::$instance->frontend->is_static_render_mode();
			$post_id = get_queried_object_id();

			if ($is_static_render_mode) {
				$video_html = Embed::get_embed_thumbnail_html($video_url, $post_id);
				// YouTube API requires a different markup which was set above.
			} else if ('youtube' !== $settings['strativ_video_type']) {
				$video_html = Embed::get_embed_html($video_url, $embed_params, $embed_options);
			}
		}



		if (empty($video_html)) {
			echo esc_url($video_url);

			return;
		}

		$this->add_render_attribute('video-wrapper', 'class', 'elementor-wrapper');

		$this->add_render_attribute('video-wrapper', 'class', 'elementor-open-' . ($settings['strativ_video_lightbox'] ? 'lightbox' : 'inline'));
?>


		<!-- Header part -->
		<div class="custom-video-card">
			<div class="video-info" style="text-align: <?php echo esc_attr($settings['video_header_alignment']); ?>;">
				<h4 style="margin: 0"><?php echo $settings['video_title']; ?></h4>
			</div>

			<!-- Video part -->
			<div <?php $this->print_render_attribute_string('video-wrapper'); ?>>
				<?php
				if (!$settings['strativ_video_lightbox']) {
					Utils::print_unescaped_internal_string($video_html); // XSS ok.
				}

				if ($this->has_image_overlay()) {
					$this->add_render_attribute('image-overlay', 'class', 'elementor-custom-embed-image-overlay');

					if ($settings['strativ_video_lightbox']) {
						if ('hosted' === $settings['strativ_video_type']) {
							$lightbox_url = $video_url;
						} else {
							$lightbox_url = Embed::get_embed_url($video_url, $embed_params, $embed_options);
						}

						$lightbox_options = [
							'type' => 'video',
							'videoType' => $settings['strativ_video_type'],
							'url' => $lightbox_url,
							'modalOptions' => [
								'id' => 'elementor-lightbox-' . $this->get_id(),
								'videoAspectRatio' => $settings['strativ_video_aspect_ratio'],
							],
						];

						if ('hosted' === $settings['strativ_video_type']) {
							$lightbox_options['videoParams'] = $this->get_hosted_params();
						}

						$this->add_render_attribute('image-overlay', [
							'data-elementor-open-lightbox' => 'yes',
							'data-elementor-lightbox' => wp_json_encode($lightbox_options),
							'data-e-action-hash' => Plugin::instance()->frontend->create_action_hash('lightbox', $lightbox_options),
						]);

						if (Plugin::$instance->editor->is_edit_mode()) {
							$this->add_render_attribute('image-overlay', [
								'class' => 'elementor-clickable',
							]);
						}
					} else {
						// When there is an image URL but no ID, it means the overlay image is the placeholder. In this case, get the placeholder URL.
						if (empty($settings['strativ_video_image_overlay']['id'] && !empty($settings['strativ_video_image_overlay']['url']))) {
							$image_url = $settings['strativ_video_image_overlay']['url'];
						} else {
							$image_url = Group_Control_Image_Size::get_attachment_image_src($settings['strativ_video_image_overlay']['id'], 'strativ_video_image_overlay', $settings);
						}

						$this->add_render_attribute('image-overlay', 'style', 'background-image: url(' . $image_url . ');');
					}
				?>
					<div <?php $this->print_render_attribute_string('image-overlay'); ?>>
						<?php if ($settings['strativ_video_lightbox']) : ?>
							<?php Group_Control_Image_Size::print_attachment_image_html($settings, 'strativ_video_image_overlay'); ?>
						<?php endif; ?>
						<?php if ('yes' === $settings['strativ_video_show_play_icon']) : ?>
							<div class="elementor-custom-embed-play" role="button" aria-label="<?php $this->print_a11y_text($settings['strativ_video_image_overlay']); ?>" tabindex="0">
								<?php
								if (empty($settings['strativ_video_play_icon']['value'])) {
									$settings['strativ_video_play_icon'] = [
										'library' => 'eicons',
										'value' => 'eicon-play',
									];
								}
								Icons_Manager::render_icon($settings['strativ_video_play_icon'], ['aria-hidden' => 'true']);
								?>
								<span class="elementor-screen-only"><?php $this->print_a11y_text($settings['strativ_video_image_overlay']); ?></span>
							</div>
						<?php endif; ?>
					</div>
				<?php } ?>
			</div>

			<!-- card footer -->
			<div class="video-footer" style="margin-top: -20px">
				<h2 class="video_footer_title"><?php echo esc_attr($settings['video_footer_title']); ?></h2>
				<div class="btn-container" style="text-align: <?php echo esc_attr($settings['video_button_alignment']); ?>;">
					<button class="play-button" style="cursor: pointer;" data-elementor-open-lightbox="yes" data-elementor-lightbox="<?php echo esc_attr(wp_json_encode($lightbox_options)); ?>" data-e-action-hash="<?php echo esc_attr(Plugin::instance()->frontend->create_action_hash('lightbox', $lightbox_options)); ?>">
						<?php if ($settings['button_icon_position'] === 'left' && $settings['button_icon']['value']) : ?>
							<i class="<?php echo esc_attr($settings['button_icon']['value']); ?>"></i>
						<?php endif; ?>
						<?php echo esc_html($settings['button_text']); ?>
						<?php if ($settings['button_icon_position'] === 'right' && $settings['button_icon']['value']) : ?>
							<i class="<?php echo esc_attr($settings['button_icon']['value']); ?>"></i>
						<?php endif; ?>
					</button>
				</div>
			</div>
		</div>
<?php

	}

	/**
	 * @param bool $from_media
	 *
	 * @return string
	 * @since 2.1.0
	 * @access private
	 */
	private function get_hosted_video_url()
	{
		$settings = $this->get_settings_for_display();

		if (!empty($settings['strativ_insert_url'])) {
			$video_url = $settings['external_url']['url'];
		} else {
			$video_url = $settings['strativ_hosted_url']['url'];
		}

		if (empty($video_url)) {
			return '';
		}

		if ($settings['start'] || $settings['end']) {
			$video_url .= '#t=';
		}

		if ($settings['start']) {
			$video_url .= $settings['start'];
		}

		if ($settings['end']) {
			$video_url .= ',' . $settings['end'];
		}

		return $video_url;
	}


	/**
	 * Get embed params.
	 *
	 * Retrieve video widget embed parameters.
	 *
	 * @since 1.5.0
	 * @access public
	 *
	 * @return array Video embed parameters.
	 */
	public function get_embed_params()
	{
		$settings = $this->get_settings_for_display();

		$params = [];

		if ($settings['strativ_video_autoplay'] && !$this->has_image_overlay()) {
			$params['strativ_video_autoplay'] = '1';

			if ($settings['strativ_play_on_mobile']) {
				$params['playsinline'] = '1';
			}
		}

		$params_dictionary = [];

		if ('youtube' === $settings['strativ_video_type']) {
			$params_dictionary = [
				'strativ_loop',
				'strativ_mute',
				'strativ_video_controls'
			];

			if ($settings['strativ_loop']) {
				$video_properties = Embed::get_video_properties($settings['strativ_youtube_url']);

				// var_dump($video_properties);_

				$params['playlist'] = $video_properties['video_id'];
			}

			$params['start'] = $settings['start'] ?? 0;

			$params['end'] = $settings['end'] ?? 0;

			$params['wmode'] = 'opaque';
		} elseif ('dailymotion' === $settings['strativ_video_type']) {
			$params_dictionary = [
				'strativ_video_controls',
				'strativ_mute',
				'strativ_video_showinfo' => 'ui-start-screen-info',
				'strativ_video_logo' => 'ui-logo',
			];

			$params['ui-highlight'] = str_replace('#', '', $settings['color']);

			$params['start'] = $settings['start'] ?? 0;

			$params['endscreen-enable'] = '0';
		}

		foreach ($params_dictionary as $key => $param_name) {

			// var_dump($param_name);

			$setting_name = $param_name;

			if (is_string($key)) {
				$setting_name = $key;
			}

			$setting_value = $settings[$setting_name] ? '1' : '0';

			$params[$param_name] = $setting_value;
		}

		return $params;
	}


	/**
	 * @since 2.1.0
	 * @access private
	 */
	private function get_embed_options()
	{
		$settings = $this->get_settings_for_display();

		$embed_options = [];

		if ('youtube' === $settings['strativ_video_type']) {
			$embed_options['privacy'] = $settings['strativ_yt_privacy'];
		} elseif ('vimeo' === $settings['strativ_video_type']) {
			$embed_options['start'] = $settings['start'] ?? 0;
		}

		$embed_options['lazy_load'] = !empty($settings['strativ_lazy_load']);

		return $embed_options;
	}

	/**
	 * Whether the video widget has an overlay image or not.
	 *
	 * Used to determine whether an overlay image was set for the video.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return bool Whether an image overlay was set for the video.
	 */
	protected function has_image_overlay()
	{
		$settings = $this->get_settings_for_display();

		return !empty($settings['strativ_video_image_overlay']['url']) && 'yes' === $settings['strativ_video_show_image_overlay'];
	}
}
