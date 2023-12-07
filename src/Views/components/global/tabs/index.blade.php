@php
    $id = Illuminate\Support\Str::random(12);
@endphp

<div class="tabs">
    <ul class="nav nav-tabs nav-primary" id="{{ $id }}" role="tablist">
        @stack('tabs-buttons')
        @if(isset($actions))
            <li class="col"></li>
            <li>
                <div class="btn-group">
                    {{ $actions }}
                </div>
            </li>
        @endif
    </ul>
    <div class="content">
        <div class="tab-content" id="{{ $id }}">
            {{ $slot }}
        </div>
    </div>
</div>
