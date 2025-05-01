<?php

namespace Amerhendy\PageManger\App;
use \Amerhendy\Amer\App\Helpers\Library\AmerPanel\AmerPanelFacade as AMER;
trait PageTemplates
{
    /*
    |--------------------------------------------------------------------------
    | Page Templates for Backpack\PageManager
    |--------------------------------------------------------------------------
    |
    | Each page template has its own method, that define what fields should show up using the Backpack\CRUD API.
    | Use snake_case for naming and PageManager will make sure it looks pretty in the create/update form
    | template dropdown.
    |
    | Any fields defined here will show up after the standard page fields:
    | - select template
    | - page name (only seen by admins)
    | - page title
    | - page slug
    */

    private function services()
    {
        AMER::addField([   // CustomHTML
            'name' => 'metas_separator',
            'type' => 'custom_html',
            'value' => '<br><h2>'.trans('PAGELANG::Pages.metas').'</h2><hr>',
        ]);
        AMER::addField([
            'name' => 'meta_title',
            'label' => trans('PAGELANG::Pages.meta_title'),
            'fake' => true,
            'store_in' => 'extras',
        ]);
        AMER::addField([
            'name' => 'meta_description',
            'label' => trans('PAGELANG::Pages.meta_description'),
            'fake' => true,
            'store_in' => 'extras',
        ]);
        AMER::addField([
            'name' => 'meta_keywords',
            'type' => 'textarea',
            'label' => trans('PAGELANG::Pages.meta_keywords'),
            'fake' => true,
            'store_in' => 'extras',
        ]);
        AMER::addField([   // CustomHTML
            'name' => 'content_separator',
            'type' => 'custom_html',
            'value' => '<br><h2>'.trans('PAGELANG::Pages.content').'</h2><hr>',
        ]);
        AMER::addField([
            'name' => 'content',
            'label' => trans('PAGELANG::Pages.content'),
            'type' => 'summernote',
            'placeholder' => trans('PAGELANG::Pages.content_placeholder'),
        ]);
    }

    private function about_us()
    {
        AMER::addField([
            'name' => 'content',
            'label' => trans('PAGELANG::Pages.content'),
            'type' => 'summernote',
            'placeholder' => trans('PAGELANG::Pages.content_placeholder'),
        ]);
    }
}
