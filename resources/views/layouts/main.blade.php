<!DOCTYPE html>
<html dir="ltr" lang="PT-BR">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>@yield('title')</title>

		<!-- Custom CSS -->
		<link href="/assets/libs/flot/css/float-chart.css" rel="stylesheet" />
		<link href="/dist/css/style.min.css" rel="stylesheet" />
		<link href="/css/myStyle.css" rel="stylesheet" />

	</head>

	<body>
		<div class="preloader">
			<div class="lds-ripple">
				<div class="lds-pos"></div>
				<div class="lds-pos"></div>
			</div>
		</div>
		<header class="topbar" data-navbarbg="skin5">
			<nav class="navbar top-navbar navbar-expand-md navbar-dark navMain">
				<div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
					<ul class="navbar-nav float-start me-auto">
						<h1 class="text-center" id="titulo">XPTO</h1>
					</ul>
					<ul class="navbar-nav float-end mr-50">
						<li class="nav-item dropdown">
							<form action="/logout" method="post" id='logout'>
							  	@csrf
							    <button type="submit" class="mainBtn">Sair</button>
							</form>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<div class="wrapper">
			<div class="container-fluid cf-main">
				@if(session('msg'))
					<p class="msg">{{ session('msg') }}</p>
				@endif

				@yield('content')
			</div>
			<footer class="footer text-center sticky-footer" >

			</footer>
		</div>

		{{-- SCRIPTS --}}
		<script src="/assets/libs/jquery/dist/jquery.min.js"></script>

		<!-- Bootstrap tether Core JavaScript -->
		<script src="/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
		<script src="/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>

		<!--Wave Effects -->
		<script src="/dist/js/waves.js"></script>

		<!--Custom JavaScript -->
		<script src="/dist/js/custom.min.js"></script>

	</body>
</html>
