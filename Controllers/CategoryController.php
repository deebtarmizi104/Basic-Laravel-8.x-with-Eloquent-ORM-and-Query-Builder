<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCat(){
       //BELOW IS QUERY BUILDER METHOD WITH JOINING TABLES
      // $categories = DB::table('categories') //FROM TABLE CATEGORIES
      //   ->join('users', 'categories.user_id', 'users.id') //JOIN USERS TABLE USING USER_ID IN CATEGORIES AND ID IN USER
      //   ->select('categories.*', 'users.name' ) //SELECT ALL FROM  CATEGORIES AND NAME FROM USERS TABLE TO DISPLAY
      //   ->latest()->paginate(5);

      $categories = Category::latest()->paginate(5);     //ELOQUENT ORM METHOD
      // $categories = DB::table('categories')->latest()->paginate(5 );     //QUERY BUILDER METHOD WITHOUT JOINING TABLES

      $categories = Category::latest()->paginate(5);
      $trashCat = Category::onlyTrashed()->latest()->paginate(3);       //EO TEMPORARY DELETE AND SAVE IN TRASH

      return view('admin.category.index', compact('categories', 'trashCat'));
    }

    public function AddCat(Request $request){
      $validatedData = $request->validate([
        'category_name' => 'required|unique:categories|max:255',
      ],
      [
        'category_name.required' => 'Please input category name',
      ]);

      // ELOQUENT ORM METHOD BELOW  TO POST DATA

      Category::insert([
        'category_name' => $request->category_name,
        'user_id' => Auth::user()->id,
        'created_at' => Carbon::now()
      ]);

      // $category = new Category;
      // $category-> category_name = $request-> category_name;
      // $category-> user_id = Auth::user()-> id;
      // $category-> save();

      // QUERY BUILDER METHOD BELOW TO POST DATA

      // $data = array();
      // $data['category_name'] = $request->category_name;
      // $data['user_id'] = Auth::user()->id;
      // DB::table('categories')->insert($data);

      return redirect()->back()->with('success', 'Category Inserted Successfully');
    }


    public function Edit($id){
      $categories = Category::find($id);     //ELOQUENT ORM METHOD

      // $categories = DB::table('categories')->where('id', $id)->first();
      // SELECT DB TABLE WHICH TABLE TO EDIT
      // WHERE ID IS EQUAL TO THE REQUESTED ID
      // COLLECT FIRST DATA

      return view('admin.category.edit', compact('categories'));
    }

    public function Update(Request $request, $id){
      //BELOW IS THE ELOQUENT ORM METHOD
      $update = Category::find($id)->update([
        'category_name' => $request->category_name,
        'user_id' => Auth::user()->id
      ]);

      //BELOW IS THE QUERY BUILDER method
      // $data = array();
      // $data['category_name'] = $request->category_name;
      // $data['user_id'] = Auth::user->id;
      // DB::table('categories')->where('id', $id)->update($data);

      return redirect()->route('all.category')->with('success', 'Category Update Successfully');
    }

    public function SoftDelete($id){
      //EO METHOD
      $delete = Category::find($id)->delete();

      return redirect()->back()->with('success', 'Category Soft Delete Successfully');
    }


  public function Restore($id){
      $delete = Category::withTrashed()->find($id)->restore();
      return Redirect()->back()->with('success','Category Restore Successfully');

  }

 public function Pdelete($id){
     $delete = Category::onlyTrashed()->find($id)->forceDelete();
     return Redirect()->back()->with('success','Category Permanently Deleted');
 }

}
