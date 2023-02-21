<?php

namespace DDM\CookieByte\UpdateScripts;

use DDM\CookieByte\Configuration\CookieByteConfig;

class UpdateModalPositionConfig extends UpdateConfigScript
{

	public function shouldUpdate($newVersion, $oldVersion): bool
	{
		return $this->isUpdatingTo('1.1.4');
	}

	protected function updateForConfig(CookieByteConfig $config)
	{
		$modalHorizontalPosition = $config->rawValue('modal_horizontal_positon');
		$modalVerticalPosition = $config->rawValue('modal_vertical_positon');

		if ($modalHorizontalPosition) {
			$config->addValue('modal_horizontal_position', $modalHorizontalPosition);
			$config->removeValue('modal_horizontal_positon');
		}

		if ($modalVerticalPosition) {
			$config->addValue('modal_vertical_position', $modalVerticalPosition);
			$config->removeValue('modal_vertical_positon');
		}

		$config->save();
	}

}