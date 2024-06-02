<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;

class AdminController extends Controller
{
        public function index(){

            if(Auth::id())  //this mean if some one is tries to login
            {
                $usertype = Auth()->user()->usertype;

                if($usertype == 'user')
                {
                    return view('home.index');
                }
                else if($usertype == 'admin')
                {
                    return view('admin.index');
                }
                
                else{
                    return redirect()->back();
                }
            }
        }

        public function home(){
            return view('home.index');
        }

        public function create_room(){
            return view('admin.create_room');
        }

        public function add_room(Request $request){
            
            $data = new Room;

            $data->room_title = $request->title;  //Here room_title is a field_name in DB and title is name of form
            $data->description = $request->description;

            $data->price = $request->price;

            $data->wifi = $request->wifi;

            $data->room_type = $request->type;

            $image = $request->image;  //get image from form

            if($image){

                $imagename = time().'.'.$image->getClientOriginalExtension();  //modify the image name using time function

                $request->image->move('room',$imagename);  //moving the image in public folder with certain name

                $data->image = $imagename;   //storing the data in DB
            }

            $data->save();

            return redirect()->back();

        }
}
