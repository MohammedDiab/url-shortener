<?php
/**
 * Created by PhpStorm.
 * User: Mohamed Magdy
 * Date: 10/11/2015
 * Time: 2:31 AM
 */

namespace Shortener\Form;
use Zend\Form\Form;
use Zend\Form\Element\Captcha;
use Zend\Captcha\AdapterInterface as CaptchaAdapter;
class TrackForm extends Form{

    public function __construct(CustomCaptcha $captchaAdapter = null)
    {
        parent::__construct('Track Form');
        $this->setAttribute('method', 'post');

        /*$captcha = new Captcha('captcha');
        $captcha->setCaptcha($captchaAdapter);
        $captcha->setOptions(array('label' => 'Please verify you are human.',"class"=>"test"));*/
        $this->add(array(
            'type' => 'Zend\Form\Element\Captcha',
            'name' => 'captcha',
            'options' => array(
                'label' => 'Please verify you are human',
                'captcha' => $captchaAdapter,),));

    }

}