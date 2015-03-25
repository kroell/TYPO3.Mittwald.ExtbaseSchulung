<?php
namespace OliverThiele\OtEvents\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Soeren Kroell <hallo@soerenkroell.com>
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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

/**
 * Test case for class OliverThiele\OtEvents\Controller\EventController.
 *
 * @author Soeren Kroell <hallo@soerenkroell.com>
 */
class EventControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \OliverThiele\OtEvents\Controller\EventController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('OliverThiele\\OtEvents\\Controller\\EventController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllEventsFromRepositoryAndAssignsThemToView() {

		$allEvents = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$eventRepository = $this->getMock('OliverThiele\\OtEvents\\Domain\\Repository\\EventRepository', array('findAll'), array(), '', FALSE);
		$eventRepository->expects($this->once())->method('findAll')->will($this->returnValue($allEvents));
		$this->inject($this->subject, 'eventRepository', $eventRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('events', $allEvents);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenEventToView() {
		$event = new \OliverThiele\OtEvents\Domain\Model\Event();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('event', $event);

		$this->subject->showAction($event);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenEventToView() {
		$event = new \OliverThiele\OtEvents\Domain\Model\Event();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newEvent', $event);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($event);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenEventToEventRepository() {
		$event = new \OliverThiele\OtEvents\Domain\Model\Event();

		$eventRepository = $this->getMock('OliverThiele\\OtEvents\\Domain\\Repository\\EventRepository', array('add'), array(), '', FALSE);
		$eventRepository->expects($this->once())->method('add')->with($event);
		$this->inject($this->subject, 'eventRepository', $eventRepository);

		$this->subject->createAction($event);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenEventToView() {
		$event = new \OliverThiele\OtEvents\Domain\Model\Event();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('event', $event);

		$this->subject->editAction($event);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenEventInEventRepository() {
		$event = new \OliverThiele\OtEvents\Domain\Model\Event();

		$eventRepository = $this->getMock('OliverThiele\\OtEvents\\Domain\\Repository\\EventRepository', array('update'), array(), '', FALSE);
		$eventRepository->expects($this->once())->method('update')->with($event);
		$this->inject($this->subject, 'eventRepository', $eventRepository);

		$this->subject->updateAction($event);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenEventFromEventRepository() {
		$event = new \OliverThiele\OtEvents\Domain\Model\Event();

		$eventRepository = $this->getMock('OliverThiele\\OtEvents\\Domain\\Repository\\EventRepository', array('remove'), array(), '', FALSE);
		$eventRepository->expects($this->once())->method('remove')->with($event);
		$this->inject($this->subject, 'eventRepository', $eventRepository);

		$this->subject->deleteAction($event);
	}
}
