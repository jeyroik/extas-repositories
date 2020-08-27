<?php
namespace tests\repositories\misc;

use extas\components\plugins\Plugin;
use extas\components\THasIO;
use extas\interfaces\stages\IStageAfterRepositoriesInit;

/**
 * Class PluginAfterRepositoriesInit
 *
 * @package tests\repositories\misc
 * @author jeyroik <jeyroik@gmail.com>
 */
class PluginAfterRepositoriesInit extends Plugin implements IStageAfterRepositoriesInit
{
    use THasIO;

    /**
     * @param array $packages
     */
    public function __invoke(array $packages): void
    {
        $this->writeLn([
            'After repositories init'
        ]);
    }
}
