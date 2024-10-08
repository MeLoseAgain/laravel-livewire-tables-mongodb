<?php

namespace KaitoSaikyo\LaravelLivewireTables\Views\Filters;

use DateTime;
use KaitoSaikyo\LaravelLivewireTables\Views\Filter;
use KaitoSaikyo\LaravelLivewireTables\Views\Traits\Filters\{HasConfig, IsStringFilter};

class DateFilter extends Filter
{
    use HasConfig,
        IsStringFilter;

    protected string $view = 'livewire-tables-kaito::components.tools.filters.date';

    protected string $configPath = 'livewire-tables.dateFilter.defaultConfig';

    public function validate(string $value): string|bool
    {
        if (DateTime::createFromFormat('Y-m-d', $value) === false) {
            return false;
        }

        return $value;
    }

    public function getFilterPillValue($value): ?string
    {
        if ($this->validate($value)) {
            return DateTime::createFromFormat('Y-m-d', $value)->format($this->getConfig('pillFormat'));
        }

        return null;
    }
}
