<?php
namespace Pluswerk\Simpleblog\ViewHelpers\Widget\Controller;

class SortController extends \TYPO3\CMS\Fluid\Core\Widget\AbstractWidgetController
{
    /**
     * @var \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    protected $objects;

    public function initializeAction()
    {
        $this->objects = $this->widgetConfiguration['objects'];
    }

    /**
     * @param string $order
     */
    public function indexAction($order = \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING)
    {
        $order = ($order == \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING) ? \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING : \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING;

        $query = $this->objects->getQuery();
        $query->setOrderings(array($this->widgetConfiguration['property'] => $order));
        $modifiedObjects = $query->execute();

        $this->view->assign('contentArguments', array(
            $this->widgetConfiguration['as'] => $modifiedObjects
        ));
        $this->view->assign('order', $order);
    }
}