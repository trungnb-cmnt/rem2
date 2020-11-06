<?php

namespace Botble\GeneralConfig\Providers;

use Illuminate\Support\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{
    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Bootstrap the application events.
     * @author Tuan Nguyen
     */
    public function boot()
    {
        if (env('GENERAL_CONFIG_ENABLE_DASHBOARD_WIDGETS', true)) {
            add_filter(BASE_FILTER_AFTER_SETTING_CONTENT, [$this, 'addGeneralConfig'], 9999, 1);
        }
    }


    /**
     * @param null $data
     * @return string
     * @throws \Throwable
     * @author Tuan Nguyen
     */
    public function addGeneralConfig($data = null)
    {
        return $data . view('plugins/general-config::setting')->render();
    }
}
