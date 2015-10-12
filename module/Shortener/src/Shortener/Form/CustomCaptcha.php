<?php
/**
 * Created by PhpStorm.
 * User: Mohamed Magdy
 * Date: 10/12/2015
 * Time: 1:16 AM
 */

namespace Shortener\Form;


use Zend\Form\ElementInterface;
use Zend\Captcha\Image as CaptchaAdapter;
use Zend\Form\Exception;

class CustomCaptcha  extends CaptchaAdapter{

    public function getHelperName()
    {
        return 'customCaptchaViewHelper';
    }


}