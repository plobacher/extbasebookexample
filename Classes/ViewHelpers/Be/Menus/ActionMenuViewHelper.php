<?php
namespace Pluswerk\Simpleblog\ViewHelpers\Be\Menus;

/**
 * Wrapper for f:be.menus.actionMenu
 * Adapts HTML for 7.6 ModuleTemplate API
 */
class ActionMenuViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Be\Menus\ActionMenuViewHelper
{

    /**
     * @param string $defaultController
     * @return string
     */
    public function render($defaultController = null)
    {
        $this->tag->addAttribute('class', 'form-control input-sm');
        $this->tag->addAttribute('onchange', 'jumpToUrl(this.options[this.selectedIndex].value, this);');
        $options = '';
        foreach ($this->childNodes as $childNode) {
            if ($childNode instanceof \TYPO3\CMS\Fluid\Core\Parser\SyntaxTree\ViewHelperNode) {
                $options .= $childNode->evaluate($this->renderingContext);
            }
        }
        $this->tag->setContent($options);
        return $this->tag->render();
    }
}
