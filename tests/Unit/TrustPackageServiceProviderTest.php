<?php

namespace Pierre\Trustpackage\Tests\Unit;

use Illuminate\Support\Facades\Log;
use Orchestra\Testbench\TestCase;
use Pierre\Trustpackage\Exceptions\InvalidKeyException;
use Pierre\Trustpackage\TrustpackageServiceProvider;

// use Pierre\Trustpackage\Exceptions\InvalidKeyException;

class TrustPackageServiceProviderTest  extends TestCase
{
    
        /** @test */
        function boot_throw_exception_is_thrown_if_app_key_is_null()
        {   
            $provider = new TrustpackageServiceProvider($this->app);
            Log::shouldReceive('error')
            ->once();
            $provider->boot();
            // $this->expectException(new InvalidKeyException());
            // $this->expectExceptionMessage("Config key is missing.");
        }

}