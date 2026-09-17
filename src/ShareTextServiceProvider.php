<?php

namespace Pteal79\ShareText;

use Illuminate\Support\ServiceProvider;

class ShareTextServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ShareText::class);
    }
}
