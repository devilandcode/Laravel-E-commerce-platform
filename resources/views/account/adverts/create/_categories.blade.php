<ul>
    @foreach($categories as $category)
        <li>
            <a href="{{ route('account.adverts.create.region', $category) }}">{{ $category->name }}</a>
            @include('account.adverts.create._categories', ['categories' => $category->children])
        </li>
    @endforeach
</ul>
