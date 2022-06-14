@inject('cookieByte', 'DDM\CookieByte\CookieByte')
@inject('licenses', 'Statamic\Licensing\LicenseManager')
@extends('statamic::layout')

@section('content')
	@if (!$cookieByte::isLicenseValid())
	<div class="py-1 5 px-2 mb-4 text-sm w-full rounded-md bg-red text-white">
		<div class="flex justify-between items-center">
			<span>
				<strong class="mr-1">{{ $cookieByte::getCpTranslation('cookie_byte') }}</b>
				{{ $cookieByte::getCpTranslation('licensing_warning') }}
			</span>
			<div class="flex flex-shrink-0">
				<a href="" class="text-2xs text-white hover:text-yellow flex items-center" aria-label="{{ $cookieByte::getCpTranslation('licensing_buy_button') }}">
					{{ $cookieByte::getCpTranslation('licensing_buy_button') }}
				</a>
			</div>
		</div>
	</div>
	@endif
	<publish-form
		title="{{ $title }}"
		action="{{ $action }}"
		:blueprint='@json($blueprint)'
		:meta='@json($meta)'
		:values='@json($values)'>
	</publish-form>

	@include('statamic::partials.docs-callout', [
		'topic' => 'Cookie Byte',
		'url' => 'https://statamic.com/addons/dryven/cookie-byte'
	])
@stop
