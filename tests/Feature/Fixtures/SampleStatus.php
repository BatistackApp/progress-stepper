<?php

namespace Webkul\ProgressStepper\Tests\Feature\Fixtures;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum SampleStatus: string implements HasLabel, HasColor, HasIcon
{
    case Draft = 'draft';
    case Sent = 'sent';
    case Confirmed = 'confirmed';
    case Done = 'done';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Sent => 'Sent',
            self::Confirmed => 'Confirmed',
            self::Done => 'Done',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Draft => 'gray',
            self::Sent => 'info',
            self::Confirmed => 'primary',
            self::Done => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Draft => 'heroicon-m-document',
            self::Sent => 'heroicon-m-paper-airplane',
            self::Confirmed => 'heroicon-m-check-badge',
            self::Done => 'heroicon-m-check-circle',
        };
    }
}
