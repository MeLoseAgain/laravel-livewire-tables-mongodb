<?php

namespace KaitoSaikyo\LaravelLivewireTables\Views\Traits\Configuration;

use KaitoSaikyo\LaravelLivewireTables\Views\Traits\Columns;

trait ColorColumnConfiguration
{
    public function color(callable $callback): self
    {
        $this->colorCallback = $callback;

        return $this;
    }
}
