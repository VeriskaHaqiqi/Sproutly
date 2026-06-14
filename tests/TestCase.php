<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $this->traitsUsedByTest = array_flip(class_uses_recursive(static::class));

        if (isset(\Illuminate\Foundation\Testing\CachedState::$cachedConfig) &&
            isset($this->traitsUsedByTest[\Illuminate\Foundation\Testing\WithCachedConfig::class])) {
            $this->markConfigCached($app);
        }

        if (isset(\Illuminate\Foundation\Testing\CachedState::$cachedRoutes) &&
            isset($this->traitsUsedByTest[\Illuminate\Foundation\Testing\WithCachedRoutes::class])) {
            $app->booting(fn () => $this->markRoutesCached($app));
        }

        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
}
