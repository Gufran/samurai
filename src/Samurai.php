<?php
namespace Samurai;

use Pimple\Container;
use Samurai\Composer\Composer;
use Samurai\Composer\Project;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TRex\Cli\Executor;

/**
 * Class Samurai
 * main console
 *
 * @package Samurai
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class Samurai
{
    /**
     * @var Application
     */
    private $application;

    /**
     * @var Executor
     */
    private $executor;

    /**
     * @var Container
     */
    private $services;

    /**
     * @param Application $application
     * @param Executor $executor
     */
    public function __construct(Application $application, Executor $executor = null)
    {
        $application->setName('Samurai console');
        $application->setVersion('0.0.0');

        $this->setApplication($application);
        $this->setExecutor($executor ? : new Executor());

        $this->initCommands();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Exception
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        return $this->getApplication($input, $output)->run();
    }

    /**
     * Getter of $application
     *
     * @return Application
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * Getter of $services
     *
     * @return Container
     */
    public function getServices()
    {
        if(null === $this->services){
            $this->setServices($this->buildServices());
        }
        return $this->services;
    }

    /**
     * Setter of $services
     *
     * @param Container $services
     */
    public function setServices(Container $services)
    {
        $this->services = $services;
    }

    /**
     *
     */
    private function initCommands()
    {
       //todo
    }

    /**
     * Setter of $application
     *
     * @param Application $application
     */
    private function setApplication(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Getter of $executor
     *
     * @return Executor
     */
    private function getExecutor()
    {
        return $this->executor;
    }

    /**
     * Setter of $executor
     *
     * @param Executor $executor
     */
    private function setExecutor(Executor $executor)
    {
        $this->executor = $executor;
    }

    /**
     * @return Container
     */
    private function buildServices()
    {
        $application = $this->getApplication();
        $executor = $this->getExecutor();

        $services = new Container();

        $services['composer'] = function () use ($executor) {
            return new Composer(new Project(), $executor);
        };

        $services['question'] = function () use ($application) {
            return $application->getHelperSet()->get('question');
        };

        return $services;
    }
}