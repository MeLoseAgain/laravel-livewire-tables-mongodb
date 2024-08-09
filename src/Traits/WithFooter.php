<?php

namespace KaitoSaikyo\LaravelLivewireTables\Traits;

use KaitoSaikyo\LaravelLivewireTables\Traits\Configuration\FooterConfiguration;
use KaitoSaikyo\LaravelLivewireTables\Traits\Helpers\FooterHelpers;

trait WithFooter
{
    use FooterConfiguration,
        FooterHelpers;

    protected bool $footerStatus = true;

    protected bool $useHeaderAsFooterStatus = false;

    protected bool $columnsWithFooter = false;

    protected $footerTrAttributesCallback;

    protected $footerTdAttributesCallback;

    public function setupFooter(): void
    {
        foreach ($this->getColumns() as $column) {
            if ($column->hasFooter()) {
                $this->columnsWithFooter = true;
            }
        }
    }

    public function renderingWithFooter(): void
    {
        $this->setupFooter();
    }
}
