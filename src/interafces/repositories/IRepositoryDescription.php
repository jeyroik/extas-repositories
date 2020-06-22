<?php
namespace extas\interfaces\repositories;

use extas\interfaces\IHasAliases;
use extas\interfaces\IHasClass;
use extas\interfaces\IHasId;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;

/**
 * Interface IRepositoryDescription
 *
 * @package extas\interfaces\repositories
 * @author jeyroik@gmail.com
 */
interface IRepositoryDescription extends IItem, IHasName, IHasClass, IHasAliases, IHasId
{
    public const SUBJECT = 'extas.repository.description';

    public const FIELD__PRIMARY_KEY = 'pk';
    public const FIELD__SCOPE = 'scope';

    /**
     * @return string
     */
    public function getPrimaryKey(): string;

    /**
     * @return string
     */
    public function getScope(): string;

    /**
     * @param string $glue
     * @return string
     */
    public function getTotalName(string $glue = ''): string;

    /**
     * @param string $key
     * @return $this
     */
    public function setPrimaryKey(string $key);

    /**
     * @param string $scope
     * @return $this
     */
    public function setScope(string $scope);
}
