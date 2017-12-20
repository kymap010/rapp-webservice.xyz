@extends('front.template')

@section('main')

@if(session()->has('error'))
    @include('partials/error', ['type' => 'danger', 'message' => session('error')])
@endif	

	<div class="well well-lg">
		<div class="row">


				<hr>	
				<h2 class="intro-text text-center">{{ trans('front/login.connection') }}</h2>
				<hr>
			    <div class="col-md-4 col-md-offset-4">
				
                {!! Form::open(['url' => 'auth/login', 'method' => 'post', 'role' => 'form']) !!}	
				
				<div class="row">
                    <style>input.btn{width:112px;}</style>
					{!! Form::control('text', 12, 'log', $errors, trans('front/login.log')) !!}
					{!! Form::control('password', 12, 'password', $errors, trans('front/login.password')) !!}
					{!! Form::submit(trans('front/form.login'), ['col-lg-6 col-md-6 col-sm-6 col-xs-6']) !!}
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">	 
                    {!! link_to('auth/register', trans('front/login.registering'), ['class' => 'btn btn-default pull-right']) !!}    
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-left:-15px;">
					{!! Form::check('memory', trans('front/login.remind')) !!}
					{!! Form::text('address', '', ['class' => 'hpet']) !!}	
                    </div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">						
						{!! link_to('password/email', trans('front/login.forget')) !!}
					</div>

				</div>
				
				{!! Form::close() !!}

                </div>
			
		</div>

@stop

