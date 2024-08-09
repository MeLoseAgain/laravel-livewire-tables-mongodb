<?php

namespace KaitoSaikyo\LaravelLivewireTables\Views\Traits\Configuration;

trait LivewireComponentColumnConfiguration
{
    use ComponentColumnConfiguration;

    protected string $componentView;

    protected mixed $slotCallback;
}
