<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle">
    <x-slot name="body">
        <x-admin::drawer>
            <x-admin::layout.part.breadcrumb :page-title="__($category->title)"/>

            <form action="{{ route('admin.config.update', $category->slug) }}" method="post">
                @csrf

                @forelse($configs as $config)
                    <div class="mb-3">
                        <x-admin::config.form
                                :type="$config->type"
                                :name="$config->slug"
                                :label="$config->name"
                                :value="$config->value"
                                :variants="$config->variants"
                                :default="$config->default"
                                :text="$config->text"
                        />
                    </div>
                @empty
                    <div>
                        {{ __('No data') }}
                    </div>
                @endforelse

                @if(count($configs))
                    <hr class="mt-3 mb-4 border--blue-gray">
                    <div class="d-flex justify-content-end gap-2">
                        <button class="btn btn-outline--secondary rounded-pill" type="reset">{{ __('Cancel') }}</button>
                        <button class="btn btn--primary rounded-pill" type="submit"><div class="px-2">{{ __('Save') }}</div></button>
                    </div>
                @endif
            </form>
            @include('admin::config.part.aside')
        </x-admin::drawer>
    </x-slot>
</x-dynamic-component>