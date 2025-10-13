<?php

namespace Ro749\LoginTemplate;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Ro749\LoginTemplate\Commands\LoginTemplateCommand;

class LoginTemplateServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('login-template')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_login_template_table')
            ->hasCommand(LoginTemplateCommand::class)
            ->hasRoutes('web');
    }

    public function register()
    {
        parent::register();
        $packageConfig = require __DIR__.'/../config/login-template.php';
        config(['overrides' => $this->mergeConfigs($packageConfig['overrides'], config('overrides', []))]);
    }

    protected function mergeConfigs(array $package, array $project): array
    {
        foreach ($project as $key => $value) {
            $package[$key] = (is_array($value) && isset($package[$key]) && is_array($package[$key]))
                ? $this->mergeConfigs($package[$key], $value)
                : $value;
        }
        return $package;
    }
}
