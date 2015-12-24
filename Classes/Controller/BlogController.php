<?php
namespace Pluswerk\Simpleblog\Controller;

class BlogController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \Pluswerk\Simpleblog\Domain\Repository\BlogRepository
     */
    protected $blogRepository;

    /**
     * @param \Pluswerk\Simpleblog\Domain\Repository\BlogRepository $blogRepository
     */
    public function injectBlogRepository(\Pluswerk\Simpleblog\Domain\Repository\BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function listAction()
    {
        $this->view->assign('blogs',$this->blogRepository->findAll());
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function addFormAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog = NULL)
    {
        $this->view->assign('blog',$blog);
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function addAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog)
    {
        $this->blogRepository->add($blog);
        $this->redirect('list');
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function showAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog)
    {
        $this->view->assign('blog',$blog);
    }
}