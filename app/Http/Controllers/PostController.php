<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // redirect add item
    public function addItem(){
        $category = Category::get();
        return view('admin.post.addItem',compact('category'));
    }

    // add item
    public function addNewItem(Request $request){
        $this->addItemValidationCheck($request);

        if(!empty($request->itemImage)){

            $file = $request->file('itemImage');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/postImage',$fileName);
            $data = $this->getNewItemData($request,$fileName);
        }
        else{
            $data = $this->getNewItemData($request,null);
        }
        Post::create($data);
        return back()->with(['addSuccess' => 'Item added successful...']);
    }

    // edit item page
    public function editItemPage($id){
        $category = Category::get();
        $data = Post::where('id',$id)->first();
        return view('admin.post.editPage',compact('data','category'));
    }

    // update item
    public function updateItem(Request $request){
        $this->addItemValidationCheck($request);
        $data = $this->getUpdateItemData($request);

        if(isset($request->itemImage)){
            $file = $request->file('itemImage');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path().'/postImage',$fileName);

            $dbData = Post::where('id',$request->itemId)->first();
            $dbImage = $dbData->image;

            if(File::exists(public_path().'/postImage/'.$dbImage)){
                File::delete(public_path().'/postImage/'.$dbImage);
            }

            $data = ['image' => $fileName];
            Post::where('id',$request->itemId)->update($data);
        }else{
            Post::where('id',$request->itemId)->update($data);
        }
        return back()->with(['updateSuccess' => 'Item updated success...']);
    }

    // delete item
    public function deleteItem($id){
        $dbData = Post::where('id',$id)->first();
        $dbImage = $dbData->image;

        if(File::exists(public_path().'/postImage/'.$dbImage)){
            File::delete(public_path().'/postImage/'.$dbImage);
        }
        Post::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Item deleted successful...']);
    }

    // item change status
    public function itemChangeStatus(Request $request){
        Post::where('id',$request->itemId)->update([
            'publish' => $request->status
        ]);
    }



    // get new item data
    private function getNewItemData($request,$fileName){
        return [
            'name' => $request->itemName,
            'category_id' => $request->itemCategory,
            'price' => $request->itemPrice,
            'description' => $request->itemDescription,
            'image' => $fileName,
            'condition' => $request->itemCondition,
            'publish' => $request->itemStatus,
            'owner_name' => $request->ownerName,
            'owner_phone' => $request->ownerPhone,
            'owner_address' => $request->ownerAddress

        ];
    }

    // add item validation check
    private function addItemValidationCheck($request){
        return Validator::make($request->all(),[
            'itemName' => 'required',
            'itemCategory' => 'required',
            'itemPrice' => 'required',
            'itemDescription' => 'required',
            'itemCondition' => 'required',
            'ownerName' => 'required',
            'ownerPhone' => 'required',
            'ownerAddress' => 'required'
        ])->validate();
    }

    // get update item data
    private function getUpdateItemData($request){
        return [
            'name' => $request->itemName,
            'category_id' => $request->itemCategory,
            'price' => $request->itemPrice,
            'description' => $request->itemDescription,
            'condition' => $request->itemCondition,
            'publish' => $request->itemStatus,
            'owner_name' => $request->ownerName,
            'owner_phone' => $request->ownerPhone,
            'owner_address' => $request->ownerAddress
        ];
    }
}
