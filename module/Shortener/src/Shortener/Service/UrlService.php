<?php
/**
 * Created by PhpStorm.
 * User: Mohamed Magdy
 * Date: 10/12/2015
 * Time: 4:03 AM
 */

namespace Shortener\Service;


use Application\Service\AbstractService;
use Domain\Entity\Url;

class UrlService extends AbstractService{

    /**
     * @param Url $url
     * @return integer
     */
    public function createShortUrl ($url){
        try{
            $this->entityManager->persist($url);
            $this->entityManager->flush();
            if ($url->id!=null){
                return base64_encode($url->id);
            }
        } catch (\Exception $e){
            var_dump($e->getMessage());
            return null;
        }
        return null;
    }
}