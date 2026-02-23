<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>

        @if($post->featured_image)
            <img src="{{ asset('storage/'.$post->featured_image) }}" class="mb-4">
        @endif

        <div>{!! $post->content !!}</div>
    </div>
</x-app-layout>
