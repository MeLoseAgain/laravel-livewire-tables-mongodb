<?php

namespace KaitoSaikyo\LaravelLivewireTables\Traits;

use KaitoSaikyo\LaravelLivewireTables\Traits\Configuration\CollapsingColumnConfiguration;
use KaitoSaikyo\LaravelLivewireTables\Traits\Helpers\CollapsingColumnHelpers;

trait WithCollapsingColumns
{
    use CollapsingColumnConfiguration;
    use CollapsingColumnHelpers;

    protected bool $collapsingColumnsStatus = true;
}
