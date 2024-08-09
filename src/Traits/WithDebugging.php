<?php

namespace KaitoSaikyo\LaravelLivewireTables\Traits;

use KaitoSaikyo\LaravelLivewireTables\Traits\Configuration\DebuggingConfiguration;
use KaitoSaikyo\LaravelLivewireTables\Traits\Helpers\DebugHelpers;

trait WithDebugging
{
    use DebuggingConfiguration,
        DebugHelpers;

    /**
     * Dump table properties for debugging
     */
    protected bool $debugStatus = false;
}
