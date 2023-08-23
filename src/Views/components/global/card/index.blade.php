@props([
'link' => null,
'title' => null,
'icon' => null,
'bg' => null,
'color' => null,
'iconColor' => null,
'iconOpacity' => null,
'noBody' => false,
])

<div class="card position-relative overflow-hidden {{ $bg }}">
    <div class="@if(!$noBody) card-body @endif">
        <div class="fw-bold fs-5">{{ __($title) }}</div>
        {{ @$subtitle }}
        {{ $slot }}
    </div>
    {{ @$afterBody }}
    @if($icon)
        <i class="{{ $icon }} f-size--100 position-absolute opacity-{{ $iconOpacity ?: 25 }}  text--{{ $iconColor ?: 'primary' }}"
           style="right: -20px; bottom: -20px; transform: rotate(347deg);"></i>
    @endif
</div>