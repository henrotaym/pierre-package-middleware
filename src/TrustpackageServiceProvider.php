<?php

namespace Pm\trustpackage;

use Illuminate\Support\ServiceProvider;
use Pm\trustpackage\Console\Installtrustpackage;


class trustpackageServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'trusted');
  }

  public function boot()
  {
    // Register the command if we are using the application via the CLI
    if ($this->app->runningInConsole()) {
      $this->commands([
        Installtrustpackage::class,
      ]);
    }
  }
}
