<x-dynamic-component :component="$layoutComponent">
    <x-tabs>
        <x-slot name="actions">
            <x-admin::back/>
        </x-slot>
        <x-tabs.item active name="Wellcome">
            <x-form.html type="short"/>
        </x-tabs.item>
        <x-tabs.item name="Second">
            <div>Comming soon...</div>
        </x-tabs.item>
    </x-tabs>
</x-dynamic-component>