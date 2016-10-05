<?php

namespace Skelliton;

return array(
    'controllers' => array(
        'invokables' => array(
            'Skelliton\Controller\Skelliton' => 'Skelliton\Controller\SkellitonController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'skelliton' => __DIR__ . '/../view',
        ),
    ),
    'router' => array(
        'routes' => array(
            'skelliton' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/skelliton[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Skelliton\Controller\Skelliton',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
);