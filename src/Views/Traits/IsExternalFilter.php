<?php

namespace KaitoSaikyo\LaravelLivewireTables\Views\Traits;

use Livewire\Attributes\Modelable;

trait IsExternalFilter
{
    #[Modelable]
    public $value = '';

    public $filterKey = '';
}
