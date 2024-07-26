<!DOCTYPE html>
<html>
<head>
<!-- Font Awesome Icon Library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.checked {
  color: orange;
}
</style>
</head>
<body>
<div  class="our_room">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Our Room</h2>
                     <p>Lorem Ipsum available, but the majority have suffered </p>
                  </div>
               </div>
            </div>

            <div class="row">
               @foreach($room as $rooms)

               <div class="col-md-4 col-sm-6">
                  <div id="serv_hover"  class="room">
                     <div class="room_img">
                        <img style="height: 200px; width: 350px" src="room/{{$rooms->image}}" alt="#"/>
                     </div>
                     <div class="bed_room">
                        <h3>{{$rooms->room_title}}</h3>
                        <h5>
                           <span class="fa fa-star checked"></span>
                           <span class="fa fa-star checked"></span>
                           <span class="fa fa-star checked"></span>
                           <span class="fa fa-star"></span>
                           <span class="fa fa-star"></span>
                        </h5>
                        <p>{!! Str::limit($rooms->description,100) !!} </p>
                        <a href="{{url('room_details',$rooms->id)}}" class="btn btn-primary">Room Details</a>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>

           

         </div>
      </div>

</body>
</html>
