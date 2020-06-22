<?php
namespace extas\components\extensions;

use extas\components\exceptions\MissedOrUnknown;
use extas\components\repositories\RepositoryDescription;
use extas\components\repositories\RepositoryDescriptionRepository;
use extas\components\repositories\RepositoryDynamic;
use extas\interfaces\extensions\IExtensionRepositoryDescription;

/**
 * Class ExtensionRepositoryDescription
 *
 * @package extas\components\extensions
 * @author jeyroik@gmail.com
 */
class ExtensionRepositoryDescription extends Extension implements IExtensionRepositoryDescription
{
    /**
     * @param string $repoName
     * @param mixed ...$args
     * @return RepositoryDynamic|mixed|null
     * @throws MissedOrUnknown
     */
    protected function wildcardMethod(string $repoName, ...$args)
    {
        $list = new RepositoryDescriptionRepository();
        $repo = $list->one([RepositoryDescription::FIELD__ALIASES => $repoName]);

        if ($repo) {
            return new RepositoryDynamic([
                RepositoryDynamic::FIELD__REPOSITORY_DESCRIPTION => $repo
            ]);
        }

        throw new MissedOrUnknown('repository with alias "' . $repoName . '"');
    }
}
