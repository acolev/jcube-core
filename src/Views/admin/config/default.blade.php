<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle" no-body>
  <x-admin::breadcrumb :page-title="$pageTitle">
    <ol class="breadcrumb m-0">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home"></i></a></li>
      <li class="breadcrumb-item active">{{ __('Configurations') }}</li>
    </ol>
  </x-admin::breadcrumb>

  <div class="card">
    <div class="card-body">
      <div class="row g-3">
        <div class="col-lg-3">
          @include('admin::config.part.aside')
        </div>
        <div class="col-lg-9">
          <form action="{{ route('admin.config.update', $category->slug) }}" method="post" enctype="multipart/form-data">
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
            <x-admin::submit/>
          </form>
        </div>
      </div>
    </div>
  </div>

</x-dynamic-component>
