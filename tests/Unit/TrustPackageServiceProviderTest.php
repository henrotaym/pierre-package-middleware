<?php

namespace Wasilp\Trustpackage\Tests\Unit;

use Illuminate\Support\Facades\Log;
use Orchestra\Testbench\TestCase;
use Wasilp\Trustpackage\Exceptions\InvalidKeyException;
use Wasilp\Trustpackage\TrustpackageServiceProvider;



class TrustPackageServiceProviderTest  extends TestCase
{

    /** @test */
    function boot_throw_exception_is_thrown_if_app_key_is_null()
    {
        $provider = new TrustpackageServiceProvider($this->app);
        Log::shouldReceive('error')
            ->once()
            ->withArgs(function($message){
               return (new InvalidKeyException())->getMessage() === $message;
            });
        $provider->boot();
    }
}
