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

    public function initializeObject()
    {
        //$this->databaseHandle = $GLOBALS['TYPO3_DB'];
        //$this->databaseHandle->explainOutput = 2;
        //$this->databaseHandle->store_lastBuiltQuery = TRUE;
        //$this->databaseHandle->debugOutput = 2;
    }

    public function initializeAction()
    {
        //if ($this->arguments->hasArgument('blog')) {
        //    $this->arguments->getArgument('blog')->getPropertyMappingConfiguration()->setTargetTypeForSubProperty('image', 'array');
        //}
    }

    public function listAction()
    {
        if ($this->request->hasArgument('search')){
            $search = $this->request->getArgument('search');
        }

        $limit = ($this->settings['blog']['max']) ?: NULL;

        $this->view->assign('blogs', $this->blogRepository->findSearchForm($search,$limit));
        $this->view->assign('search', $search);
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function addFormAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog = NULL)
    {
        $this->view->assign('blog',$blog);
    }

    public function initializeAddAction()
    {
        $this->setTypeConverterConfigurationForImageUpload('blog');
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @validate $blog Pluswerk.Simpleblog:Autocomplete(property=title)
     */
    public function addAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog)
    {
        $this->addFlashMessage(
            'Blog created successfully!',
            'Status',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::OK,TRUE
        );
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

    public function initializeUpdateAction()
    {
        $this->setTypeConverterConfigurationForImageUpload('blog');
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function updateFormAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog)
    {
        $this->view->assign('blog',$blog);
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function updateAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog)
    {
        $this->blogRepository->update($blog);
        $this->redirect('list');
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function deleteConfirmAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog)
    {
        $this->view->assign('blog',$blog);
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function deleteAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog)
    {
        $this->blogRepository->remove($blog);
        $this->redirect('list');
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function rssAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog)
    {
        $this->view->assign('blog', $blog);
    }

    protected function setTypeConverterConfigurationForImageUpload($argumentName)
    {
        $uploadConfiguration = array(
            \Pluswerk\Simpleblog\Property\TypeConverter\UploadedFileReferenceConverter::CONFIGURATION_ALLOWED_FILE_EXTENSIONS => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
            \Pluswerk\Simpleblog\Property\TypeConverter\UploadedFileReferenceConverter::CONFIGURATION_UPLOAD_FOLDER => '1:/simpleblog/',
        );
        $newExampleConfiguration = $this->arguments[$argumentName]->getPropertyMappingConfiguration();
        $newExampleConfiguration->forProperty('image')
            ->setTypeConverterOptions(
                'Pluswerk\\Simpleblog\\Property\\TypeConverter\\UploadedFileReferenceConverter',
                $uploadConfiguration
            );
    }
}