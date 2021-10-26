<?php

namespace Pm\Trustpackage\Tests\Unit;

use Illuminate\Http\Request;
use Pm\Trustpackage\Http\Middleware\CheckSignature;
use Pm\Trustpackage\Tests\TestCase;

class RequestHeaderMiddlewareTest extends TestCase
{
    /** @test */
    function check_header_request()
    {
        // Given we have a request
        $request = new Request();

        // with  a non-capitalized 'title' parameter
        $request->merge(['X-Header-Name' => 'sdjfhsdkfh']);

        // when we pass the request to this middleware,
        // it should've capitalized the title
        (new CheckSignature())->handle($request, function ($request) {
            $this->assertEquals(config('trusted.app_key'), $request->title);
            $this->assertTrue(config('trusted.app_key'), $request->title);
            $this->assertFalse(config('trusted.app_key'), $request->title);
        });
    }
}