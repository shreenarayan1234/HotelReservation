<!DOCTYPE html>
<html lang="en">
   <head>
    <base href="/public">
      @include('home.css')
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

      <style>
        label{
            display: inline-block;
            width: 200px;
        }
        input{
            width: 100%;
        }
      </style>
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#"/></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
            @include('home.header')
      </header>


      <div  class="our_room">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Our Room</h2>
                     <p>Our Best Service Can Impress The Customers </p>
                  </div>
               </div>
            </div>

            <div class="row">

               <div class="col-md-8">
                  <div id="serv_hover"  class="room">
                     <div style="padding:20px;" class="room_img">
                        <img style="height: 300px; width: 800px" src="/room/{{$room->image}}" alt="#"/>
                     </div>
                     <div class="bed_room">
                        <h2>{{$room->room_title}}</h2>
                        <p style="padding: 12px">{{$room->description}}</p>
                        <h4 style="padding: 12px">Free Wifi : {{$room->wifi}}</h4>
                        <h4 style="padding: 12px">Room Type : {{$room->room_type}}</h4>
                        <!-- <h3 style="padding: 12px">Price : {{$room->price}}</h3> -->
                        <h3 style="padding: 12px">Price per night: <span id="pricePerNight">{{$room->price}}</span></h3>
                        <h3 style="padding: 12px">Total Price: <span id="totalPrice">0</span></h3>


                     </div>
                  </div>
               </div>
             
            <div class="col-md-4">
                <h1 style="font-size: 40px;">Book Room</h1>

                <div>
                    <!-- message came from HomeController -->

                    @if (session()->has('message'))
                        <div class="alert alert-success">
                        <button type="button" class="close" data-bs-dismiss="alert">X</button>
                        {{session()->get('message')}}
                        </div>
                        
                    @endif

                </div>

                @if($errors)

                @foreach($errors->all() as $errors)

                <li style="color:red">
                    {{$errors}}
                </li>

                @endforeach

                @endif
                <!-- <form action="{{url('add_booking',$room->id)}}" method="post">
                @csrf
                <div>
                    <label>Name</label>
                    <input type="text" name="name" 
                    @if(Auth::id())
                    value="{{Auth::user()->name}}"
                    @endif
                    >
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="email"
                    @if(Auth::id())
                    value="{{Auth::user()->email}}"
                    @endif
                    >
                </div>
                <div>
                    <label>Phone</label>
                    <input type="number" name="phone"
                    @if(Auth::id())
                    value="{{Auth::user()->phone}}"
                    @endif
                    >
                </div>
                <div>
                    <label>Start Date</label>
                    <input type="date" name="startDate" id="startDate">
                </div>
                <div>
                    <label>End Date</label>
                    <input type="date" name="endDate" id="endDate">
                </div></br>
                <div>
                    <input type="submit" style="background-color:skyblue;" class="btn btn-primary" value="Book Room">
                </div>
                </form> -->
                <form action="{{ url('add_booking', $room->id) }}" method="post">
    @csrf
    <div>
        <label>Name</label>
        <input type="text" name="name" 
        @if(Auth::id())
        value="{{ Auth::user()->name }}"
        @endif
        >
    </div>
    <div>
        <label>Email</label>
        <input type="email" name="email"
        @if(Auth::id())
        value="{{ Auth::user()->email }}"
        @endif
        >
    </div>
    <div>
        <label>Phone</label>
        <input type="number" name="phone"
        @if(Auth::id())
        value="{{ Auth::user()->phone }}"
        @endif
        >
    </div>
    <div>
        <label>Start Date</label>
        <input type="date" name="startDate" id="startDate">
    </div>
    <div>
        <label>End Date</label>
        <input type="date" name="endDate" id="endDate">
    </div>
    <br>
    <div>
        @if(Auth::id())
        <input type="submit" style="background-color: skyblue;" class="btn btn-primary" value="Book Room">
        @else
        <input type="button" style="background-color: skyblue; cursor: not-allowed;" class="btn btn-primary" value="Book Room" id="bookRoomButton">
        <script>
            document.getElementById('bookRoomButton').addEventListener('click', function() {
                confirm('Please log in to book a room.');
            });
        </script>
        @endif
    </div>
</form>

            </div>

            </div>
         </div>
      </div>


     
      <!--  footer -->
            @include('home.footer')

            <script>
                $(function(){
                    var dtToday = new Date();
                    var month = dtToday.getMonth() + 1;  //dtToday.getMonth() + 1 gets the current month (0-11) and adds 1 to make it 1-12.
                    var day = dtToday.getDate();
                    var year = dtToday.getFullYear();
                    //If the month or day is less than 10, add a leading zero to ensure a two-digit format (e.g., 1 becomes 01)
                    if(month < 10)
                        month = '0' + month.toString();

                    if(day < 10)
                    day = '0' + day.toString();
                    var maxDate = year + '-' + month + '-' + day; //Concatenate the year, month, and day to create a string in the format YYYY-MM-DD.
                    $('#startDate').attr('min',maxDate);
                    $('#endDate').attr('min',maxDate);

                function calculateTotalPrice() {
                    var startDate = new Date($('#startDate').val());//Get the values of the #startDate and #endDate inputs and convert them to Date objects.
                    var endDate = new Date($('#endDate').val());
                    if(startDate && endDate && endDate > startDate) {
                        var timeDifference = endDate.getTime() - startDate.getTime();//Calculate the difference in time between the end date and start date in milliseconds.

                        var nights = timeDifference / (1000 * 3600 * 24);//Convert the time difference from milliseconds to days by dividing by the number of milliseconds in a day.

                        var pricePerNight = parseFloat($('#pricePerNight').text());//Get the price per night from the #pricePerNight element and convert it to a float.
                        var totalPrice = nights * pricePerNight;
                        $('#totalPrice').text(totalPrice.toFixed(2));
                    } else {
                        $('#totalPrice').text('0');
                    }
                }

                $('#startDate, #endDate').on('change', calculateTotalPrice);

        });
    </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
   </body>
</html>