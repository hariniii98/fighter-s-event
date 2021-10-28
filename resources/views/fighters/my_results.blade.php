@extends('layouts.master_layout')

@push('css-styles')
<style>
    .wh-40{
        width:40px !important;
        height:40px !important;
    }
    .s_bode{
  width: 700px;
  padding: 50px;
  display: flex;
  position:relative;
  z-index: 1000;
  border-radius: 20px;
  background-position: 0 -289px;
  background-size: cover;
  overflow: hidden;
}


.s_bode:after{
  content: '';
  height: 100%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  background-color:rgba(0, 0, 0, .8);
  z-index: -2;
  border-radius: 20px;
}


.s_bode:before{
  content: '';
  height: 100%;
  width: 100%;
  position: absolute;
  top: 0;
  left: -47%;
  background-color:rgba(255, 255, 255, .2);
  z-index: -1;
  transform: skewX(-10deg);
}

.s_bode img{
  height: 100px;
  width: 100px;
}

.left_section{
  flex-grow: 2;
   display: flex;
   flex-direction: column;
  align-items: center;
}

.mid_section{
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  color: #fff;
  font-size: 26px;
}

.right_section{
  flex-grow:2;
   display: flex;
   flex-direction: column;
   align-items: center;

}

.s_bode h2{
  margin-top: 10px;
  color: #f39c12;
  font-size: 26px;
  font-weight:bold;
}


.s_bode p{
 margin-top:5px;
 font-weight:bold;
 font-size: 14px;
 color: #fff;
}


@media screen and (max-width: 850px) {
    .s_bode{
      width: 500px;
       background-position: 0 -209px;
    }

    .s_bode img{
      width: 80px;
      height: 80px
    }

    .s_bode h2{
     font-size: 18px;
    }
}


@media screen and (max-width: 640px) {
    .s_bode{
      width: 400px;
      padding: 10px;
      background-position: 0 -190px;
    }

    .s_bode img{
      width: 50px;
      height: 50px
    }

    .s_bode h2{
     font-size: 14px;
    }
    .s_bode h1{
     font-size: 18px;
    }

    .s_bode p{
     font-size: 10px;
    }
}

@media screen and (max-width: 450px) {
    .s_bode{
      width: 320px;
      padding:10px;
       background-position: 0 -90px;
    }

    .s_bode img{
      width: 50px;
      height: 50px
    }

    .s_bode h2{
     font-size: 14px;
    }
    .s_bode h1{
     font-size: 18px;
    }
}


@media screen and (max-width: 850px) {
    .s_bode{
      width: 500px;
       background-position: 0 -209px;
    }

    .s_bode img{
      width: 80px;
      height: 80px
    }

    .s_bode h2{
     font-size: 18px;
    }
}


@media screen and (max-width: 640px) {
    .s_bode{
      width: 400px;
      padding: 10px;
      background-position: 0 -190px;
    }

    .s_bode img{
      width: 50px;
      height: 50px
    }

    .s_bode h2{
     font-size: 14px;
    }
    .s_bode h1{
     font-size: 18px;
    }

    .s_bode p{
     font-size: 10px;
    }
}

@media screen and (max-width: 450px) {
    .s_bode{
      width: 320px;
      padding:10px;
       background-position: 0 -90px;
    }

    .s_bode img{
      width: 50px;
      height: 50px
    }

    .s_bode h2{
     font-size: 14px;
    }
    .s_bode h1{
     font-size: 18px;
    }
}
</style>
@endpush

@section('content')
@include('elements.settings_section')

 <!-- Main Content -->

      <div class="section-header">

        <h1>Results</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{url('/home')}}">Home</a></div>
          <div class="breadcrumb-item">Results</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">Results</h2>


        <div id="output-status"></div>
        <div class="row">
            @foreach($my_matches_array as $key=>$row)
            <div class="s_bode col-10 offset-1 mb-3">
                <div class="left_section">
                        <img src="{{asset('assets/images/user_images/'.Auth::user()->user_image)}}" alt="">
                        <h2>{{Auth::user()->first_name}}&nbsp;{{Auth::user()->last_name}} <span>({{$match_status[$key]}})</span></h2>
                </div>

                <div class="mid_section">
                    <h1>{{$match_decision[$key]}}</h1>
                    <h3>Match - {{$row}}</h3>
                    <h3>Stage - {{$my_matches_stages_array[$key]}}</h3>
                </div>
                <div class="right_section">
                    <img src="{{asset('assets/images/user_images/'.$my_opponents_images_array[$key])}}" alt="">
                    <h2>{{$my_opponents_names_array[$key]}} <span>({{$opponent_match_status[$key]}})</h2>
                </div>
            </div>
            @endforeach
        </div>
      </div>

@endsection
