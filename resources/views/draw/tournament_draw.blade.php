@extends('layouts.master_layout')
@section('content')
@include('elements.settings_section')
@push('css-styles')
    <!-- CSS Libraries -->
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <!-- basic styles -->
	<style type="text/css">
        body { font-family: 'Roboto'; background-color: #fafafa; }
        h1 { margin: 150px auto 30px auto; text-align: center; }
        canvas {  }
            .g_gracket { width: 9999px; background-color: #fafafa; padding: 55px 15px 5px; line-height: 100%; position: relative; overflow: hidden;}
            .g_round { float: left; margin-right: 70px; }
            .g_game { position: relative; margin-bottom: 15px; }
            .g_gracket h3 { margin: 0; padding: 10px 8px 8px; font-size: 18px; font-weight: normal; color: #fff}
            .g_team { background:red; }
            .g_team:last-child {  background: blue; }
            .g_round:last-child { margin-right: 20px; }
            .g_winner { background: #444; }
            .g_winner .g_team { background: none; }
            .g_current { cursor: pointer; background: #A0B43C!important; }
            .g_round_label { top: -5px; font-weight: normal; color: blueviolet; text-align: center; font-size: 18px; }
        </style>
@endpush

<!-- Main Content -->


<div class="section-header">

    <h1>Tournament Draw System</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></div>
      <div class="breadcrumb-item active">Tournament Draw System</div>
    </div>
  </div>
	<!-- empty gracket element -->
	<div class="my_gracket"></div>


    @endsection

    @push('scripts')
     <!-- dependencies -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>

	<!-- main lib -->
	<script type="text/javascript" src="{{asset('assets/js/jquery.gracket.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/js/test.js')}}"></script>

	<script type="text/javascript">
		(function(win, doc, $){

			console.warn("Make sure the min-width of the .gracket_h3 element is set to width of the largest name/player. Gracket needs to build its canvas based on the width of the largest element. We do this my giving it a min width. I'd like to change that!");

			// Fake Data
			win.TestData = [
				[
					[ {"name" : "Erik Zettersten", "id" : "erik-zettersten", "seed" : 1, "displaySeed": "D1", "score" : 47 }, {"name" : "Andrew Miller", "id" : "andrew-miller", "seed" : 2} ],
					[ {"name" : "James Coutry", "id" : "james-coutry", "seed" : 3}, {"name" : "Sam Merrill", "id" : "sam-merrill", "seed" : 4}],
					[ {"name" : "Anothy Hopkins", "id" : "anthony-hopkins", "seed" : 5}, {"name" : "Everett Zettersten", "id" : "everett-zettersten", "seed" : 6} ],
					[ {"name" : "John Scott", "id" : "john-scott", "seed" : 7}, {"name" : "Teddy Koufus", "id" : "teddy-koufus", "seed" : 8}],
					[ {"name" : "Arnold Palmer", "id" : "arnold-palmer", "seed" : 9}, {"name" : "Ryan Anderson", "id" : "ryan-anderson", "seed" : 10} ],
					[ {"name" : "Jesse James", "id" : "jesse-james", "seed" : 1}, {"name" : "Scott Anderson", "id" : "scott-anderson", "seed" : 12}],
					[ {"name" : "Josh Groben", "id" : "josh-groben", "seed" : 13}, {"name" : "Sammy Zettersten", "id" : "sammy-zettersten", "seed" : 14} ],
					[ {"name" : "Jake Coutry", "id" : "jake-coutry", "seed" : 15}, {"name" : "Spencer Zettersten", "id" : "spencer-zettersten", "seed" : 16}]
				],
				[
					[ {"name" : "Erik Zettersten", "id" : "erik-zettersten", "seed" : 1}, {"name" : "James Coutry", "id" : "james-coutry", "seed" : 3} ],
					[ {"name" : "Anothy Hopkins", "id" : "anthony-hopkins", "seed" : 5}, {"name" : "Teddy Koufus", "id" : "teddy-koufus", "seed" : 8} ],
					[ {"name" : "Ryan Anderson", "id" : "ryan-anderson", "seed" : 10}, {"name" : "Scott Anderson", "id" : "scott-anderson", "seed" : 12} ],
					[ {"name" : "Sammy Zettersten", "id" : "sammy-zettersten", "seed" : 14}, {"name" : "Jake Coutry", "id" : "jake-coutry", "seed" : 15} ]
				],
				[
					[ {"name" : "Erik Zettersten", "id" : "erik-zettersten", "seed" : 1}, {"name" : "Anothy Hopkins", "id" : "anthony-hopkins", "seed" : 5} ],
					[ {"name" : "Ryan Anderson", "id" : "ryan-anderson", "seed" : 10}, {"name" : "Sammy Zettersten", "id" : "sammy-zettersten", "seed" : 14} ]
				],
				[
					[ {"name" : "Erik Zettersten", "id" : "erik-zettersten", "seed" : 1}, {"name" : "Ryan Anderson", "id" : "ryan-anderson", "seed" : 10} ]
				],
				[
					[ {"name" : "Erik Zettersten", "id" : "erik-zettersten", "seed" : 1} ]
				]
			];

			// initializer
			$(".my_gracket").gracket({ src : win.TestData });

		})(window, document, jQuery);
	</script>
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

@endpush

