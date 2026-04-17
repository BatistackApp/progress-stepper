<?php

use Webkul\ProgressStepper\Infolists\Components\ProgressStepper;

function steppers(): ProgressStepper
{
    return ProgressStepper::make('state')->options([
        'draft' => 'Draft',
        'sent' => 'Sent',
        'confirmed' => 'Confirmed',
        'done' => 'Done',
    ])->state('confirmed');
}

it('marks the matching value as current', function () {
    expect(steppers()->getStepStatus('confirmed'))->toBe('current');
});

it('marks earlier values as completed when markCompletedUpToCurrent is on', function () {
    $component = steppers()->markCompletedUpToCurrent();

    expect($component->getStepStatus('draft'))->toBe('completed');
    expect($component->getStepStatus('sent'))->toBe('completed');
});

it('marks earlier values as upcoming when markCompletedUpToCurrent is off', function () {
    expect(steppers()->getStepStatus('draft'))->toBe('upcoming');
});

it('marks later values as upcoming regardless', function () {
    expect(steppers()->markCompletedUpToCurrent()->getStepStatus('done'))->toBe('upcoming');
});

it('marks error states as error, overriding other rules', function () {
    $component = steppers()
        ->markCompletedUpToCurrent()
        ->errorStates(['draft']);

    expect($component->getStepStatus('draft'))->toBe('error');
});

it('maps status → color via getStepColor', function () {
    $component = steppers()->markCompletedUpToCurrent();

    expect($component->getStepColor('draft'))->toBe('success');   // completed → completedColor default
    expect($component->getStepColor('confirmed'))->toBe('primary'); // current → currentColor default
    expect($component->getStepColor('done'))->toBe('gray');         // upcoming → upcomingColor default
});

it('uses errorColor for steps flagged as error', function () {
    $component = steppers()->errorStates(['draft']);

    expect($component->getStepColor('draft'))->toBe('danger');
});

it('honours custom color overrides', function () {
    $component = steppers()
        ->markCompletedUpToCurrent()
        ->completedColor('info')
        ->currentColor('warning')
        ->upcomingColor('success');

    expect($component->getStepColor('draft'))->toBe('info');
    expect($component->getStepColor('confirmed'))->toBe('warning');
    expect($component->getStepColor('done'))->toBe('success');
});
