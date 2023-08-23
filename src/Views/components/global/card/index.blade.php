@props([
'link' => null,
'title' => null,
'icon' => null,
'bg' => null,
'iconColor' => null,
'iconOpacity' => null,
'noBody' => false,
])

<div class="card position-relative overflow-hidden {{ $bg }}">
    {{ @$befereBody }}
    <div class="{{ @$color }} @if(!$noBody) card-body @endif">
        @if(isset($title))
            <div class="fw-bold fs-5">{{ __($title) }}</div>
        @endif
        {{ @$subtitle }}
        {{ $slot }}
    </div>
    {{ @$afterBody }}
    @if($icon)
        <i class="{{ $icon }} f-size--100 position-absolute opacity-{{ $iconOpacity ?: 25 }}  text--{{ $iconColor ?: 'primary' }}"
           style="right: -20px; bottom: -20px; transform: rotate(347deg);"></i>
    @endif
</div>