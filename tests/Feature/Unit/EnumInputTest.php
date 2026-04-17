<?php

use Webkul\ProgressStepper\Enums\ConnectorShape;
use Webkul\ProgressStepper\Enums\Direction;
use Webkul\ProgressStepper\Enums\Size;
use Webkul\ProgressStepper\Enums\StepStatus;
use Webkul\ProgressStepper\Enums\Theme;
use Webkul\ProgressStepper\Infolists\Components\ProgressStepper;

it('accepts Size enum as input to size()', function () {
    expect(ProgressStepper::make('s')->size(Size::Small)->getSize())->toBe('sm');
    expect(ProgressStepper::make('s')->size(Size::Medium)->getSize())->toBe('md');
    expect(ProgressStepper::make('s')->size(Size::Large)->getSize())->toBe('lg');
});

it('accepts Direction enum as input to direction()', function () {
    expect(ProgressStepper::make('s')->direction(Direction::Horizontal)->getDirection())->toBe('horizontal');
    expect(ProgressStepper::make('s')->direction(Direction::Vertical)->getDirection())->toBe('vertical');
});

it('accepts Theme enum as input to theme()', function () {
    expect(ProgressStepper::make('s')->theme(Theme::Filled)->getTheme())->toBe('filled');
    expect(ProgressStepper::make('s')->theme(Theme::Outlined)->getTheme())->toBe('outlined');
    expect(ProgressStepper::make('s')->theme(Theme::Minimal)->getTheme())->toBe('minimal');
});

it('accepts ConnectorShape enum as input to connectorShape()', function () {
    expect(ProgressStepper::make('s')->connectorShape(ConnectorShape::Arrow)->getConnectorShape())->toBe('arrow');
    expect(ProgressStepper::make('s')->connectorShape(ConnectorShape::Chevron)->getConnectorShape())->toBe('chevron');
    expect(ProgressStepper::make('s')->connectorShape(ConnectorShape::Dot)->getConnectorShape())->toBe('dot');
    expect(ProgressStepper::make('s')->connectorShape(ConnectorShape::Line)->getConnectorShape())->toBe('line');
});

it('string input continues to work (backwards compatible)', function () {
    expect(ProgressStepper::make('s')->size('lg')->getSize())->toBe('lg');
    expect(ProgressStepper::make('s')->direction('vertical')->getDirection())->toBe('vertical');
    expect(ProgressStepper::make('s')->theme('outlined')->getTheme())->toBe('outlined');
    expect(ProgressStepper::make('s')->connectorShape('dot')->getConnectorShape())->toBe('dot');
});

it('accepts a Closure returning an enum', function () {
    expect(
        ProgressStepper::make('s')->size(fn () => Size::Large)->getSize()
    )->toBe('lg');
});

it('getStepStatus returns values that match StepStatus enum cases', function () {
    $component = ProgressStepper::make('state')
        ->options(['a' => 'A', 'b' => 'B', 'c' => 'C'])
        ->state('b')
        ->markCompletedUpToCurrent()
        ->errorStates(['c']);

    // 'a' is before current → completed
    expect(StepStatus::from($component->getStepStatus('a')))->toBe(StepStatus::Completed);
    // 'b' is current
    expect(StepStatus::from($component->getStepStatus('b')))->toBe(StepStatus::Current);
    // 'c' is in errorStates → error
    expect(StepStatus::from($component->getStepStatus('c')))->toBe(StepStatus::Error);
});

it('each enum provides a default() matching the trait default', function () {
    expect(Size::default())->toBe(Size::Medium);
    expect(Direction::default())->toBe(Direction::Horizontal);
    expect(Theme::default())->toBe(Theme::Filled);
    expect(ConnectorShape::default())->toBe(ConnectorShape::Arrow);
});
