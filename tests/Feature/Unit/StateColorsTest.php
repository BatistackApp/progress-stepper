<?php

use Webkul\ProgressStepper\Infolists\Components\ProgressStepper;

it('defaults every color slot to a sensible Filament token', function () {
    $component = ProgressStepper::make('state');

    expect($component->getCompletedColor())->toBe('success');
    expect($component->getCurrentColor())->toBe('primary');
    expect($component->getUpcomingColor())->toBe('gray');
    expect($component->getErrorColor())->toBe('danger');
});

it('overrides each color slot via scalar setter', function () {
    $component = ProgressStepper::make('state')
        ->completedColor('info')
        ->currentColor('warning')
        ->upcomingColor('success')
        ->errorColor('primary');

    expect($component->getCompletedColor())->toBe('info');
    expect($component->getCurrentColor())->toBe('warning');
    expect($component->getUpcomingColor())->toBe('success');
    expect($component->getErrorColor())->toBe('primary');
});

it('accepts a Closure for color setters', function () {
    $component = ProgressStepper::make('state')
        ->currentColor(fn () => 'warning');

    expect($component->getCurrentColor())->toBe('warning');
});

it('color setters return static for chaining', function () {
    $component = ProgressStepper::make('state');

    expect($component->completedColor('info'))->toBe($component);
    expect($component->currentColor('primary'))->toBe($component);
    expect($component->upcomingColor('gray'))->toBe($component);
    expect($component->errorColor('danger'))->toBe($component);
});
