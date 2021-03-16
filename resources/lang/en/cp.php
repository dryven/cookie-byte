<?php

	return [
		/* NAVIGATION */
		'navigation_item' => 'Cookie Byte',


		/* CONTROL PANEL */
		'title' => 'Cookie Byte settings',
		/** General tab **/
		'tab_general' => 'General',

		'enabled' => 'Enable cookie notice',
		'enabled_instructions' => '',

		'classes' => 'Cookie classes',
		'classes_instructions' => 'Cookie classes are categories into which cookies are divided. For example: essential, statistical and third party cookies.',
		'classes_add_row' => 'Add a cookie class',
		'class_title' => 'Name',
		'class_title_instructions' => 'Give it a concise name.',
		'class_title_placeholder' => '',
		'class_handle' => 'Handle',
		'class_handle_instructions' => 'The internal naming identifier.',
		'class_handle_placeholder' => '',
		'class_required' => 'Required',
		'class_required_instructions' => 'Are these cookies mandatory?',
		'class_description' => 'Description',
		'class_description_instructions' => 'This text is displayed in a tooltip. Gives the user an idea for what these cookies are used for.',
		'class_description_placeholder' => '',
		'class_code_snippets' => 'Code Snippets',
		'class_code_snippets_instructions' => 'These code snippets are executed as soon as the user agrees to the cookie class.',
		'class_code_snippets_add_row' => 'Add a code snippet',

		'developer_section' => 'Developer settings',
		'developer_section_instructions' => 'Attention: Danger looms ahead! This section is for experienced nerds and geeks only!',

		'custom_style' => 'Custom CSS styling',
		'custom_style_instructions' => 'Would you like to make the cookie modal your own? Flip this switch to customize our styles or start from scratch, just as you like it.',
		'custom_code' => 'Custom JavaScript code',
		'custom_code_instructions' => 'Need more control over the code on your site? Flip this switch to stop code from being added to your site automatically.',

		/** Modal tab **/
		'tab_modal' => 'Modal',
		'modal_section' => 'Modal',
		'modal_section_instructions' => 'The modal is displayed to the user on their first visit. Help them understand why cookies are needed on your page.',

		'modal_title' => 'Title',
		'modal_title_instructions' => 'That is a headline and generates a lot of attention. Use it accordingly.',
		'modal_title_placeholder' => 'Cookie settings',
		'modal_description' => 'Description',
		'modal_description_instructions' => 'Explain why your site needs cookies in the first place. Emotionalisation for the win.',
		'modal_description_placeholder' => 'Cookies help us to...',
		'modal_button_all' => '"Select all" button',
		'modal_button_all_instructions' => 'This button selects all cookie classes in one click.',
		'modal_button_all_placeholder' => 'Select all',
		'modal_button_selected' => '"Confirm selection" button',
		'modal_button_selected_instructions' => 'This button will just confirm the actual selection of the user.',
		'modal_button_selected_placeholder' => 'Confirm selection',
		'modal_horizontal_position' => 'Horizontal position',
		'modal_horizontal_position_instructions' => '',
		'modal_horizontal_position_placeholder' => 'center',
		'modal_horizontal_position_option_left' => 'left',
		'modal_horizontal_position_option_center' => 'center',
		'modal_horizontal_position_option_right' => 'right',
		'modal_vertical_position' => 'Vertical position',
		'modal_vertical_position_instructions' => '',
		'modal_vertical_position_placeholder' => 'center',
		'modal_vertical_position_option_top' => 'top',
		'modal_vertical_position_option_center' => 'center',
		'modal_vertical_position_option_bottom' => 'bottom',
		'modal_background' => 'Background type',
		'modal_background_instructions' => '',
		'modal_background_placeholder' => '',
		'modal_background_option_none' => 'Transparent background',
		'modal_background_option_light' => 'Light blurry background',
		'modal_background_option_heavy' => 'Dark blurry background',

		/** Covers Tab **/
		'tab_covers' => 'Covers',
		'covers_section' => 'Covers',
		'covers_section_instructions' => 'A cookie cover hides sections that cannot yet be displayed without cookie consent. You can create a whole bunch of them.',

		'covers' => 'Cookie covers',
		'covers_instructions' => 'Don\'t forget: Each of these cookie covers still has to be inserted into the code to be displayed.',
		'covers_add_row' => 'Add a cookie cover',
		'cover_handle' => 'Handle',
		'cover_handle_instructions' => 'The internal naming identifier.',
		'cover_handle_placeholder' => '',
		'cover_classes' => 'Cookie classes needed',
		'cover_classes_instructions' => 'Which cookie classes require consent to make the cover disappear?',
		'cover_classes_placeholder' => 'essential,thirdparty',
		'cover_title' => 'Title',
		'cover_title_instructions' => 'Another heading that will catch the eye of the user. Make it useful.',
		'cover_title_placeholder' => '',
		'cover_paragraph' => 'Paragraph',
		'cover_paragraph_instructions' => '',
		'cover_paragraph_placeholder' => '',
		'cover_button_accept' => '"Accept cookies" button',
		'cover_button_accept_instructions' => 'We thought it might be useful to make this button text special on every cover.',
		'cover_button_accept_placeholder' => 'Accept cookies',
		'cover_bg_image' => 'Background image',
		'cover_bg_image_instructions' => 'Show the user what to expect as soon as he accepts the cookies, so it doesn\'t look as boring.',
		'cover_bg_image_placeholder' => '/assets/images/cookie-cover.jpg',

		/* PERMISSIONS */
		'permission_settings' => 'Cookie Byte',
		'permission_general' => 'Configure settings',
		'permission_general_description' => 'Grants access to all Cookie Byte related permissions',
	];