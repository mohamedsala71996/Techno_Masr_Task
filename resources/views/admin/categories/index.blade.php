@extends('admin.layouts.app')

@section('title', 'Category Management')
@section('styles')
    <style>
        .category-row.level-0 {
            background-color: #f8f9fa;
        }

        .category-row.level-1 {
            background-color: #fff;
            padding-left: 20px;
        }

        .category-row.level-2 {
            background-color: #fefefe;
            padding-left: 40px;
        }

        .category-row:hover {
            background-color: #f1f1f1 !important;
        }
    </style>
@endsection
@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>الاقسام</h5>
                            @can('create categories')
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                                    <i class="fas fa-plus"></i> إضافة قسم جديد
                                </button>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                        <input type="text" id="category-search" class="form-control"
                                            placeholder="ابحث باسم القسم...">
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="categories-table">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="5%">#</th>
                                            <th>الاسم</th>
                                            <th>التسلسل الهرمي</th>
                                            <th width="10%">المستوى</th>
                                            <th width="20%">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody id="categories-tbody">
                                        @foreach ($categories as $category)
                                            @include('admin.categories.partials.category_rows', [
                                                'category' => $category,
                                                'level' => 0,
                                                'parentChain' => [],
                                            ])
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Category Modal -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">إضافة قسم جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="createCategoryForm">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="parent_id" class="form-label">القسم الرئيسي</label>
                            <select class="form-select" id="parent_id" name="parent_id">
                                <option value="">لا يوجد</option>
                                @foreach ($categories as $category)
                                    @if ($category->depth < 2)
                                        {{-- Only allow up to 2 levels deep (making 3 total) --}}
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                            @if ($category->depth == 0)
                                                (رئيسي)
                                            @elseif($category->depth == 1)
                                                (فرعي)
                                            @endif
                                        </option>
                                        @if ($category->children->isNotEmpty())
                                            @foreach ($category->children as $child)
                                                @if ($child->depth < 2)
                                                    <option value="{{ $child->id }}">
                                                        -- {{ $child->name }}
                                                        @if ($child->depth == 1)
                                                            (فرعي)
                                                        @endif
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل قسم</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editCategoryForm">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_category_id" name="id">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">الاسم</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_parent_id" class="form-label">القسم الرئيسي</label>
                            <select class="form-select" id="edit_parent_id" name="parent_id">
                                <option value="">لا يوجد</option>
                                @foreach ($categories as $category)
                                    @if ($category->depth < 2)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                            @if ($category->depth == 0)
                                                (رئيسي)
                                            @elseif($category->depth == 1)
                                                (فرعي)
                                            @endif
                                        </option>
                                        @if ($category->children->isNotEmpty())
                                            @foreach ($category->children as $child)
                                                @if ($child->depth < 2)
                                                    <option value="{{ $child->id }}">
                                                        -- {{ $child->name }}
                                                        @if ($child->depth == 1)
                                                            (فرعي)
                                                        @endif
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">تحديث</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Create category
            $('#createCategoryForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.categories.store') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#createCategoryModal').modal('hide');
                        $('#createCategoryForm')[0].reset();
                        refreshCategoryTable();
                        refreshCategoryDropdowns(); // Add this line
                        toastr.success(response.message);
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            });

            // Edit category - open modal
            $(document).on('click', '.edit-btn', function() {
                var categoryId = $(this).data('id');
                $.ajax({
                    url: "categories/" + categoryId + "/edit",
                    method: 'GET',
                    success: function(response) {
                        $('#edit_category_id').val(response.id);
                        $('#edit_name').val(response.name);
                        $('#edit_parent_id').val(response.parent_id);
                        $('#editCategoryModal').modal('show');
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            });

            // Update category
            $('#editCategoryForm').submit(function(e) {
                e.preventDefault();
                var categoryId = $('#edit_category_id').val();
                $.ajax({
                    url: "categories/" + categoryId,
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editCategoryModal').modal('hide');
                        refreshCategoryTable();
                        refreshCategoryDropdowns(); // Add this line
                        toastr.success(response.message);
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            });


            // Realtime filter for category search
            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }
            const searchInput = document.getElementById('category-search');
            const tbody = document.getElementById('categories-tbody');
            if (searchInput && tbody) {
                searchInput.addEventListener('input', debounce(function() {
                    const search = searchInput.value;
                    $.ajax({
                        url: "{{ route('admin.categories.table') }}",
                        method: 'GET',
                        data: {
                            search
                        },
                        success: function(response) {
                            $(tbody).html(response);
                        },
                        error: function(xhr) {
                            toastr.error('خطأ في البحث');
                        }
                    });
                }, 300));
            }

            // Refresh category table after CRUD operations
            function refreshCategoryTable() {
                $.ajax({
                    url: "{{ route('admin.categories.table') }}",
                    method: 'GET',
                    success: function(response) {
                        // Only replace the rows, not the entire tbody
                        var $newRows = $(response);
                        var $tbody = $('#categories-table tbody');

                        // Remove existing rows
                        $tbody.find('tr').remove();

                        // Add new rows with proper animation
                        $newRows.hide().appendTo($tbody).fadeIn(300);

                        // Reinitialize any plugins if needed
                        $('[data-bs-toggle="tooltip"]').tooltip();
                    },
                    error: function(xhr) {
                        console.error('Refresh error:', xhr.responseText);
                        toastr.error('Error refreshing table');
                    }
                });
            }
        });

        // New function to refresh dropdown options
        function refreshCategoryDropdowns() {
            $.ajax({
                url: "{{ route('admin.categories.options') }}", // You'll need to create this route
                method: 'GET',
                success: function(optionsHtml) {
                    // Update both create and edit modal dropdowns
                    $('#parent_id, #edit_parent_id').html(optionsHtml);
                },
                error: function(xhr) {
                    console.error('Dropdown refresh error:', xhr.responseText);
                }
            });
        }
    </script>
    @include('admin.layouts.partials.delete')
@endsection
