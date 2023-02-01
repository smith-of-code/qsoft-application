<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

return [
	'js' => [
		'./dist/application.bundle.js',
	],
	'css' => [
		'./dist/application.bundle.css',
	],
	'rel' => [
		'main.polyfill.core',
		'ui.vue3',
		'select2',
		'jquery.nicescroll',
		'inputmask',
		'tippy.js',
		'loda',
		'swiper',
		'ui.vue3.pinia',
	],
	'skip_core' => true,
];