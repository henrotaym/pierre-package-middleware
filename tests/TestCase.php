<?php

namespace Wasilp\Trustpackage\Tests;

use Wasilp\Trustpackage\TrustpackageServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

  public function setUp(): void
  {
    parent::setUp();
    // additional setup
  }


  protected function getPackageProviders($app)
  {
    return [
      TrustpackageServiceProvider::class,
    ];
  }

  protected function getEnvironmentSetUp($app)
  {
    // perform environment setup
  }
}
