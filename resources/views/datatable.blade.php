@php($tableName = $this->getTableName())

<div>
    <x-livewire-tables-kaito::wrapper :component="$this" :tableName="$tableName">
        @if ($this->hasConfigurableAreaFor('before-tools'))
            @include($this->getConfigurableAreaFor('before-tools'), $this->getParametersForConfigurableArea('before-tools'))
        @endif

        <x-livewire-tables-kaito::tools>
            <x-livewire-tables-kaito::tools.sorting-pills />
            <x-livewire-tables-kaito::tools.filter-pills />
            <x-livewire-tables-kaito::tools.toolbar :$filterGenericData />
        </x-livewire-tables-kaito::tools>

        <x-livewire-tables-kaito::table>
            <x-slot name="thead">
                @if($this->getCurrentlyReorderingStatus())
                    <x-livewire-tables-kaito::table.th.reorder x-cloak x-show="currentlyReorderingStatus" />
                @endif
                @if($this->bulkActionsAreEnabled() && $this->hasBulkActions())
                    <x-livewire-tables-kaito::table.th.bulk-actions :displayMinimisedOnReorder="true" />
                @endif
                <x-livewire-tables-kaito::table.th.collapsed-columns />

                @foreach($columns as $index => $column)
                    @continue($column->isHidden())
                    @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))
                    @continue($column->isReorderColumn() && !$this->getCurrentlyReorderingStatus() && $this->getHideReorderColumnUnlessReorderingStatus())

                    <x-livewire-tables-kaito::table.th wire:key="{{ $tableName.'-table-head-'.$index }}" :column="$column" :index="$index" />
                @endforeach
            </x-slot>

            @if($this->secondaryHeaderIsEnabled() && $this->hasColumnsWithSecondaryHeader())
                <x-livewire-tables-kaito::table.tr.secondary-header :rows="$rows" :$filterGenericData />
            @endif
            @if($this->hasDisplayLoadingPlaceholder())
                <x-livewire-tables-kaito::includes.loading colCount="{{ $this->columns->count()+1 }}" />
            @endif


            <x-livewire-tables-kaito::table.tr.bulk-actions :rows="$rows" :displayMinimisedOnReorder="true" />

            @forelse ($rows as $rowIndex => $row)
                <x-livewire-tables-kaito::table.tr wire:key="{{ $tableName }}-row-wrap-{{ $row->{$this->getPrimaryKey()} }}" :row="$row" :rowIndex="$rowIndex">
                    <x-livewire-tables-kaito::table.td.reorder x-cloak x-show="currentlyReorderingStatus" wire:key="{{ $tableName }}-row-reorder-{{ $row->{$this->getPrimaryKey()} }}" :rowID="$tableName.'-'.$row->{$this->getPrimaryKey()}" :rowIndex="$rowIndex" />
                    <x-livewire-tables-kaito::table.td.bulk-actions wire:key="{{ $tableName }}-row-bulk-act-{{ $row->{$this->getPrimaryKey()} }}" :row="$row" :rowIndex="$rowIndex"/>
                    <x-livewire-tables-kaito::table.td.collapsed-columns wire:key="{{ $tableName }}-row-collapsed-{{ $row->{$this->getPrimaryKey()} }}" :rowIndex="$rowIndex" />

                    @foreach($columns as $colIndex => $column)
                        @continue($column->isHidden())
                        @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))
                        @continue($column->isReorderColumn() && !$this->getCurrentlyReorderingStatus() && $this->getHideReorderColumnUnlessReorderingStatus())

                        <x-livewire-tables-kaito::table.td wire:key="{{ $tableName . '-' . $row->{$this->getPrimaryKey()} . '-datatable-td-' . $column->getSlug() }}"  :column="$column" :colIndex="$colIndex">
                            {{ $column->renderContents($row) }}
                        </x-livewire-tables-kaito::table.td>
                    @endforeach
                </x-livewire-tables-kaito::table.tr>

                <x-livewire-tables-kaito::table.collapsed-columns :row="$row" :rowIndex="$rowIndex" />
            @empty
                <x-livewire-tables-kaito::table.empty />
            @endforelse

            @if ($this->footerIsEnabled() && $this->hasColumnsWithFooter())
                <x-slot name="tfoot">
                    @if ($this->useHeaderAsFooterIsEnabled())
                        <x-livewire-tables-kaito::table.tr.secondary-header :rows="$rows" :$filterGenericData />
                    @else
                        <x-livewire-tables-kaito::table.tr.footer :rows="$rows"  :$filterGenericData />
                    @endif
                </x-slot>
            @endif
        </x-livewire-tables-kaito::table>

        <x-livewire-tables-kaito::pagination :rows="$rows" />

        @includeIf($customView)
    </x-livewire-tables-kaito::wrapper>
</div>
