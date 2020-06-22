<?php
namespace extas\components\repositories;

/**
 * Class RepositoryDescriptionRepository
 *
 * @package extas\components\repositories
 * @author jeyroik@gmail.com
 */
class RepositoryDescriptionRepository extends Repository
{
    protected string $name = 'repositories';
    protected string $scope = 'extas';
    protected string $pk = RepositoryDescription::FIELD__ID;
    protected string $itemClass = RepositoryDescription::class;
}
