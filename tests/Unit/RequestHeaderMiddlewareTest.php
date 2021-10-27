<?php

namespace Pierre\Trustpackage\Tests\Unit;

use Illuminate\Http\Request;
use Illuminate\Testing\TestResponse;
use Pierre\Trustpackage\Tests\TestCase;
use Pierre\Trustpackage\Http\Middleware\RequestHeader;

class RequestHeaderMiddlewareTest extends TestCase
{
    /** @test */
    function check_header_request_forbidden()
    {
        $request = new Request();
        $next = function () {
            return response('ok', 200);
        };
        $middleware = new RequestHeader();
        $response = new TestResponse($middleware->handle($request, $next));
        $response->assertStatus(401);
    }

    /** @test */
    function request_header_middleware_check_forbiden_response_if_request_header_has_different_value_than_config()
    {
        // Fake request
        $request = new Request();
        // Create middleware
        $middleware = new RequestHeader();
        // Faking next response and make sure response is valide (200)
        $next = function () {
            return response('ok', 200);
        };
        // Force la valeur dans la config 
        config(['trusted.app_key'  => "fhsdfksfksdfk"]);
        // Force uin header différent à une request
        $request->headers->set('X-Header-Name', 'ploperdeplop');
        // Try de pass middleware
        $response = new TestResponse($middleware->handle($request, $next));
        // Check that I get forbiden
        $response->assertStatus(401);
    }

    /** @test */
    function request_header_middleware_check_access_if_header_and_config_are_same_value()
    {
        $request = new Request();
        $next = function () {
            return response('ok', 200);
        };
        $middleware = new RequestHeader();
        config(['trusted.app_key' => 'plop']);
        $request->headers->set('X-Header-Name', 'plop');
        $response = new TestResponse($middleware->handle($request, $next));
        $response->assertStatus(200);
    }

    /** @test */
    function request_header_middleware_check_is_empty_header_and_config()
    {
        $request = new Request();
        $next = function () {
            return response('ok', 200);
        };
        $middleware = new RequestHeader();
        config(['trusted.app_key' => '']);
        $request->headers->set('X-Header-Name', '');
        $response = new TestResponse($middleware->handle($request, $next));
        $response->assertStatus(401);
    }

    /** @test */
    function request_header_middleware_check_is_null_header_and_config()
    {
        $request = new Request();
        $next = function () {
            return response('ok', 200);
        };
        $middleware = new RequestHeader();
        config(['trusted.app_key' => null]);
        $request->headers->set('X-Header-Name', null);
        $response = new TestResponse($middleware->handle($request, $next));
        $response->assertStatus(401);
    }
}