<?php
namespace extas\components\repositories;

use extas\components\exceptions\MissedOrUnknown;
use extas\interfaces\repositories\IRepositoryDescription;
use extas\interfaces\repositories\IRepositoryDynamic;

/**
 * Class RepositoryDynamic
 *
 * @package extas\components\repositories
 * @author jeyroik@gmail.com
 */
class RepositoryDynamic extends Repository implements IRepositoryDynamic
{
    /**
     * RepositoryDynamic constructor.
     * @param array $config
     * @throws MissedOrUnknown
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);

        $rd = $this->getRepositoryDescription();

        if (!$rd) {
            throw new MissedOrUnknown('repository description');
        }

        $this->name = $rd->getName();
        $this->scope = $rd->getScope();
        $this->pk = $rd->getPrimaryKey();
        $this->itemClass = $rd->getClass();
    }

    /**
     * @return IRepositoryDescription|null
     */
    public function getRepositoryDescription(): ?IRepositoryDescription
    {
        return $this->config[static::FIELD__REPOSITORY_DESCRIPTION] ?? null;
    }
}
