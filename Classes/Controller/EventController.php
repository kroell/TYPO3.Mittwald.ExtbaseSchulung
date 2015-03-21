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
class EventController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

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
	 * __construct
	 */
	public function initializeAction() {
//		DebuggerUtility::var_dump($this->request);

		if($this->request->hasArgument('event')) {

			$this->arguments['event'] // arguments hat kein @api als annotation, daher mit vorsicht verwenden
				->getPropertyMappingConfiguration()
				->forProperty('eventTimeStart')
				->setTypeConverterOption('\\TYPO3\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');


			$this->arguments['event']->getPropertyMappingConfiguration()->skipProperties('eventTimeStop');
		}


	}

	/**
	 * __construct
	 */
	public function initializeListAction() {

		if(isset($this->settings['flexForm']['category']) && $this->settings['flexForm']['category'] > 0){
			$this->request->setArgument('eventCategory', $this->settings['flexForm']['category']);
		}
	}

	/**
	 * action list
	 *
	 * @param \OliverThiele\OtEvents\Domain\Model\EventCategory $eventCategory
	 * @return void
	 */
	public function listAction($eventCategory = NULL) {
		$events = $this->eventRepository->findAll()->getQuery()->setOrderings(array('eventDateTimeStart'=>\TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING))->execute();

//		DebuggerUtility::var_dump($this->request->getArguments());
//		DebuggerUtility::var_dump($eventCategory);

//		$args = $this->request->getArguments();
//		$selectedEvent = $args['eventCategory'];

		if(!is_null($eventCategory)){
			$events = $this->eventRepository->findByEventCategory($eventCategory);

//			$filteredEvent = $this->eventCategoryRepository->findByUid($selectedEvent);
		}


		$this->view->assignMultiple(
			array(
				'events' => $events,
				'settings' => $this->settings['flexForm'],
				'allCategories' => $this->eventCategoryRepository->findAll(),
				'selectedEventCategory' => $eventCategory
			)
		);
	}

	/**
	 * action show
	 *
	 * @param \OliverThiele\OtEvents\Domain\Model\Event $event
	 * @return void
	 */
	public function showAction(\OliverThiele\OtEvents\Domain\Model\Event $event) {
		$this->view->assign('event', $event);
	}

	/**
	 * action new
	 *
	 * @param \OliverThiele\OtEvents\Domain\Model\Event $newEvent
	 * @ignorevalidation $newEvent
	 * @return void
	 */
	public function newAction(\OliverThiele\OtEvents\Domain\Model\Event $newEvent = NULL) {
		$this->view->assign('newEvent', $newEvent);
	}

	/**
	 * action create
	 *
	 * @param \OliverThiele\OtEvents\Domain\Model\Event $newEvent
	 * @return void
	 */
	public function createAction(\OliverThiele\OtEvents\Domain\Model\Event $newEvent) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->eventRepository->add($newEvent);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \OliverThiele\OtEvents\Domain\Model\Event $event
	 * @ignorevalidation $event
	 * @return void
	 */
	public function editAction(\OliverThiele\OtEvents\Domain\Model\Event $event) {
		$this->view->assign('event', $event);
	}

	/**
	 * action update
	 *
	 * @param \OliverThiele\OtEvents\Domain\Model\Event $event
	 * @return void
	 */
	public function updateAction(\OliverThiele\OtEvents\Domain\Model\Event $event) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->eventRepository->update($event);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \OliverThiele\OtEvents\Domain\Model\Event $event
	 * @return void
	 */
	public function deleteAction(\OliverThiele\OtEvents\Domain\Model\Event $event) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->eventRepository->remove($event);
		$this->redirect('list');
	}

}