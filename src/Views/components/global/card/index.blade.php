@props([
'icon' => null,
'bg' => null,
'iconColor' => null,
'iconOpacity' => null,
'noBody' => false,
])

<div class="card position-relative overflow-hidden {{ $bg }}">
    @isset($header)
        <div @class(['card-header', @$header->attributes->get('class')])>{{ $header }}</div>
    @endisset
    <div @class(['card-body' => !$noBody, @$slot->attributes->get('class')])>
        {{ $slot }}
    </div>
    @isset($footer)
        <div @class(['card-footer', 'bg-transparent', 'border-0', @$footer->attributes->get('class')])>{{ $footer }}</div>
    @endisset
    @if($icon)
        <i class="{{ $icon }} f-size--100 position-absolute opacity-{{ $iconOpacity ?: 25 }}  text--{{ $iconColor ?: 'primary' }}"
           style="right: -20px; bottom: -20px; transform: rotate(347deg);">
        </i>
    @endif
</div>