<?php

use Webkul\ProgressStepper\Infolists\Components\ProgressStepper;

it('defaults markCompletedUpToCurrent to false', function () {
    expect(ProgressStepper::make('s')->shouldMarkCompletedUpToCurrent())->toBeFalse();
});

it('toggles markCompletedUpToCurrent on and off', function () {
    $component = ProgressStepper::make('s');

    $component->markCompletedUpToCurrent();
    expect($component->shouldMarkCompletedUpToCurrent())->toBeTrue();

    $component->markCompletedUpToCurrent(false);
    expect($component->shouldMarkCompletedUpToCurrent())->toBeFalse();
});

it('stores error states as array', function () {
    $component = ProgressStepper::make('s')->errorStates(['cancelled', 'rejected']);

    expect($component->getErrorStates())->toBe(['cancelled', 'rejected']);
});

it('accepts a Closure for error states', function () {
    $component = ProgressStepper::make('s')->errorStates(fn () => ['foo']);

    expect($component->getErrorStates())->toBe(['foo']);
});

it('returns empty hidden states when no closure is set', function () {
    expect(ProgressStepper::make('s')->getHiddenStates())->toBe([]);
});

it('invokes hideStatesFor closure to compute hidden states', function () {
    $component = ProgressStepper::make('s')->hideStatesFor(fn () => ['refunded', 'pending']);

    expect($component->getHiddenStates())->toBe(['refunded', 'pending']);
});
