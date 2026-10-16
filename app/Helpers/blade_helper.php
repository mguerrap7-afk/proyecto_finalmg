<?php

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

if (! function_exists('blade')) {
    function blade(string $view, array $data = []): string
    {
        static $factory = null;

        if ($factory === null) {
            $cache = WRITEPATH . 'cache/blade';
            if (! is_dir($cache)) {
                mkdir($cache, 0775, true);
            }

            $files    = new Filesystem();
            $compiler = new BladeCompiler($files, $cache);

            $resolver = new EngineResolver();
            $resolver->register('blade', fn () => new CompilerEngine($compiler, $files));
            $resolver->register('php', fn () => new PhpEngine($files));

            $finder  = new FileViewFinder($files, [APPPATH . 'Views']);
            $factory = new Factory($resolver, $finder, new Dispatcher(new Container()));
        }

        return $factory->make($view, $data)->render();
    }
}