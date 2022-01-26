<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use Image;
use Session;

class BannerController extends Controller
{
    //

    public function addBanner(Request $request){

        $banner = Banner::find(2);
        if($request->isMethod('post')){

            if($banner){
                $old_slider1 = $banner->slider1;
                $slider1_filename = '';
                //Slider2
                $old_slider2 = $banner->slider2;
                $slider2_filename = '';
                //Slider3
                $old_slider3 = $banner->slider3;
                $slider3_filename = '';
    
                //Banner1
                $old_banner1 = $banner->banner1;
                $banner1_filename = '';
    
                //Banner2
                $old_banner2 = $banner->banner2;
                $banner2_filename = '';
    
                //Banner2
                $old_banner3 = $banner->banner3;
                $banner3_filename = '';
            }
            //Slider1
            




            //Banners
            $banner->topic1 = $request->topic1;
            $banner->body1 = $request->body1;

            $banner->topic2 = $request->topic2;
            $banner->body2 = $request->body2;

            $banner->topic3 = $request->topic3;
            $banner->body3 = $request->body3;


            //Upload Slider1
            if ($request->hasFile('slider1')) {

                $img_temp = $request->file('slider1');
                if ($img_temp->isValid()) {

                    $extension = $img_temp->getClientOriginalExtension();
                    $slider1_filename = 'alvinsmakeup' . rand(111, 9999) . '.' . $extension;
                    $image_path = 'images/backend/banners/' . $slider1_filename;



                    //Resize Images

                    //Image::make($img_temp)->save($image_path);
                    Image::make($img_temp)->resize(1920, 692 , function ($constraint){
                        $constraint->aspectRatio();
                    })->save($image_path);


                    //Delete
                    $image_src = 'images/backend/banners/';


                    //Delete
                    if (file_exists($image_src . $old_slider1)) {
                        unlink($image_src . $old_slider1);
                    }


                    //Store Images
                    $banner->slider1 = $slider1_filename;

                }
            } else {
             $slider1_filename = $old_slider1;
            }

            //Upload Slider2
            if ($request->hasFile('slider2')) {

                $img_temp = $request->file('slider2');
                if ($img_temp->isValid()) {

                    $extension = $img_temp->getClientOriginalExtension();
                    $slider2_filename = 'alvinsmakeup' . rand(111, 9999) . '.' . $extension;
                    $image_path = 'images/backend/banners/' . $slider2_filename;



                    //Resize Images

                    //Image::make($img_temp)->save($image_path);
                    Image::make($img_temp)->resize(1920, 692 , function ($constraint){
                        $constraint->aspectRatio();
                    })->save($image_path);




                    //Delete
                    $image_src = 'images/backend/banners/';



                    //Delete
                    if (file_exists($image_src . $old_slider2)) {
                        unlink($image_src . $old_slider2);
                    }


                    //Store Images
                    $banner->slider2 = $slider2_filename;

                }
            } else {
                $slider2_filename = $old_slider2;
            }

            //Upload Slider 3
            if ($request->hasFile('slider3')) {

                $img_temp = $request->file('slider3');
                if ($img_temp->isValid()) {

                    $extension = $img_temp->getClientOriginalExtension();
                    $slider3_filename = 'alvinsmakeup' . rand(111, 9999) . '.' . $extension;
                    $image_path = 'images/backend/banners/' . $slider3_filename;



                    //Resize Images

                    Image::make($img_temp)->resize(1920, 692 , function ($constraint){
                        $constraint->aspectRatio();
                    })->save($image_path);



                    //Delete
                    $image_src = 'images/backend/banners/';



                    //Delete
                    if (file_exists($image_src . $old_slider3)) {
                        unlink($image_src . $old_slider3);
                    }


                    //Store Images
                    $banner->slider3 = $slider3_filename;

                }
            } else {
                $slider3_filename = $old_slider3;
            }

            //Upload Banner 1
            if ($request->hasFile('banner1')) {

                $img_temp = $request->file('banner1');
                if ($img_temp->isValid()) {

                    $extension = $img_temp->getClientOriginalExtension();
                    $banner1_filename = 'alvinsmakeup' . rand(111, 9999) . '.' . $extension;
                    $image_path = 'images/backend/banners/' . $banner1_filename;

                    //Resize Images
                    //Image::make($img_temp)->save($image_path);

                    Image::make($img_temp)->resize(377, 230 , function ($constraint){
                        $constraint->aspectRatio();
                    })->save($image_path);

                    //Delete
                    $image_src = 'images/backend/banners/';




                    //Delete
                    if (file_exists($image_src . $banner1_filename)) {
                        unlink($image_src . $old_banner1);
                    }


                    //Store Images
                    $banner->banner1 = $banner1_filename;

                }
            } else {
                $banner1_filename = $old_banner1;
            }

            //Upload Banner 2
            if ($request->hasFile('banner2')) {

                $img_temp = $request->file('banner2');
                if ($img_temp->isValid()) {

                    $extension = $img_temp->getClientOriginalExtension();
                    $banner2_filename = 'alvinsmakeup' . rand(111, 9999) . '.' . $extension;
                    $image_path = 'images/backend/banners/' . $banner2_filename;

                    //Resize Images
                    //Image::make($img_temp)->save($image_path);

                    Image::make($img_temp)->resize(377, 230 , function ($constraint){
                        $constraint->aspectRatio();
                    })->save($image_path);

                    //Delete
                    $image_src = 'images/backend/banners/';



                    //Delete
                    if (file_exists($image_src . $banner2_filename)) {
                        unlink($image_src . $old_banner2);
                    }

                    //Store Images
                    $banner->banner2 = $banner2_filename;
                }
            } else {
                $banner2_filename = $old_banner2;
            }

            //Upload Banner 3
            if ($request->hasFile('banner3')) {

                $img_temp = $request->file('banner3');
                if ($img_temp->isValid()) {

                    $extension = $img_temp->getClientOriginalExtension();
                    $banner3_filename = 'alvinsmakeup' . rand(111, 9999) . '.' . $extension;
                    $image_path = 'images/backend/banners/' . $banner3_filename;

                    //Resize Images
                    //Image::make($img_temp)->save($image_path);

                    Image::make($img_temp)->resize(377, 230 , function ($constraint){
                        $constraint->aspectRatio();
                    })->save($image_path);


                    //Delete
                    $image_src = 'images/backend/banners/';



                    //Delete
                    if (file_exists($image_src . $banner3_filename)) {
                        unlink($image_src . $old_banner3);
                    }

                    //Store Images
                    $banner->banner3 = $banner3_filename;
                }
            } else {
                $banner3_filename = $old_banner3;
            }




            $banner->slider1 = $slider1_filename;
            $banner->slider2 = $slider2_filename;
            $banner->slider3 = $slider3_filename;
            $banner->banner1 = $banner1_filename;
            $banner->banner2 = $banner2_filename;
            $banner->banner3 = $banner3_filename;


            $banner->save();
            Session::flash('success', 'Updated Successfully!');
            return redirect()->route('banners');


        }







        return view('backend.banners.add_banners')->with(compact('banner'));
    }
}
