<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Brand;
use App\Exports\ProductExport;
use App\Mail\Newletters;
use App\ProductView;
use App\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Illuminate\Support\Str;
use Image;
use Session;
use Auth;
use Excel;
use App\Picture;
use App\Jobs\sendNewsletterEmail;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    //

    public function addProduct(Request $request)
    {

        if ($request->isMethod('post')) {
            //dd($request);
            $data = $request->all();
            if (!empty($data['product_name']) && !empty($data['product_code']) && !empty($data['category_id']) && !empty($data['brand_id'])
            && !empty($data['price'])){

                if(empty($data['check']) && empty($data['stock'])){
                    Session::flash('failure', ' Please You Have To Fill Product Stock If The Product Does Not Have An Attribute');
                    return redirect()->back();
                }else{
                    $product = new Product;

                    $product->product_name = $data['product_name'];
                    $product->product_code = $data['product_code'];

                    $product->category_id = $data['category_id'];
                    $category = Category::where('id',$product->category_id)->first();
                    $niche = Category::where('id',$category->parent_id)->first();
                    $product->niche_id = $niche->id;
                    $product->brand_id = $data['brand_id'];
                    $product->user_id = Auth::user()->id;
                    $product->url = $this->createSlug($data['product_name']);





                    if (!empty($data['description'])) {
                        $product->description = $data['description'];;
                    } else {
                        $product->description = '';
                    }

                    if (!empty($data['keywords'])) {
                        $product->keywords = $data['keywords'];
                    } else {
                        $product->keywords = '';
                    }

                    if (empty($data['status'])) {
                        $product->status = 0;
                    } else {
                        $product->status = 1;
                    }




                    if (empty($data['featured'])) {
                        $product->featured = 0;
                    } else {
                        $product->featured = 1;
                    }

                    if (empty($data['review'])) {
                        $product->review = 0;
                    } else {
                        $product->review = 1;
                    }

                    $product->price = $data['price'];

                    if(isset($data['check']) && !empty($data['check'])){
                        $product->stock_status = "yes";
                    }else{
                        $product->stock_status = "no";

                    }

                    $product->stock = $data['stock'];



                    $product->prev_price = $data['prev_price'];


                    //Upload Picture
                    if ($request->hasFile('image')) {

                        $img_temp = $request->file('image');
                        if ($img_temp->isValid()) {

                            $extension = $img_temp->getClientOriginalExtension();
                            $filename = 'alvinsmakeup' . rand(111, 9999) . '.' . $extension;
                            $large_image_path = 'images/backend/products/large/' . $filename;
                            $medium_image_path = 'images/backend/products/medium/' . $filename;
                            $small_image_path = 'images/backend/products/small/' . $filename;


                            //Resize Images

                            Image::make($img_temp)->save($large_image_path);
                            Image::make($img_temp)->resize(600, 600)->save($medium_image_path);
                            Image::make($img_temp)->resize(300, 300)->save($small_image_path);


                            //Store Images
                            $product->image = $filename;
                        }
                    }
                    else{
                        Session::flash('failure', ' Product Image Is Compulsory!');
                        return redirect()->back();
                    }

                    //Upload Video
                    if ($request->hasFile('video')) {
                        $video_temp = $request->file('video');
                        $extension = $video_temp->getClientOriginalExtension();
                        $video_name = 'alvinsmakeup' . rand(111, 9999) . $request->product_name . '.' . $extension;
                        $video_path = 'videos/';
                        $video_temp->move($video_path, $video_name);
                        $product->video = $video_name;
                    }


                    $product->save();
                    Session::flash('success', ' Product Uploaded Successfully!');
                    return redirect()->route('view.products');
                }
            }else{
                Session::flash('failure', ' Please Fill Out All Compulsory Fields');
                return redirect()->back();
            }



        }

        //Categories
        $categories = Category::where('parent_id', '=', 0)->get();
        $categories_dropdown = "<option selected disabled>Select</option>";
        foreach ($categories as $cat) {
            //$categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
            $categories_dropdown .= "<optgroup label='" . $cat->name . "'>";

            $sub_categories = Category::where('parent_id', '=', $cat->id)->get();
            foreach ($sub_categories as $sub_cat) {
                $categories_dropdown .= "<option value='" . $sub_cat->id . "'>&nbsp;--&nbsp;" . $sub_cat->name . "</option>";
            }
        }

        //Brands
        $brands = Brand::all();
        return view('backend.products.add_product')->with(compact('categories_dropdown', 'brands'));
    }


    public function viewProducts()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        return view('backend.products.view_products')->with(compact('products'));
    }

    public function editProduct($id, Request $request)
    {

        $product = Product::where('id', '=', $id)->first();

        if ($request->isMethod('post')) {
            $data = $request->all();
            if (!empty($data['product_name']) && !empty($data['product_code']) && !empty($data['category_id']) && !empty($data['brand_id'])
                && !empty($data['price'])) {

                if (empty($data['check']) && empty($data['stock'])) {
                    Session::flash('failure', ' Please You Have To Fill Product Stock If The Product Does Not Have An Attribute');
                    return redirect()->back();
                }else{

                    $product->product_name = $data['product_name'];
                    $product->product_code = $data['product_code'];


                    $product->category_id = $data['category_id'];
                    $category = Category::where('id',$product->category_id)->first();
                    $niche = Category::where('id',$category->parent_id)->first();
                    $product->niche_id = $niche->id;
                    $product->brand_id = $data['brand_id'];
                    $product->user_id = Auth::user()->id;
                    $product->url = $this->createSlug($data['product_name'],$id);



                    if (!empty($data['description'])) {
                        $product->description = $data['description'];;
                    } else {
                        $product->description = '';
                    }

                    if (!empty($data['keywords'])) {
                        $product->keywords = $data['keywords'];;
                    } else {
                        $product->keywords = '';
                    }


                    if (empty($data['review'])) {
                        $product->review = 0;
                    } else {
                        $product->review = 1;
                    }


                    if (empty($data['status'])) {
                        $product->status = 0;
                    } else {
                        $product->status = 1;
                    }


                    if (empty($data['featured'])) {
                        $product->featured = 0;
                    } else {
                        $product->featured = 1;
                    }

                    if(isset($data['check']) && !empty($data['check'])){
                        $product->stock_status = "yes";
                        $product->stock = 0;
                    }else{
                        $product->stock_status = "no";
                        $product->stock = $data['stock'];
                        $items = Attribute::where('product_id',$id)->get();
                        foreach ($items as $item){
                            $item->delete();
                        }
                    }



                    $product->price = $data['price'];


                    $product->prev_price = $data['prev_price'];





                    //Old Image
                    $old_image = $product->image;
                    $filename = '';
                    //Upload Picture
                    if ($request->hasFile('image')) {

                        $img_temp = $request->file('image');
                        if ($img_temp->isValid()) {

                            $extension = $img_temp->getClientOriginalExtension();
                            $filename = 'alvinsmakeup' . rand(111, 9999) . '.' . $extension;
                            $large_image_path = 'images/backend/products/large/' . $filename;
                            $medium_image_path = 'images/backend/products/medium/' . $filename;
                            $small_image_path = 'images/backend/products/small/' . $filename;


                            //Resize Images

                            Image::make($img_temp)->save($large_image_path);
                            Image::make($img_temp)->resize(600, 600)->save($medium_image_path);
                            Image::make($img_temp)->resize(300, 300)->save($small_image_path);


                            //Delete
                            $large_image_src = 'images/backend/products/large/';
                            $medium_image_src = 'images/backend/products/medium/';
                            $small_image_src = 'images/backend/products/medium/';


                            //Delete
                            if (file_exists($large_image_src . $old_image)) {
                                unlink($large_image_src . $old_image);
                            }
                            if (file_exists($medium_image_src . $old_image)) {
                                unlink($medium_image_src . $old_image);
                            }
                            if (file_exists($small_image_src . $old_image)) {
                                unlink($small_image_src . $old_image);
                            }


                            //Store Images
                            $product->image = $filename;
                        }
                    } else {
                        $filename = $old_image;
                    }

                    $product->image = $filename;



                    //Upload Video
                    $old_video = $product->video;
                    if ($request->hasFile('video')) {
                        $video_temp = $request->file('video');
                        $extension = $video_temp->getClientOriginalExtension();
                        $video_name = 'alvinsmakeup' . rand(111, 9999) . $request->product_name . '.' . $extension;
                        $video_path = 'videos/';
                        $video_temp->move($video_path, $video_name);

                        //Delete Video
                        if ($product->video != null) {
                            $video_src = 'videos/';

                            if (file_exists($video_src . $old_video)) {
                                unlink($video_src . $old_video);
                            }
                        }

                        $product->video = $video_name;

                    } else {
                        $product->video = $old_video;
                    }


                    $product->save();
                    Session::flash('success', ' Product Edited Successfully!');
                    return redirect()->route('view.products');
                }

            }else{
                Session::flash('failure', ' Please Fill Out All Compulsory Fields');
                return redirect()->back();
            }



        }


        $categories = Category::where('parent_id', '=', 0)->get();
        $categories_dropdown = "<option selected disabled>Select</option>";
        foreach ($categories as $cat) {

            if ($cat->id == $product->category_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            //$categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
            $categories_dropdown .= "<optgroup label='" . $cat->name . "'>";

            $sub_categories = Category::where('parent_id', '=', $cat->id)->get();
            foreach ($sub_categories as $sub_cat) {
                if ($sub_cat->id == $product->category_id) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $categories_dropdown .= "<option value='" . $sub_cat->id . "'" . $selected . ">&nbsp;--&nbsp;" . $sub_cat->name . "</option>";
            }
        }


        //Brands
        $brands = Brand::all();
        return view('backend.products.edit_product')->with(compact('product', 'categories_dropdown', 'brands'));
    }


    public function deleteProduct($id)
    {
        $product = Product::find($id);

        ProductView::where('product_id',$id)->delete();
        $product->delete();
        $pictures = Picture::where('product_id', '=', $product->id)->get();

        $large_image_src = 'images/backend/products/large/';
        $medium_image_src = 'images/backend/products/medium/';
        $small_image_src = 'images/backend/products/small/';


        //Delete
        if (file_exists($large_image_src . $product->image)) {
            unlink($large_image_src . $product->image);
        }
        if (file_exists($medium_image_src . $product->image)) {
            unlink($medium_image_src . $product->image);
        }
        if (file_exists($small_image_src . $product->image)) {
            unlink($small_image_src . $product->image);
        }


        foreach ($pictures as $picture) {

            $picture->delete();
            $large_image_path = 'images/backend/pictures/large/';
            $medium_image_path = 'images/backend/pictures/medium/';
            $small_image_path = 'images/backend/pictures/small/';

            //Delete
            if (file_exists($large_image_path . $picture->image)) {
                unlink($large_image_path . $picture->image);
            }
            if (file_exists($medium_image_path . $picture->image)) {
                unlink($medium_image_path . $picture->image);
            }
            if (file_exists($small_image_path . $picture->image)) {
                unlink($small_image_path . $picture->image);
            }
        }



        //Delete Video

        if($product->video != null){
        $video_src = 'videos/';
        if (file_exists($video_src . $product->video)) {
            unlink($video_src . $product->video);
        }
        }

        Session::flash('deleted', 'The product has been deleted successfully!');
        return redirect()->route('view.products');

    }


    public function addImages(Request $request, $id)
    {

        $product = Product::find($id);


        if ($request->isMethod('post')) {

            $picture = new Picture;
            $picture->product_id = $id;

            $image = $request->file('file');
            if ($image) {

                $extension = $image->getClientOriginalExtension();
                $imageName = 'alvinsmakeup' . rand(111, 9999) . '.' . $extension;

                $large_image_path = 'images/backend/pictures/large';
                $medium_image_path = 'images/backend/pictures/medium';
                $small_image_path = 'images/backend/pictures/small';

                $img = Image::make($image->getRealPath());

                //Save to Large Folder
                //$img->save($large_image_path.'/'.$imageName);
                $img->save($large_image_path . '/' . $imageName);

                //Save to Medium folder
                $img->resize(600, 600)->save($medium_image_path . '/' . $imageName);

                //Save to small folder
                $img->resize(100, 100)->save($small_image_path . '/' . $imageName);

                $picture->image = $imageName;

            }

            $picture->save();
            Session::flash('success', 'Images added successfully!');


        }

        $images = Picture::orderBy('id', 'desc')->where('product_id', $id)->get();
        return view('backend.products.add_images')->with(compact('product', 'images'));
    }


    public function deleteImage($id)
    {
        $picture = Picture::find($id);
        $picture->delete();


        $large_image_src = 'images/backend/pictures/large/';
        $medium_image_src = 'images/backend/pictures/medium/';
        $small_image_src = 'images/backend/pictures/small/';


        //Delete
        if (file_exists($large_image_src . $picture->image)) {
            unlink($large_image_src . $picture->image);
        }
        if (file_exists($medium_image_src . $picture->image)) {
            unlink($medium_image_src . $picture->image);
        }
        if (file_exists($small_image_src . $picture->image)) {
            unlink($small_image_src . $picture->image);
        }

        Session::flash('success', 'Image Deleted successfully!');
        return back();
    }


    public function deleteProducts(Request $request)
    {

        $action = $request->action;
        if ($action == null) {
            Session::flash('failure', 'You have to select at least a product!');
            return back();
        }
        $products = Product::whereIn('id', $action)->get();

        foreach($products as $product){

            $product->delete();
            $pictures = Picture::where('product_id', '=', $product->id)->get();
            $large_image_src = 'images/backend/products/large/';
            $medium_image_src = 'images/backend/products/medium/';
            $small_image_src = 'images/backend/products/small/';


            //Delete
            if (file_exists($large_image_src . $product->image)) {
                unlink($large_image_src . $product->image);
            }
            if (file_exists($medium_image_src . $product->image)) {
                unlink($medium_image_src . $product->image);
            }
            if (file_exists($small_image_src . $product->image)) {
                unlink($small_image_src . $product->image);
            }


            foreach ($pictures as $picture) {

                $picture->delete();
                $large_image_path = 'images/backend/pictures/large/';
                $medium_image_path = 'images/backend/pictures/medium/';
                $small_image_path = 'images/backend/pictures/small/';

                //Delete
                if (file_exists($large_image_path . $picture->image)) {
                    unlink($large_image_path . $picture->image);
                }
                if (file_exists($medium_image_path . $picture->image)) {
                    unlink($medium_image_path . $picture->image);
                }
                if (file_exists($small_image_path . $picture->image)) {
                    unlink($small_image_path . $picture->image);
                }
            }

            if($product->video != null){
                $video_src = 'videos/';
                if (file_exists($video_src . $product->video)) {
                    unlink($video_src . $product->video);
                }
            }

        }


        Session::flash('deleted', 'The products have been deleted successfully!');
        return redirect()->route('view.products');


    }

    public function sendNewsletter(Request $request)
    {
        $action = $request->action;


        if($request->topic == ""){
            $topic = "New Product Alert";
        }else{
            $topic = $request->topic;
        }

        if($request->body == ""){
            $body = "Please check out our new and exciting products from Alvinsmakeup";
        }else{
            $body = $request->body;
        }


        if ($action == null) {
            Session::flash('failure', 'You have to select at least a product!');
            return back();
        }
        $products = Product::whereIn('id', $action)->get();

        //Send Newsletter here
        $subscribers = Subscriber::where('status', 1)->get();
        foreach($subscribers as $subscriber){
            dispatch(new sendNewsletterEmail($subscriber,$products,$topic,$body));
          //  Mail::to($subscriber->email)->send(new Newletters($subscriber,$products,$topic,$body));
        }


        Session::flash('success', 'Emails Sent Successfully!');
        return back();

    }

    public function addAttributes(Request $request, $id){
        if($request->isMethod('post')){

            $colors = $request->color;
            $picker = $request->picker;
            $stock = $request->stock;

           // dd($picker);

            $color_records = [];

            if($request->type == "color"){

                foreach($colors as $color => $v){
                    if(!empty($colors)){
                        $now = Carbon::now();

                        $color_records[] = [
                            'product_id' => $id,
                            'color' => strtolower($v),
                            'stock' => $stock[$color],
                            'picker' => $picker[$color],
                            'updated_at' => $now,  // remove if not using timestamps
                            'created_at' => $now   // remove if not using timestamps
                        ];
                    }
                }


            }elseif ($request->type == "size"){


                $picker = "";
                foreach($colors as $color => $v){
                    if(!empty($colors)){
                        $now = Carbon::now();

                        $color_records[] = [
                            'product_id' => $id,
                            'color' => strtolower($v),
                            'stock' => $stock[$color],
                            'updated_at' => $now,  // remove if not using timestamps
                            'created_at' => $now   // remove if not using timestamps
                        ];
                    }
                }
            }


            Attribute::insert($color_records);
            Session::flash('success', 'Attribute(s) added Successfully!');
            return back();

        }
      $product = Product::where('id',$id)->first();

      //$products = Attribute::where('product_id',$id)->get();
      return view('backend.products.add_attributes')->with(compact('product'));
    }


    public function editAttributes(Request $request, $id){
        $data = $request->all();
        //dd($data);
        foreach($data['idAttr'] as $key => $attr){
            //echo $key"<br>";die;
            Attribute::where(['id'=>$data['idAttr'][$key]])->update(['color'=>$data['color'][$key],'picker'=>$data['picker'][$key],'stock'=>$data['stock'][$key]]);
        }

        Session::flash('success', 'Attribute(s) updated Successfully!');
        return back();
    }

    public function deleteAttribute($id){
        Attribute::find($id)->delete();
        Session::flash('success', 'Attribute deleted Successfully!');
        return back();
    }


    public function exportProductsList(){
        return Excel::download(new ProductExport(), 'products.xlsx');
    }



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



           return Product::select('url')->where('url', 'like', $slug.'%')->where('id', '<>', $id)->get();

    }





}
