<?php

use Webkul\ProgressStepper\Infolists\Components\ProgressStepper;

describe('size()', function () {
    it('defaults to md', function () {
        expect(ProgressStepper::make('s')->getSize())->toBe('md');
    });

    it('accepts the three supported values', function () {
        expect(ProgressStepper::make('s')->size('sm')->getSize())->toBe('sm');
        expect(ProgressStepper::make('s')->size('md')->getSize())->toBe('md');
        expect(ProgressStepper::make('s')->size('lg')->getSize())->toBe('lg');
    });

    it('falls back to md for an unknown value', function () {
        expect(ProgressStepper::make('s')->size('huge')->getSize())->toBe('md');
    });
});

describe('direction()', function () {
    it('defaults to horizontal', function () {
        expect(ProgressStepper::make('s')->getDirection())->toBe('horizontal');
    });

    it('accepts horizontal and vertical', function () {
        expect(ProgressStepper::make('s')->direction('horizontal')->getDirection())->toBe('horizontal');
        expect(ProgressStepper::make('s')->direction('vertical')->getDirection())->toBe('vertical');
    });

    it('falls back to horizontal for an unknown value', function () {
        expect(ProgressStepper::make('s')->direction('diagonal')->getDirection())->toBe('horizontal');
    });
});

describe('theme()', function () {
    it('defaults to filled', function () {
        expect(ProgressStepper::make('s')->getTheme())->toBe('filled');
    });

    it('accepts the three supported values', function () {
        expect(ProgressStepper::make('s')->theme('filled')->getTheme())->toBe('filled');
        expect(ProgressStepper::make('s')->theme('outlined')->getTheme())->toBe('outlined');
        expect(ProgressStepper::make('s')->theme('minimal')->getTheme())->toBe('minimal');
    });

    it('falls back to filled for an unknown value', function () {
        expect(ProgressStepper::make('s')->theme('neon')->getTheme())->toBe('filled');
    });
});

describe('connectorShape()', function () {
    it('defaults to arrow', function () {
        expect(ProgressStepper::make('s')->getConnectorShape())->toBe('arrow');
    });

    it('accepts all four shapes', function () {
        expect(ProgressStepper::make('s')->connectorShape('arrow')->getConnectorShape())->toBe('arrow');
        expect(ProgressStepper::make('s')->connectorShape('chevron')->getConnectorShape())->toBe('chevron');
        expect(ProgressStepper::make('s')->connectorShape('dot')->getConnectorShape())->toBe('dot');
        expect(ProgressStepper::make('s')->connectorShape('line')->getConnectorShape())->toBe('line');
    });

    it('falls back to arrow for an unknown value', function () {
        expect(ProgressStepper::make('s')->connectorShape('zigzag')->getConnectorShape())->toBe('arrow');
    });
});

describe('showIndex()', function () {
    it('defaults to false', function () {
        expect(ProgressStepper::make('s')->shouldShowIndex())->toBeFalse();
    });

    it('toggles on and off', function () {
        $component = ProgressStepper::make('s');

        $component->showIndex();
        expect($component->shouldShowIndex())->toBeTrue();

        $component->showIndex(false);
        expect($component->shouldShowIndex())->toBeFalse();
    });
});

describe('iconOnly()', function () {
    it('defaults to false', function () {
        expect(ProgressStepper::make('s')->isIconOnly())->toBeFalse();
    });

    it('toggles on and off', function () {
        $component = ProgressStepper::make('s');

        $component->iconOnly();
        expect($component->isIconOnly())->toBeTrue();

        $component->iconOnly(false);
        expect($component->isIconOnly())->toBeFalse();
    });
});
