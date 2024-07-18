<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Admin\Traits\HasCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use HasCategory;

    /**
     * Show the categories page 
     *
     * @return void
     */
    public function index()
    {
        $categories = Category::paginate(10);

        return view('admin.frontend.categories.index', compact('categories'));
    }

    /**
     * Add a new category
     *
     * @return void
     */
    public function storage(Request $request)
    {
        $validator = $this->validateAddForm($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $this->doStore($validator->validated());

        return back()->with('simpleSuccessAlert', 'New product added successfully');
    }

    /**
     * Show edit category form 
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function edit(Category $category)
    {
        return view('admin.frontend.categories.edit', compact('category'));
    }

    /**
     * Update a category 
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function update(Request $request, Category $category)
    {
        $validator = $this->validateUpdateForm($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $this->doUpdate($category, $validator->validated());

        return redirect()->route('admin.categories.index')->with('simpleSuccessAlert', 'Update category successfully');
    }

    /**
     * Destroy a category
     *
     * @return void
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('simpleSuccessAlert', 'Remove category successfully');
    }

    /**
     * Validate form data for adding a new category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateAddForm(Request $request)
    {
        return Validator::make($request->all(), [
            'slug' => 'required|string|min:3',
            'title' => 'required|string|min:3',
        ],
    );
    }

    /**
     * Validate form data for updating an existing category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateUpdateForm(Request $request)
    {
        return Validator::make($request->all(), [
            'slug' => 'required|string|min:3',
            'title' => 'required|string|min:3',
        ],
    );
    }
}