<?php
namespace tests\repositories;

use Dotenv\Dotenv;
use extas\components\console\TSnuffConsole;
use extas\components\extensions\Extension;
use extas\components\extensions\ExtensionRepositoryDescription;
use extas\components\plugins\init\AfterInitRepositoriesDescriptions;
use extas\components\plugins\Plugin;
use extas\components\repositories\RepositoryDescription;
use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\components\THasMagicClass;
use extas\interfaces\extensions\IExtension;
use extas\interfaces\IHasIO;
use extas\interfaces\stages\IStageAfterRepositoriesInit;
use PHPUnit\Framework\TestCase;
use tests\repositories\misc\PluginAfterRepositoriesInit;

class PluginAfterInitTest extends TestCase
{
    use TSnuffRepositoryDynamic;
    use THasMagicClass;
    use TSnuffConsole;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->createSnuffDynamicRepositories([
            ['repositoryDescriptions', 'name', RepositoryDescription::class]
        ]);
        $this->getMagicClass('repositoryDescriptions')->create(new RepositoryDescription([
            RepositoryDescription::FIELD__NAME => 'repository_descriptions',
            RepositoryDescription::FIELD__ALIASES => ['repositoryDescriptions']
        ]));
        $this->getMagicClass('repositoryDescriptions')->create(new RepositoryDescription([
            RepositoryDescription::FIELD__NAME => 'test',
            RepositoryDescription::FIELD__ALIASES => ['tests']
        ]));
        $this->createWithSnuffRepo('extensionRepository', new Extension([
            Extension::FIELD__CLASS => ExtensionRepositoryDescription::class,
            Extension::FIELD__SUBJECT => '*',
            Extension::FIELD__METHODS => ['repositoryDescriptions']
        ]));
    }

    public function testInstallPlugin()
    {
        $output =$this->getOutput(true);
        $plugin = new AfterInitRepositoriesDescriptions([
            IHasIO::FIELD__INPUT => $this->getInput(),
            IHasIO::FIELD__OUTPUT => $output
        ]);

        $this->createWithSnuffRepo('pluginRepository', new Plugin([
            Plugin::FIELD__CLASS => PluginAfterRepositoriesInit::class,
            Plugin::FIELD__STAGE => IStageAfterRepositoriesInit::NAME
        ]));

        $plugin([]);
        $outputText = $output->fetch();

        $this->assertStringContainsString(
            'Dynamic repositories installed: ',
            $outputText,
            'Missed welcome message: "' . PHP_EOL . $outputText . '"'
        );

        $this->assertStringContainsString(
            'After repositories init',
            $outputText,
            'Missed after init message: "' . PHP_EOL . $outputText . '"'
        );

        $extension = $this->OneSnuffRepos(
            'extensionRepository',
            [IExtension::FIELD__CLASS => ExtensionRepositoryDescription::class]
        );

        $this->assertEquals(
            ['repositoryDescriptions', 'tests'],
            $extension->getMethods(),
            'Missed repos: ' . print_r($extension->getMethods(), true)
        );
    }
}
