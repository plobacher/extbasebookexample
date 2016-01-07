<?php
namespace Pluswerk\Simpleblog\Domain\Model;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Patrick Lobacher <patrick@lobacher.de>, +Pluswerk AG
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
 * Blogs
 */
class Blog extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title
     *
     * @var string
     * @validate NotEmpty, Pluswerk.Simpleblog:Word(max=3)
     */
    protected $title = '';
    
    /**
     * description
     *
     * @var string
     */
    protected $description = '';
    
    /**
     * Picture of the blog
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $image = null;
    
    /**
     * Blog posts
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Pluswerk\Simpleblog\Domain\Model\Post>
     * @cascade remove
     * @lazy
     */
    protected $posts = null;

    /**
     * crdate
     * @var DateTime
     */
    protected $crdate;
    
    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    /**
     * Returns the image
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function getImage()
    {
        return $this->image;
    }
    
    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        $this->image = $image;
    }
    
    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }
    
    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->posts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Adds a Post
     *
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     * @return void
     */
    public function addPost(\Pluswerk\Simpleblog\Domain\Model\Post $post)
    {
        $this->posts->attach($post);
    }
    
    /**
     * Removes a Post
     *
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $postToRemove The Post to be removed
     * @return void
     */
    public function removePost(\Pluswerk\Simpleblog\Domain\Model\Post $postToRemove)
    {
        $this->posts->detach($postToRemove);
    }
    
    /**
     * Returns the posts
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Pluswerk\Simpleblog\Domain\Model\Post> $posts
     */
    public function getPosts()
    {
        return $this->posts;
    }
    
    /**
     * Sets the posts
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Pluswerk\Simpleblog\Domain\Model\Post> $posts
     * @return void
     */
    public function setPosts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $posts)
    {
        $this->posts = $posts;
    }

    /**
     * @param \DateTime $crdate
     * @return void
     */
    public function setCrdate(\DateTime $crdate) {
        $this->crdate = $crdate;
    }

    /**
     * @return \DateTime
     */
    public function getCrdate() {
        return $this->crdate;
    }

}