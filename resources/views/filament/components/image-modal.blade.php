&lt;div class="p-4">
    &lt;img 
        src="{{ $url }}" 
        alt="{{ $title }}" 
        class="max-w-full h-auto rounded-lg shadow-lg"
    >
    @if($title)
        &lt;h3 class="mt-4 text-lg font-medium text-gray-900">{{ $title }}&lt;/h3>
    @endif
&lt;/div>