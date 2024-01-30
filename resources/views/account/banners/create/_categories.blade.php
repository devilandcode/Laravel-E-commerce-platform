<ul>
    @foreach($categories as $category)
        <li>
            <a href="{{ route('account.banners.create.region', $category) }}">{{ $category->name }}</a>
            @include('account.banners.create._categories', ['categories' => $category->children])
        </li>
    @endforeach
</ul>
