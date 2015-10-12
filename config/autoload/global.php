<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    //captcha settings
    'captcha' => array(
        'font' =>'public/font/roboto/Roboto-Light.ttf',
        'imgTmpPath' => 'data/captchaTmpImages',
        'width' => 200,
        'height' => 50,
        'captchaGeneratorRouteName'=>'captcha'
    ),
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'params' => array(
                    'driver'=>'pdo_mysql',
                    'host'     => '127.0.0.1',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => '',
                    'dbname'   => 'lesschr',
                    )
            )
        ),
        'configuration' => array(
            // Configuration for service `doctrine.configuration.orm_default` service
            'orm_default' => array(
                // metadata cache instance to use. The retrieved service name will
                // be `doctrine.cache.$thisSetting`
                'metadata_cache'    => 'array',

                // DQL queries parsing cache instance to use. The retrieved service
                // name will be `doctrine.cache.$thisSetting`
                'query_cache'       => 'array',

                // ResultSet cache to use.  The retrieved service name will be
                // `doctrine.cache.$thisSetting`
                'result_cache'      => 'array',

                // Hydration cache to use.  The retrieved service name will be
                // `doctrine.cache.$thisSetting`
                'hydration_cache'   => 'array',

                // Mapping driver instance to use. Change this only if you don't want
                // to use the default chained driver. The retrieved service name will
                // be `doctrine.driver.$thisSetting`
                'driver'            => 'orm_default',

                // Generate proxies automatically (turn off for production)
                'generate_proxies'  => false,

                // directory where proxies will be stored. By default, this is in
                // the `data` directory of your application
                'proxy_dir'         => 'data/DoctrineORMModule/Proxy',

                // namespace for generated proxy classes
                'proxy_namespace'   => 'DoctrineORMModule\Proxy',

                // SQL filters. See http://docs.doctrine-project.org/en/latest/reference/filters.html
                'filters'           => array(),

                // Custom DQL functions.
                // You can grab common MySQL ones at https://github.com/beberlei/DoctrineExtensions
                // Further docs at http://docs.doctrine-project.org/en/latest/cookbook/dql-user-defined-functions.html
                'datetime_functions' => array(),
                'string_functions' => array(),
                'numeric_functions' => array(),

                // Second level cache configuration (see doc to learn about configuration)
                'second_level_cache' => array()
            )
        ),
    )
);
