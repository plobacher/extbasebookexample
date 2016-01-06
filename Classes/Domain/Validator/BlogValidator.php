<?php
namespace Pluswerk\Simpleblog\Domain\Validator;

class BlogValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator
{
    /**
     * Validates a blog
     *
     * @param mixed $object
     * @return bool
     */
    protected function isValid($blog)
    {
        if (    preg_match('/Joomla/i',$blog->getTitle()) &&
                preg_match('/is better than TYPO3/i',$blog->getDescription())) {

            $this->result->forProperty('title')
                ->addError(
                    new \TYPO3\CMS\Extbase\Error\Error(
                        'Title should not be "Joomla" while description is "better than TYPO3"!', 1451373678));

            $this->result->forProperty('description')
                ->addError(
                    new \TYPO3\CMS\Extbase\Error\Error(
                        'Description should not be "better than TYPO3" while title is "Joomla"!', 1451373679));

            return FALSE;
        } else {
            return TRUE;
        }
    }
}