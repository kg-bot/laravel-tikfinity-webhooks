<?php

namespace KgBot\TikFinityWebhooks\Tests;

use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as Orchestra;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

abstract class TestCase extends Orchestra
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function setUpDatabase(): void
    {
        $this->app->get('db')
            ->connection()
            ->getSchemaBuilder()
            ->create('tikfinity_webhooks', function (Blueprint $table) {
                $table->increments('id');
                $table->string('state')->nullable();
                $table->string('message')->nullable();
                $table->timestamps();
            });
    }
}