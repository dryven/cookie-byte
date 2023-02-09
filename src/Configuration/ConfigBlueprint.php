<?php

namespace DDM\CookieByte\Configuration;

use DDM\CookieByte\CookieByte;
use Illuminate\Config\Repository;
use Statamic\Facades\AssetContainer;
use Illuminate\Contracts\Foundation\Application;
use DDM\CookieByte\Exceptions\CookieByteException;

/**
 * Class ConfigBlueprint
 * @package DDM\CookieByte\Configuration
 * @author  dryven
 */
class ConfigBlueprint
{

	/**
	 * Returns the configured asset container.
	 *
	 * @return Repository|Application|mixed
	 * @throws CookieByteException
	 */
	protected static function getAssetsContainerHandle()
	{
		$assetContainerHandle = config('cookie-byte.asset_container', 'assets');

		if (!AssetContainer::findByHandle($assetContainerHandle)) {
			throw new CookieByteException("The container with the handle $assetContainerHandle cannot be found.");
		}

		return $assetContainerHandle;
	}

	/**
	 * Returns the config blueprint as an array.
	 *
	 * @return array[]
	 * @throws CookieByteException
	 */
	public static function getBlueprint(): array
	{
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
							'handle' => 'categories',
							'field' => [
								'type' => 'grid',
								'display' => CookieByte::getCpTranslation('categories'),
								'instructions' => CookieByte::getCpTranslation('categories_instructions'),
								'add_row' => CookieByte::getCpTranslation('categories_add_row'),
								'mode' => 'stacked',
								'reorderable' => true,
//								'min_rows' => 1,  FIXME Hotfix for Statamic adding a ghost item when min_rows is set to 1
								'fields' => [
									[
										'handle' => 'title',
										'field' => [
											'type' => 'text',
											'display' => CookieByte::getCpTranslation('category_title'),
											'instructions' => CookieByte::getCpTranslation('category_title_instructions'),
											'placeholder' => CookieByte::getCpTranslation('category_title_placeholder'),
											'validate' => ['required'],
											'width' => 33
										]
									],
									[
										'handle' => 'handle',
										'field' => [
											'type' => 'slug',
											'display' => CookieByte::getCpTranslation('category_handle'),
											'instructions' => CookieByte::getCpTranslation('category_handle_instructions'),
											'placeholder' => CookieByte::getCpTranslation('category_handle_placeholder'),
											'generate' => true,
											'from' => 'title',
											'validate' => ['alpha', 'required'],
											'width' => 33
										]
									],
									[
										'handle' => 'required',
										'field' => [
											'type' => 'toggle',
											'display' => CookieByte::getCpTranslation('category_required'),
											'instructions' => CookieByte::getCpTranslation('category_required_instructions'),
											'width' => 33
										]
									],
									[
										'handle' => 'description',
										'field' => [
											'type' => 'textarea',
											'display' => CookieByte::getCpTranslation('category_description'),
											'instructions' => CookieByte::getCpTranslation('category_description_instructions'),
											'placeholder' => CookieByte::getCpTranslation('category_description_placeholder'),
										]
									],
									[
										'handle' => 'code_snippets',
										'field' => [
											'type' => 'grid',
											'display' => CookieByte::getCpTranslation('category_code_snippets'),
											'instructions' => CookieByte::getCpTranslation('category_code_snippets_instructions'),
											'add_row' => CookieByte::getCpTranslation('category_code_snippets_add_row'),
											'fields' => [
												[
													'handle' => 'code',
													'field' => [
														'type' => 'code',
														'display' => CookieByte::getCpTranslation('category_code_snippets'),
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
								'validate' => ['required']
							]
						],
						[
							'handle' => 'modal_description',
							'field' => [
								'type' => 'textarea',
								'display' => CookieByte::getCpTranslation('modal_description'),
								'instructions' => CookieByte::getCpTranslation('modal_description_instructions'),
								'placeholder' => CookieByte::getCpTranslation('modal_description_placeholder'),
								'validate' => ['required']
							]
						],
						[
							'handle' => 'modal_button_all',
							'field' => [
								'type' => 'text',
								'display' => CookieByte::getCpTranslation('modal_button_all'),
								'instructions' => CookieByte::getCpTranslation('modal_button_all_instructions'),
								'placeholder' => CookieByte::getCpTranslation('modal_button_all_placeholder'),
								'validate' => ['required'],
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
								'validate' => ['required'],
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
										'handle' => 'name',
										'field' => [
											'type' => 'text',
											'display' => CookieByte::getCpTranslation('cover_name'),
											'instructions' => CookieByte::getCpTranslation('cover_name_instructions'),
											'placeholder' => CookieByte::getCpTranslation('cover_name_placeholder'),
											'width' => 50
										]
									],
									[
										'handle' => 'handle',
										'field' => [
											'type' => 'slug',
											'display' => CookieByte::getCpTranslation('cover_handle'),
											'instructions' => CookieByte::getCpTranslation('cover_handle_instructions'),
											'placeholder' => CookieByte::getCpTranslation('cover_handle_placeholder'),
											'generate' => false,
											'validate' => ['alpha', 'required'],
											'width' => 50
										]
									],
									[
										'handle' => 'categories',
										'field' => [
											'type' => 'cookie_category',
											'display' => CookieByte::getCpTranslation('cover_categories'),
											'instructions' => CookieByte::getCpTranslation('cover_categories_instructions'),
											'validate' => ['required'],
											'multiple' => true,
											'width' => 100
										]
									],
									[
										'handle' => 'title',
										'field' => [
											'type' => 'text',
											'display' => CookieByte::getCpTranslation('cover_title'),
											'instructions' => CookieByte::getCpTranslation('cover_title_instructions'),
											'placeholder' => CookieByte::getCpTranslation('cover_title_placeholder'),
											'validate' => ['required']
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
											'validate' => ['required']
										]
									],
									[
										'handle' => 'bg_image',
										'field' => [
											'type' => 'assets',
											'display' => CookieByte::getCpTranslation('cover_bg_image'),
											'instructions' => CookieByte::getCpTranslation('cover_bg_image_instructions'),
											'placeholder' => CookieByte::getCpTranslation('cover_bg_image_placeholder'),
											'container' => self::getAssetsContainerHandle(),
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
