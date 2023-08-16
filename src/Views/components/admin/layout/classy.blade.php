<div class="row g-0">
    <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
        <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
             aria-labelledby="sidebarMenuLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                        aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                {{ $aside }}
                <div style="height: 200vh;"></div>
            </div>
        </div>
    </div>

    <main class="col-md-9 ms-sm-auto col-lg-10">
        <x-admin::layout.part.header/>
        <div class="px-md-4">
            {{ $slot }}
        </div>
    </main>
</div>
