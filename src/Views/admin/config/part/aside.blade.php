<x-slot name="aside">
    <div>
        <div class="drawer-menu-title">{{ __('Configurations') }}</div>
    </div>
    <div class="drawer-menu">
        @foreach($categories as $item)
        <a href="{{ route('admin.config.view', $item->slug) }}"
                @class(['active' => $category->slug === $item->slug])
        >
            <div class="d-flex py-2">
                <div class="me-3 mt-1">
                    <i class="{{$item->icon}}"></i>
                </div>
                <div>
                    <b>{{ __($item->title) }}</b>
                    <p>{{ __($item->description) }}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</x-slot>