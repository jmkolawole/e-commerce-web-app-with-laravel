<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Category;
use Session;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //

    public function addCategory(Request $request){

        if($request->isMethod('post')){

            $status = "";
            $data = $request->all();
            if(empty($request->status)){
                $status = 0;
            }else{
                $status = 1;
            }



            $category = new Category;
            $category->name = $data['name'];
            $category->parent_id = $data['parent_id'];

            if(empty($data['description'])){
                $category->description = "";
            }else{
                $category->description = $data['description'];
            }

            if(empty($data['keywords'])){
                $category->keywords = "";
            }else{
                $category->keywords = $data['keywords'];
            }

            $category->url = $this->createSlug($data['name']);
            $category->status = $status;
            $category->save();

            Session::flash('success','The category has been successfully created!');
            return redirect()->route('categories');
        }

    }


    public function index(){
        $categories = Category::orderBy('id','desc')->paginate(10);
        $levels = Category::where('parent_id','=',0)->get();
        return view('backend.categories.index')->with(compact('categories','levels'));
    }

    public function editCategory(Request $request,$id){

        $category = Category::find($id);
        if($category->id == $request->parent_id){
            Session::flash('failure','This operation is not allowed!');
            return redirect()->route('categories');
        }
        $this->validate($request,[
            'name'=>'required',
        ]);


        $category->name = $request->name;
        if(empty($request->description)){
            $category->description = "";
        }else{
            $category->description = $request->description;
        }



        if(empty($request->keywords)){
            $category->keywords = "";
        }else{
            $category->keywords = $request->keywords;
        }

        if(empty($request->status)){
            $status = 0;
        }else{
            $status = 1;
        }


        $category->url = $this->createSlug($category->name, $category->id);
        $category->parent_id = $request->parent_id;
        $category->status = $status;
        $category->save();
        Session::flash('success','Category details edited successfully!');
        return redirect()->route('categories');


    }


    public function deleteCategory($id){

        $category = Category::find($id);
        $sub_cats = Category::where('parent_id',$category->id)->get();
        foreach($sub_cats as $cat){
            $cat->delete();
        }
        $category->delete();
        Session::flash('deleted','Category Deleted Successfully');
        return redirect()->route('categories');
    }


    public function showProducts($url){

        $category = Category::where('url',$url)->first();

        $products = "";
        $status = "";
        if($category->parent_id != 0){
            $products = Product::where('category_id',$category->id)->orderBy('id','desc')->paginate(10);
            $status = '"'.$category->name.'" Category';
        }elseif ($category->parent_id == 0){
            $status = '"'.$category->name.'" Niche';
            $products = Product::where('niche_id',$category->id)->orderBy('id','desc')->paginate(10);
        }

        return view('backend.categories.resources')->with(compact('products','status'));

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
        if (! $allSlugs->contains('url', $slug)){
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('url', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Category::select('url')->where('url', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }



}
