@extends('front.template')

@section('main')


<div class="container">
    <div class="well well-lg" id="block-items">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-6">

                <script type="text/javascript" src="//vk.com/js/api/openapi.js?150"></script>

                <script type="text/javascript">
                    VK.init({
                        apiId: 5799373,
                        onlyWidgets: true
                    });
                </script>

                <div id="vk_comments"></div>
                <script type="text/javascript">
                    VK.Widgets.Comments("vk_comments", {
                        limit: 10,
                        attach: "*"
                    });
                </script>
                
            </div>
            <div class="hidden-xs hidden-sm col-md-5 col-lg-6">

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <h3>{{ trans('front/feedback.title') }}</h3>
                            <p>{{ trans('front/feedback.text') }}</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

@stop


