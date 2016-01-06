<?php
namespace Pluswerk\Simpleblog\ViewHelpers;

class HasErrorViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper
{


    public function initializeArguments()
    {
        $this->registerArgument('property', 'string', 'Name of object property.', TRUE);
    }

    /**
     * @param string $then
     * @param string $else
     * @return string
     */
    public function render($then = '', $else = '')
    {
        $originalRequestMappingResults = $this->controllerContext->getRequest()->getOriginalRequestMappingResults();
        $formObjectName = $this->viewHelperVariableContainer->get( 'TYPO3\\CMS\\Fluid\\ViewHelpers\\FormViewHelper',  'formObjectName');
        $errors = $originalRequestMappingResults->forProperty( $formObjectName )->forProperty( $this->arguments['property'] );
        if ($errors->hasErrors() == 1) {
            return $then;
        } else {
            return $else;
        }

    }
}