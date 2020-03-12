<?php

namespace Pagekit\Highlight;

use Pagekit\Application as App;
/**
 * @Access(admin=true)
 */
class HighlightController
{
    /**
     *  Returns several config settings needed for the settings view.
     */
    public function configAction()
    {
        $styles = array_map(function ($fn) {
            return basename($fn, '.css');
        }, glob(App::locator()->get('highlight:assets/styles').'/*.css'));

        return compact('styles');
    }
    /**
     * @Access("search: manage settings")
     */
    public function settingsAction()
    {
        return [
            '$view' => [
                'title' => __('Highlight Settings'),
                'name'  => 'highlight:views/admin/settings.php'
            ],
            '$data' => [
                'config' => App::module('highlight')->config()
            ]
        ];
    }
}
