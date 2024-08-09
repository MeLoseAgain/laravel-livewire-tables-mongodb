<?php

namespace KaitoSaikyo\LaravelLivewireTables\Views\Traits\Columns;

use Closure;
use Illuminate\View\ComponentAttributeBag;
use KaitoSaikyo\LaravelLivewireTables\Views\{Column,Filter};

trait HasDefaultStringValue
{
    public string $defaultValue = '';

    public function defaultValue(string $defaultValue): self
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }
}
