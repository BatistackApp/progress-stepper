<?php

use Filament\Infolists\Components\Entry;
use Webkul\ProgressStepper\Infolists\Components\ProgressStepper;

it('can be instantiated via make()', function () {
    expect(ProgressStepper::make('state'))->toBeInstanceOf(ProgressStepper::class);
});

it('extends Filament Entry', function () {
    expect(ProgressStepper::make('state'))->toBeInstanceOf(Entry::class);
});

it('uses the expected infolist view path', function () {
    $component = ProgressStepper::make('state');

    $reflection = new ReflectionProperty($component, 'view');
    $reflection->setAccessible(true);

    expect($reflection->getValue($component))->toBe('progress-stepper::infolists.progress-stepper');
});

it('stores and returns options via options()/getOptions()', function () {
    $component = ProgressStepper::make('state')->options([
        'a' => 'A',
        'b' => 'B',
    ]);

    expect($component->getOptions())->toBe(['a' => 'A', 'b' => 'B']);
});

it('toggles inline() on and off', function () {
    $component = ProgressStepper::make('state');

    expect($component->isInline())->toBeFalse();
    $component->inline();
    expect($component->isInline())->toBeTrue();
    $component->inline(false);
    expect($component->isInline())->toBeFalse();
});

it('returns the configured per-step icon', function () {
    $component = ProgressStepper::make('state')->icons([
        'draft' => 'heroicon-m-document',
    ]);

    expect($component->getStepIcon('draft'))->toBe('heroicon-m-document');
    expect($component->getStepIcon('missing'))->toBeNull();
});

it('getColor() delegates to getStepColor()', function () {
    $component = ProgressStepper::make('state')
        ->options(['a' => 'A', 'b' => 'B'])
        ->state('a');

    expect($component->getColor('a'))->toBe('primary');
    expect($component->getColor('b'))->toBe('gray');
});
