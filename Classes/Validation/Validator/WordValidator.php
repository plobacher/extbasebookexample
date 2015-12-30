<?php
namespace Pluswerk\Simpleblog\Validation\Validator;

class WordValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator
{
    protected $supportedOptions = array(
        'max' => array(3, 'Maximum word count for a valid string', 'integer'),
    );

    public function isValid($property) {

        $maxWords   = $this->options['max'];
        $usedWords  = str_word_count($property, 0);

        if ($usedWords <= $maxWords) {
            return TRUE;
        } else {
            $this->addError('Reduce word count - allowed are <strong>' . $maxWords . '</strong> words maximum (you used ' . $usedWords . ' words)!', 1451318887);
            return FALSE;
        }
    }

}