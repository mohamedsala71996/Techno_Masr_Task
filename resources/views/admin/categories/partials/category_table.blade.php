@foreach($categories as $category)
    @include('admin.categories.partials.category_rows', [
        'category' => $category,
        'level' => 0,
        'parentChain' => []
    ])
@endforeach