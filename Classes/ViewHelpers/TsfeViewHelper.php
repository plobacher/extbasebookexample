<?php
namespace Pluswerk\Simpleblog\ViewHelpers;

class TsfeViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    public function initializeArguments()
    {
        $this->registerArgument('key', 'string',
            'This is the TSFE key e.g. page|title', FALSE);
    }

    public function render()
    {
        $key = ($this->arguments['key']) ? $this->arguments['key'] : $this->renderChildren();
        if ($key === NULL) {
            return '';
        } else {
            return $this->getTsfeValue('TSFE|'.$key);
        }
    }

    public function getTsfeValue($keyString)
    {
        $keys = explode('|', $keyString);
        $numberOfLevels = count($keys);
        $rootKey = trim($keys[0]);
        $value = $GLOBALS[$rootKey];
        for ($i = 1; $i < $numberOfLevels && isset($value); $i++) {
            $currentKey = trim($keys[$i]);
            if (is_object($value)) {
                $value = $value->{$currentKey};
            } elseif (is_array($value)) {
                $value = $value[$currentKey];
            } else {
                $value = '';
                break;
            }
        }
        if (!is_scalar($value)) {
            $value = '';
        }
        return $value;
    }
}