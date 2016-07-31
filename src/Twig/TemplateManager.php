<?php

namespace Battleship\Twig;

class TemplateManager
{
    private static $instance;

    private $engine;

    private function __construct()
    {
        \Twig_Autoloader::register();
        $loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/Views');
        $this->engine = new \Twig_Environment($loader, [
            // 'cache' => dirname(dirname(__DIR__)) . '/cache'
        ]);
    }

    public static function instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new TemplateManager();
        }

        return self::$instance;
    }

    public function render($template, $variables)
    {
        return $this->engine->render($template, $variables);
    }
}
