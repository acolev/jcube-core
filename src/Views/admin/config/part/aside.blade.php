<div class="nav nav-pills flex-column nav-pills-tab custom-verti-nav-pills text-center" role="tablist" aria-orientation="vertical">
    @foreach($categories as $item)
    <a @class(['nav-link', 'active' => $category->slug === $item->slug])
       href="{{ route('admin.config.view', $item->slug) }}">
        <div class="d-flex py-2">
            <div class="me-3 mt-1">
                <i class="la-2x {{$item->icon}}"></i>
            </div>
            <div>
                <b>{{ __($item->title) }}</b>
                <p class="small">{{ __($item->description) }}</p>
            </div>
        </div>
    </a>
    @endforeach
</div>
