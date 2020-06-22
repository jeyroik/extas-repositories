<?php
namespace extas\components\repositories;

use extas\components\Item;
use extas\components\THasAliases;
use extas\components\THasClass;
use extas\components\THasId;
use extas\components\THasName;
use extas\interfaces\repositories\IRepositoryDescription;

/**
 * Class RepositoryDescription
 *
 * @package extas\components\repositories
 * @author jeyroik@gmail.com
 */
class RepositoryDescription extends Item implements IRepositoryDescription
{
    use THasName;
    use THasClass;
    use THasAliases;
    use THasId;

    /**
     * @return string
     */
    public function getPrimaryKey(): string
    {
        return $this->config[static::FIELD__PRIMARY_KEY] ?? '';
    }

    /**
     * @return string
     */
    public function getScope(): string
    {
        return $this->config[static::FIELD__SCOPE] ?? '';
    }

    /**
     * @param string $glue
     * @return string
     */
    public function getTotalName(string $glue = ''): string
    {
        return $this->getScope() . $glue . $this->getName();
    }

    /**
     * @param string $key
     * @return $this
     */
    public function setPrimaryKey(string $key)
    {
        $this->config[static::FIELD__PRIMARY_KEY] = $key;

        return $this;
    }

    /**
     * @param string $scope
     * @return $this
     */
    public function setScope(string $scope)
    {
        $this->config[static::FIELD__SCOPE] = $scope;

        return $this;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
