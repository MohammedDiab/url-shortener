<?php
/**
 * Created by PhpStorm.
 * User: Mohamed Magdy
 * Date: 10/12/2015
 * Time: 4:01 AM
 */

namespace Application\Service;

use Doctrine\ORM\EntityManager;

class AbstractService {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    public function __construct(EntityManager $em ){
        $this->entityManager = $em;
    }
}