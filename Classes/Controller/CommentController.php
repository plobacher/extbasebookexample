<?php
namespace Pluswerk\Simpleblog\Controller;

class CommentController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \Pluswerk\Simpleblog\Domain\Repository\CommentRepository
     */
    protected $commentRepository;

    /**
     * @param \Pluswerk\Simpleblog\Domain\Repository\CommentRepository $commentRepository
     */
    public function injectCommentRepository(\Pluswerk\Simpleblog\Domain\Repository\CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function initializeAction()
    {
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        $querySettings->setRespectStoragePage(FALSE);
        $querySettings->setIgnoreEnableFields(TRUE);
        $querySettings->setIncludeDeleted(TRUE);
        $this->commentRepository->setDefaultQuerySettings($querySettings);
    }

    public function indexAction()
    {
    }

    public function listAction()
    {
        $this->view->assign('commentsLive', $this->commentRepository->findByDeleted(0));
        $this->view->assign('commentsDeleted', $this->commentRepository->findByDeleted(1));
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Comment $comment
     */
    public function deleteAction(\Pluswerk\Simpleblog\Domain\Model\Comment $comment)
    {
        $this->commentRepository->remove($comment);
        $this->redirect('list');
    }

    public function testAction()
    {
        return 'Ausgabe der Action test';
    }
}