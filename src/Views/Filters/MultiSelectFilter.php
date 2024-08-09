<?php

namespace KaitoSaikyo\LaravelLivewireTables\Views\Filters;

use KaitoSaikyo\LaravelLivewireTables\Views\Filter;
use KaitoSaikyo\LaravelLivewireTables\Views\Traits\Filters\{HasOptions,IsArrayFilter};

class MultiSelectFilter extends Filter
{
    use HasOptions,
        IsArrayFilter;

    protected string $view = 'livewire-tables-kaito::components.tools.filters.multi-select';

    protected string $configPath = 'livewire-tables.multiSelectFilter.defaultConfig';

    protected string $optionsPath = 'livewire-tables.multiSelectFilter.defaultOptions';

    public function validate(int|string|array $value): array|int|string|bool
    {
        if (is_array($value)) {
            foreach ($value as $index => $val) {
                // Remove the bad value
                if (! in_array($val, $this->getKeys())) {
                    unset($value[$index]);
                }
            }
        }

        return $value;
    }

    public function getFilterPillValue($value): ?string
    {
        $values = [];

        foreach ($value as $item) {
            $found = $this->getCustomFilterPillValue($item) ?? $this->getOptions()[$item] ?? null;

            if ($found) {
                $values[] = $found;
            }
        }

        return implode(', ', $values);
    }
}
