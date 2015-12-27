<?php
namespace Pluswerk\Simpleblog\View;

class TemplateParser extends \TYPO3\CMS\Fluid\Core\Parser\TemplateParser {
    protected $namespacesBase = array();
    public function initializeObject() {
        $this->namespacesBase = $this->namespaces += array(
            'simpleblog' => 'Pluswerk\Simpleblog\ViewHelpers'
        );
    }

    protected function reset() {
        $this->namespaces = $this->namespacesBase;
    }
}
