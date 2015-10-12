<?php
/**
 * Created by PhpStorm.
 * User: Mohamed Magdy
 * Date: 10/12/2015
 * Time: 1:15 AM
 */

namespace Shortener\ViewHelper;

use Shortener\Form\CustomCaptcha;
use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\View\Helper\Captcha\AbstractWord;

use Zend\Form\ElementInterface;
use Zend\Form\Exception;

class CustomCaptchaViewHelper extends AbstractWord
{
    /**
     * Override
     *
     * Render the captcha
     *
     * @param  ElementInterface $element
     * @throws Exception\DomainException
     * @return string
     */
    public function render(ElementInterface $element)
    {
        $captcha = $element->getCaptcha();

        if ($captcha === null || !$captcha instanceof CustomCaptcha) {
            throw new Exception\DomainException(sprintf(
                '%s requires that the element has a "captcha" attribute of type Zend\Captcha\Image; none found',
                __METHOD__
            ));
        }

        $captcha->generate();

        $imgAttributes = array(
            'width'  => $captcha->getWidth(),
            'height' => $captcha->getHeight(),
            'alt'    => $captcha->getImgAlt(),
            'src'    => $captcha->getImgUrl() . $captcha->getId() . $captcha->getSuffix(),
        );
        $closingBracket = $this->getInlineClosingBracket();
        $img = sprintf(
            '<img %s%s',
            $this->createAttributesString($imgAttributes),
            $closingBracket
        );

        $position     = $this->getCaptchaPosition();
        $separator    = $this->getSeparator();
        $captchaInput = $this->renderCaptchaInputs($element);

        $pattern = '<div class="captha-text input-field col s6">%s</div>%s<div class="captha-image input-field col s6">%s</div>';
        //$pattern = '%s%s%s';
        if ($position == self::CAPTCHA_PREPEND) {
            return sprintf($pattern, $img, $separator, $captchaInput);
        }
        return sprintf($pattern, $captchaInput, $separator, $img);

    }

    protected function renderCaptchaInputs(ElementInterface $element)
    {
        $name = $element->getName();
        if ($name === null || $name === '') {
            throw new Exception\DomainException(sprintf(
                '%s requires that the element has an assigned name; none discovered',
                __METHOD__
            ));
        }

        $attributes = $element->getAttributes();
        $captcha = $element->getCaptcha();

        if ($captcha === null || !$captcha instanceof CaptchaAdapter) {
            throw new Exception\DomainException(sprintf(
                '%s requires that the element has a "captcha" attribute implementing Zend\Captcha\AdapterInterface; none found',
                __METHOD__
            ));
        }

        $hidden = $this->renderCaptchaHidden($captcha, $attributes);
        $input  = $this->renderCaptchaInput($captcha, $attributes);

        return $hidden . $input;
    }

    protected function renderCaptchaInput(CaptchaAdapter $captcha, array $attributes)
    {
        $attributes['type']  = 'text';
        $attributes['required']  = 'true';
        $attributes['class']  = 'validate';
        $attributes['name'] .= '[input]';


        if (array_key_exists('value', $attributes)) {
            unset($attributes['value']);
        }
        $closingBracket      = $this->getInlineClosingBracket();
        $input               = sprintf(
            '<input %s%s',
            $this->createAttributesString($attributes),
            $closingBracket
        );

        $html = $input.'<label for="'.$attributes['name'].'" >Prove you are a human!</label>';
        return $html;
    }

}