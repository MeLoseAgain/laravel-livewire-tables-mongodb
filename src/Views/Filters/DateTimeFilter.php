<?php

namespace KaitoSaikyo\LaravelLivewireTables\Views\Filters;

use DateTime;
use KaitoSaikyo\LaravelLivewireTables\Views\Filter;
use KaitoSaikyo\LaravelLivewireTables\Views\Traits\Filters\{HasConfig, IsStringFilter};

class DateTimeFilter extends Filter
{
    use HasConfig,
        IsStringFilter;

    protected string $view = 'livewire-tables-kaito::components.tools.filters.datetime';

    protected string $configPath = 'livewire-tables.dateTimeFilter.defaultConfig';

    public function validate(string $value): string|bool
    {
        if (DateTime::createFromFormat('Y-m-d\TH:i', $value) === false) {
            return false;
        }

        return $value;
    }

    public function getFilterPillValue($value): ?string
    {
        if ($this->validate($value)) {
            return DateTime::createFromFormat('Y-m-d\TH:i', $value)->format($this->getConfig('pillFormat'));
        }

        return null;
    }
}
