<?php

use Filament\Contracts\Plugin;
use Filament\Forms\Components\ToggleButtons;
use Filament\Infolists\Components\Entry;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Webkul\ProgressStepper\Concerns\HasProgressStepperStyle;
use Webkul\ProgressStepper\Forms\Components\ProgressStepper as FormProgressStepper;
use Webkul\ProgressStepper\Infolists\Components\ProgressStepper as InfolistProgressStepper;
use Webkul\ProgressStepper\ProgressStepperPlugin;
use Webkul\ProgressStepper\ProgressStepperServiceProvider;

it('form component extends ToggleButtons', function () {
    expect(is_subclass_of(FormProgressStepper::class, ToggleButtons::class))->toBeTrue();
});

it('infolist component extends Entry', function () {
    expect(is_subclass_of(InfolistProgressStepper::class, Entry::class))->toBeTrue();
});

it('both components use the shared style trait', function () {
    expect(class_uses_recursive(FormProgressStepper::class))->toContain(HasProgressStepperStyle::class);
    expect(class_uses_recursive(InfolistProgressStepper::class))->toContain(HasProgressStepperStyle::class);
});

it('plugin class implements Filament Plugin contract', function () {
    expect(in_array(Plugin::class, class_implements(ProgressStepperPlugin::class), true))->toBeTrue();
});

it('service provider extends Spatie PackageServiceProvider', function () {
    expect(is_subclass_of(ProgressStepperServiceProvider::class, PackageServiceProvider::class))->toBeTrue();
});

arch('no debug calls leak into shipped code')
    ->expect(['Webkul\\ProgressStepper'])
    ->not->toUse(['dd', 'dump', 'var_dump', 'ray', 'die', 'exit']);

arch('plugin namespace uses strict types where it matters')
    ->expect('Webkul\\ProgressStepper')
    ->classes()
    ->not->toBeFinal();
