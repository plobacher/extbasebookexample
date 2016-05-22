<?php
namespace Pluswerk\Simpleblog\ViewHelpers\Form;

class UploadViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Form\UploadViewHelper
{
    /**
     * @var \TYPO3\CMS\Extbase\Security\Cryptography\HashService
     * @inject
     */
    protected $hashService;

    /**
     * @var \TYPO3\CMS\Extbase\Property\PropertyMapper
     * @inject
     */
    protected $propertyMapper;

    /**
     * Render the upload field including possible resource pointer
     *
     * @return string
     * @api
     */
    public function render() {
        $output = '';

        $resource = $this->getUploadedResource();
        if ($resource !== NULL) {
            $resourcePointerIdAttribute = '';
            if ($this->hasArgument('id')) {
                $resourcePointerIdAttribute = ' id="' . htmlspecialchars($this->arguments['id']) . '-file-reference"';
            }
            $resourcePointerValue = $resource->getUid();
            if ($resourcePointerValue === NULL) {
                // Newly created file reference which is not persisted yet.
                // Use the file UID instead, but prefix it with "file:" to communicate this to the type converter
                $resourcePointerValue = 'file:' . $resource->getOriginalResource()->getOriginalFile()->getUid();
            }
            $output .= '<input type="hidden" name="' . $this->getName() . '[submittedFile][resourcePointer]" value="' . htmlspecialchars($this->hashService->appendHmac((string)$resourcePointerValue)) . '"' . $resourcePointerIdAttribute . ' />';

            $this->templateVariableContainer->add('resource', $resource);
            $output .= $this->renderChildren();
            $this->templateVariableContainer->remove('resource');
        }

        $output .= parent::render();
        return $output;
    }


    /**
     * Return a previously uploaded resource.
     * Return NULL if errors occurred during property mapping for this property.
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected function getUploadedResource() {
        if ($this->getMappingResultsForProperty()->hasErrors()) {
            return NULL;
        }
        $resource = $this->getValue(FALSE);
        if ($resource instanceof \TYPO3\CMS\Extbase\Domain\Model\FileReference) {
            return $resource;
        }
        return $this->propertyMapper->convert($resource, 'TYPO3\\CMS\\Extbase\\Domain\\Model\\FileReference');
    }


}