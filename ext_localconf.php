<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'OliverThiele.' . $_EXTKEY,
	'Pi1',
	array(
		'Event' => 'list, show, new, create, edit, update, delete',
		'EventLocation' => 'list',
		'EventCategory' => 'list',
		
	),
	// non-cacheable actions
	array(
		'Event' => 'list, show, create, update, delete',
		'EventLocation' => '',
		'EventCategory' => '',
		
	)
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder