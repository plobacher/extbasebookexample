<?php
namespace Pluswerk\Simpleblog\ViewHelpers;

class PropertyViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
    /**
     * @param string $propertyName
     * @param mixed $object
     * @return mixed
     */
    public function render($propertyName, $subject = NULL) {
        if ($subject === NULL) {
            $subject = $this->renderChildren();
        }
        return \TYPO3\CMS\Extbase\Reflection\ObjectAccess::getPropertyPath($subject,
            $propertyName);
    }
}