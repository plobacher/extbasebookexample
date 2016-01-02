<?php
namespace Pluswerk\Simpleblog\ViewHelpers;

class DummyTextViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
    public function initializeArguments()
    {
        $this->registerArgument('length', 'integer', 'This is the length of the dummytext', FALSE);
    }

    public function render()
    {
        $length = ($this->arguments['length']) ?: 100;
        $dummytext = ($this->renderChildren()) ?: 'Lorem ipsum dolor sit amet. ';
        $len = strlen($dummytext);
        $repeat = ceil($length / $len);
        $dummytext_neu = substr(str_repeat($dummytext,$repeat),0,$length);
        return $dummytext_neu;
    }
}