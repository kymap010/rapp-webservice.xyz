@extends('front.template')

@section('main')

@if(session()->has('status'))
    @include('partials/error', ['type' => 'success', 'message' => session('status')])
@endif
@if(session()->has('error'))
    @include('partials/error', ['type' => 'danger', 'message' => session('error')])
@endif
	<div class="well well-lg">
		<div class="row">
			<div class="col-lg-12">

                
                
				<hr>	
				<h2 class="intro-text text-center">{{ trans('front/password.title') }}</h2>
				<hr>
                <div class="col-md-4 col-md-offset-4">
				<p>{{ trans('front/password.info') }}</p>	

				{!! Form::open(['url' => 'password/email', 'method' => 'post', 'role' => 'form']) !!}	

					<div class="row">

						{!! Form::control('email', 12, 'email', $errors, trans('front/password.email')) !!}
						{!! Form::submit(trans('front/form.send'), ['col-lg-12']) !!}
						{!! Form::text('address', '', ['class' => 'hpet']) !!}	
						
					</div>

				{!! Form::close() !!}
                </div>

			</div>
		</div>
	</div>
@stop