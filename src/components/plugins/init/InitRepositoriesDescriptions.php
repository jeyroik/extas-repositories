<?php
namespace extas\components\plugins\init;

use extas\components\repositories\RepositoryDescription;

/**
 * Class InitRepositoriesDescriptions
 *
 * @package extas\components\plugins\init
 * @author jeyroik@gmail.com
 */
class InitRepositoriesDescriptions extends InitSection
{
    protected string $selfSection = 'repositories';
    protected string $selfName = 'repository';
    protected string $selfRepositoryClass = 'repositoryDescriptionRepository';
    protected string $selfUID = RepositoryDescription::FIELD__ID;
    protected string $selfItemClass = RepositoryDescription::class;
}
