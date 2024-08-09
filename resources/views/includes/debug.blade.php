<div>
    @if ($component->debugIsEnabled())
        <p><strong>@lang('Debugging Values'):</strong></p>

        @if (! app()->runningInConsole())
            <div class="mb-4">@dump((new \KaitoSaikyo\LaravelLivewireTables\DataTransferObjects\DebuggableData($component))->toArray())</div>
        @endif
    @endif
</div>
