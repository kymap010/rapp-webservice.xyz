<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>{{ trans('front/site.title') }}</title>
		<meta name="description" content="">	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		@yield('head')

		{!! HTML::style('css/main_front.css') !!}

		<!--[if (lt IE 9) & (!IEMobile)]>
			{!! HTML::script('js/vendor/respond.min.js') !!}
		<![endif]-->
		<!--[if lt IE 9]>
			{!! HTML::style('https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js') !!}
			{!! HTML::style('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') !!}
		<![endif]-->

		{!! HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800') !!}
		{!! HTML::style('http://fonts.googleapis.com/css?family=Open+Sans+Condensed:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic') !!}

	</head>

  <body>

	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<header role="banner">
        <div class="brand">
            <span style="color:#ff9901;">Ali</span><span style="color:#e62e04;">express</span>
            <span style="color:#777;">vs</span>
            <span style="color:#e53238;">e</span><span style="color:#0964d2;">B</span><span style="color:#f5af02;">a</span><span style="color:#86b817;">y</span>
        </div>
		<div class="address-bar" style="text-shadow: black 0 0 20px;color:#777;">{{ trans('front/site.sub-title') }}</div>
		<div id="flags" class="text-center"></div>
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container" style="margin-bottom:-7px;">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html">{{ trans('front/site.title') }}</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
                        
                        <li {!! classActivePath('/') !!} class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{!! trans('front/site.home') !!} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li {!! classActivePath('/') !!}>{!! link_to('/', trans('front/site.home')) !!}</li>
                                <li {!! classActiveSegment(1, ['articles', 'blog']) !!}>{!! link_to('articles', trans('front/site.blog')) !!}</li>   
                                
                                @if(session('statut') == 'admin')
                                    <li role="separator" class="divider"></li>
									<li>
										{!! link_to_route('admin', trans('front/site.administration')) !!}
									</li>
								@elseif(session('statut') == 'redac') 
                                    <li role="separator" class="divider"></li>
									<li>
										{!! link_to('blog', trans('front/site.redaction')) !!}
									</li>
								@endif 
                                <li role="separator" class="divider"></li>
                                @if(session('statut') == 'visitor' || session('statut') == 'user')
                                    <li {!! classActivePath('contact/create') !!}>
                                        {!! link_to('contact/create', trans('front/site.contact')) !!}
                                    </li>
                                @endif 
                                <li {!! classActivePath('feedback') !!}>
                                    {!! link_to('feedback', trans('front/site.feedback')) !!}
                                </li>
                            </ul>
                        </li>


                        <li {!! classActivePath('search') !!}>
							{!! link_to('search', trans('front/site.search')) !!}
						</li>
                       
						@if(Request::is('auth/register'))
							<li class="active">
								{!! link_to('auth/register', trans('front/site.register')) !!}
							</li>
						@elseif(Request::is('password/email'))
							<li class="active">
								{!! link_to('password/email', trans('front/site.forget-password')) !!}
							</li>
						@else
							@if(session('statut') == 'visitor')
								<li {!! classActivePath('auth/login') !!}>
									{!! link_to('auth/login', trans('front/site.connection')) !!}
								</li>
							@else
								<li>
									{!! link_to('auth/logout', trans('front/site.logout')) !!}
								</li>
							@endif
						@endif
						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#"><img width="32" height="32" alt="{{ session('locale') }}"  src="{!! asset('img/' . session('locale') . '-flag.png') !!}" onerror="this.src = 'img/ru-flag.png'" />&nbsp; <b class="caret"></b></a>
							<ul class="dropdown-menu">
							@foreach ( config('app.languages') as $user)
								@if($user !== config('app.locale'))
									<li><a href="{!! url('language') !!}/{{ $user }}"><img width="32" height="32" alt="{{ $user }}" src="{!! asset('img/' . $user . '-flag.png') !!}"></a></li>
								@endif
							@endforeach
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		@yield('header')	
	</header>

	<main role="main" class="container" style="min-height:55vh">
		@if(session()->has('ok'))
			@include('partials/error', ['type' => 'success', 'message' => session('ok')])
		@endif	
		@if(isset($info))
			@include('partials/error', ['type' => 'info', 'message' => $info])
		@endif  
		@yield('main')     
	</main>
       
	<footer class="footer" style="margin-bottom:0px;">
		 @yield('footer')
		<p class="text-center"><small style="color:white;">{{ trans('front/site.copyright') }} &copy; 2017</small></p>
	</footer>

	{!! HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') !!}
	<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
	{!! HTML::script('js/plugins.js') !!}
	{!! HTML::script('js/main.js') !!}

	<script>
		(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
		function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
		e=o.createElement(i);r=o.getElementsByTagName(i)[0];
		e.src='//www.google-analytics.com/analytics.js';
		r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
		ga('create','UA-89591453-1');ga('send','pageview');
	</script>

	@yield('scripts')

  </body>
</html>