<?php

namespace Pierre\Trustpackage;

use Illuminate\Support\ServiceProvider;
use Pierre\Trustpackage\Exceptions\InvalidKeyException;


class TrustpackageServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->mergeConfigFrom(__DIR__ . '../config/config.php', 'trusted');
  }

  public function boot()
  {
    $this->checkAppKeyIsNotNull();
  }

  protected function checkAppKeyIsNotNull()
  {
    if (!config('trusted.app_key')) {
      report(new InvalidKeyException());
    }
  }
}
