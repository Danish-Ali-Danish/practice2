@foreach($categories as $category)
    <a href="{{ route('allproducts', ['category' => $category->slug]) }}"
       class="filter-chip">{{ $category->name }}</a>
@endforeach
