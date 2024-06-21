<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;

use App\Models\Booking;

use App\Models\Contact;

use App\Models\Gallary;

use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function room_details($id)
    {

        $room = Room::find($id);
        return view('home.room_details', compact('room'));
    }

    public function add_booking(Request $request, $id)
    {

        $request->validate([
            'startDate' => 'required|date',

            'endDate' => 'date|after:startDate',
        ]);

        $data = new Booking;

        $data->room_id = $id;

        $data->name = $request->name;

        $data->email = $request->email;

        $data->phone = $request->phone;

        $startDate = $request->startDate;

        $endDate = $request->endDate;

        $isBooked = Booking::where('room_id', $id)->where('start_date', '<=', $endDate)->where('end_date', '>=', $startDate)->exists();

        if ($isBooked) {
            return redirect()->back()->with('message', 'Room is already booked please try different date');
        } else {
            $data->start_date = $request->startDate;

            $data->end_date = $request->endDate;

            $data->save();

            return redirect()->back()->with('message', 'Room Book Successfully');
        }
    }

    public function contact(Request $request)
    {
        $contact = new Contact;

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;

        $contact->save();

        return redirect()->back()->with('message', 'Message Sent Successfully');

    }
    public function our_rooms()
    {
        $room = Room::all();
        return view('home.our_rooms', compact('room'));
    }
    public function hotel_gallary()
    {
        $gallery = Gallary::all();
        return view('home.hotel_gallary', compact('gallery'));
    }

    public function contact_us()
    {

        return view('home.contact_us');
    }

    
    public function mybooking()
    {
        //The user() method of the Auth facade returns the currently authenticated user. It returns an instance of the User model (or whichever model you have configured for authentication).

        $userEmail = Auth::user()->email;  //gives you the email address of the logged-in user.
        $datas = Booking::where('email', $userEmail)->get(); //This line performs a query on the Booking model to fetch all booking records where the email field matches the authenticated user's email:
        return view('home.mybooking', compact('datas'));
    }


    public function cancel_book($id)
    {

        $booking = Booking::find($id);

        $booking->status = 'Canceled';

        $booking->save();

        return redirect()->back();
    }
}
