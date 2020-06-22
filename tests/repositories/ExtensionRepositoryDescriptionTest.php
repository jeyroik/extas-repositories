<?php
namespace tests\repositories;

use extas\components\repositories\RepositoryDescriptionRepository;
use extas\interfaces\extensions\IExtensionRepositoryDescription;

use extas\components\extensions\Extension;
use extas\components\extensions\ExtensionRepository;
use extas\components\extensions\ExtensionRepositoryDescription;
use extas\components\Item;
use extas\components\items\SnuffItem;
use extas\components\items\SnuffRepository;
use extas\components\repositories\RepositoryDescription;
use extas\components\repositories\RepositoryDynamic;
use extas\components\repositories\TSnuffRepository;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

/**
 * Class ExtensionRepositoryDescriptionTest
 *
 * @package tests\repositories
 * @author jeyroik@gmail.com
 */
class ExtensionRepositoryDescriptionTest extends TestCase
{
    use TSnuffRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->registerSnuffRepos([
            'extensionRepository' => ExtensionRepository::class,
            'snuffRepository' => SnuffRepository::class
        ]);
    }

    protected function tearDown(): void
    {
        $this->unregisterSnuffRepos();
    }

    public function testRepository()
    {
        $item = new class extends Item {
            protected function getSubjectForExtension(): string
            {
                return 'test';
            }
        };

        $this->createWithSnuffRepo('extensionRepository', new Extension([
            Extension::FIELD__CLASS => ExtensionRepositoryDescription::class,
            Extension::FIELD__INTERFACE => IExtensionRepositoryDescription::class,
            Extension::FIELD__SUBJECT => '*',
            Extension::FIELD__METHODS => ['snuffRepo']
        ]));

        $list = new RepositoryDescriptionRepository();
        $list->create(new RepositoryDescription([
            RepositoryDescription::FIELD__NAME => 'snuff_items',
            RepositoryDescription::FIELD__SCOPE => 'extas',
            RepositoryDescription::FIELD__PRIMARY_KEY => 'id',
            RepositoryDescription::FIELD__CLASS => SnuffItem::class,
            RepositoryDescription::FIELD__ALIASES => ['snuffRepo']
        ]));

        $this->createWithSnuffRepo('snuffRepository', new SnuffItem([
            'id' => 'test',
            'name' => 'is ok'
        ]));

        $result = $item->snuffRepo()->one(['name' => 'is ok']);
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(SnuffItem::class, $result);
        $this->assertEquals('test', $result['id']);
    }
}
