<?php

namespace Tzsk\Crypton;

use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Str;

class Crypton
{
    protected string $cipher = 'AES-256-CBC';

    public static function make(): Encrypter
    {
        $factory = new self;

        return new Encrypter($factory->key(), $factory->cipher);
    }

    protected function key(): string
    {
        $key = config('crypton.key');
        if (Str::contains($key, 'base64:')) {
            $key = substr($key, 7);
        }

        return base64_decode($key);
    }
}
