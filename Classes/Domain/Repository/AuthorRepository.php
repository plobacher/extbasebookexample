<?php
namespace Pluswerk\Simpleblog\Domain\Repository;

class AuthorRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    protected $defaultOrderings = array('fullname' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);

}