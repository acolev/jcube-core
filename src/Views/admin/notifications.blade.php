<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle">
    <div class="notify__area">
        @forelse($notifications as $notification)
            <a class="notify__item @if($notification->read_status == 0) unread--notification @endif"
               href="{{ route('admin.notification.read',$notification->id) }}">
                <div class="notify__content">
                    <h6 class="title">{{ __($notification->title) }}</h6>
                    <span class="date">
                        <i class="las la-clock"></i>
                        {{ $notification->created_at->diffForHumans() }}
                    </span>
                </div>
            </a>
        @empty
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">{{ __('Data not found') }}</h3>
                </div>
            </div>
        @endforelse
        <div class="mt-3">
            {{ paginateLinks($notifications) }}
        </div>
    </div>

    @push('breadcrumb-plugins')
        <a href="{{ route('admin.notifications.readAll') }}"
           class="btn btn-sm btn-outline--primary">@lang('Mark All as Read')</a>
    @endpush
</x-dynamic-component>