<?php

if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Turnjs',
	'turnjs'
);

$pluginSignature = str_replace('_', '', $_EXTKEY) . '_' . turnjs;
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_' . turnjs . '.xml');


t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'turnjs');

?>