<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CategoryController extends BaseController
{
    public function __construct()
    {
        $this->middleware('permission:view categories')->only('index');
        $this->middleware('permission:create categories')->only('create', 'store');
        $this->middleware('permission:edit categories')->only('edit', 'update');
        $this->middleware('permission:delete categories')->only('destroy');
    }
    public function index()
    {
        $categories = Category::with(['children' => function ($query) {
            $query->with(['children' => function ($query) {
                $query->with('children'); // Load up to 3 levels
            }]);
        }])->whereNull('parent_id')->get();

        // Add depth to each category
        $categories->each(function ($category) {
            $this->calculateDepth($category);
        });

        return view('admin.categories.index', compact('categories'));
    }

    public function table(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::with(['children' => function ($query) {
            $query->with(['children' => function ($query) {
                $query->with('children');
            }]);
        }])->whereNull('parent_id')
        ->when($search, function($q) use ($search) {
            $q->where('name', 'like', "%$search%")
              ->orWhereHas('children', function($q2) use ($search) {
                  $q2->where('name', 'like', "%$search%")
                     ->orWhereHas('children', function($q3) use ($search) {
                         $q3->where('name', 'like', "%$search%") ;
                     });
              });
        })->get();

        $categories->each(function ($category) {
            $this->calculateDepth($category);
        });

        return view('admin.categories.partials.category_table', [
            'categories' => $categories
        ])->render();
    }

    public function options(Request $request)
    {
        $currentId = $request->input('current_id', null);

        $categories = Category::with(['children' => function ($query) {
            $query->with(['children' => function ($query) {
                $query->with('children');
            }]);
        }])->whereNull('parent_id')->get();

        $categories->each(function ($category) {
            $this->calculateDepth($category);
        });

        return view('admin.categories.partials.category_options', [
            'categories' => $categories,
            'currentId' => $currentId
        ])->render();
    }

    public function store(CategoryRequest $request)
    {
        // Check if adding this category would exceed 3 levels
        if ($request->parent_id) {
            $parent = Category::find($request->parent_id);
            if ($parent->depth >= 2) {
                return response()->json(['message' => 'Cannot add category. Maximum depth of 3 levels reached.'], 422);
            }
        }

        $category = Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id
        ]);

        return response()->json(['message' => 'تم اضافة القسم بنجاح!']);
    }

    public function edit(Category $category)
    {
        return response()->json($category);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        // Prevent circular references
        if ($request->parent_id == $category->id) {
            return response()->json(['message' => 'لا يمكن اضافة القسم الى نفسه.'], 422);
        }

        // Check if new parent would create a cycle
        if ($this->wouldCreateCycle($category, $request->parent_id)) {
            return response()->json(['message' => 'لا يمكن هذا الربط.'], 422);
        }

        // Check depth limit
        if ($request->parent_id) {
            $parent = Category::find($request->parent_id);
            if ($parent->depth >= 2 && $category->children->isNotEmpty()) {
                return response()->json(['message' => 'لا يمكن نقل القسم. ارتفاع القسم 3 مستويات.'], 422);
            }
        }

        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id
        ]);

        return response()->json(['message' => 'تم تعديل القسم بنجاح!']);
    }

    public function destroy(Category $category)
    {
        // Delete all children recursively
        $this->deleteChildren($category);
        $category->delete();

        return response()->json(['success' => true, 'message' => 'تم حذف القسم بنجاح!']);
    }

    private function deleteChildren(Category $category)
    {
        foreach ($category->children as $child) {
            $this->deleteChildren($child);
            $child->delete();
        }
    }

    private function calculateDepth(Category $category, $depth = 0)
    {
        $category->depth = $depth;
        foreach ($category->children as $child) {
            $this->calculateDepth($child, $depth + 1);
        }
    }

    private function wouldCreateCycle(Category $category, $newParentId)
    {
        if (!$newParentId) return false;

        $parent = Category::find($newParentId);
        while ($parent) {
            if ($parent->id == $category->id) {
                return true;
            }
            $parent = $parent->parent;
        }

        return false;
    }
}
