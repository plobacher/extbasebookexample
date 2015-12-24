<?php
namespace Pluswerk\Simpleblog\Controller;

class BlogController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    public function listAction()
    {
        $blogs = array();
        for ($i=1; $i<=3; $i++) {
            /** @var \Pluswerk\Simpleblog\Domain\Model\Blog $blog */
            $blog = $this->objectManager->get('Pluswerk\\Simpleblog\\Domain\\Model\\Blog');
            $blog->setTitle('Das ist der ' . $i . '. Blog!');
            $blogs[] = $blog;
        }
        $this->view->assign('blogs', $blogs);
    }

}