<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Pluswerk.' . $_EXTKEY,
	'Bloglisting',
	array(
		'Blog' => 'list,addForm,add,show',
	),
	// non-cacheable actions
	array(
		'Blog' => 'list,addForm,add,show',
	)
);
