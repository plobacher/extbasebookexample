<?php
namespace Pluswerk\Simpleblog\ViewHelpers\Widget\Controller;

class AtoZNavController extends \TYPO3\CMS\Fluid\Core\Widget\AbstractWidgetController
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
    public function indexAction($char = '%')
    {
        $query = $this->objects->getQuery();
        // just get objects with configured beginning char
        $query->matching($query->like($this->widgetConfiguration['property'],$char.'%'));
        $modifiedObjects = $query->execute();

        $this->view->assign('contentArguments', array(
            $this->widgetConfiguration['as'] => $modifiedObjects
        ));

        $this->view->assign('letters', range('A', 'Z'));
        $this->view->assign('char', $char);
    }

}
