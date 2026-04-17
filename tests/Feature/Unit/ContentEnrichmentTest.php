<?php

use Webkul\ProgressStepper\Infolists\Components\ProgressStepper;

describe('stepDescription()', function () {
    it('returns null when not configured', function () {
        expect(ProgressStepper::make('s')->getStepDescription('draft', 'Draft'))->toBeNull();
    });

    it('resolves descriptions from an array map', function () {
        $component = ProgressStepper::make('s')->stepDescription([
            'draft' => 'Not yet sent',
            'sent' => 'Awaiting response',
        ]);

        expect($component->getStepDescription('draft', 'Draft'))->toBe('Not yet sent');
        expect($component->getStepDescription('sent', 'Sent'))->toBe('Awaiting response');
        expect($component->getStepDescription('done', 'Done'))->toBeNull();
    });

    it('resolves a scalar description from a Closure', function () {
        $component = ProgressStepper::make('s')->stepDescription(
            fn (string $value) => "description-for-{$value}"
        );

        expect($component->getStepDescription('draft', 'Draft'))->toBe('description-for-draft');
    });
});

describe('stepTooltip()', function () {
    it('returns null when not configured', function () {
        expect(ProgressStepper::make('s')->getStepTooltip('draft', 'Draft'))->toBeNull();
    });

    it('resolves tooltips from an array map', function () {
        $component = ProgressStepper::make('s')->stepTooltip(['sent' => 'Emailed']);

        expect($component->getStepTooltip('sent', 'Sent'))->toBe('Emailed');
    });
});

describe('stepBadge()', function () {
    it('returns null when not configured', function () {
        expect(ProgressStepper::make('s')->getStepBadge('draft', 'Draft'))->toBeNull();
    });

    it('returns integers and strings from a map', function () {
        $component = ProgressStepper::make('s')->stepBadge([
            'sent' => 3,
            'cancelled' => '!',
        ]);

        expect($component->getStepBadge('sent', 'Sent'))->toBe(3);
        expect($component->getStepBadge('cancelled', 'Cancelled'))->toBe('!');
    });

    it('treats empty / zero / null badges as "no badge"', function () {
        $component = ProgressStepper::make('s')->stepBadge([
            'a' => null,
            'b' => '',
            'c' => 0,
            'd' => '0',
        ]);

        expect($component->getStepBadge('a', 'A'))->toBeNull();
        expect($component->getStepBadge('b', 'B'))->toBeNull();
        expect($component->getStepBadge('c', 'C'))->toBeNull();
        expect($component->getStepBadge('d', 'D'))->toBeNull();
    });
});
