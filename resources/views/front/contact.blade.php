@extends('front.template')

@section('main')

<div class="container"> 
    <div class="well well-lg">
        <div class="row">
            <div class="col-md-12">
                <div class="row"> 
                <div style="margin-left: 20px;"> 
				<hr>	
				<h2 class="intro-text text-center">{{ trans('front/contact.title') }}</h2>
				<hr> 
				<p>{{ trans('front/contact.text') }}</p>				
				
				{!! Form::open(['url' => 'contact', 'method' => 'post', 'role' => 'form']) !!}	
				
					<div class="row">
                        <style>textarea{resize: none;}</style>
						{!! Form::control('text', 6, 'name', $errors, trans('front/contact.name')) !!}
						{!! Form::control('email', 6, 'email', $errors, trans('front/contact.email')) !!}
						{!! Form::control('textarea', 12, 'message', $errors, trans('front/contact.message')) !!}
						{!! Form::text('address', '', ['class' => 'hpet']) !!}		

					  	{!! Form::submit(trans('front/form.send'), ['col-lg-12']) !!}

					</div>
					
				{!! Form::close() !!}                    
                </div>                    


                </div>
            </div>
        </div>
    </div>
</div> 

@stop