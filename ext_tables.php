<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Events'
);

$pluginSignature = str_replace('_','',$_EXTKEY) . '_pi1';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_pi1.xml');

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'OliverThiele.' . $_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'mod1',	// Submodule key
		'',						// Position
		array(
			'Event' => 'list, show, new, create, edit, update, delete','EventLocation' => 'list','EventCategory' => 'list',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod1.xlf',
		)
	);

}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Eventcalendar');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_otevents_domain_model_event', 'EXT:ot_events/Resources/Private/Language/locallang_csh_tx_otevents_domain_model_event.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_otevents_domain_model_event');
$GLOBALS['TCA']['tx_otevents_domain_model_event'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_event',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,subtitle,event_date_time_start,event_date_time_stop,short_text,bodytext,images,documents,event_location,event_categories,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Event.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_otevents_domain_model_event.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_otevents_domain_model_eventcategory', 'EXT:ot_events/Resources/Private/Language/locallang_csh_tx_otevents_domain_model_eventcategory.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_otevents_domain_model_eventcategory');
$GLOBALS['TCA']['tx_otevents_domain_model_eventcategory'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_eventcategory',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,parent_event_category,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/EventCategory.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_otevents_domain_model_eventcategory.gif'
	),
);

if (!isset($GLOBALS['TCA']['tt_address']['ctrl']['type'])) {
	if (file_exists($GLOBALS['TCA']['tt_address']['ctrl']['dynamicConfigFile'])) {
		require_once($GLOBALS['TCA']['tt_address']['ctrl']['dynamicConfigFile']);
	}
	// no type field defined, so we define it here. This will only happen the first time the extension is installed!!
	$GLOBALS['TCA']['tt_address']['ctrl']['type'] = 'tx_extbase_type';
	$tempColumns = array();
	$tempColumns[$GLOBALS['TCA']['tt_address']['ctrl']['type']] = array(
		'exclude' => 1,
		'label'   => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents.tx_extbase_type',
		'config' => array(
			'type' => 'select',
			'items' => array(),
			'size' => 1,
			'maxitems' => 1,
		)
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_address', $tempColumns, 1);
}

$tmp_ot_events_columns = array(

	'name' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_eventlocation.name',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim,required'
		),
	),
	'address' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_eventlocation.address',
		'config' => array(
			'type' => 'text',
			'cols' => 40,
			'rows' => 15,
			'eval' => 'trim'
		)
	),
	'zip' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_eventlocation.zip',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'city' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_eventlocation.city',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'country' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_eventlocation.country',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'latitude' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_eventlocation.latitude',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'longitude' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_eventlocation.longitude',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_address',$tmp_ot_events_columns);

$GLOBALS['TCA']['tt_address']['types']['Tx_OtEvents_EventLocation']['showitem'] = $TCA['tt_address']['types']['1']['showitem'];
$GLOBALS['TCA']['tt_address']['types']['Tx_OtEvents_EventLocation']['showitem'] .= ',--div--;LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_eventlocation,';
$GLOBALS['TCA']['tt_address']['types']['Tx_OtEvents_EventLocation']['showitem'] .= 'name, address, zip, city, country, latitude, longitude';

$GLOBALS['TCA']['tt_address']['columns'][$TCA['tt_address']['ctrl']['type']]['config']['items'][] = array('LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tt_address.tx_extbase_type.Tx_OtEvents_EventLocation','Tx_OtEvents_EventLocation');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_address', $GLOBALS['TCA']['tt_address']['ctrl']['type'],'','after:' . $TCA['tt_address']['ctrl']['label']);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
    $_EXTKEY,
    'tx_otevents_domain_model_event'
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder