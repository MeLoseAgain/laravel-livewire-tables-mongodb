<?php

namespace KaitoSaikyo\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentAttributeBag;
use KaitoSaikyo\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use KaitoSaikyo\LaravelLivewireTables\Views\Column;
use KaitoSaikyo\LaravelLivewireTables\Views\Traits\Configuration\ComponentColumnConfiguration;
use KaitoSaikyo\LaravelLivewireTables\Views\Traits\Helpers\ComponentColumnHelpers;

class ComponentColumn extends Column
{
    use ComponentColumnConfiguration,
        ComponentColumnHelpers;

    protected string $componentView;

    protected mixed $slotCallback = null;

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
    }

    public function getContents(Model $row): null|string|HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if ($this->isLabel()) {
            throw new DataTableConfigurationException('You can not use a label column with a component column');
        }

        if ($this->hasComponentView() === false) {
            throw new DataTableConfigurationException('You must specify a component view for a component column');
        }

        $attributes = [];
        $value = $this->getValue($row);
        $slotContent = $value;

        if ($this->hasAttributesCallback()) {
            $attributes = call_user_func($this->getAttributesCallback(), $value, $row, $this);

            if (! is_array($attributes)) {
                throw new DataTableConfigurationException('The return type of callback must be an array');
            }
        }
        if ($this->hasSlotCallback()) {
            $slotContent = call_user_func($this->getSlotCallback(), $value, $row, $this);
            if (is_string($slotContent)) {
                $slotContent = new HtmlString($slotContent);
            }
        }

        return view($this->getComponentView(), [
            'attributes' => new ComponentAttributeBag($attributes),
            'slot' => $slotContent,
        ]);
    }
}
