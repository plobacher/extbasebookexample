<?php
namespace Pluswerk\Simpleblog\ViewHelpers;

class GravatarViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper
{
    protected $tagName = 'img';

    public function initializeArguments() {
        $this->registerArgument('email', 'string',
            'Email for lookup at gravatar database', FALSE);
        $this->registerArgument('size', 'integer',
            'Size of gravatar picture', FALSE, 100);
    }

    public function render() {
        $email = ($this->arguments['email']) ?: $this->renderChildren();

        $gravatarUri = 'http://www.gravatar.com/avatar/' . md5($email) . '?s=' . urlencode($this->arguments['size']);

        $this->tag->addAttribute('src', $gravatarUri);

        return $this->tag->render();
    }
}