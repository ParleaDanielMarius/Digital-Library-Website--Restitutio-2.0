<ul class="wc_payment_methods payment_methods methods">
    <fieldset>
        @forelse($data as $author)
        <li class="wc_payment_method payment_method_bacs">
            <input id="authors_id" type="checkbox" name="{{$author->fullname}}" value="{{$author->id}}">
            <label for="authors_id">{{$author->fullname}}</label>
        </li>
        @empty
            {{__('no results')}}
        @endforelse
    </fieldset>
    {!! $data->links() !!}
</ul>
