<?php
namespace Pluswerk\Simpleblog\Controller;

class PostController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \Pluswerk\Simpleblog\Domain\Repository\PostRepository
     */
    protected $postRepository;

    /**
     * @param \Pluswerk\Simpleblog\Domain\Repository\PostRepository $postRepository
     */
    public function injectPostRepository(\Pluswerk\Simpleblog\Domain\Repository\PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function addFormAction(
            \Pluswerk\Simpleblog\Domain\Model\Blog $blog,
            \Pluswerk\Simpleblog\Domain\Model\Post $post = NULL)
    {
        $this->view->assign('blog',$blog);
        $this->view->assign('post',$post);
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function addAction(
            \Pluswerk\Simpleblog\Domain\Model\Blog $blog,
            \Pluswerk\Simpleblog\Domain\Model\Post $post)
    {
        //$post->setPostdate(new \DateTime());

        //$this->postRepository->add($post);

        $blog->addPost($post);
        $this->objectManager->get('Pluswerk\\Simpleblog\\Domain\\Repository\\BlogRepository')->update($blog);
        $this->redirect('show','Blog',NULL,array('blog'=>$blog));
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function showAction(
            \Pluswerk\Simpleblog\Domain\Model\Blog $blog,
            \Pluswerk\Simpleblog\Domain\Model\Post $post)
    {
        $this->view->assign('blog',$blog);
        $this->view->assign('post',$post);
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function updateFormAction(
        \Pluswerk\Simpleblog\Domain\Model\Blog $blog,
        \Pluswerk\Simpleblog\Domain\Model\Post $post)
    {
        $this->view->assign('blog',$blog);
        $this->view->assign('post',$post);
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function updateAction(
        \Pluswerk\Simpleblog\Domain\Model\Blog $blog,
        \Pluswerk\Simpleblog\Domain\Model\Post $post)
    {
        $this->postRepository->update($post);
        $this->redirect('show','Blog',NULL,array('blog'=>$blog));
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function deleteConfirmAction(
        \Pluswerk\Simpleblog\Domain\Model\Blog $blog,
        \Pluswerk\Simpleblog\Domain\Model\Post $post)
    {
        $this->view->assign('blog',$blog);
        $this->view->assign('post',$post);
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function deleteAction(
        \Pluswerk\Simpleblog\Domain\Model\Blog $blog,
        \Pluswerk\Simpleblog\Domain\Model\Post $post)
    {
        $blog->removePost($post);
        $this->objectManager->get('Pluswerk\\Simpleblog\\Domain\\Repository\\BlogRepository')->update($blog);
        $this->postRepository->remove($post);
        $this->redirect('show','Blog',NULL,array('blog'=>$blog));
    }
}