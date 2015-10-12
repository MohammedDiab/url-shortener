<?php
/**
 * Created by PhpStorm.
 * User: Mohamed Magdy
 * Date: 10/11/2015
 * Time: 2:40 AM
 */


namespace Shortener\Service;

use Shortener\Form\CustomCaptcha;
use Traversable;
use Zend\Captcha\Factory;
use Zend\Captcha\Image;
use Zend\Form\Element\Text;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\ArrayUtils;

class CaptchaFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $config  = $sm->get('config');

        $captchaOptions = $config['captcha'];

        $plugins = $sm->get('ViewHelperManager');
        $urlHelper = $plugins->get('url');

        $url = $urlHelper($captchaOptions['captchaGeneratorRouteName']);

        $captcha = new CustomCaptcha(
           array(
               'font'=>$captchaOptions['font'],
               'imgDir' => 'data/captchaTmpImages',
               'imgUrl'=>$url,
               'width' => $captchaOptions['width'],
               'height' => $captchaOptions['height'],
               'dotNoiseLevel' => 40,
               'lineNoiseLevel' => 3,
           )
        );

        $url = new Text(
            array(

            )
        );

        return $captcha;
    }
}