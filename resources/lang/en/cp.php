<?php

return [
	'cookie_byte' => 'Cookie Byte',

	/* NAVIGATION */
	'navigation_item' => 'Cookie Byte',


	/* CONTROL PANEL */
	'title' => 'Cookie Byte settings',
	/** General tab **/
	'tab_general' => 'General',

	'enabled' => 'Enable Cookie Byte',
	'enabled_instructions' => '',

	'categories' => 'Cookie categories',
	'categories_instructions' => 'Cookie categories divide the cookies used on the website into categories that can be accepted by website visitors. For example: Essential cookies, statistical cookies, marketing cookies.',
	'categories_add_row' => 'Add a cookie category',
	'category_title' => 'Name',
	'category_title_instructions' => 'Name of the cookie category (this is displayed on the website).',
	'category_title_placeholder' => 'Example cookies',
	'category_handle' => 'Handle',
	'category_handle_instructions' => 'This is the internal name for the cookie category.',
	'category_handle_placeholder' => 'example',
	'category_required' => 'Required',
	'category_required_instructions' => 'Are these cookies mandatory for navigating the website?',
	'category_description' => 'Description',
	'category_description_instructions' => 'Give users an idea for what these cookies are used for (this is displayed on the website in a tooltip).',
	'category_description_placeholder' => 'Example cookies are used to ...',
	'category_code_snippets' => 'Code snippets',
	'category_code_snippets_instructions' => 'These code snippets are executed as soon as the user accepts this cookie category. For example: Add the code snippet of you analysis tool to the cookies category "Statistical cookies" so that the analysis tool is only tracking as soon as the user accepts the "Statistical cookies".',
	'category_code_snippets_add_row' => 'Add a code snippet',

	'developer_section' => 'Developer settings',
	'developer_section_instructions' => 'Beware: Developer settings ahead! This section is for experienced nerds and geeks only - in case of doubt, please consult a developer friend (or the documentation of this addon).',

	'custom_style' => 'Custom CSS styling',
	'custom_style_instructions' => 'Would you like to make the cookie modal your own? Flip this switch to customize our styles or start from scratch, whatever takes your fancy!',
	'custom_code' => 'Custom JavaScript code',
	'custom_code_instructions' => 'Don\'t want code added to your website automatically by the addon? Flip this switch and regain full control over your code! You can then manually integrate the addon into your website via custom JavaSript code.',

	/** Modal tab **/
	'tab_modal' => 'Modal',
	'modal_section' => 'Cookie modal',
	'modal_section_instructions' => 'The cookie modal is displayed to the user when they visit the website. The user is informed about the cookies used on the website and can accept them. All information on this page is displayed on the website.',

	'modal_title' => 'Headline',
	'modal_title_instructions' => 'This is the headline of the cookie modal and generates a lot of attention. Use it accordingly!',
	'modal_title_placeholder' => 'Cookie settings',
	'modal_description' => 'Description',
	'modal_description_instructions' => 'Explain why your website needs cookies in the first place. Tip: Emotionalisation for the win.',
	'modal_description_placeholder' => 'We use cookies to give you ...',
	'modal_button_all' => 'Button "Select all"',
	'modal_button_all_instructions' => 'With this button, users accept all categories - with just one click!',
	'modal_button_all_placeholder' => 'Select all',
	'modal_button_selected' => 'Button "Confirm selection"',
	'modal_button_selected_instructions' => 'With this button the user accepts the selection he/she has made.',
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
	'modal_background' => 'Background',
	'modal_background_instructions' => '',
	'modal_background_placeholder' => '',
	'modal_background_option_none' => 'Transparent background',
	'modal_background_option_light' => 'Light blurred background',
	'modal_background_option_heavy' => 'Dark blurred background',

	/** Covers Tab **/
	'tab_covers' => 'Content covers',
	'covers_section' => 'Cookie content covers',
	'covers_section_instructions' => 'Some content must be hidden as long as the corresponding cookies have not been accepted, such as Google Maps embeds. For this you can configure cookie content covers. You can create a whole bunch of them.',

	'covers' => 'Cookie content covers',
	'covers_instructions' => 'Please note: Each of these cookie content covers must be inserted into the website\'s code in order to work. More details on how this works can be found in the addon\'s documentation.',
	'covers_add_row' => 'Add a cookie content cover',
	'cover_handle' => 'Handle',
	'cover_handle_instructions' => 'This is the internal name for the cookie category.',
	'cover_handle_placeholder' => 'example',
	'cover_categories' => 'Cookie categories to be accepted',
	'cover_categories_instructions' => 'Which cookie categories must be accepted by the user for the cookie content cover to magically disappear?',
	'cover_name' => 'Name',
	'cover_name_instructions' => 'Internal description (does not appear on the website)',
	'cover_name_placeholder' => 'Cover for Google Maps',
	'cover_title' => 'Headline of the cookie content cover',
	'cover_title_instructions' => 'Another headline (it is displayed on the website) that will catch the eye of the user. Make it useful!',
	'cover_title_placeholder' => 'This content can not be displayed.',
	'cover_paragraph' => 'Paragraph',
	'cover_paragraph_instructions' => 'Give users info on what they need to do to view the content (this is displayed on the website).',
	'cover_paragraph_placeholder' => 'Please accept the cookies.',
	'cover_button_accept' => 'Button "Accept cookies"',
	'cover_button_accept_instructions' => 'This button is displayed on every cookie content cover to provide users with a shortcut to accept the cookies.',
	'cover_button_accept_placeholder' => 'Accept cookies',
	'cover_bg_image' => 'Background image',
	'cover_bg_image_instructions' => 'Give users a sneak peak of what to expect after they accept the cookies. To make the exciting Cookie Consent Cover even more exciting!',
	'cover_bg_image_placeholder' => '/assets/images/cookie-cover.jpg',

	/* PERMISSIONS */
	'permission_settings' => 'Cookie Byte',
	'permission_general' => 'Configure settings',
	'permission_general_description' => 'Grants access to all Cookie Byte related permissions',

	/* LICENSING */
	'licensing_warning' => 'You use an unlicensed copy of Cookie Byte. You must purchase a license for using this addon.',
	'licensing_buy_button' => 'Get a license',
	'license_warning_toast_0' => 'Cookie Byte seems to lack a license.',
	'license_warning_toast_1' => 'Purchase a Cookie Byte license&nbsp;<a href="https://statamic.com/addons/dryven/cookie-byte">here</a>.',
	'license_warning_toast_2' => 'You need to purchase a license for Cookie Byte.',
	
	/* FIELDTYPES */
	'cookie_cover_fieldtype_title' => 'Cookie Content Cover',
	'cookie_category_fieldtype_title' => 'Cookie Category',
];
