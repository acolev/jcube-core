@props([
	"name" => '',
	"value" => '',
	"type" => 'string',
	"label" => "",
	"placeholder" => "",
	"required" => false,
	"btn" => false,
	"inline" => false,
	"variants" => [],
	"id" => "a" . genTrx(6),
])

<x-dynamic-component :component="'input.' . strtolower($type)"
                     :name="$name"
                     :value="$value"
                     :type="$type"
                     :label="$label"
                     :placeholder="$placeholder ? __($placeholder) : null"
                     :required="$required"
                     :variants="$variants"
                     :id="$id"
                     :attributes="$attributes"/>
