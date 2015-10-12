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
 * Class Url
 * @package Domain\Entity
 * @ORM\Table(name="url")
 * @ORM\Entity
 */
class Url extends Entity{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer",name="id")
     */
    public $id;

    /**
     * @ORM\Column(type="string",name="url")
     */
    public $url;

    /**
     * @ORM\Column(type="datetime",name="created_date")
     */
    public $createdDate;

}