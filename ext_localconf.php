<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Pluswerk.' . $_EXTKEY,
	'Bloglisting',
	array(
		'Blog' => 'list,addForm,add,show,updateForm,update,deleteConfirm,delete,rss',
		'Post' => 'addForm,add,show,updateForm,update,deleteConfirm,delete,ajax',
	),
	// non-cacheable actions
	array(
		'Blog' => 'list,addForm,add,show,updateForm,update,deleteConfirm,delete,rss',
		'Post' => 'addForm,add,show,updateForm,update,deleteConfirm,delete,ajax',
	)
);
