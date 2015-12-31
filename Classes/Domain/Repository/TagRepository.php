<?php
namespace Pluswerk\Simpleblog\Domain\Repository;

class TagRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    protected $defaultOrderings = array('tagvalue' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);

}