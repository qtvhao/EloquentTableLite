<?php
/**
 * Created by PhpStorm.
 * User: qtvha
 * Date: 1/20/2017
 * Time: 10:51 PM
 */

namespace WFCore;


trait TableTrait
{
    use \Stevebauman\EloquentTable\TableTrait;

    public function newCollection(array $models = array())
    {
        return new WFCollection($models);
    }

    public function render($view = '')
    {
        // If no attributes have been set, we'll set them to the configuration defaults
        if (count($this->eloquentTableAttributes) === 0) {
            $attributes = [];

            $this->attributes($attributes);
        }

        /*
         * If a view isn't specified, we'll check the configuration
         * separator to see what laravel version we're using so the
         * correct blade tags are used.
         */
        if (empty($view))
            $view = 'table.php';
        $collection = $this;
        require_once __DIR__ . DIRECTORY_SEPARATOR . $view;
        return;
    }

}