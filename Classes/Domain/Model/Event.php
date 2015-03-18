<?php
namespace OliverThiele\OtEvents\Domain\Model;

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

/**
 * Event
 */
class Event extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title = '';

	/**
	 * Subtitle
	 *
	 * @var string
	 */
	protected $subtitle = '';

	/**
	 * topEvent
	 *
	 * @var bool
	 */
	protected $topEvent = FALSE;

	/**
	 * Start
	 *
	 * @var \DateTime
	 * @validate NotEmpty
	 */
	protected $eventDateTimeStart = NULL;

	/**
	 * Stop
	 *
	 * @var \DateTime
	 */
	protected $eventDateTimeStop = NULL;

	/**
	 * Teaser
	 *
	 * @var string
	 */
	protected $shortText = '';

	/**
	 * RTE-Text
	 *
	 * @var string
	 */
	protected $bodytext = '';

	/**
	 * Images
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @cascade remove
	 */
	protected $images = NULL;

	/**
	 * Documents
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @cascade remove
	 */
	protected $documents = NULL;

	/**
	 * eventLocation
	 *
	 * @var \OliverThiele\OtEvents\Domain\Model\EventLocation
	 */
	protected $eventLocation = NULL;

	/**
	 * eventCategories
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverThiele\OtEvents\Domain\Model\EventCategory>
	 */
	protected $eventCategories = NULL;

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the subtitle
	 *
	 * @return string $subtitle
	 */
	public function getSubtitle() {
		return $this->subtitle;
	}

	/**
	 * Sets the subtitle
	 *
	 * @param string $subtitle
	 * @return void
	 */
	public function setSubtitle($subtitle) {
		$this->subtitle = $subtitle;
	}

	/**
	 * Returns the eventDateTimeStart
	 *
	 * @return \DateTime $eventDateTimeStart
	 */
	public function getEventDateTimeStart() {
		return $this->eventDateTimeStart;
	}

	/**
	 * Sets the eventDateTimeStart
	 *
	 * @param \DateTime $eventDateTimeStart
	 * @return void
	 */
	public function setEventDateTimeStart(\DateTime $eventDateTimeStart) {
		$this->eventDateTimeStart = $eventDateTimeStart;
	}

	/**
	 * Returns the eventDateTimeStop
	 *
	 * @return \DateTime $eventDateTimeStop
	 */
	public function getEventDateTimeStop() {
		return $this->eventDateTimeStop;
	}

	/**
	 * Sets the eventDateTimeStop
	 *
	 * @param \DateTime $eventDateTimeStop
	 * @return void
	 */
	public function setEventDateTimeStop(\DateTime $eventDateTimeStop) {
		$this->eventDateTimeStop = $eventDateTimeStop;
	}

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();

		if(!$this->title){
			$now = new \DateTime();
			$this->title = $now->format('d.m.Y H:i:s');
		}
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->images = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->documents = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->eventCategories = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the shortText
	 *
	 * @return string $shortText
	 */
	public function getShortText() {
		return $this->shortText;
	}

	/**
	 * Sets the shortText
	 *
	 * @param string $shortText
	 * @return void
	 */
	public function setShortText($shortText) {
		$this->shortText = $shortText;
	}

	/**
	 * Returns the bodytext
	 *
	 * @return string $bodytext
	 */
	public function getBodytext() {
		return $this->bodytext;
	}

	/**
	 * Sets the bodytext
	 *
	 * @param string $bodytext
	 * @return void
	 */
	public function setBodytext($bodytext) {
		$this->bodytext = $bodytext;
	}

	/**
	 * Adds a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 * @return void
	 */
	public function addImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image) {
		$this->images->attach($image);
	}

	/**
	 * Removes a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageToRemove The FileReference to be removed
	 * @return void
	 */
	public function removeImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $imageToRemove) {
		$this->images->detach($imageToRemove);
	}

	/**
	 * Returns the images
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 */
	public function getImages() {
		return $this->images;
	}

	/**
	 * Sets the images
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 * @return void
	 */
	public function setImages(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $images) {
		$this->images = $images;
	}

	/**
	 * Adds a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $document
	 * @return void
	 */
	public function addDocument(\TYPO3\CMS\Extbase\Domain\Model\FileReference $document) {
		$this->documents->attach($document);
	}

	/**
	 * Removes a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $documentToRemove The FileReference to be removed
	 * @return void
	 */
	public function removeDocument(\TYPO3\CMS\Extbase\Domain\Model\FileReference $documentToRemove) {
		$this->documents->detach($documentToRemove);
	}

	/**
	 * Returns the documents
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $documents
	 */
	public function getDocuments() {
		return $this->documents;
	}

	/**
	 * Sets the documents
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $documents
	 * @return void
	 */
	public function setDocuments(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $documents) {
		$this->documents = $documents;
	}

	/**
	 * Returns the eventLocation
	 *
	 * @return \OliverThiele\OtEvents\Domain\Model\EventLocation $eventLocation
	 */
	public function getEventLocation() {
		return $this->eventLocation;
	}

	/**
	 * Sets the eventLocation
	 *
	 * @param \OliverThiele\OtEvents\Domain\Model\EventLocation $eventLocation
	 * @return void
	 */
	public function setEventLocation(\OliverThiele\OtEvents\Domain\Model\EventLocation $eventLocation) {
		$this->eventLocation = $eventLocation;
	}

	/**
	 * Adds a EventCategory
	 *
	 * @param \OliverThiele\OtEvents\Domain\Model\EventCategory $eventCategory
	 * @return void
	 */
	public function addEventCategory(\OliverThiele\OtEvents\Domain\Model\EventCategory $eventCategory) {
		$this->eventCategories->attach($eventCategory);
	}

	/**
	 * Removes a EventCategory
	 *
	 * @param \OliverThiele\OtEvents\Domain\Model\EventCategory $eventCategoryToRemove The EventCategory to be removed
	 * @return void
	 */
	public function removeEventCategory(\OliverThiele\OtEvents\Domain\Model\EventCategory $eventCategoryToRemove) {
		$this->eventCategories->detach($eventCategoryToRemove);
	}

	/**
	 * Returns the eventCategories
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverThiele\OtEvents\Domain\Model\EventCategory> $eventCategories
	 */
	public function getEventCategories() {
		return $this->eventCategories;
	}

	/**
	 * Sets the eventCategories
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverThiele\OtEvents\Domain\Model\EventCategory> $eventCategories
	 * @return void
	 */
	public function setEventCategories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $eventCategories) {
		$this->eventCategories = $eventCategories;
	}

	/**
	 * @return boolean
	 */
	public function isTopEvent()
	{
		return $this->topEvent;
	}
	/**
	 * @return boolean
	 */
	public function getTopEvent()
	{
		return $this->isTopEvent();
	}

	/**
	 * @param boolean $topEvent
	 */
	public function setTopEvent($topEvent)
	{
		$this->topEvent = $topEvent;
	}

}