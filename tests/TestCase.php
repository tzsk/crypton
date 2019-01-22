<?php

namespace Tzsk\Crypton\Tests;

use Illuminate\Http\Request;
use Orchestra\Testbench\TestCase as Orchestra;
use Tzsk\Crypton\Middlewares\EncryptRequestResponse;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return ['Tzsk\Crypton\CryptonServiceProvider'];
    }

    protected function getEnvironmentSetUp($app)
    {
        $settings = require __DIR__.'/../config/crypton.php';
        $app['config']->set('crypton', $settings);

        $app['router']->any('tzsk/crypton', function (Request $request) {
            return $request->all();
        })->middleware(EncryptRequestResponse::class);
    }
}
