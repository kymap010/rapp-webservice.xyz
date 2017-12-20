@extends('front.template')

@section('main')
{!! HTML::style('css/shop-homepage.css') !!}

<div id="alertWindow" class="container hide"> 
    <div class="row text-center">
        <div class="col-md-12">
            <div id="searchAlert" class="alert alert-danger" role="alert">


            </div> 
        </div>
    </div>  
</div>    

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default" style="border:0;">
                        <div class="panel-body" style="padding:0;">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keywords" placeholder="{!! trans('front/site.search') !!}">
                                <div class="input-group-btn">
                                    <button id="search" style="margin-right:1px;" onClick="Search(this)" ; class="btn btn-default">
                                                <i class="glyphicon glyphicon-search"></i>
                                    </button>

                                    <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#FindSetting"> 
                                                <span class="caret"></span>         
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div id="FindSetting" class="panel-footer collapse">
                            <div class="container" id="parameters">
<style>
.nav-tabs > li, .nav-pills > li {
float:none;
display:inline-block;
*display:inline; /* ie7 fix */
zoom:1; /* hasLayout ie7 trigger */
}

.nav-tabs, .nav-pills {
text-align:center;
}
</style>
                                
<ul class="nav nav-tabs" style="margin-left:-30px; margin-right:30px;">
  <li class="active" id="ebaytab"><a data-toggle="tab" href="#ebay" style="padding-bottom:5px; padding-top:5px;"><span style="color:#e53238;">e</span><span style="color:#0964d2;">B</span><span style="color:#f5af02;">a</span><span style="color:#86b817;">y</span></a></li>    
  <li id="alitab"><a data-toggle="tab" href="#ali" style="padding-bottom:5px; padding-top:5px;"><span style="color:#ff9901;">Ali</span><span style="color:#e62e04;">express</span></a></li>
</ul>

<div class="tab-content" style="margin-left:-30px; padding-right:30px;">
  <div id="ebay" class="tab-pane fade in active">
<br>

                                <div class="col-md-4">          
                                    <label>{!! trans('front/search.text-category') !!}</label>
                                      <select class="form-control" id="categoryebay" style="width:280px;">
                                        <option id="None">Все категории</option>
                                        <option id="179">Стационарные ПК и моноблоки</option>
                                        <option id="80053">Мониторы</option>
                                        <option id="177">Ноутбуки и нетбуки PC</option>
                                      </select>
                                    <label style="margin-top:15px;">{!! trans('front/search.text-sort') !!}</label>
                                      <select class="form-control" id="sortOrderebay" style="width:280px;">
                                        <option id="None">Без сортировки</option>
                                        <option id="CurrentPriceHighest">По цене: по возрастанию</option>
                                        <option id="BestMatch">Наивысший рейтинг: по возрастанию</option>
                                        <option id="StartTimeNewest">По времени: новые</option>
                                      </select>
                                </div>
                                <div class="col-md-4">
                                    <label>{!! trans('front/search.text-exclude-seller') !!}</label>
                                      <select class="form-control" id="sellers" style="width:280px;" disabled>
                                        <option id="None">Нет</option>
                                      </select>
                                    <label style="margin-top:15px;">{!! trans('front/search.text-exclude-product') !!}</label>
                                      <select class="form-control" id="products" style="width:280px;" disabled>
                                        <option id="None">Нет</option>
                                      </select>
                                </div>
                                <div class="col-md-3">
                                    <label>{!! trans('front/search.text-min') !!}</label>
                                    <div class="form-group input-group" style="width:280px;">
                                        <span class="input-group-addon">$</span>
                                        <input name="minPriceebay" type="text" value="0" class="form-control">
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                    <label>{!! trans('front/search.text-max') !!}</label>
                                    <div class="form-group input-group" style="width:280px;">
                                        <span class="input-group-addon">$</span>
                                        <input name="maxPriceebay" type="text" value="0" class="form-control">
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                </div>      
      
  </div>
  <div id="ali" class="tab-pane fade">
 <br>
                                <div class="col-md-4">          
                                    <label>{!! trans('front/search.text-category') !!}</label>
                                      <select class="form-control" id="categoryali" style="width:280px;">
                                        <option id="None">Все категории</option>
                                        <option id="502">Электротехнические компоненты</option>
                                        <option id="5">Электротехническое оборудование</option>
                                        <option id="42">Аппаратные средства</option>
                                      </select>
                                    <label style="margin-top:15px;">{!! trans('front/search.text-sort') !!}</label>
                                      <select class="form-control" id="sortOrderali" style="width:280px;">
                                        <option id="None">Без сортировки</option>
                                        <option id="orignalPriceDown">По цене: по возрастанию</option>
                                        <option id="sellerRateDown">Наивысший рейтинг: по возрастанию</option>
                                        <option id="validTimeDown">По времени: новые</option>
                                      </select>
                                </div>
                                <div class="col-md-4">
                                    <label>{!! trans('front/search.text-exclude-seller') !!}</label>
                                      <select class="form-control" id="sellers" style="width:280px;" disabled>
                                        <option id="None">Нет</option>
                                      </select>
                                    <label style="margin-top:15px;">{!! trans('front/search.text-exclude-product') !!}</label>
                                      <select class="form-control" id="products" style="width:280px;" disabled>
                                        <option id="None">Нет</option>
                                      </select>
                                </div>
                                <div class="col-md-3">
                                    <label>{!! trans('front/search.text-min') !!}</label>
                                    <div class="form-group input-group" style="width:280px;">
                                        <span class="input-group-addon">$</span>
                                        <input name="minPriceali" type="text" value="0" class="form-control">
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                    <label>{!! trans('front/search.text-max') !!}</label>
                                    <div class="form-group input-group" style="width:280px;">
                                        <span class="input-group-addon">$</span>
                                        <input name="maxPriceali" type="text" value="0" class="form-control">
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                </div> 
      
      
  </div>
</div>                                
                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
  #parameters {
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
  }
</style>

<div class="container">
    <div class="well well-lg" id="block-items">
        <div class="row">
            <div class="col-md-12">
                <div class="row" id="items">
                </div>
                <div class="row">
                    <div id="howtofind" style="margin-left: 20px;">
                        <h1>{!! trans('front/search.text-h1') !!}</h1>
                        {!! trans('front/search.text1') !!}

                        <h3>{!! trans('front/search.text-h3-1') !!}</h3>
                        <b>{!! trans('front/search.b1') !!}</b>
                        <ol type="1">
                            <li>{!! trans('front/search.li1') !!}</li>
                            <li>{!! trans('front/search.li2') !!}</li>
                            <li>{!! trans('front/search.li3') !!}</li>
                        </ol>
                        <h3>{!! trans('front/search.text-h3-2') !!} </h3>
                        <b>{!! trans('front/search.text2') !!}</b>
                        <ul>
                            <li>{!! trans('front/search.li4') !!}</li>
                            <li>{!! trans('front/search.li5') !!}</li>
                            <li>{!! trans('front/search.li6') !!}</li>
                        </ul>
                        <h3>{!! trans('front/search.text-h3-3') !!} </h3>
                        <b>{!! trans('front/search.text3') !!}</b>
                        <ul>
                            <li>{!! trans('front/search.li7') !!}</li>
                            <li>{!! trans('front/search.li8') !!} <b>';'</b>.</li>
                            <li>{!! trans('front/search.li9') !!}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="pagination" class="text-center hide">
    <div class="btn-group" role="group">
      <button onClick="Search(this)" id="firstPage" type="button" class="btn btn-default">
            <span aria-hidden="true">&laquo;</span>
      </button>

      <button onClick="Search(this)" id="PreviousPage" type="button" class="btn btn-default">
          <span aria-hidden="true">&lsaquo;</span>
      </button>
      <button type="button" class="btn btn-default" disabled>
          <span id="currentPage"></span> {!! trans('front/search.of') !!} <span id="totalPages"></span> {!! trans('front/search.page') !!}
      </button>
      <button onClick="Search(this)" id="NextPage" type="button" class="btn btn-default">
          <span aria-hidden="true">&rsaquo;</span>
      </button>
      <button onClick="Search(this)" id="lastPage" type="button" class="btn btn-default">
          <span aria-hidden="true">&raquo;</span>
      </button>
    </div>
</div>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script> 
<script type="text/javascript"> 
       
    var currentPage = 1;
    var totalPages = 0;
    
    function myalert(text){
        $('#load').remove();
        $("#howtofind").show();
        $("#pagination").addClass("hide");
        $('#searchAlert').empty();
        $("#searchAlert").append(
        "<div style='text-align:center;'>"+text+"</div>"
        );
        $("#alertWindow").removeClass("hide");
        $("#alertWindow").hide().slideDown(500, function () {
        $(this).addClass('in').delay(500).fadeTo(2000, 500).slideUp(500, function () {
        $(this).removeClass('in');
        });
        });
    }
    
    function Search(obj)
    {
        $tabid ='';
        if ($('#alitab').hasClass('active'))
            $tabid = 'ali';
 
        if ($('#ebaytab').hasClass('active'))
            $tabid = 'ebay';
             
        $("#firstPage").attr("disabled", true);
        $("#PreviousPage").attr("disabled", true);
        $("#NextPage").attr("disabled", true);
        $("#lastPage").attr("disabled", true);
        
        $("#"+obj.id).blur(); 
           
        if (obj.id=="search")
        {           
            $("#pagination").removeClass("hide"); 
            $("#pagination").addClass("hide");
        }
            
        $category = $("#category"+$tabid).children(":selected").attr("id");//$('input[name=category]:checked').val();
        $sortOrder = $("#sortOrder"+$tabid).children(":selected").attr("id");//$('input[name=sortOrder]:checked').val();
        
        $minPrice = $('input[name=minPrice'+$tabid+']').val();
        $maxPrice = $('input[name=maxPrice'+$tabid+']').val();
        $keywords = $('input[name=keywords]').val();
       
        if (obj.id=="search" || obj.id=="firstPage") {
        currentPage = 1;
        } else if (obj.id=="NextPage") {
            if (currentPage <= totalPages)
            {
                currentPage = parseInt(currentPage) + 1;
            }
        } else if (obj.id=="PreviousPage") {
            if (currentPage > 1)
                {
                    currentPage -= 1;
                }
        } else if (obj.id=="lastPage") {
        currentPage = totalPages;
        }
  
        if (!$keywords.trim())
        {
            $('#searchAlert').empty();
            $("#searchAlert").append(
            "<div style='text-align:center;'>{!! trans('front/search.error-msg1') !!}</div>"
            );
            $("#alertWindow").removeClass("hide");
            $("#alertWindow").hide().slideDown(500, function () {
                $(this).addClass('in').delay(500).fadeTo(2000, 500).slideUp(500, function () {
                $(this).removeClass('in');
                });
            });
            return;
        }
        
        if (parseInt($minPrice) > parseInt($maxPrice))
        {
            $('#searchAlert').empty();
            $("#searchAlert").append(
            "<div style='text-align:center;'>{!! trans('front/search.error-msg2') !!}</div>"
            );
            $("#alertWindow").removeClass("hide");
            $("#alertWindow").hide().slideDown(500, function () {
                $(this).addClass('in').delay(500).fadeTo(2000, 500).slideUp(500, function () {
                $(this).removeClass('in');
                });
            });
            return;
        }
        
        $url = '';
        if ($('#alitab').hasClass('active'))
        {
            if ($keywords.split(';').length > 1)
                $url = 'searchaliexpress';
            else
                $url = 'searchaliexpresslist';            
        }

        
        if ($('#ebaytab').hasClass('active'))
            $url = 'searchebay';
        
        $("#items").empty();
        $("#howtofind").hide();
        $("#items").append(
            "<div id='load' class='text-center'><img src='img/load.gif'></div>"
        );
        
        $.ajax({
            type: 'get',
            url: $url,
            data: {
                'category':$category,
                'sortOrder': $sortOrder,
                'minPrice':$minPrice,
                'maxPrice':$maxPrice,
                'keywords':$keywords,
                'currentPage':currentPage
            },
            success: function(data){ 
                if ($url == 'searchebay')
                {
                if (data.indexOf('Error') + 1)
                {
                    myalert("{!! trans('front/search.error-msg3') !!}");
                    return;
                }               
                
                if (data == "null")
                {
                    myalert("{!! trans('front/search.error-msg4') !!}");
                    return;
                }
                
                totalPages = JSON.parse(data)["totalPages"];
                currentPage = JSON.parse(data)["curruntPage"];
                $("#totalPages").empty();
                $("#currentPage").empty();
                $("#totalPages").append(totalPages);
                $("#currentPage").append(currentPage);

                
                $.each($.parseJSON(data)["items"], function(idx, obj) {
                    $discount = "";
                       if (JSON.parse(data)["items"][idx]["discount"] != 0) 
                        $discount = "<span class='round-tag'>&nbsp;"+JSON.parse(data)["items"][idx]["discount"]+"%</span>";

                    
                $stars = "";
                for (var i = 0; i < JSON.parse(data)["items"][idx]["evaluetaScore"]; i++) {
                    $stars+="<span class='glyphicon glyphicon-star'></span>";
                }  
                for (var i = JSON.parse(data)["items"][idx]["evaluetaScore"]; i < 5; i++) {
                $stars+="<span class='glyphicon glyphicon-star-empty'></span>";
                } 
                    $("#items").append(
                        "<div class='col-sm-6 col-lg-3 col-md-3'><div class='thumbnail'><div class='post-img-content'><img src='"+JSON.parse(data)["items"][idx]["imageUrl"]+"' alt='' class='img-responsive'>"+$discount+"</div><div class='caption'>                               <h4 class='pull-right'>$"+JSON.parse(data)["items"][idx]["salePrice"]+"</h4><h4><div class='ratings'><p >"+$stars+"</p></div></h4><p style='font-size: 11pt;'>"+JSON.parse(data)["items"][idx]["productTitle"]+"</p></div><span class='input-group-btn'><a href='"+JSON.parse(data)["items"][idx]["productUrl"]+"' target='_blank'><button style='width:100%;' id='"+JSON.parse(data)["items"][idx]["productId"]+"' class='thumbnailbtn btn btn-success pull-right' type='button'><i class='glyphicon glyphicon-list'></i><span class='hidden-md'>{!! trans('front/search.button-more') !!}</span></button></a>       </span>                           </div></div>"  
                    );
                                 
//                    $("#items").append(
//                        "<div class='col-sm-6 col-lg-3 col-md-3'><div class='thumbnail'><div class='post-img-content'><img src='"+JSON.parse(data)["items"][idx]["LinkImage"]+"' alt='' class='img-responsive'>"+$discount+"</div><div class='caption'>                               <h4 class='pull-right'>$"+JSON.parse(data)["items"][idx]["Price"]+"</h4><h4><div class='ratings'><p >"+$stars+"</p></div></h4><p style='font-size: 11pt;'>"+JSON.parse(data)["items"][idx]["Title"]+"</p></div><span class='input-group-btn'><a href='/item/"+JSON.parse(data)["items"][idx]["Id"]+"' target='_blank'><button style='width:100%;' id='"+JSON.parse(data)["items"][idx]["Id"]+"' class='thumbnailbtn btn btn-success pull-right' type='button'><i class='glyphicon glyphicon-list'></i><span class='hidden-md'>Подробнее</span></button></a>       </span>                           </div></div>"  
//                    );
                    //<button class='thumbnailbtn btn btn-success' type='button'><i class='glyphicon glyphicon-star'></i><span class='hidden-md'>Добавить</span></button>
                    
                });
                }
                
                if ($url == 'searchaliexpresslist' || $url == 'searchaliexpress')
                {
                if (data == null)
                {
                    myalert("{!! trans('front/search.error-msg4') !!}");
                    return;                    
                }
                    
                totalPages = data["totalPages"];
                
                if (data["totalPages"] == "0")
                {
                    myalert("{!! trans('front/search.error-msg4') !!}");
                    return;
                }    
                    
                currentPage = data["curruntPage"];
                $("#totalPages").empty();
                $("#currentPage").empty();
                $("#totalPages").append(totalPages);
                $("#currentPage").append(currentPage);


                $.each(data["items"], function(idx) {
                $discount = "";
                if (data["items"][idx]["discount"] != '0%') 
                $discount = "<span class='round-tag'>&nbsp;"+data["items"][idx]["discount"]+"</span>";

                $stars = "";
                $score = parseInt(data["items"][idx]["evaluateScore"]);   
                for (var i = 0; i < $score; i++) {
                $stars+="<span class='glyphicon glyphicon-star'></span>";
                }  
                for (var i = $score; i < 5; i++) {
                $stars+="<span class='glyphicon glyphicon-star-empty'></span>";
                } 
                $("#items").append(
                "<div class='col-sm-6 col-lg-3 col-md-3'><div class='thumbnail'><div class='post-img-content'><img src='"+data["items"][idx]["imageUrl"]+"' alt='' class='img-responsive'>"+$discount+"</div><div class='caption'>                               <h4 class='pull-right'>"+data["items"][idx]["salePrice"]+"</h4><h4><div class='ratings'><p >"+$stars+"</p></div></h4><p style='font-size: 11pt;'>"+data["items"][idx]["productTitle"]+"</p></div><span class='input-group-btn'><a href='"+data["items"][idx]["productUrl"]+"' target='_blank'><button style='width:100%;' id='"+data["items"][idx]["productId"]+"' class='thumbnailbtn btn btn-success pull-right' type='button'><i class='glyphicon glyphicon-list'></i><span class='hidden-md'>{!! trans('front/search.button-more') !!}</span></button></a>       </span>                           </div></div>"  
                );
                });
                    
                    
                }
                
                $('#load').remove();
                $("#pagination").removeClass("hide"); 
                        
                $("#firstPage").removeAttr("disabled");
                $("#PreviousPage").removeAttr("disabled");
                $("#NextPage").removeAttr("disabled");
                $("#lastPage").removeAttr("disabled");
            }
        });  
    }
     
</script>


@stop


