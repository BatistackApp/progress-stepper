<?php

use Webkul\ProgressStepper\Infolists\Components\ProgressStepper;
use Webkul\ProgressStepper\Tests\Feature\Fixtures\SampleStatus;

it('derives option label map from a BackedEnum implementing HasLabel', function () {
    $component = ProgressStepper::make('state')->optionsFromEnum(SampleStatus::class);

    expect($component->getOptions())->toBe([
        'draft' => 'Draft',
        'sent' => 'Sent',
        'confirmed' => 'Confirmed',
        'done' => 'Done',
    ]);
});

it('picks up per-case icons when the enum implements HasIcon', function () {
    $component = ProgressStepper::make('state')->optionsFromEnum(SampleStatus::class);

    expect($component->getStepIcon('draft'))->toBe('heroicon-m-document');
    expect($component->getStepIcon('done'))->toBe('heroicon-m-check-circle');
});

it('ignores non-enum class gracefully', function () {
    $component = ProgressStepper::make('state')->optionsFromEnum(\stdClass::class);

    expect($component->getOptions())->toBe([]);
});

it('returns static for chaining', function () {
    $component = ProgressStepper::make('state');

    expect($component->optionsFromEnum(SampleStatus::class))->toBe($component);
});
