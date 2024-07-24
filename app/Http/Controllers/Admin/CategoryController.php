<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Admin\Traits\HasCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller{
    use HasCategory;

    /**
     * Show the categories page 
     *
     * @return void
     */
    public function index(){
        $categories = Category::paginate(10);

        return view('admin.frontend.categories.index' , compact('categories'));
    }
  
    /**
     * Add a new category
     *
     * @return void
     */
    public function storage(Request $request){
        $validator = $this->validateAddForm($request);
        
        $this->doStore($validator);

        return back()->with('simpleSuccessAlert' , 'New product added successfully');
    }

    /**
     * Show edit category form 
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function edit(Category $category){
        return view('admin.frontend.categories.edit' , compact('category'));
    }
    
    /**
     * Update a category 
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function update(Category $category , Request $request){
        $validator = $this->validateUpdateForm($request);

        $this->doUpdate($category , $validator);

        return redirect()->route('admin.categories.index')->with('simpleSuccessAlert' , 'Update category successfully');
    }

    /**
     * Destroy a category
     *
     * @return void
     */ 
    public function destroy(Category $category){
        $category->delete();

        return back()->with('simpleSuccessAlert' , 'Remove category successfully');
    }

    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $categories = Category::all();

    //         // If using DataTables for server-side processing
    //         return DataTables::of($categories)
    //             ->addColumn('action', function ($row) {
    //                 $editUrl = route('admin.categories.edit', $row->id);
    //                 $deleteUrl = route('admin.categories.destroy', $row->id);
    //                 return '
    //                     <a href="' . $editUrl . '" class="btn btn-primary" title="Edit">
    //                         <i class="fa fa-pencil" aria-hidden="true"></i>
    //                     </a>
    //                     <form action="' . $deleteUrl . '" method="POST" style="display:inline;" class="delete-form">
    //                         ' . csrf_field() . '
    //                         ' . method_field('DELETE') . '
    //                         <button type="submit" class="btn btn-danger" title="Delete">
    //                             <i class="fa fa-trash" aria-hidden="true"></i>
    //                         </button>
    //                     </form>';
    //             })
    //             ->rawColumns(['action']) // Allow HTML in action column
    //             ->make(true);
    //     }

    //     // Non-AJAX request (standard view rendering)
    //     $categories = Category::paginate(10);
    //     return view('admin.categories.index', compact('categories'));
    // }
}