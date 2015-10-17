<?php
/**
 * Created by PhpStorm.
 * User: Mohamed Magdy
 * Date: 10/12/2015
 * Time: 4:03 AM
 */

namespace Shortener\Service;


use Application\Service\AbstractService;
use Doctrine\Common\Util\Debug;
use Domain\Entity\Log;
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

    /**
     * @param $id
     * @return Url
     */
    public function getUrlById ($id){
        try {
          $url= $this->entityManager->getRepository('\Domain\Entity\Url')->find($id);
          return $url;

        } catch (\Exception $e){
          return null;
        }
    }

    public function logVisit (Log $log){
        try{
            $this->entityManager->persist($log);
            $this->entityManager->flush();
            if ($log->id!=null){
                return $log;
            }
        } catch (\Exception $e){
            var_dump($e->getMessage());
            return null;
        }
        return null;
    }

    public function getReportData ($id){
        $query = $this->entityManager->createQuery(
            'SELECT Date(log.visitDate) as date , count(log.id) as num
                FROM \Domain\Entity\Log log
             WHERE log.urlId = ?1
             GROUP BY date
            ORDER BY date asc'
        );
        $query->setParameter(1, $id);
        $result = $query->getResult();
        $results = array ();

        foreach ($result as $row) {
            $results[$row['date']]= $row['num'];
        }
        return $results;
    }
}