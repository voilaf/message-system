<?php

namespace Voilaf\MessageSystem\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class MessageMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new message-subscribe class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Subscribe';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/subscribe.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Subs';
    }
}
