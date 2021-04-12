@extends('statamic::layout')

@section('content')
	<publish-form
		title="{{ $title }}"
		action="{{ $action }}"
		:blueprint='@json($blueprint)'
		:meta='@json($meta)'
		:values='@json($values)'>
	</publish-form>

	@include('statamic::partials.docs-callout', [
		'topic' => 'Cookie Byte',
		'url' => 'https://statamic.com/addons/ddm-studio/cookie-byte'
	])
@stop
