<?php
namespace tests\repositories;

use Dotenv\Dotenv;
use extas\components\repositories\RepositoryDescription;
use PHPUnit\Framework\TestCase;

/**
 * Class BasicTest
 *
 * @package tests\repositories
 * @author jeyroik <jeyroik@gmail.com>
 */
class BasicTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
    }

    public function testBasicMethods()
    {
        $desc = new RepositoryDescription([
            RepositoryDescription::FIELD__NAME => 'is_ok'
        ]);
        $desc->setScope('test')->setPrimaryKey('name');
        $this->assertEquals('test', $desc->getScope());
        $this->assertEquals('name', $desc->getPrimaryKey());
        $this->assertEquals('name', $desc->getPrimaryKey());
        $this->assertEquals('test.is_ok', $desc->getTotalName('.'));
    }
}
