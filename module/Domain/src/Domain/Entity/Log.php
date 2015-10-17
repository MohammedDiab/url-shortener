<?php
/**
 * Created by PhpStorm.
 * User: Mohamed Magdy
 * Date: 10/12/2015
 * Time: 3:43 AM
 */

namespace Domain\Entity;


use Domain\Entity\Abstracts\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Log
 * @package Domain\Entity
 * @ORM\Table(name="log")
 * @ORM\Entity
 */
class Log extends Entity{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer",name="id")
     */
    public $id;

    /**
     * @ORM\Column(type="integer",name="url_id")
     */
    public $urlId;

    /**
     * @ORM\Column(type="datetime",name="visit_date")
     */
    public $visitDate;

}