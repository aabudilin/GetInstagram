<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Pushe\Application\GetInstagram;


if (!$arParams['CACHE_TIME']) {
	$arParams['CACHE_TIME'] = 3600000;
}

if (!$arParams['CACHE_TYPE']) {
	$arParams['CACHE_TYPE'] = 'A';
}

if (!$arParams['COUNT']) {
	$arParams['COUNT'] = 12;
}

$key = md5('list_instagram');

$cache = \Bitrix\Main\Data\Cache::createInstance();

$result = array();

if ($cache->initCache($arParams['CACHE_TIME'], $key)) {
	$result = $cache->getVars();
} elseif ($cache->startDataCache()) {

	$insta = new GetInstagram();
	$media = $insta->get_media();

	$i = 0;

	foreach($media->data as $item) {
		$result[] = array (
			'permalink' => $item->permalink,
			'media_url' => $item->media_url
		);
		if ($i > $arParams['COUNT']) break;
		$i++;
	}

	if (count($result) === 0) {
		$cache->abortDataCache();
	}

	$cache->endDataCache($result);
}

$arResult['ITEMS'] = $result;

$this->includeComponentTemplate();
