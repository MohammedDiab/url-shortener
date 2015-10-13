<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Shortener\Controller;

use Domain\Entity\Url;
use Shortener\Form\FormCaptcha;
use Shortener\Form\URLShortenerForm;
use Shortener\Form\URLShortenerFormCaptcha;
use Shortener\Service\UrlService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\RequestInterface as Request;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    /**
     * @var Request
     */
    protected $request;
    protected $captchaService;

    /**
     * @var URLShortenerForm
     */
    protected $form ;
    /**
     * @var UrlService
     */
    protected $urlService;

    public function dispatch(Request $request, Response $response = null)
    {
        $this->request=  $request;
        $this->captchaService = $this->getServiceLocator()->get('CaptchaService');
        $this->form =  new URLShortenerForm($this->captchaService);
        $this->urlService= $this->getServiceLocator()->get("UrlService");
        return parent::dispatch($request, $response); // TODO: Change the autogenerated stub
    }


    public function tryAction()
    {
        return array('form' => $this->form);
    }

    public function shortAction (){

        $baseEncodedId  = null;
        $shortUrl = null;
        $error = null;
        if ($this->request->isPost()) {
            $this->form->setData($this->request->getPost());
            // check if the captcha is valid
            if (true) {
                $url = $this->params()->fromPost('url');
                $urlEntity = new Url();
                    $urlEntity->url=$url;
                    $urlEntity->createdDate= new \DateTime();
                $baseEncodedId = $this->urlService->createShortUrl($urlEntity) ;
            }else {
                $error = "Captcha is invalid";
            }
        }
        if ($baseEncodedId!=null){
            $shortUrl= "lesschr.com/".$baseEncodedId;
        }

        return new ViewModel(array("url"=>$shortUrl,"error"=>$error));


    }

    public function captchaAction ()
    {
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', "image/png");

        $id = $this->params('id', false);
        if ($id) {
            $config = $this->getServiceLocator()->get('config');
            $captchaOptions = $config['captcha'];
            $imagePath = $captchaOptions ['imgTmpPath']."/".$id;
            if (file_exists($imagePath) !== false) {
                $image= file_get_contents($imagePath);
                $response->setStatusCode(200);
                $response->setContent($image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        return $response;
    }
}
