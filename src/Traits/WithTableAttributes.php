<?php

namespace KaitoSaikyo\LaravelLivewireTables\Traits;

use Closure;
use KaitoSaikyo\LaravelLivewireTables\Traits\Configuration\TableAttributeConfiguration;
use KaitoSaikyo\LaravelLivewireTables\Traits\Helpers\TableAttributeHelpers;

trait WithTableAttributes
{
    use TableAttributeConfiguration,
        TableAttributeHelpers;

    protected array $componentWrapperAttributes = [];

    protected array $tableWrapperAttributes = [];

    protected array $tableAttributes = [];

    protected array $theadAttributes = [];

    protected array $tbodyAttributes = [];

    protected $thAttributesCallback;

    protected $thSortButtonAttributesCallback;

    protected $trAttributesCallback;

    protected $tdAttributesCallback;

    protected $trUrlCallback;

    protected $trUrlTargetCallback;
}
