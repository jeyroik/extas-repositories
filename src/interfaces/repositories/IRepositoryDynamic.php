<?php
namespace extas\interfaces\repositories;

/**
 * Interface IRepositoryDynamic
 *
 * @package extas\interfaces\repositories
 * @author jeyroik@gmail.com
 */
interface IRepositoryDynamic extends IRepository
{
    public const FIELD__REPOSITORY_DESCRIPTION = 'rd';

    /**
     * @return IRepositoryDescription|null
     */
    public function getRepositoryDescription(): ?IRepositoryDescription;

    /**
     * @return array
     */
    public function getDefaultProperties(): array;
}
