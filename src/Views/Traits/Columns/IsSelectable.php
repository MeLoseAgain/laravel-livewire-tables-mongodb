<?php

namespace KaitoSaikyo\LaravelLivewireTables\Views\Traits\Columns;

use Closure;
use KaitoSaikyo\LaravelLivewireTables\DataTableComponent;
use KaitoSaikyo\LaravelLivewireTables\Views\Column;

trait IsSelectable
{
    protected bool $selectable = true;

    protected bool $selected = true;

    public function isSelectable(): bool
    {
        return $this->selectable === true;
    }

    public function isSelected(): bool
    {
        return $this->selected === true;
    }

    public function excludeFromColumnSelect(): self
    {
        $this->selectable = false;

        return $this;
    }

    public function deselected(): self
    {
        $this->selected = false;

        return $this;
    }
}
