<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_otevents_domain_model_event'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_otevents_domain_model_event']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, subtitle, event_date_time_start, event_date_time_stop, short_text, bodytext, images, documents, event_location, event_categories',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, subtitle, event_date_time_start, event_date_time_stop, short_text, bodytext;;;richtext:rte_transform[mode=ts_links], images, documents, event_location, event_categories, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_otevents_domain_model_event',
				'foreign_table_where' => 'AND tx_otevents_domain_model_event.pid=###CURRENT_PID### AND tx_otevents_domain_model_event.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_event.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'subtitle' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_event.subtitle',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'event_date_time_start' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_event.event_date_time_start',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime,required',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			),
		),
		'event_date_time_stop' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_event.event_date_time_stop',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			),
		),
		'short_text' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_event.short_text',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'bodytext' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_event.bodytext',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
		),
		'images' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_event.images',
			'config' => 
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'images',
				array('maxitems' => 3),
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),

		),
		'documents' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_event.documents',
			'config' => 
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'documents',
				array('maxitems' => 10)
			),

		),
		'event_location' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_event.event_location',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tt_address',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'event_categories' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_event.event_categories',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_otevents_domain_model_eventcategory',
				'MM' => 'tx_otevents_event_eventcategory_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_otevents_domain_model_eventcategory',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		
	),
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

$GLOBALS['TCA']['tx_otevents_domain_model_event']['columns']['subtitle'] = array(
	'exclude' => 1,
	'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_event.subtitle',
	'config' => array(
		'type' => 'text',
		'cols' => 40,
		'rows' => 3,
		'eval' => 'trim'
	)
);

$GLOBALS['TCA']['tx_otevents_domain_model_event']['columns']['images'] = array(
	'exclude' => 1,
	'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_event.images',
	'config' =>
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'images',
			array('maxitems' => 3,
				'appearance' => array(
					'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
				),
				'foreign_types' => array(
					'0' => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					)
				)
			),
			$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
		),
);

$GLOBALS['TCA']['tx_otevents_domain_model_event']['columns']['documents'] = array(
	'exclude' => 1,
	'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_event.documents',
	'config' =>
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'documents',
			array('maxitems' => 10)
		),
);

$GLOBALS['TCA']['tx_otevents_domain_model_event']['columns']['event_location'] = array(
	'exclude' => 1,
	'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_event.event_location',
	'config' => array(
		'type' => 'select',
		'items' => array(
			array('-', 0) // Leereintrag
		),
		'foreign_table' => 'tt_address',
		'minitems' => 0,
		'maxitems' => 1,
	),
);
$GLOBALS['TCA']['tx_otevents_domain_model_event']['columns']['event_categories'] = array(
	'exclude' => 1,
	'label' => 'LLL:EXT:ot_events/Resources/Private/Language/locallang_db.xlf:tx_otevents_domain_model_event.event_categories',
	'config' => array(
		'type' => 'select',
		'foreign_table' => 'tx_otevents_domain_model_eventcategory',
		'MM' => 'tx_otevents_event_eventcategory_mm',
		'size' => 10,
		'autoSizeMax' => 30,
		'maxitems' => 9999,
		'multiple' => 0,
		'renderMode' => 'tree',
		'treeConfig' => array(
			'expandAll' => true,
			'parentField' => 'parent_event_category',
			'appearance' => array(
				'showHeader' => TRUE,
			)
		),
		'wizards' => array(
			'_PADDING' => 1,
			'_VERTICAL' => 1,
			'edit' => array(
				'type' => 'popup',
				'title' => 'Edit',
				'script' => 'wizard_edit.php',
				'icon' => 'edit2.gif',
				'popup_onlyOpenIfSelected' => 1,
				'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
			),
			'add' => Array(
				'type' => 'script',
				'title' => 'Create new',
				'icon' => 'add.gif',
				'params' => array(
					'table' => 'tx_otevents_domain_model_eventcategory',
					'pid' => '###CURRENT_PID###',
					'setValue' => 'prepend'
				),
				'script' => 'wizard_add.php',
			),
		),
	),
);