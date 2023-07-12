<ul class="list-unstyled">
    <li>
        <span class="text-muted small">{{ __('Created:') }} </span>
        {{ $created->toDateTimeString() }}
    </li>
    @if ($start)
        <li>
            <span class="text-muted small">{{ __('Starts:') }} </span>
            {{ $start->toDateTimeString() }}
        </li>
    @endif
    @if ($end)
        <li>
            <span class="text-muted small">{{ __('Ends:') }} </span>
            {{ $end->toDateTimeString() }}
        </li>
    @endif
</ul>
