@props(['author'])

<div class="cbp-item {{substr($author->fullname, 0, 1)}}">
    <a class="cbp-caption" href="{{route('authors.show', $author)}}">

        <div class="py-3 text-center">
            <h4 class="h6 text-dark">{{$author->fullname}}</h4>
            <span class="font-size-2 text-secondary-gray-700">{{$author->items_count}} Items</span>
        </div>
    </a>
</div>
