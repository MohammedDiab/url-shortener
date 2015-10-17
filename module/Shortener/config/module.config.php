<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'try' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/url/try',
                    'defaults' => array(
                        'module'=>'Shortener',
                        'controller' => 'Shortener\Controller\Index',
                        'action'     => 'try',
                    ),
                ),
            ),
            'short' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/url/short',
                    'defaults' => array(
                        'module'=>'Shortener',
                        'controller' => 'Shortener\Controller\Index',
                        'action'     => 'short',
                    ),
                ),
            ),
            'track' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/url/track',
                    'defaults' => array(
                        'module'=>'Shortener',
                        'controller' => 'Shortener\Controller\Index',
                        'action'     => 'track',
                    ),
                ),
            ),
            'graph' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/url/track/graph',
                    'defaults' => array(
                        'module'=>'Shortener',
                        'controller' => 'Shortener\Controller\Index',
                        'action'     => 'trackGraph',
                    ),
                ),
            ),
            'redirect' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/:baseEncodedUrl',
                    'defaults' => array(
                        'module'=>'Shortener',
                        'controller' => 'Shortener\Controller\Index',
                        'action'     => 'redirect',
                    ),
                ),
            ),
            'captcha' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    =>  '/captcha/[:id]',
                    'defaults' => array(
                        'controller' => 'Shortener\Controller\Index',
                        'action' => 'captcha',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Shortener\Controller\Index' => 'Shortener\Controller\IndexController'
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'UrlService' => function (\Zend\ServiceManager\ServiceLocatorInterface $sm) {
                return new \Shortener\Service\UrlService($sm->get('doctrine.entitymanager.orm_default'));
            },
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
            'invokables' => array(
                'customCaptchaViewHelper' => 'Shortener\ViewHelper\CustomCaptchaViewHelper',),));
