<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // redirect dashboard
    public function dashboard(){
        $data = Post::select('posts.*','categories.category_name')
                ->leftJoin('categories','categories.id','posts.category_id')
                ->when(request('key'),function($query){
                    $query->where('name','LIKE','%'.request('key').'%');
                })
                ->get();
        return view('admin.post.index',compact('data'));
    }

    // redirect profile page
    public function profile(){
        $data = User::where('id',Auth::user()->id)->first();
        return view('admin.profile.profilePage',compact('data'));
    }

    // update profile
    public function updateProfile(Request $request){
        $this->updateProfileValidationCheck($request);
        $data = $this->updateProfileData($request);
        User::where('id',Auth::user()->id)->update($data);
        return back()->with(['updateSuccess' => 'Your profile was updated']);
    }








    // update profile validation check
    private function updateProfileValidationCheck($request){
        return Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
        ])->validate();
    }

    // update profile data
    private function updateProfileData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender
        ];
    }
}
