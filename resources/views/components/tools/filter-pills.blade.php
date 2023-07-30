@aware(['component'])

@if ($component->filtersAreEnabled() && $component->filterPillsAreEnabled() && $component->hasAppliedVisibleFiltersForPills())
    <div>
        <div
            @class([
                'mb-4 px-4 md:p-0' => $component->isTailwind(),
                'mb-3' => $component->isBootstrap4(),
                'mb-3' => $component->isBootstrap5(),
            ])
        >
            <small @class([
                    'text-gray-700 dark:text-white' => $component->isTailwind(),
                    '' =>  $component->isBootstrap4(),
                    '' =>  $component->isBootstrap5(),
                ])
            >
                @lang('Applied Filters'):
            </small>

            @foreach($component->getAppliedFiltersWithValues() as $filterSelectName => $value)
                @php($filter = $component->getFilterByKey($filterSelectName))

                @continue(is_null($filter))
                @continue($filter->isHiddenFromPills())
                @if ($filter->hasCustomPillBlade())
                    @include($filter->getCustomPillBlade(), ['filter' => $filter])
                @else
                <span
                    wire:key="{{ $component->getTableName() }}-filter-pill-{{ $filter->getKey() }}"
                    @class([
                        'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-indigo-100 text-indigo-800 capitalize dark:bg-indigo-200 dark:text-indigo-900' => $component->isTailwind(),
                        'badge badge-pill badge-info d-inline-flex align-items-center' => $component->isBootstrap4(),
                        'badge rounded-pill bg-info d-inline-flex align-items-center' => $component->isBootstrap5(),
                    ])
                >
                    {{ $filter->getFilterPillTitle() }}: {{ $filter->getFilterPillValue($value) }}
                    @if ($component->isTailwind())
                        <button
                                wire:click="resetFilter('{{ $filter->getKey() }}')"
                                type="button"
                                class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:outline-none focus:bg-indigo-500 focus:text-white"
                            >
                                <span class="sr-only">@lang('Remove filter option')</span>
                                <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                                    <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                                </svg>
                        </button>

                    @else
                        <a
                            href="#"
                            wire:click="resetFilter('{{ $filter->getKey() }}')"
                            @class([
                                'text-white ml-2' => ($component->isBootstrap()),
                            ])
                        >
                            <span @class([
                                'sr-only' => $component->isBootstrap4(),
                                'visually-hidden' => $component->isBootstrap5(),
                            ])
                            >
                                @lang('Remove filter option')
                            </span>
                            <svg style="width:.5em;height:.5em" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                                <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                            </svg>
                        </a>
                    @endif
                </span>
                @endif
            @endforeach
            @if ($component->isTailwind())
                <button
                    wire:click.prevent="setFilterDefaults"
                    class="focus:outline-none active:outline-none"
                >
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-200 dark:text-gray-900">
                        @lang('Clear')
                    </span>
                </button>
            @else
                <a
                    href="#"
                    wire:click.prevent="setFilterDefaults"
                    @class([
                        'badge badge-pill badge-light' => $component->isBootstrap4(),
                        'badge rounded-pill bg-light text-dark text-decoration-none' => $component->isBootstrap5(),
                    ])
                >
                    @lang('Clear')
                </a>
            @endif
        </div>
    </div>
@endif

