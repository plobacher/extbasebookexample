<?php
namespace Pluswerk\Simpleblog\ViewHelpers\Widget;

class AtoZNavViewHelper extends \TYPO3\CMS\Fluid\Core\Widget\AbstractWidgetViewHelper
{
    /**
     * @var \Pluswerk\Simpleblog\ViewHelpers\Widget\Controller\AtoZNavController
     * @inject
     */
    protected $controller;

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\QueryResultInterface $objects
     * @param string $as
     * @param string $property
     * @return string
     */
    public function render(
            \TYPO3\CMS\Extbase\Persistence\QueryResultInterface $objects,
            $as,
            $property)
    {
        return $this->initiateSubRequest();
    }
}