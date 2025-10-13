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
            ->hasCommand(LoginTemplateCommand::class);
    }
}
