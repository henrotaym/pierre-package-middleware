<?php

namespace Pierre\Trustpackage\Tests\Unit;

use Illuminate\Http\Request;
use Pierre\Trustpackage\Http\Middleware\RequestHeader;
use Pierre\Trustpackage\Tests\TestCase;

class RequestHeaderMiddlewareTest extends TestCase
{
    /** @test */
    function check_header_request()
    {
        // Given we have a request
        $request = new Request();


        $request->headers->set('X-Header-Name', 'base64:2fl+Ktvkfl+Fuz4Qp/A75G2RTiWVA/ZoKZvp6fiiM10=');

        // when we pass the request to this middleware,
        (new RequestHeader())->handle($request, function ($request) {
            $this->assertEquals(config('trusted.app_key'), $request->header('X-Header-Name'));
            $this->assertTrue(config('trusted.app_key') == $request->header('X-Header-Name'));
            $this->assertFalse(config('trusted.app_key') !== $request->header('X-Header-Name'));
        });
    }
}
