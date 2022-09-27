@props(['collection'])

<div class="cbp-item {{substr($collection->title, 0, 1)}}">
    <a class="cbp-caption" href="{{route('collections.show', $collection)}}">
        <img class="rounded-circle img-fluid mb-3" src="@if($collection->cover_path && file_exists('storage' . '/' . $collection->cover_path)){{asset('storage/' . $collection->cover_path)}} @else{{asset('assets/img/collections/no-collection-image.png')}}@endif" alt="Image Description">
        <div class="py-3 text-center">
            <h4 class="h6 text-dark text-height-2 crop-text-2">{{$collection->title}}</h4>
<span class="font-size-2 text-secondary-gray-700">{{$collection->items_count}} Items</span>
</div>
</a>
</div>
