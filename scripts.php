<?php

return [

    /*
     * Enable hook
     *
     */
    'enable' => function ($app) {
    },

    /*
     * Uninstall hook
     *
     */
    'uninstall' => function ($app) {

        // remove the config
        $app['config']->remove('pagekit/highlight');
    },

];
