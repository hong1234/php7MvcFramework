<?php
namespace Diva\Repository;

use Doctrine\ORM\EntityManager;

abstract class EntityRepository {
    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
}