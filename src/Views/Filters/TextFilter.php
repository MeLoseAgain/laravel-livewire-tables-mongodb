<?php

namespace KaitoSaikyo\LaravelLivewireTables\Views\Filters;

use KaitoSaikyo\LaravelLivewireTables\Views\Filter;
use KaitoSaikyo\LaravelLivewireTables\Views\Traits\Filters\{IsStringFilter};

class TextFilter extends Filter
{
    use IsStringFilter;

    protected string $view = 'livewire-tables::components.tools.filters.text-field';

    public function validate(string $value): string|bool
    {
        if ($this->hasConfig('maxlength')) {
            return strlen($value) <= $this->getConfig('maxlength') ? $value : false;
        }

        return strlen($value) ? $value : false;
    }
}
