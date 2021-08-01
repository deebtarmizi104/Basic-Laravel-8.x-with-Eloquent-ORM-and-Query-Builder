<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Slider;
use Image;
use Auth;


class HomeController extends Controller
{
    public function HomeSlider(){
      $sliders = Slider::latest()->get();

      return view('admin.slider.index', compact('sliders'));
    }

    public function AddSlider(){
      return view('admin.slider.create');
    }

    public function StoreSlider(Request $request){
      $slider_image = $request->file('image');

      //BELOW IS CODE WITH IMAGE INTERVENTION
      $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();      //get image extension with generated name
      Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);     //create image intervention

      $last_img = 'image/slider/'.$name_gen;

      //BELOW IS THE ELOQUENT ORM METHOD
      Slider::insert([
        'title' => $request->title,
        'description' => $request->description,
        'image' => $last_img,
        'created_at' => Carbon::now(),
      ]);

      return redirect()->route('home.slider')->with('success', 'Slider Insert Successfully');
    }
}
