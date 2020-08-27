<?php
namespace extas\interfaces\stages;

use extas\interfaces\IHasIO;

/**
 * Interface IStageAfterRepositoriesInit
 *
 * @package extas\interfaces\stages
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IStageAfterRepositoriesInit extends IHasIO
{
    public const NAME = 'extas.after.repositories.init';

    /**
     * @param array $packages
     */
    public function __invoke(array $packages): void;
}
