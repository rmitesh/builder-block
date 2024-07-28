<?php

namespace Rmitesh\BuilderBlock\Enums;

use Filament\Support\Contracts;

enum CardType: string implements Contracts\HasLabel, Contracts\HasIcon
{
    case Grid = 'grid';
    case Inline = 'inline';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Grid => 'Grid',
            self::Inline => 'Inline',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Grid => 'heroicon-o-squares-2x2',
            self::Inline => 'heroicon-o-queue-list',
        };
    }
}
