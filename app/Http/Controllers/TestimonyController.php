<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimony;
use Session;

class TestimonyController extends Controller
{
    //


    public function create(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $testimony = new Testimony;

            if(empty($data['name'])){
                Session::flash('failure','Please add fill out all inputs!');
                return redirect()->back();
            }else{
                $testimony->name = $data['name'];
            }

            if(empty($data['body'])){
                Session::flash('failure','Please add contents to the Body!');
                return redirect()->back();
            }else{
                $testimony->body = $data['body'];
            }


            $testimony->save();
            Session::flash('success','Testimony saved successfully!');
            return redirect()->route('index.testimony');

        }


        return view('backend.testimonies.create');



    }



    public function index(){
        $testimonies = Testimony::orderBy('id','desc')->paginate(10);
        return view('backend.testimonies.index')->with(compact('testimonies'));

    }


    public function edit(Request $request, $id){
        $testimony = Testimony::where('id','=',$id)->first();

        if($request->isMethod('post')){

            $data = $request->all();

            if(empty($data['name'])){
                Session::flash('failure','Please add fill out all inputs!');
                return redirect()->back();
            }else{
                $testimony->name = $data['name'];
            }

            if(!empty($data['body'])){
                $testimony->body = $data['body'];
            }else{
                Session::flash('failure','Please add contents to the Body!');
                return redirect()->back();
            }

            $testimony->save();
            Session::flash('success','Testimony updated successfully!');
            return redirect()->route('index.testimony');
        }

        return view('backend.testimonies.edit')->with(compact('testimony'));
    }



    public function show($id){
        $testimony = Testimony::where('id','=',$id)->first();
        return view('backend.testimonies.show')->with(compact('testimony'));
    }


    public function delete($id){
        $testimony = Testimony::find($id);
        $testimony->delete();
        Session::flash('success','Testimony deleted successfully!');
        return redirect()->route('index.testimony');


    }


}
