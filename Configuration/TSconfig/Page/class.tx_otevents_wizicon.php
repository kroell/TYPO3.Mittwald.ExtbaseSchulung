<?php

class tx_otevents_wizicon {

	/**
	* Processing the wizard items array
	*
	* @param array $wizardItems The wizard items
	* @return array Modified array with wizard items
	*/
	function proc($wizardItems) {
		$wizardItems['plugins_tx_examples_pierror'] = array(
			'icon' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('ot_events') . 'Resources/Public/Icons/wizard_icon.gif',
			#'title' => $GLOBALS['LANG']->sL('LLL:EXT:examples/locallang.xlf:pierror_wizard_title'),
//			'description' => $GLOBALS['LANG']->sL('LLL:EXT:examples/locallang.xlf:pierror_wizard_description'),
			'title' => 'Eventkalender',
			'description' => 'Zeigt ein oder mehrere Events an.',
			'params' => '&defVals[tt_content][CType]=list&&defVals[tt_content][list_type]=otevents_pi1'
		);

		return $wizardItems;
	}

}