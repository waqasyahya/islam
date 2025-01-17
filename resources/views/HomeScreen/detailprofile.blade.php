@extends('HomeScreen.Header-Layout') 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://fonts.googleapis.com/css2?family=Readex+Pro&display=swap" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>islame - Detail Profile</title>
    <link rel="icon" type="image/png" sizes="16x16" href="/image/logo3.png">
</head>
<body>
  

    <div class="container card shadow-lg" style="width: 75%; height:50%; margin-top:160px;">
        @foreach ($data as $profile)
        <div style="width: 150px; height: 150px; overflow: hidden; border-radius: 100%; margin-left:41%; margin-top:-8.5%;">
            <img src="{{ asset('/BlogImage/' .  $profile->image) }}" style="width: 100%; height: 100%;" class="img-fluid rounded-circle card-img-top" alt="Profile Image">

        </div>  
        <h2 style="text-align: center; margin-top:1%; font-family: 'Readex Pro', sans-serif;"> {{$profile->name}}</h2>
        <div class="row" style="margin-top: 2%;">
            <div class="col-4"></div>
            <div class="col-2">
                <span style=" margin-top:2%;margin-left: 50px;font-size:17px; font-family: 'Readex Pro', sans-serif; ">Exp:</span>
            </div>
           
            <div class="col-2">
                <h4 style=" margin-top:0%; margin-left: -25px; font-family: 'Readex Pro', sans-serif;" > {{$profile->experience}}</h4>
            </div>
            <div class="col-4"></div>
        </div>
        <center>
            <button class="btn" style="width: 160px; height:50px; margin-top:3%; font-size:20px;  background-color:#069999 !important; color: white !important;" data-bs-toggle="modal" data-bs-target="#exampleModal">Contact</button>
         </center>
         <h4 style="border-bottom: #069999 solid 3px; width:24%; text-align:center; font-family: 'Readex Pro', sans-serif;">Overview</h4>
         <hr style="height: 1px; background-color: #ccc; border: none; margin: -9px 0;">
         <div class="container-fluid" style="margin-top:7%;">
<div class="row" style="">
    <div class="col-3">
        <h3 style=" margin-top:3%; font-family: 'Readex Pro', sans-serif;"> {{$profile->rate}} pkr/hr</h3> 
        <span style=" margin-top:3%; font-size:14px; font-family: 'Readex Pro', sans-serif;">Charges</span>
    </div>
    <div class="col-4">
        <h4 style=" margin-top:3%; font-family: 'Readex Pro', sans-serif;"> {{$profile->language}}</h4>
        <span style=" margin-top:3%; font-size:14px; font-family: 'Readex Pro', sans-serif;">Language</span>
    </div> 
        
    <div class="col-2">
        <h4 style=" margin-top:3%; font-family: 'Readex Pro', sans-serif;"> {{$profile->gender}}</h4>
        <span style=" margin-top:3%; font-size:14px; font-family: 'Readex Pro', sans-serif;">Gender</span>

        </div> 
    <div class="col-3">
        <h4 style=" margin-top:3%; font-family: 'Readex Pro', sans-serif;"> {{$profile->location}}</h4>
        <span style=" margin-top:3%; font-size:14px; font-family: 'Readex Pro', sans-serif;">Location</span>
    </div>
</div>
</div>
<hr>




    
  
    
       <div class="row">
        <div class="col-4">
            <h5 style=" margin-top:3%;">About</h5>
        </div>
    </div>
    <div class=" card" style="width:85%; height:100%; margin-top:3%;margin-left:10%;">
        <h6> {{$profile->about}}</h6>
    </div>
    @endforeach
    
    </div>



    <div class="modal fade" style=" background-color: whitesmoke;" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" >
          <div class="modal-content" style=" width:750px;">
            <div class="modal-header">
                <center>
              <h1 class="modal-title fs-5" style="text-align: center !important;" ></h1>
            </center>
              <button type="button" class="btn-close btn" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <center>
                    <h1 class="modal-title fs-5" style="text-align: center !important; margin-top:-10%; font-family: 'Readex Pro', sans-serif;" >Contact</h1>
                  </center> 
                    {{-- Location --}}
       <div class="row">
        <div class="col-2"></div>
        <div class="col-3">
            <span style=" margin-top:3%; font-size:14px; font-family: 'Readex Pro', sans-serif;">Phone</span>
        </div>
        <div class="col-2"></div>
        <div class="col-3">
            <h4 style="font-family: 'Readex Pro', sans-serif;"> {{$profile->phone_number}}</h4>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-3">
            <span style=" margin-top:3%; margin-left:2%; font-size:14px; font-family: 'Readex Pro', sans-serif;">Gmail</span>
        </div>
        <div class="col-2"></div>
        <div class="col-3" style="margin-left:-39px; font-family: 'Readex Pro', sans-serif;">
            <h4> {{$profile->email}}</h4>
        </div>
    </div>
            </div>
        </div>
    </div>
    </div>
    @include('HomeScreen.Footer-Layout')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>