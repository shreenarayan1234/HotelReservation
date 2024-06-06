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
                    $room = Room::all();

                    return view('home.index',compact('room'));
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

            $room = Room::all();

            return view('home.index',compact('room'));
        }

        public function create_room(){
            return view('admin.create_room');
        }

        //inserting the Data to DB
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
    
        //Displaying the room
    public function view_room(){
        $datas = Room::all();   //here 'Room' is modal name and all data from table is store in $data variable

        return view('admin.view_room',compact('datas'));  //all the data from $data is send to blade file
    }

    //Deleting the room
    public function room_delete($id){
        $data = Room::find($id);
        $data->delete();
        return redirect()->back();
    }


    public function room_update($id){

        $data = Room::find($id);
        return view('admin.update_room',compact('data'));
    }

    public function edit_room(Request $request,$id){
        
        $data = Room::find($id);

        $data->room_title = $request->title;

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
