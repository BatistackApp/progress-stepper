<?php

namespace Webkul\ProgressStepper;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ProgressStepperServiceProvider extends PackageServiceProvider
{
    public static string $name = 'progress-stepper';

    public static string $viewNamespace = 'progress-stepper';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasTranslations()
            ->hasViews(static::$viewNamespace);
    }

    public function packageBooted(): void
    {
        FilamentAsset::register([
            Css::make('progress-stepper', __DIR__.'/../resources/dist/progress-stepper.css'),
        ], 'aureuserp/progress-stepper');

        FilamentIcon::register([
            'progress-stepper::step-completed' => 'heroicon-m-check',
            'progress-stepper::step-error' => 'heroicon-m-x-mark',
            'progress-stepper::step-current' => 'heroicon-m-arrow-right',
        ]);
    }
}
