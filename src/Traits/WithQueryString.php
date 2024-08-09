<?php

namespace KaitoSaikyo\LaravelLivewireTables\Traits;

use Livewire\Attributes\Locked;
use KaitoSaikyo\LaravelLivewireTables\Traits\Configuration\QueryStringConfiguration;
use KaitoSaikyo\LaravelLivewireTables\Traits\Helpers\QueryStringHelpers;

trait WithQueryString
{
    use QueryStringConfiguration,
        QueryStringHelpers;

    protected ?string $queryStringAlias;

    #[Locked]
    public ?bool $queryStringStatus;

    /**
     * Set the custom query string array for this specific table
     *
     * @return array<mixed>
     */
    protected function queryStringWithQueryString(): array
    {

        if ($this->queryStringIsEnabled()) {
            return [
                $this->getTableName() => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAlias()],
            ];
        }

        return [];
    }
}
