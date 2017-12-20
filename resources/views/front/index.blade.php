@extends('front.template')

@section('main')

<style>

.navbar {
    margin-bottom: 50px;
    border-radius: 0;
}

.slide-image {
    width: 100%;
}

.carousel-holder {
    margin-bottom: 30px;
}

.carousel-control,
.item {
    border-radius: 4px;
}

.carousel{
    margin-top: 20px;
}

.carousel-control {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  width: 15%;
  opacity: .5;
  font-size: 20px;
  color: #fff;
  text-align: center;
  text-shadow: none;
}
.carousel-control.left {
	background-image: none;
}
.carousel-control.right {
  left: auto;
  right: 0;
  background-image: none;
}

.carousel-control {
  padding-top:10.25%;
  width:5%;
}

.carousel .item img {
width: 100%;
height: 100%;
}

.item{
    background: #333;    
    text-align: center;
    height: 300px !important;
}

</style>
<div class="container">        
    <div class="row">
        <div class="col-md-12">
            <div class="row carousel-holder">
                <div class="col-md-12">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="item active">
                                <img class="slide-image" src="img/slide1.jpg" alt="">
                            </div>
                            <div class="item">
                                <img class="slide-image" src="img/slide3.png" alt="">
                            </div>
                        </div>
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  

<div class="container"> 
    <div class="well well-lg">
        <div class="row">
            <div class="col-md-12">
                <div class="row"> 
                <div style="margin-left: 20px;"> 
                <h4>{{ trans('front/index.title') }}</h4>                   
                <p>{{ trans('front/index.text1') }}</p>     
                <p>{{ trans('front/index.text2') }} </p>                    
                </div>                    


                </div>
            </div>
        </div>
    </div>
</div> 



@stop


