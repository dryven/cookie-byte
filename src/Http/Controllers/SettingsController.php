<?php

	namespace DDM\CookieByte\Http\Controllers;

	use DDM\CookieByte\Configuration\CookieByteConfig;
	use DDM\CookieByte\CookieByte;
	use Illuminate\Http\Request;
	use Statamic\Facades\User;
	use Statamic\Http\Controllers\CP\CpController;

	/**
	 * Class SettingsController
	 * @package DDM\CookieByte\Http\Controllers
	 * @author  DDM Studio
	 */
	class SettingsController extends CpController {

		protected $config;

		public function __construct(Request $request) {
			parent::__construct($request);

			$this->config = new CookieByteConfig();
		}

		public function index() {
			// No access if the user doesn't have the right permissions to show them
			abort_unless(User::current()->hasPermission('super') ||
				User::current()->hasPermission(CookieByte::PERMISSION_GENERAL_KEY), 403);

			return view(CookieByte::getNamespacedKey('settings'), [
				'title' => CookieByte::getCpTranslation('title'),
				'action' => cp_route(CookieByte::ROUTE_SETTINGS_INDEX),
				'blueprint' => $this->config->blueprint()->toPublishArray(),
				'values' => $this->config->values(),
				'meta' => $this->config->fields()->meta()
			]);
		}

		public function update(Request $request) {
			// No access if the user doesn't have the right permissions to edit them
			abort_unless(User::current()->hasPermission('super') ||
				User::current()->hasPermission(CookieByte::PERMISSION_GENERAL_KEY), 403);

			$values = $this->config->validatedValues($request);

			$this->config->setValues($values)->save();
		}

	}