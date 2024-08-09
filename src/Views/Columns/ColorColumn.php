<?php

namespace KaitoSaikyo\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use KaitoSaikyo\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use KaitoSaikyo\LaravelLivewireTables\Views\Column;
use KaitoSaikyo\LaravelLivewireTables\Views\Traits\Columns\HasDefaultStringValue;
use KaitoSaikyo\LaravelLivewireTables\Views\Traits\Configuration\ColorColumnConfiguration;
use KaitoSaikyo\LaravelLivewireTables\Views\Traits\Helpers\ColorColumnHelpers;
use KaitoSaikyo\LaravelLivewireTables\Views\Traits\IsColumn;

class ColorColumn extends Column
{
    use IsColumn;
    use ColorColumnConfiguration,
        ColorColumnHelpers;
    use HasDefaultStringValue;

    public ?object $colorCallback = null;

    protected string $view = 'livewire-tables::includes.columns.color';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        if (! isset($from)) {
            $this->label(fn () => null);
        }

    }

    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view($this->getView())
            ->withIsTailwind($this->getComponent()->isTailwind())
            ->withIsBootstrap($this->getComponent()->isBootstrap())
            ->withColor($this->getColor($row))
            ->withAttributeBag($this->getAttributeBag($row));
    }

    public function getValue(Model $row): string
    {
        return parent::getValue($row) ?? $this->getDefaultValue();
    }
}
