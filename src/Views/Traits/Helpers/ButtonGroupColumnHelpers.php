<?php

namespace KaitoSaikyo\LaravelLivewireTables\Views\Traits\Helpers;

use KaitoSaikyo\LaravelLivewireTables\Views\Columns\LinkColumn;

trait ButtonGroupColumnHelpers
{
    public function getButtons(): array
    {
        return collect($this->buttons)
            ->reject(fn ($button) => ! $button instanceof LinkColumn)
            ->toArray();
    }
}
