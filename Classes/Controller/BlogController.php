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

    public function addAction()
    {
        for ($i=1; $i<=3; $i++) {
            $blog = $this->objectManager->get('Pluswerk\\Simpleblog\\Domain\\Model\\Blog');
            $blog->setTitle('Das ist der ' . $i . '. Blog!');
            $this->blogRepository->add($blog);
        }
       $this->redirect('list');
    }

}