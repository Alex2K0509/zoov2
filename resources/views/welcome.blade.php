@extends('layouts.app', ['class' => 'bg-default'])

@section('content')

   
    <div class="header bg-default-primary py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mt-7 mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <h1 class="text-black">{{ __('Bienvenido al zoo-control.') }}</h1>
                       <style>
                           #mapid { 
  height: 250px;
  width: 500px;
}


#container {
	margin: 0px auto;
	width: 500px;
	height: 375px;
	border: 10px #333 solid;
}
#videoElement {
	width: 500px;
	height: 250px;
	background-color: #666;
}

@media only screen and (max-width: 700px) {
    #videoElement {
	width: 100%;
	height: 250px;
	background-color: #666;
}
#mapid { 
  height: 100%;
  width: 500px;
}
}
 
                       </style>

<div id="mapid"></div>
<video autoplay="true" id="videoElement">
	
	</video>
                    </div>

                </div>

            </div>

        </div>

    </div>
<script>
var video = document.querySelector("#videoElement");

if (navigator.mediaDevices.getUserMedia) {
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(function (stream) {
      video.srcObject = stream;
    })
    .catch(function (err0r) {
      console.log("Something went wrong!");
    });
}
</script>
    <div class="container mt--10 pb-5"></div>

@include('layouts.footers.guest')
@endsection
