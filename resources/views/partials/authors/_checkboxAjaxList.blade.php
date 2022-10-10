<ul id="authors_list" class="wc_payment_methods payment_methods methods">
    <fieldset>
        @forelse($data as $author)
        <li class="wc_payment_method payment_method_bacs">
            <input id="{{$author->fullname}}" type="checkbox" name="authors_id[]" value="{{$author->id}}">
            <label for="{{$author->fullname}}">{{$author->fullname}}</label>
        </li>
        @empty
            {{__('no results')}}
        @endforelse
    </fieldset>
</ul>

{{ $data->links('vendor.pagination.simple-bootstrap-4') }}
