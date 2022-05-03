<?php
namespace App\Service\Query;

use App\Entity\Customers;

class CustomersQuery extends AbstractQuery
{
    /**
     *
     * {@inheritDoc}
     * @see \App\Service\Query\QueryInterface::getRepository()
     */
    public function getRepository()
    {
        return $this->em->getRepository(Customers::class);
    }
}
