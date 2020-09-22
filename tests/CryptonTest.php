<?php

namespace Tzsk\Crypton\Tests;

use Tzsk\Crypton\Crypton;

class CryptonTest extends TestCase
{
    /**
     * @var Encrypter
     */
    protected $crypton;

    public function setUp(): void
    {
        parent::setUp();

        $this->crypton = Crypton::make();
    }

    public function test_it_ignores_normal_calls()
    {
        $response = $this->post('tzsk/crypton', $data = ['foo' => 'bar']);

        $response->assertJson($data);
    }

    public function test_it_will_encrypt_response_if_header_is_present()
    {
        $response = $this->post('tzsk/crypton', $data = ['foo' => 'bar'], [
            'x-response-encrypted' => 1,
        ]);

        $response->assertHeader('x-response-encrypted');
        $this->assertArrayHasKey('payload', $response->json());

        $decrypted = $this->crypton->decrypt($response->json('payload'));
        $this->assertSame($data, $decrypted);
    }

    public function test_it_will_decrypt_request_if_header_is_present()
    {
        $data = ['foo' => 'bar'];
        $response = $this->post('tzsk/crypton', ['payload' => $this->crypton->encrypt($data)], [
            'x-request-encrypted' => 1,
        ]);

        $response->assertJson($data);
        $response->assertHeaderMissing('x-response-encrypted');
    }

    public function test_it_will_encrypt_response_and_decrypte_request()
    {
        $data = ['foo' => 'bar'];
        $response = $this->post('tzsk/crypton', ['payload' => $this->crypton->encrypt($data)], [
            'x-request-encrypted' => 1,
            'x-response-encrypted' => 1,
        ]);

        $response->assertHeader('x-response-encrypted');
        $this->assertArrayHasKey('payload', $response->json());

        $decrypted = $this->crypton->decrypt($response->json('payload'));
        $this->assertSame($data, $decrypted);
    }
}
