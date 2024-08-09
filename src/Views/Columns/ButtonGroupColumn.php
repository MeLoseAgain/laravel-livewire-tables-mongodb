<?php

namespace KaitoSaikyo\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use KaitoSaikyo\LaravelLivewireTables\Views\Column;
use KaitoSaikyo\LaravelLivewireTables\Views\Traits\Configuration\ButtonGroupColumnConfiguration;
use KaitoSaikyo\LaravelLivewireTables\Views\Traits\Helpers\ButtonGroupColumnHelpers;

class ButtonGroupColumn extends Column
{
    use ButtonGroupColumnConfiguration,
        ButtonGroupColumnHelpers;

    protected array $buttons = [];

    protected string $view = 'livewire-tables-kaito::includes.columns.button-group';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);

        $this->label(fn () => null);
    }

    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|\KaitoSaikyo\LaravelLivewireTables\Exceptions\DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view($this->getView())
            ->withColumn($this)
            ->withRow($row)
            ->withButtons($this->getButtons())
            ->withAttributes($this->hasAttributesCallback() ? app()->call($this->getAttributesCallback(), ['row' => $row]) : []);
    }
}
