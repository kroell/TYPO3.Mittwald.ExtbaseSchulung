<?php
namespace OliverThiele\OtEvents\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Soeren Kroell <hallo@soerenkroell.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use \TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use \OliverThiele\OtEvents\Domain\Model\Event;
use \OliverThiele\OtEvents\Domain\Model\EventCategory;

/**
 * EventController
 */
class WidgetController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * eventRepository
	 *
	 * @var \OliverThiele\OtEvents\Domain\Repository\EventRepository
	 * @inject
	 */
	protected $eventRepository = NULL;

	/**
	 * EventCategoryRepository
	 *
	 * @var \OliverThiele\OtEvents\Domain\Repository\EventCategoryRepository
	 * @inject
	 */
	protected $eventCategoryRepository = NULL;

	/**
	 * persistence manager
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface
	 * @inject
	 */
	protected $persistenceManager;


	/**
	 * action calendar
	 *
	 * @return void
	 */
	public function calendarAction() {

		$startStop = $this->monthStartAndStop();
		$events = $this->eventRepository->findByStartAndEnd($startStop['start'], $startStop['stop']);

		foreach($events as $i => $event){
			$temp[$i]['startDate'] = $event->getEventDateTimeStart()->format('d.m.Y');
			$temp[$i]['className'] = 'event-start active';
		}

		// heute mit einer extra Klasse versehen
		$today = new \DateTime('now');
		$j = count($temp) + 1;
		$temp[$j]['startDate'] = $today->format('d.m.Y');
		$temp[$j]['className'] = 'today active';


		$this->uriBuilder->setTargetPageUid($this->settings['flexForm']['listEventPidWidget']);
//		$this->uriBuilder->setUseCacheHash(FALSE);
		$uri = $this->uriBuilder->uriFor('list', NULL, 'Event');
//		DebuggerUtility::var_dump($uri);

		$this->view->assignMultiple(
			array(
				'events' => json_encode($temp),
				'settings' => $this->settings['flexForm'],
				'today' => $today,
				'linkToList' =>$uri
			)
		);
	}

	/**
	 * Allgemeiner Ajax Callback
	 *
	 * @return string
	 */
	public function ajaxAction() {

		$arguments = $this->request->getArguments();

		switch ($arguments['type']){
			// Gibt die Events fuer den uebergebenen Zeitraum als JSON zurueck
			case 'getEvents':
				if(isset($arguments['data'])) {
					$date = new \DateTime($arguments['data']);
					$startStop = $this->monthStartAndStop($date);
					$events = $this->eventRepository->findByStartAndEnd($startStop['start'], $startStop['stop']);
					foreach($events as $i => $event){
						$temp[$i] = $event->getEventDateTimeStart()->format('d.m.Y');
					}
					return json_encode(array('message' => 'Events for ' . $date->format('F'), 'data' => $temp));
    			}
				return json_encode(array('message' => 'No data set!', 'args' => $arguments));
				break;
		}
	}

	/**
	 * Gibt ein Array mit Start undStopdatum zurueck
	 *
	 * @param \DateTime $date
	 * @return array
	 */
	private function monthStartAndStop($date=NULL) {

		$mStart = new \DateTime();
		$mStop = new \DateTime();

		if($date){
			$month = $date->format('M');
			$mStart->modify('first day of ' . $month);
//			$mStart->modify('-10 days');
			$mStop->modify('last day of ' . $month);
//			$mStop->modify('+10 days');
		} else {
			$mStart->modify('first day of this month');
			$mStart->modify('-10 days');
			$mStop->modify('last day of this month');
			$mStop->modify('+10 days');
		}

		return array('start' => $mStart, 'stop' => $mStop);
	}

}