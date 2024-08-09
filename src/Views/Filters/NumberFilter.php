<?php

namespace KaitoSaikyo\LaravelLivewireTables\Views\Filters;

use KaitoSaikyo\LaravelLivewireTables\Views\Filter;
use KaitoSaikyo\LaravelLivewireTables\Views\Traits\Filters\{IsStringFilter};

class NumberFilter extends Filter
{
    use IsStringFilter;

    protected string $view = 'livewire-tables-kaito::components.tools.filters.number';

    public function validate(mixed $value): float|int|bool
    {
        return is_numeric($value) ? $value : false;
    }
}
