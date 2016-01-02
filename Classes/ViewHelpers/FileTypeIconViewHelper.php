<?php
namespace Pluswerk\Simpleblog\ViewHelpers;

class FileTypeIconViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{


    public function initializeArguments()
    {
        $this->registerArgument('file', 'string', 'Filename with extension', FALSE);
    }

    public function render()
    {
        if (isset($this->arguments['file'])) {
            $file = $this->arguments['file'];
        } else {
            $file = $this->renderChildren();
        }
        $extension = end(explode('.',$file));

        switch ($extension) {
            case 'pdf':
                $icon = '647710-pdf-16.png';
                break;
            case 'xls':
            case 'xlst':
                $icon = '647708-excel-16.png';
                break;
            case 'doc':
            case 'docx':
                $icon = '647713-word-16.png';
                break;
            default:
                $icon = '647712-text-16.png';
        }
        $url = 'https://cdn3.iconfinder.com/data/icons/document-icons-2/30/' . $icon;
        $return = '<img src="'.$url.'">&nbsp;';
        if (!isset($this->arguments['file'])) {
            $return .= $file;
        }
        return $return;
    }
}