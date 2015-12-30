<?php
namespace Pluswerk\Simpleblog\Validation\Validator;

class AutocompleteValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

    /**
     * API Service
     *
     * @var \Pluswerk\Simpleblog\Service\GoogleAutocompleteApiService
     */
    protected $googleAutocompleteApiService;

    /**
     * Object Manager
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     */
    protected $objectManager;

    protected $supportedOptions = array(
        'property' => array('', 'Property to validate against', 'string'),
    );

    /**
     * @param \Pluswerk\Simpleblog\Service\GoogleAutocompleteApiService $googleAutocompleteApiService
     */
    public function injectGoogleAutocompleteApiService(\Pluswerk\Simpleblog\Service\GoogleAutocompleteApiService $googleAutocompleteApiService)
    {
        $this->googleAutocompleteApiService = $googleAutocompleteApiService;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     */
    public function injectObjectManager(\TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    protected function isValid($object) {
        $property = $this->options['property'];
        $apiValidationResult = $this->googleAutocompleteApiService->validateData($object,$property);
        $success = TRUE;
        if ($apiValidationResult[$property]) {
            $error = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Validation\\Error',
                $apiValidationResult[$property], 1451457544);
            $this->result->forProperty($property)->addError($error);
            $success = FALSE;
        }
        return $success;
    }
}