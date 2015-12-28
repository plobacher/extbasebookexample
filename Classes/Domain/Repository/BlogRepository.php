<?php
namespace Pluswerk\Simpleblog\Domain\Repository;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Patrick Lobacher <patrick@lobacher.de>, +Pluswerk AG
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * The repository for Blogs
 */
class BlogRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    public function findSearchWord($search, $words = array('Tick', 'Trick', 'Track'))
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalOr(
                $query->logicalAnd(
                    $query->like('title', '%'.$search.'%'),
                    $query->equals('description', '')
                ),
                $query->logicalAnd(
                    $query->equals('title', 'TYPO3'),
                    $query->like('description', '%ist toll%')
                ),
                $query->in('title', $words)
            )
        );
        return $query->execute();
    }

    /**
     * @param string $search
     * @param int $limit
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findSearchForm($search,$limit)
    {

        $query = $this->createQuery();

        $query->matching(
            $query->like('title','%'.$search.'%')
        );

        $query->setOrderings(array('title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));

        $limit = (int)$limit;
        if ($limit > 0) {
            $query->setLimit($limit);
        }

        return $query->execute();
    }
}