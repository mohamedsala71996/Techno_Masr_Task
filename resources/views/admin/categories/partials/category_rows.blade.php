<tr class="category-row level-{{ $level }}">
    <td>{{ $category->id }}</td>
    <td>
        @if($level == 0)
            <strong class="text-primary">{{ $category->name }}</strong>
        @elseif($level == 1)
            <span class="text-success">↳ {{ $category->name }}</span>
        @else
            <span class="text-muted">↳ ↳ {{ $category->name }}</span>
        @endif
    </td>
    <td>
        @if($level == 0)
            <span class="badge bg-primary">قسم رئيسي</span>
        @else
            @foreach($parentChain as $parent)
                @if(!$loop->first)
                    <i class="fas fa-arrow-left mx-1 text-muted"></i>
                @endif
                <span class="{{ $loop->last ? 'fw-bold' : '' }}">
                    {{ $parent->name }}
                </span>
            @endforeach
        @endif
    </td>
    <td>
        <span class="badge bg-{{ ['info', 'warning', 'danger'][$level] ?? 'secondary' }}">
            المستوى {{ $level + 1 }}
        </span>
    </td>
    <td>
        @can('edit categories')
        <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $category->id }}">
            <i class="fas fa-edit"></i> تعديل
        </button>
        @endcan
        @can('delete categories')
        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger delete-btn">
                <i class="fas fa-trash"></i> حذف
            </button>
        </form>
        @endcan
    </td>
</tr>

@if($category->children->isNotEmpty() && $level < 2)
    @foreach($category->children as $child)
        @include('admin.categories.partials.category_rows', [
            'category' => $child,
            'level' => $level + 1,
            'parentChain' => array_merge($parentChain, [$category])
        ])
    @endforeach
@endif