<?php

namespace Spinzar\Money\Tests;

use Spinzar\Money\MoneyServiceProvider;
use GrahamCampbell\TestBench\AbstractPackageTestCase;

class MoneyServiceProviderTest extends AbstractPackageTestCase
{
    public function testBladeDirectives()
    {
        $customDirectives = $this->app->make('blade.compiler')->getCustomDirectives();

        static::assertArrayHasKey('money', $customDirectives);
        static::assertArrayHasKey('currency', $customDirectives);
    }

    protected function getServiceProviderClass($app)
    {
        return MoneyServiceProvider::class;
    }
}
