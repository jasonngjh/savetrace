<?php extract(collect($attributes->getAttributes())->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>
@props(['href','onclick'])
<x-jet-dropdown-link :href="$href" :onclick="$onclick" >

{{ $slot ?? "" }}
</x-jet-dropdown-link>