<?php
namespace Pluswerk\Simpleblog\ViewHelpers;

class IsFrontendViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractConditionViewHelper
{
    public function render()
    {
        if (TYPO3_MODE === 'FE') {
            return $this->renderThenChild();
        }
        return $this->renderElseChild();
    }
}