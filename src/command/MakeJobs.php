<?php

namespace Yuyue8\TpQueue\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;

class MakeJobs extends Command
{
    public function configure()
    {
        $this->setName('make:jobs')
        ->addArgument('name', Argument::REQUIRED, "The name of the class")
        ->setDescription('Create a new jobs class');
    }

    protected function getStub(): string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . 'jobs.stub';
    }

    protected function execute(Input $input, Output $output)
    {
        $classname = trim($input->getArgument('name'));

        $pathname = $this->getPathName($classname);

        if (is_file($pathname)) {
            $output->writeln('<error>' . 'jobs:' . $classname . ' already exists!</error>');
            return false;
        }

        if (!is_dir(dirname($pathname))) {
            mkdir(dirname($pathname), 0755, true);
        }

        file_put_contents($pathname, $this->buildClass($classname));

        $output->writeln('<info>' . 'jobs:' . $classname . ' created successfully.</info>');
    }

    protected function buildClass(string $classname)
    {
        $stub = file_get_contents($this->getStub());

        $namespace = trim(implode('\\', array_slice(explode('\\', $classname), 0, -1)), '\\');

        $class = str_replace($namespace . '\\', '', $classname);

        return str_replace(['{%className%}', '{%namespace%}'], [
            $class,
            $namespace
        ], $stub);
    }

    protected function getPathName(string $classname): string
    {
        return $this->app->getRootPath() . ltrim(str_replace('\\', '/', $classname), '/') . '.php';
    }
}
