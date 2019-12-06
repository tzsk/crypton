<?php

namespace Tzsk\Crypton;

use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Str;

class EncryptionFactory
{
    /**
     * @var string
     */
    protected $cipher = 'AES-256-CBC';

    /**
     * @return Encrypter
     */
    public static function make()
    {
        $factory = new self;

        return new Encrypter($factory->key(), $factory->cipher);
    }

    /**
     * @return string
     */
    protected function key()
    {
        $key = config('crypton.key');
        if (Str::contains($key, 'base64:')) {
            $key = substr($key, 7);
        }

        return base64_decode($key);
    }
}
