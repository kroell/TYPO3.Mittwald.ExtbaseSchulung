<?php
namespace OliverThiele\OtEvents\Domain\Repository;

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
use OliverThiele\OtEvents\Domain\Model\EventCategory;

/**
 * The repository for Events
 */
class EventRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * @param EventCategory $eventCategory
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByEventCategory(EventCategory $eventCategory) {

		$query = $this->createQuery();
		return $query
			->matching(
				$query->contains('eventCategories', $eventCategory)
			)
			->setOrderings(array('eventDateTimeStart'=>\TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING))
			->execute();
	}

	/**
	 * Gibt die Veranstaltungen innerhalb eines Zeitraums geordnet nach Start zurueck
	 *
	 * @param \DateTime $start
	 * @param \DateTime $end
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByStartAndEnd(\DateTime $start, \DateTime $end) {

		$query = $this->createQuery();
		return $query
			->matching(
				$query->logicalAnd(
					$query->greaterThanOrEqual('eventDateTimeStart', $start->setTime(0,0,0)->format('Y-m-d H:i:s')),
					$query->lessThanOrEqual('eventDateTimeStart', $end->setTime(23,59,59)->format('Y-m-d H:i:s'))
				)
			)
			->setOrderings(array('eventDateTimeStart'=>\TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING))
			->execute();
	}

	/**
	 * @param \DateTime $start
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByStart(\DateTime $start){
		$query = $this->createQuery();
		return $query
			->matching(
				$query->logicalAnd(
					$query->greaterThanOrEqual('eventDateTimeStart', $start->setTime(0,0,0)->format('Y-m-d H:i:s')),
					$query->lessThanOrEqual('eventDateTimeStart', $start->setTime(23,59,59)->format('Y-m-d H:i:s'))
				)
			)
			->setOrderings(array('eventDateTimeStart'=>\TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING))
			->execute();
	}
	
}