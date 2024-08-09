<?php

namespace KaitoSaikyo\LaravelLivewireTables\Traits;

use KaitoSaikyo\LaravelLivewireTables\Traits\Configuration\LoadingPlaceholderConfiguration;
use KaitoSaikyo\LaravelLivewireTables\Traits\Helpers\LoadingPlaceholderHelpers;

trait WithLoadingPlaceholder
{
    use LoadingPlaceholderConfiguration,
        LoadingPlaceholderHelpers;

    protected bool $displayLoadingPlaceholder = false;

    protected string $loadingPlaceholderContent = 'Loading';

    protected ?string $loadingPlaceholderBlade = null;

    protected array $loadingPlaceHolderAttributes = [];

    protected array $loadingPlaceHolderIconAttributes = [];

    protected array $loadingPlaceHolderWrapperAttributes = [];
}
