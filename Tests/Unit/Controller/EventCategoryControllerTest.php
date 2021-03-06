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
 * Test case for class OliverThiele\OtEvents\Controller\EventCategoryController.
 *
 * @author Soeren Kroell <hallo@soerenkroell.com>
 */
class EventCategoryControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \OliverThiele\OtEvents\Controller\EventCategoryController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('OliverThiele\\OtEvents\\Controller\\EventCategoryController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllEventCategoriesFromRepositoryAndAssignsThemToView() {

		$allEventCategories = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$eventCategoryRepository = $this->getMock('OliverThiele\\OtEvents\\Domain\\Repository\\EventCategoryRepository', array('findAll'), array(), '', FALSE);
		$eventCategoryRepository->expects($this->once())->method('findAll')->will($this->returnValue($allEventCategories));
		$this->inject($this->subject, 'eventCategoryRepository', $eventCategoryRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('eventCategories', $allEventCategories);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}
}
