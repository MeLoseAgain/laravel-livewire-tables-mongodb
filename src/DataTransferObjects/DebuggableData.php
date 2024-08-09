<?php

namespace KaitoSaikyo\LaravelLivewireTables\DataTransferObjects;

use KaitoSaikyo\LaravelLivewireTables\DataTableComponent;

class DebuggableData
{
    public DataTableComponent $component;

    public function __construct(DataTableComponent $component)
    {
        $this->component = $component;
    }

    public function toArray(): array
    {
        return [
            'query' => (clone $this->component->getBuilder())->toMql(),
            'filters' => $this->component->getAppliedFilters(),
            'sorts' => $this->component->getSorts(),
            'search' => $this->component->getSearch(),
            'select-all' => $this->component->getSelectAllStatus(),
            'selected' => $this->component->getSelected(),
        ];
    }
}
