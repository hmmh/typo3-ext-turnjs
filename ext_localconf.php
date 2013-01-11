<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,

	// Plugin name
	'Turnjs',

	// An array of controller-action combinations. The first one found is the default one.
	array(
		'Turnjs' => 'index'
	),
	array(
		'Turnjs' => 'create'
	)
);

?>