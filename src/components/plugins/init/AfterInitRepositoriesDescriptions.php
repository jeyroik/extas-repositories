<?php
namespace extas\components\plugins\init;

use extas\components\extensions\ExtensionRepository;
use extas\components\extensions\ExtensionRepositoryDescription;
use extas\components\plugins\Plugin;
use extas\components\THasIO;
use extas\interfaces\extensions\IExtension;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\repositories\IRepositoryDescription;
use extas\interfaces\stages\IStageAfterInit;
use extas\interfaces\stages\IStageAfterRepositoriesInit;

/**
 * Class AfterInitRepositoriesDescriptions
 *
 * @method IRepository repositoryDescriptions()
 *
 * @package extas\components\plugins\init
 * @author jeyroik <jeyroik@gmail.com>
 */
class AfterInitRepositoriesDescriptions extends Plugin implements IStageAfterInit
{
    use THasIO;

    /**
     * @param array $packages
     * @throws \Exception
     */
    public function __invoke(array $packages): void
    {
        $aliases = $this->getAliases();

        $this->updateExtension($aliases);
        $this->shout($aliases);
        $this->runAfterRepositoriesInit($packages);
    }

    /**
     * @return array
     */
    protected function getAliases(): array
    {
        /**
         * @var IRepositoryDescription[] $descriptions
         */
        $descriptions = $this->repositoryDescriptions()->all([]);
        $aliases = [];

        foreach ($descriptions as $description) {
            $currentAliases = $description->getAliases();
            $aliases = array_merge($aliases, array_diff($currentAliases, $aliases));
        }

        return $aliases;
    }

    /**
     * @param array $aliases
     * @throws \Exception
     */
    protected function updateExtension(array $aliases): void
    {
        /**
         * @var IExtension $extension
         */
        $extensions = new ExtensionRepository();
        $extension = $extensions->one([IExtension::FIELD__CLASS => ExtensionRepositoryDescription::class]);
        $extension->setMethods($aliases);
        $extensions->update($extension);
    }

    /**
     * @param array $aliases
     */
    protected function shout(array $aliases): void
    {
        $this->writeLn(['Dynamic repositories installed: ']);

        foreach ($aliases as $alias) {
            $this->writeLn([' - ' . $alias]);
        }
    }

    /**
     * @param array $packages
     */
    protected function runAfterRepositoriesInit(array $packages)
    {
        foreach ($this->getPluginsByStage(IStageAfterRepositoriesInit::NAME, $this->getIO()) as $plugin) {
            /**
             * @var IStageAfterRepositoriesInit $plugin
             */
            $plugin($packages);
        }
    }
}
