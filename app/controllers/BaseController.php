<?php
namespace App\Controllers;
use Twig_Environment;
use Tamtamchik\SimpleFlash\Flash;
use Tamtamchik\SimpleFlash\TemplateFactory;
use Tamtamchik\SimpleFlash\Templates;

abstract class BaseController {
    static protected $twig = null;

    /**
     * Sets the Twig object instance to use for rendering the views
     */
    static public function setTwig(Twig_Environment $twig){
        self::$twig = $twig;
    }

    /**
     * Adds a flash message to the sesion
     */
    protected function flash($message, $type = 'info')
    {
        // get template from factory, e.g. template for Foundation 6
        $template = TemplateFactory::create(Templates::BOOTSTRAP_4);

        // passing template via function
        return flash($message, $type, $template);
    }

    /**
     * Render a view using Twig and returns the content as string
     */
    protected function render($view,$args=[])
    {
        return self::$twig->render($view,array_merge($args,['flash' => flash()]));
    }
}
