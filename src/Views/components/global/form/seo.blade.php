@props([
	'item',
	'description' => false
])

<div class="row">
    <div class="form-group col-12 ">
        <x-input type="text" name="seo[meta_title]" label="Meta title" value="{{ @$item?->meta_title }}"/>
    </div>
    @if($description)
    <div class="form-group col-12 ">
        <x-forms.input type="textarea" name="seo[description]" label="Description" value="{{ @$item?->description }}" rows="4"/>
    </div>
    @endif
    <div class="form-group col-12 ">
        <x-input type="textarea" name="seo[meta_description]" label="Meta Description" value="{{ @$item?->meta_description }}" rows="4"/>
    </div>
    <div class="form-group col-12 ">
        <x-input type="textarea" name="seo[meta_keywords]" label="Meta Keywords" value="{{ @$item?->meta_keywords }}" rows="4"/>
    </div>
    <div class="form-group col-12 ">
        <x-input type="code" name="seo[raw_html]" label="HTML" value="{{ @$item?->raw_html }}" rows="4"/>
    </div>
</div>
