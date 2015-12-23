<?php

namespace Pluswerk\Simpleblog\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Patrick Lobacher <patrick@lobacher.de>, +Pluswerk AG
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
 * Test case for class \Pluswerk\Simpleblog\Domain\Model\Blog.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Patrick Lobacher <patrick@lobacher.de>
 */
class BlogTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \Pluswerk\Simpleblog\Domain\Model\Blog
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \Pluswerk\Simpleblog\Domain\Model\Blog();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle()
	{
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription()
	{
		$this->subject->setDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'description',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getImageReturnsInitialValueForFileReference()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getImage()
		);
	}

	/**
	 * @test
	 */
	public function setImageForFileReferenceSetsImage()
	{
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setImage($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'image',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPostsReturnsInitialValueForPost()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getPosts()
		);
	}

	/**
	 * @test
	 */
	public function setPostsForObjectStorageContainingPostSetsPosts()
	{
		$post = new \Pluswerk\Simpleblog\Domain\Model\Post();
		$objectStorageHoldingExactlyOnePosts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOnePosts->attach($post);
		$this->subject->setPosts($objectStorageHoldingExactlyOnePosts);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOnePosts,
			'posts',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addPostToObjectStorageHoldingPosts()
	{
		$post = new \Pluswerk\Simpleblog\Domain\Model\Post();
		$postsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$postsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($post));
		$this->inject($this->subject, 'posts', $postsObjectStorageMock);

		$this->subject->addPost($post);
	}

	/**
	 * @test
	 */
	public function removePostFromObjectStorageHoldingPosts()
	{
		$post = new \Pluswerk\Simpleblog\Domain\Model\Post();
		$postsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$postsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($post));
		$this->inject($this->subject, 'posts', $postsObjectStorageMock);

		$this->subject->removePost($post);

	}
}
