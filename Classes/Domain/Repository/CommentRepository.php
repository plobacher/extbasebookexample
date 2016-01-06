<?php
namespace Pluswerk\Simpleblog\Domain\Repository;

class CommentRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    protected $defaultOrderings = array('commentdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING);

}