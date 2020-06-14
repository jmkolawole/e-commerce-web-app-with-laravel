<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Image;

class TeamController extends Controller
{
    //
    public function index(){
        $team = Team::orderBy('id','desc')->paginate(4);
        return view('backend.teams.index')->with(compact('team'));
    }

    public function show($id){
        $team = Team::find($id);
        return view('backend.teams.show')->with(compact('team'));

    }

    public function create(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $team = new Team;
            $team->name = $data['name'];
            $team->title = $data['title'];
            $team->facebook = $data['facebook'];
            $team->twitter = $data['twitter'];
            $team->instagram = $data['instagram'];
            $team->slug = Str::slug($team->name,'-');


            if($request->hasFile('image')){
                $img_temp = $request->file('image');
                if($img_temp->isValid()){

                    $extension = $img_temp->getClientOriginalExtension();
                    $filename = 'alvinsmakeup'.rand(111,9999).'.'.$extension;

                    $medium_image_path = 'images/backend/teams/medium/'.$filename;
                    $small_image_path = 'images/backend/teams/small/'.$filename;


                    Image::make($img_temp)->save($medium_image_path);
                    Image::make($img_temp)->fit(290, 232)->save($small_image_path);



                    //Store Images
                    $team->image =$filename;
                }
            }

            $team->save();
            Session::flash('success','Team member saved successfully!');
            return redirect()->route('team.index');
        }


        return view('backend.teams.create');

    }


    public function edit(Request $request, $id){

        $team = Team::where('id','=',$id)->first();

        if($request->isMethod('post')){
            $data = $request->all();
            $filename = '';
            $team = Team::find($id);
            $old_image = $team->image;
            $team->name = $data['name'];
            $team->title = $data['title'];
            $team->facebook = $data['facebook'];
            $team->twitter = $data['twitter'];
            $team->instagram = $data['instagram'];
            $team->slug = Str::slug($team->name,'-');

            if($request->hasFile('image')){
                $img_temp = $request->file('image');
                if($img_temp->isValid()){

                    $extension = $img_temp->getClientOriginalExtension();
                    $filename = 'alvinsmakeup'.rand(111,9999).'.'.$extension;

                    $medium_image_path = 'images/backend/teams/medium/'.$filename;
                    $small_image_path = 'images/backend/teams/small/'.$filename;


                    Image::make($img_temp)->save($medium_image_path);

                    Image::make($img_temp)->fit(290, 232)->save($small_image_path);


                    //Store Images
                    $team->image =$filename;

                    //Delete old image

                    $medium_image_src = 'images/backend/teams/medium/';
                    $small_image_src = 'images/backend/teams/small/';


                    //Delete
                    if(file_exists($medium_image_src.$old_image)){
                        unlink($medium_image_src.$old_image);
                    }
                    if(file_exists($small_image_src.$old_image)){
                        unlink($small_image_src.$old_image);
                    }


                }
            }
            else{
                $filename = $old_image;
            }

            $team->image = $filename;
            $team->save();
            Session::flash('success','Team member edited successfully!');
            return redirect()->route('team.show',$team->id);

        }

        return view('backend.teams.edit')->with(compact('team'));



    }



    public function delete($id){
        $team = Team::where(['id'=>$id])->first();

        $medium_image_src = 'images/backend/teams/medium/';
        $small_image_src = 'images/backend/teams/small/';

        //Delete
        if(file_exists($medium_image_src.$team->image)){
            unlink($medium_image_src.$team->image);
        }
        if(file_exists($small_image_src.$team->image)){
            unlink($small_image_src.$team->image);
        }



        $team->delete();
        Session::flash('success','The member has been deleted successfully!');
        return redirect()->route('team.index');
    }

}
