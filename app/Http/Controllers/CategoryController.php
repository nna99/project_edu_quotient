<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // redirect category page
    public function categoryPage(){
        $data = Category::when(request('key'),function($query){
            $query->where('category_name','LIKE','%'.request('key').'%');
        })
        ->get();
        return view('admin.category.index',compact('data'));
    }

    // category add page
    public function categoryAddPage(){
        return view('admin.category.addCategory');
    }

    // add category
    public function addCategory(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->addCategoryData($request);
        Category::create($data);
        return back()->with(['addSuccess' => 'Category added success...']);
    }

    // delete category
    public function deleteCategory($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Category deleted success...']);
    }

    // category edit page
    public function categoryEditPage($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.editPage',compact('category'));
    }

    // category update
    public function categoryUpdate(Request $request){
        $this->categoryValidationCheck($request);

        Category::where('id',$request->category_id)->update([
            'category_name' => $request->categoryName,
            'category_status' => $request->categoryStatus
        ]);
        return redirect()->route('category')->with(['updateSuccess' => 'Category updated success...']);
    }

    // category change status
    public function categoryChangeStatus(Request $request){
        Category::where('id',$request->categoryId)->update([
            'category_status' => $request->status
        ]);
    }






    // get category data
    private function addCategoryData($request){
        return [
            'category_name' => $request->categoryName,
            'category_status' => $request->categoryStatus,
        ];
    }

    // category validation check
    private function categoryValidationCheck($request){
        return Validator::make($request->all(),[
            'categoryName' => 'required',
        ])->validate();
    }
}
