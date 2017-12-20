@extends('front.template')

@section('main')

<div class="container"> 
    <div class="well well-lg">
        <div class="row">
            <div class="col-md-12">
                <div class="row text-center"> 
                  <div class="inner cover">
                    <h1 class="cover-heading">{{ trans('front/missing.error-404') }}</h1>
                    <p class="lead">{{ trans('front/missing.info') }}</p>
                    <p class="lead">
                      <a href="{!! url('/') !!}" class="btn btn-lg btn-default">{{ trans('front/missing.button') }}</a>
                    </p>
                  </div>

                </div>
            </div>
        </div>
    </div>
</div> 

@stop


