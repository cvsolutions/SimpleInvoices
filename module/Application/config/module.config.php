<?php
return array(
    'router' => array(
        'routes' => array(

            /**
             * Home
             */
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Factory\IndexFactory',
                        'action' => 'index'
                    )
                )
            ),

            /**
             * Configurazione
             */
            'configurazione' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/configurazione',
                    'defaults' => array(
                        'controller' => 'Application\Factory\ConfigurazioneFactory',
                        'action' => 'index'
                    )
                )
            ),

            /**
             * Aggiungi Fattura
             */
            'aggiungi_fattura' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/aggiungi-fattura',
                    'defaults' => array(
                        'controller' => 'Application\Factory\FatturaFactory',
                        'action' => 'aggiungi'
                    )
                )
            ),
        )
    ),

    /**
     * Service Manager
     */
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory'
        )
    ),

    /**
     * Factories
     */
    'controllers' => array(
        'factories' => array(
            'Application\Factory\IndexFactory' => 'Application\Factory\IndexFactory',
            'Application\Factory\FatturaFactory' => 'Application\Factory\FatturaFactory',
            'Application\Factory\ConfigurazioneFactory' => 'Application\Factory\ConfigurazioneFactory',
            'Application\Factory\ApiFactory' => 'Application\Factory\ApiFactory'
        ),
    ),

    /**
     * View Manager
     */
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'application/fattura/index' => __DIR__ . '/../view/application/fattura/index.phtml',
            'application/configurazione/index' => __DIR__ . '/../view/application/configurazione/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml'
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    ),

    /**
     * Console
     */
    'console' => array(
        'router' => array(
            'routes' => array()
        )
    )
);
