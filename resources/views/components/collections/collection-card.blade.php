@props(['collection'])

<div class="cbp-item {{substr($collection->title, 0, 1)}}" style="height: 210px; width: 260px">
    <a class="cbp-caption" href="{{route('collections.show', $collection)}}">
        <img class="rounded-circle img-fluid mb-3" style="height: 200px; width: 250px" src="@if($collection->cover_path && file_exists('storage' . '/' . $collection->cover_path)){{asset('storage/' . $collection->cover_path)}} @else{{asset('assets/img/collections/no-collection-image.png')}}@endif" alt="Image Description">
        <div class="py-3 text-center">
            <h4 class="h6 text-dark text-height-2 crop-text-2">{{$collection->title}}</h4>
<span class="font-size-2 text-secondary-gray-700">{{__('collections')['items_count']}} {{$collection->items_count}}</span>
</div>
</a>
</div>
