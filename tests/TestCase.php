<?php

namespace Tzsk\Crypton\Tests;

use Illuminate\Http\Request;
use Orchestra\Testbench\TestCase as Orchestra;
use Tzsk\Crypton\CryptonServiceProvider;
use Tzsk\Crypton\Middleware\EncryptRequestResponse;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            CryptonServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['router']->any('tzsk/crypton', function (Request $request) {
            return $request->all();
        })->middleware(EncryptRequestResponse::class);
    }
}
