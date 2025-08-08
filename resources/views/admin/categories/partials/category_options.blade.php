<option value="">لا يوجد</option>
@foreach($categories as $category)
    @if($category->depth < 2 && $category->id != $currentId)
        <option value="{{ $category->id }}">
            {{ $category->name }}
            @if($category->depth == 0)
                (رئيسي)
            @elseif($category->depth == 1)
                (فرعي)
            @endif
        </option>
        @if($category->children->isNotEmpty())
            @foreach($category->children as $child)
                @if($child->depth < 2 && $child->id != $currentId)
                    <option value="{{ $child->id }}">
                        -- {{ $child->name }}
                        @if($child->depth == 1)
                            (فرعي)
                        @endif
                    </option>
                @endif
            @endforeach
        @endif
    @endif
@endforeach