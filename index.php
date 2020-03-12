<?php

use Pagekit\Application as App;

return [

    'name' => 'highlight',
    'type' => 'extension',
    'resources' => [
        'highlight:' => '',
        'views:highlight' => 'views'
    ],

    'autoload' => [
        'Pagekit\\Highlight\\' => 'src'
    ],

    'routes' => [
        '/highlight' => [
            'name' => '@highlight',
            'controller' => [
                'Pagekit\\Highlight\\HighlightController'
            ]
        ],
    ],

    'config' => [
        // default style. styles are located as css files in the styles folder
        'style' => 'vs',
        // Only load if page contains pre or code
        'autodetect' => true,
        // ids of pages where highlighting should be enabled
        //frontend menu id(node database table)
        'nodes' => [1,2,3,4]
    ],

    'menu' => [
        'highlight' => [
            'label'  => 'Highlight',
            'icon'   => 'highlight:icon.svg',
            'url'    => '@highlight/settings',
            'active' => '@highlight/settings*',
            'access' => 'highlight: see highlight',
            'priority' => 117
        ],
        'highlight: settings' => [
            'parent' => 'highlight',
            'label' => 'Settings',
            'url' => '@highlight/settings',
            'access' => 'system: manage settings'
        ]
    ],

    'permissions' => [
        'highlight: see highlight' => [
            'title' => 'See highlight setting'
        ]
    ],

    'settings' => '@highlight/settings',

    'events' => [
        // 'view.scripts' => function ($event, $scripts) use ($app) {
        //     $scripts->register('highlight-settings', 'highlight:app/bundle/settings.js', ['~extensions', 'input-tree']);
        // },

        'site' => function ($event, $app) {

            $app->on('view.content', function ($event, $test) use ($app) {
                if ((!$this->config['nodes'] || in_array($app['node']->id, $this->config['nodes']))
                    && (!$this->config['autodetect'] || (strpos($event->getResult(), '<pre') !== false || strpos($event->getResult(), '<code') !== false))
                ) {
                    $app['scripts']->add('highlight', 'highlight:assets/highlight.pack.js');
                    $app['scripts']->add('highlight-init', 'highlight:assets/highlight.js', 'highlight');
                    $app['styles']->add('highlight', 'highlight:assets/styles/'.$this->config['style'].'.css');
                    $app['styles']->add('highlight-override', 'highlight:assets/style.css', 'highlight');
                }
            });
        }

    ]

];
