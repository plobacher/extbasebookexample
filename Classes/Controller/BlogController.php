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
        for ($i=1; $i<=3; $i++) {
            $blog = $this->objectManager->get('Pluswerk\\Simpleblog\\Domain\\Model\\Blog');
            $blog->setTitle('Das ist der ' . $i . '. Blog!');
            $this->blogRepository->add($blog);
        }
        $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager')->persistAll();
        $this->view->assign('blogs',$this->blogRepository->findAll());
    }

}