<?php

namespace KaitoSaikyo\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use KaitoSaikyo\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use KaitoSaikyo\LaravelLivewireTables\Views\Column;
use KaitoSaikyo\LaravelLivewireTables\Views\Traits\Configuration\ImageColumnConfiguration;
use KaitoSaikyo\LaravelLivewireTables\Views\Traits\Core\HasLocationCallback;
use KaitoSaikyo\LaravelLivewireTables\Views\Traits\Helpers\ImageColumnHelpers;

class ImageColumn extends Column
{
    use ImageColumnConfiguration,
        ImageColumnHelpers,
        HasLocationCallback;

    protected string $view = 'livewire-tables-kaito::includes.columns.image';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);

        $this->label(fn () => null);
    }

    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if (! $this->hasLocationCallback()) {
            throw new DataTableConfigurationException('You must specify a location callback for an image column.');
        }

        return view($this->getView())
            ->withColumn($this)
            ->withPath(app()->call($this->getLocationCallback(), ['row' => $row]))
            ->withAttributes($this->hasAttributesCallback() ? app()->call($this->getAttributesCallback(), ['row' => $row]) : []);
    }
}
