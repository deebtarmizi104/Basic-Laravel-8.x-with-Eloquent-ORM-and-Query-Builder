<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Support\Carbon;
use Image;        //when using image intervention package

class BrandController extends Controller
{
    public function AllBrand(){

      $brands = Brand::latest()->paginate(5);

      return view('admin.brand.index', compact('brands'));
    }

    public function StoreBrand(Request $request){
      $validateData = $request->validate([
        'brand_name' => 'required|unique:brands|min:4',
        // 'brand_image' => 'required|mimes:jpg.jpeg, png',
        'brand_image' => 'required|image|file',
      ],
      [
        'brand_name.required' => 'Please Insert Brand Name',
        'brand_name.min' => 'Brand Name Should Not be Longer than 10 Characters',
      ]);

      $brand_image = $request->file('brand_image');

      //BELOW IS WITHOUT IMAGE INTERVENTION
      // $name_gen = hexdec(uniqid());   //create auto generated id
      // $img_ext =  strtolower($brand_image->getClientOriginalExtension());   //get image extension correctly
      // $img_name = $name_gen.'.'.$img_ext;     //image name = generated name concat img extension
      // $up_location = 'image/brand/';     //upload location
      // $last_img = $up_location.$img_name;   //save image
      // $brand_image->move($up_location, $img_name);

      //BELOW IS CODE WITH IMAGE INTERVENTION
      $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();      //get image extension with generated name
      Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);     //create image intervention

      $last_img = 'image/brand/'.$name_gen;

      //BELOW IS THE ELOQUENT ORM METHOD
      Brand::insert([
        'brand_name' => $request->brand_name,
        'brand_image' => $last_img,
        'created_at' => Carbon::now(),
      ]);

      return redirect()->back()->with('success', 'Brand Insert Successfully');
    }

    public function EditBrand($id){
      $brands = Brand::find($id);

      return view('admin.brand.edit', compact('brands'));
    }

    public function UpdateBrand(Request $request, $id){
      $validateData = $request->validate([
        'brand_name' => 'required|min:4',
      ],
      [
        'brand_name.required' => 'Please Insert Brand Name',
        'brand_name.min' => 'Brand Name Should Not be Longer than 10 Characters',
      ]);

      $old_img = $request->old_img;   //retrieve old image

      $brand_image = $request->file('brand_image');

      if($brand_image){       //if have images, should update image
        $name_gen = hexdec(uniqid());   //create auto generated id
        $img_ext =  strtolower($brand_image->getClientOriginalExtension());   //get image extension correctly
        $img_name = $name_gen.'.'.$img_ext;     //image name = generated name concat img extension
        $up_location = 'image/brand/';     //upload location
        $last_img = $up_location.$img_name;   //save image
        $brand_image->move($up_location, $img_name);

        unlink($old_img);    //unlink olg img with the img link in the location

        //BELOW IS THE ELOQUENT ORM METHOD
        Brand::find($id)->update([                    //find the img with the id and update img
          'brand_name' => $request->brand_name,
          'brand_image' => $last_img,
          'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Brand Updated Successfully');
      }else{    //else update without image
        Brand::find($id)->update([                    //find the img with the id and update img
          'brand_name' => $request->brand_name,
          'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Brand Updated Successfully');
      }
    }

    public function DeleteBrand($id){

      $image = Brand::find($id);
      $old_img = $image->brand_image;
      unlink($old_img);             //unlink the image so it can be deleted from the location as well

      Brand::find($id)->delete();

      return redirect()->back()->with('success', 'Brand Deleted Successfully');
    }


    ////THIS FUNCTIONS IS FOR MULTI IMAGES METHODS

    public function MultiImage(){

      $images = Multipic::all();                    //images = model_name to get all data

      return view('admin.multipic.index', compact('images'));
    }

    public function StoreImage(Request $request){
      $image = $request->file('image');

      foreach ($image as $multi_img){
        //BELOW IS CODE WITH IMAGE INTERVENTION
        $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();      //get image extension with generated name
        Image::make($multi_img)->resize(300,200)->save('image/multi/'.$name_gen);     //create image intervention

        $last_img = 'image/multi/'.$name_gen;

        //BELOW IS THE ELOQUENT ORM METHOD
        Multipic::insert([
          'image' => $last_img,
          'created_at' => Carbon::now(),
        ]);

      } //end of for loop

      return redirect()->back()->with('success', 'Images Insert Successfully');
    }
}
