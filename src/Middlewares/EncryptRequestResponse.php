<?php

namespace Tzsk\Crypton\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Tzsk\Crypton\EncryptionFactory;

class EncryptRequestResponse
{
    /**
     * @var \Illuminate\Encryption\Encrypter
     */
    protected $crypton;

    /**
     * Encrypt Reqeust Response Constructor.
     */
    public function __construct()
    {
        $this->crypton = EncryptionFactory::make();
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('X-REQUEST-ENCRYPTED')) {
            $this->modifyRequest($request);
        }

        $response = $next($request);
        if ($response instanceof JsonResponse) {
            $this->modifyResponse($request, $response);
        }

        return $response;
    }

    /**
     * @param Request $request
     * @return void
     */
    protected function modifyRequest(Request $request)
    {
        $decrypted = $request->payload ? $this->crypton->decrypt($request->payload) : null;
        if ($decrypted) {
            $request->merge($decrypted);
            $request->replace($request->except('payload'));
        }
    }

    /**
     * @param JsonResponse $response
     * @return void
     */
    protected function modifyResponse(Request $request, JsonResponse $response)
    {
        if ($request->header('X-RESPONSE-ENCRYPTED')) {
            $payload = ['payload' => $this->crypton->encrypt(json_decode($response->content(), true))];

            $response->setContent(json_encode($payload));
            $response->header('X-RESPONSE-ENCRYPTED', 1);
        }
    }
}
