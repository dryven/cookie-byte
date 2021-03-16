<?php

	namespace DDM\CookieByte\Configuration;

	use DDM\CookieByte\CookieByte;
	use Statamic\Facades\AssetContainer;

	/**
	 * Class ConfigBlueprint
	 * @package DDM\CookieByte\Configuration
	 * @author  DDM Studio
	 */
	class ConfigBlueprint {

		public static function getBlueprint(): array {
			return [
				'sections' => [
					'general' => [
						'display' => CookieByte::getCpTranslation('tab_general'),
						'fields' => [
							[
								'handle' => 'enabled',
								'field' => [
									'type' => 'toggle',
									'display' => CookieByte::getCpTranslation('enabled'),
									'instructions' => CookieByte::getCpTranslation('enabled_instructions'),
								]
							],
							[
								'handle' => 'classes',
								'field' => [
									'type' => 'grid',
									'display' => CookieByte::getCpTranslation('classes'),
									'instructions' => CookieByte::getCpTranslation('classes_instructions'),
									'add_row' => CookieByte::getCpTranslation('classes_add_row'),
									'mode' => 'stacked',
									'reorderable' => true,
									'min_rows' => 1,
									'fields' => [
										[
											'handle' => 'title',
											'field' => [
												'type' => 'text',
												'display' => CookieByte::getCpTranslation('class_title'),
												'instructions' => CookieByte::getCpTranslation('class_title_instructions'),
												'placeholder' => CookieByte::getCpTranslation('class_title_placeholder'),
												'validate' => [ 'required' ],
												'width' => 33
											]
										],
										[
											'handle' => 'handle',
											'field' => [
												'type' => 'slug',
												'display' => CookieByte::getCpTranslation('class_handle'),
												'instructions' => CookieByte::getCpTranslation('class_handle_instructions'),
												'placeholder' => CookieByte::getCpTranslation('class_handle_placeholder'),
												'generate' => true,
												'validate' => [ 'required' ],
												'width' => 33
											]
										],
										[
											'handle' => 'required',
											'field' => [
												'type' => 'toggle',
												'display' => CookieByte::getCpTranslation('class_required'),
												'instructions' => CookieByte::getCpTranslation('class_required_instructions'),
												'width' => 33
											]
										],
										[
											'handle' => 'description',
											'field' => [
												'type' => 'textarea',
												'display' => CookieByte::getCpTranslation('class_description'),
												'instructions' => CookieByte::getCpTranslation('class_description_instructions'),
												'placeholder' => CookieByte::getCpTranslation('class_description_placeholder'),
											]
										],
										[
											'handle' => 'code_snippets',
											'field' => [
												'type' => 'grid',
												'display' => CookieByte::getCpTranslation('class_code_snippets'),
												'instructions' => CookieByte::getCpTranslation('class_code_snippets_instructions'),
												'add_row' => CookieByte::getCpTranslation('class_code_snippets_add_row'),
												'fields' => [
													[
														'handle' => 'code',
														'field' => [
															'type' => 'code',
															'display' => CookieByte::getCpTranslation('class_code_snippets'),
															'mode' => 'javascript',
															'theme' => 'light',
															'indent_type' => 'tabs',
															'indent_size' => 4,
															'line_numbers' => true,
															'line_wrapping' => true
														]
													]
												]
											]
										]
									]
								]
							],
							[
								'handle' => 'developer_section',
								'field' => [
									'type' => 'section',
									'display' => CookieByte::getCpTranslation('developer_section'),
									'instructions' => CookieByte::getCpTranslation('developer_section_instructions')
								]
							],
							[
								'handle' => 'custom_style',
								'field' => [
									'type' => 'toggle',
									'display' => CookieByte::getCpTranslation('custom_style'),
									'instructions' => CookieByte::getCpTranslation('custom_style_instructions')
								]
							],
							[
								'handle' => 'custom_code',
								'field' => [
									'type' => 'toggle',
									'display' => CookieByte::getCpTranslation('custom_code'),
									'instructions' => CookieByte::getCpTranslation('custom_code_instructions')
								]
							]
						]
					],
					'modal' => [
						'display' => CookieByte::getCpTranslation('tab_modal'),
						'fields' => [
							[
								'handle' => 'modal_section',
								'field' => [
									'type' => 'section',
									'display' => CookieByte::getCpTranslation('modal_section'),
									'instructions' => CookieByte::getCpTranslation('modal_section_instructions')
								]
							],
							[
								'handle' => 'modal_title',
								'field' => [
									'type' => 'text',
									'display' => CookieByte::getCpTranslation('modal_title'),
									'instructions' => CookieByte::getCpTranslation('modal_title_instructions'),
									'placeholder' => CookieByte::getCpTranslation('modal_title_placeholder'),
									'validate' => [ 'required' ]
								]
							],
							[
								'handle' => 'modal_description',
								'field' => [
									'type' => 'textarea',
									'display' => CookieByte::getCpTranslation('modal_description'),
									'instructions' => CookieByte::getCpTranslation('modal_description_instructions'),
									'placeholder' => CookieByte::getCpTranslation('modal_description_placeholder'),
									'validate' => [ 'required' ]
								]
							],
							[
								'handle' => 'modal_button_all',
								'field' => [
									'type' => 'text',
									'display' => CookieByte::getCpTranslation('modal_button_all'),
									'instructions' => CookieByte::getCpTranslation('modal_button_all_instructions'),
									'placeholder' => CookieByte::getCpTranslation('modal_button_all_placeholder'),
									'validate' => [ 'required' ],
									'width' => 50
								]
							],
							[
								'handle' => 'modal_button_selected',
								'field' => [
									'type' => 'text',
									'display' => CookieByte::getCpTranslation('modal_button_selected'),
									'instructions' => CookieByte::getCpTranslation('modal_button_selected_instructions'),
									'placeholder' => CookieByte::getCpTranslation('modal_button_selected_placeholder'),
									'validate' => [ 'required' ],
									'width' => 50
								]
							],
							[
								'handle' => 'modal_horizontal_positon',
								'field' => [
									'type' => 'select',
									'display' => CookieByte::getCpTranslation('modal_horizontal_position'),
									'instructions' => CookieByte::getCpTranslation('modal_horizontal_position_instructions'),
									'placeholder' => CookieByte::getCpTranslation('modal_horizontal_position_placeholder'),
									'options' => [
										'left' => CookieByte::getCpTranslation('modal_horizontal_position_option_left'),
										'center' => CookieByte::getCpTranslation('modal_horizontal_position_option_center'),
										'right' => CookieByte::getCpTranslation('modal_horizontal_position_option_right'),
									],
									'default' => 'center',
									'width' => 33,
								]
							],
							[
								'handle' => 'modal_vertical_positon',
								'field' => [
									'type' => 'select',
									'display' => CookieByte::getCpTranslation('modal_vertical_position'),
									'instructions' => CookieByte::getCpTranslation('modal_vertical_position_instructions'),
									'placeholder' => CookieByte::getCpTranslation('modal_vertical_position_placeholder'),
									'options' => [
										'top' => CookieByte::getCpTranslation('modal_vertical_position_option_top'),
										'center' => CookieByte::getCpTranslation('modal_vertical_position_option_center'),
										'bottom' => CookieByte::getCpTranslation('modal_vertical_position_option_bottom'),
									],
									'default' => 'center',
									'width' => 33,
								]
							],
							[
								'handle' => 'modal_background',
								'field' => [
									'type' => 'select',
									'display' => CookieByte::getCpTranslation('modal_background'),
									'instructions' => CookieByte::getCpTranslation('modal_background_instructions'),
									'placeholder' => CookieByte::getCpTranslation('modal_background_placeholder'),
									'options' => [
										'back-none' => CookieByte::getCpTranslation('modal_background_option_none'),
										'back-light' => CookieByte::getCpTranslation('modal_background_option_light'),
										'back-heavy' => CookieByte::getCpTranslation('modal_background_option_heavy'),
									],
									'default' => 'back-none',
									'width' => 33
								]
							],
						]
					],
					'covers' => [
						'display' => CookieByte::getCpTranslation('tab_covers'),
						'fields' => [
							[
								'handle' => 'covers_section',
								'field' => [
									'type' => 'section',
									'display' => CookieByte::getCpTranslation('covers_section'),
									'instructions' => CookieByte::getCpTranslation('covers_section_instructions')
								]
							],
							[
								'handle' => 'covers',
								'field' => [
									'type' => 'grid',
									'display' => CookieByte::getCpTranslation('covers'),
									'instructions' => CookieByte::getCpTranslation('covers_instructions'),
									'add_row' => CookieByte::getCpTranslation('covers_add_row'),
									'mode' => 'stacked',
									'reorderable' => true,
									'fields' => [
										[
											'handle' => 'handle',
											'field' => [
												'type' => 'slug',
												'display' => CookieByte::getCpTranslation('cover_handle'),
												'instructions' => CookieByte::getCpTranslation('cover_handle_instructions'),
												'placeholder' => CookieByte::getCpTranslation('cover_handle_placeholder'),
												'generate' => false,
												'validate' => [ 'required', 'alpha' ],
												'width' => 33
											]
										],
										[
											'handle' => 'classes',
											'field' => [
												'type' => 'text',
												'display' => CookieByte::getCpTranslation('cover_classes'),
												'instructions' => CookieByte::getCpTranslation('cover_classes_instructions'),
												'placeholder' => CookieByte::getCpTranslation('cover_classes_placeholder'),
												'validate' => [ 'required' ],
												'width' => 66
											]
										],
										[
											'handle' => 'title',
											'field' => [
												'type' => 'text',
												'display' => CookieByte::getCpTranslation('cover_title'),
												'instructions' => CookieByte::getCpTranslation('cover_title_instructions'),
												'placeholder' => CookieByte::getCpTranslation('cover_title_placeholder'),
												'validate' => [ 'required' ]
											]
										],
										[
											'handle' => 'paragraph',
											'field' => [
												'type' => 'textarea',
												'display' => CookieByte::getCpTranslation('cover_paragraph'),
												'instructions' => CookieByte::getCpTranslation('cover_paragraph_instructions'),
												'placeholder' => CookieByte::getCpTranslation('cover_paragraph_placeholder'),
											]
										],
										[
											'handle' => 'button_accept',
											'field' => [
												'type' => 'text',
												'display' => CookieByte::getCpTranslation('cover_button_accept'),
												'instructions' => CookieByte::getCpTranslation('cover_button_accept_instructions'),
												'placeholder' => CookieByte::getCpTranslation('cover_button_accept_placeholder'),
												'validate' => [ 'required' ]
											]
										],
										[
											'handle' => 'bg_image',
											'field' => [
												'type' => 'assets',
												'display' => CookieByte::getCpTranslation('cover_bg_image'),
												'instructions' => CookieByte::getCpTranslation('cover_bg_image_instructions'),
												'placeholder' => CookieByte::getCpTranslation('cover_bg_image_placeholder'),
												'container' => AssetContainer::findByHandle('assets') ? 'assets' : null,
												'max_files' => 1
											]
										]
									]
								]
							]
						]
					]
				]
			];
		}

	}