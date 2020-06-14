<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Brand;
use Session;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    //

    public function addBrand(Request $request){

        if($request->isMethod('post')){

            $status = "";
            $data = $request->all();
            if(empty($request->status)){
                $status = 0;
            }else{
                $status = 1;
            }



            $brand = new Brand;
            $brand->name = $data['name'];
            if(empty($data['description'])){
                $brand->description = "";
            }else{
                $brand->description = $data['description'];
            }

            if(empty($data['keywords'])){
                $brand->keywords = "";
            }else{
                $brand->keywords = $data['keywords'];
            }

            $brand->url = $this->createSlug($data['name']);
            $brand->status = $status;
            $brand->save();

            Session::flash('success','The Brand has been successfully created!');
            return redirect()->route('brands');
        }

    }


    public function index(){
        $brands = Brand::orderBy('id','desc')->paginate(10);
        return view('backend.brands.index')->with(compact('brands'));
    }

    public function editBrand(Request $request,$id){

        $brand = Brand::find($id);

        $this->validate($request,[
            'name'=>'required',
        ]);


        $brand->name = $request->name;
        if(empty($request->description)){
            $brand->description = "";
        }else{
            $brand->description = $request->description;
        }

        if(empty($request->keywords)){
            $brand->keywords = "";
        }else{
            $brand->keywords = $request->keywords;
        }

        if(empty($request->status)){
            $status = 0;
        }else{
            $status = 1;
        }


        $brand->url = $this->createSlug($brand->name,$brand->id);
        $brand->status = $status;
        $brand->save();
        Session::flash('success','Brand details edited successfully!');
        return redirect()->route('brands');


    }


    public function deleteBrand($id){

        $brand = Brand::find($id);
        $brand->delete();
        Session::flash('deleted','Brand Deleted Successfully');
        return redirect()->route('brands');
    }


    public function showProducts($url){

        $brand = Brand::where('url',$url)->first();


            $products = Product::where('brand_id',$brand->id)->orderBy('id','desc')->paginate(10);
            $status = '"'.$brand->name.'" Brand';

        return view('backend.brands.resources')->with(compact('products','status'));

    }





//Slug Function
    public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = Str::slug($title);
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Brand::select('url')->where('url', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }



}
