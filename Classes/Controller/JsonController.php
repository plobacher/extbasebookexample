<?php
namespace Pluswerk\Simpleblog\Controller;

class JsonController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

protected $defaultViewObjectName = 'TYPO3\\CMS\\Extbase\\Mvc\\View\\JsonView';

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

    public function jsonAction()
    {
        $this->view->setVariablesToRender(array('blogs','posts'));
        $this->view->setConfiguration(
            array(
                'blogs' => array(
                    '_descendAll'=>array(
                        '_only'=>array('title','posts'),
                        '_descend'=>array(
                            'posts'=>array(
                                '_descendAll'=>array(
                                    '_only'=>array('title'),
                                    //'_descend'=>array('title')
                                )
                            )
                        )
                    ),
                ),
            )
        );
        $this->view->assign('blogs', $this->blogRepository->findAll());
    }

}