<?php

namespace OliverThiele\OtEvents\ViewHelpers;

/*                                                                        *
 * This script is backported from the TYPO3 Flow package "TYPO3.Fluid".   *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 *  of the License, or (at your option) any later version.                *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * Class DateTimeRangeViewHelper
 *
 * @package OliverThiele\OtEvents\ViewHelpers
 */
class DateTimeRangeViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 *
	 * @param \DateTime $start
	 * @param \DateTime $end
	 * @return string
	 */
	public function render(\DateTime $start=NULL, \DateTime $end=NULL) {

		if(!is_null($end)){
			$diff = $end->diff($start);
			$return = $start->format('d.m.Y') . ', ' . $start->format('H:i') . ' bis ' . $end->format('H:i') . ' Uhr (Dauer: '. $diff->format('%h Std') . ')';
		} else if(!is_null($start)){
			$return = $start->format('d.m.Y') . ', ' . $start->format('H:i') . ' Uhr';
		} else{
			$return = 'Kein Datum übergeben';
		}

		return $return;
	}

}
