@extends('front.template')

@section('main')

<style>

.thumbnail img {
    width: 100%;
    height: 350px;
}

.ratings {
    padding-right: 10px;
    padding-left: 10px;
    color: #d17581;
}

.thumbnail {
    padding: 0;
}

.thumbnail .caption-full {
    padding: 9px;
    color: #333;
}

footer {
    margin: 50px 0;
}
    
</style>

<div class="container">

        <div class="row">
            <div class="col-md-12">

                <div class="thumbnail">
                    <div class="row caption-full">
                        <div class="col-md-8 col-xs-8 col-sm-8 col-lg-8">
                            <h4><span id="itemTitle">php echo $data_item['title']; </span></h4>
                        </div>  
                        <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">

                            
                        </div>
                    </div> 
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <img style="height:425px; " class="img-responsive" src="<?php echo $data_item['pictureURLLarge']; ?>" alt="">
                        </div>   
                        <div class="col-md-6" style="display:inline-block;">           
                            <h2 style="padding-right: 10px; padding-left: 10px;"><span id="currentPrice">$<?php echo $data_item['currentPrice']; ?></span></h2>
                            <br>
                            <h4 style="padding-right: 10px; padding-left: 10px;">Êîä òîâàðà: <span id="itemId"><?php echo $data_item['itemId']; ?></span></h4>
                            <h4 style="padding-right: 10px; padding-left: 10px;">Ñïîñîá îïëàòû: <span id="paymentMethod"><?php foreach($data_item['paymentMethod'] as $paymant) {echo $paymant . " "; }?></span></h4>
                            <h4 style="padding-right: 10px; padding-left: 10px;"><a href="<?php echo $data_item['viewItemURL']; ?>" target="_blank" id="viewItemURL">Ñìîòðåòü íà ebay</a></h4>
                        </div>
                    </div>
                    <hr>
                    <div class="row caption-full">
                        <div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
                            <h4 style="padding-right: 10px; padding-left: 10px;">Ïðîäàâåö: <span id="storeName"><?php echo $data_item['storeName']; ?></span></h4>   
                        </div>
                        <div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
                            <h4>Ìåñòîíàõîæäåíèå: <span id="location"><a href="https://yandex.ru/maps/?mode=search&text=<?php echo $data_item['location']; ?>" target="_blank"><?php echo $data_item['location']; ?></a></span> </h4>   
                        </div>
                    </div>                   
                    <hr>
                    <div class="ratings" >
                        <p class="pull-right">Êîììåíòàðèé: <span id="countFeedBack"><?php echo $data['countComment']; ?></span></p>
                        <p>
                            <? if ($data_item['Stars'] != 0)
                            {
                            for ($x=0; $x<$data_item['Stars']; $x++) 
                            {
                            ?><span class="glyphicon glyphicon-star"></span><?
                            }
                            for ($x=$data_item['Stars']; $x<5; $x++) 
                            {
                            ?><span class="glyphicon glyphicon-star-empty"></span><?
                            }                
                            }else{
                            for ($x=$data_item['Stars']; $x<5; $x++) 
                            {
                            ?><span class="glyphicon glyphicon-star-empty"></span><?
                            }            
                            }
                            ?>
                            &nbsp;&nbsp;<?php echo $data_item['Stars']; ?>.0
                        </p>
                    </div>
                </div>


                <div class="well">  
                <?php if (checkUser() == "navbarUserLogout_view.php"){ ?>    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comment">Îáñóäèòå ýòîò òîâàð ñ äðóãèìè ïîëüçîâàòåëÿìè</label>
                                <textarea style="resize: none; margin-top:10px;" class="form-control" rows="5" id="comment"></textarea>
                            </div>

<div id="alertWindow" class="hide"> 
<div id="searchAlert" class="alert alert-danger" role="alert">

</div>  
</div> 
                        </div>
                        <div class="col-md-12">
                            <button id="comment_button" type="button" onClick="AddComment()" class="btn btn-success pull-right">Îñòàâèòü êîììåíòàðèé</button>                 
                        </div>                 
                    </div>
                <?php }else{ echo "                                <label for='comment'>Îáñóäèòå ýòîò òîâàð ñ äðóãèìè ïîëüçîâàòåëÿìè</label>"; } ?>    
                    
<?php                    
	foreach($data["comments"] as $row)
	{
echo "<hr><div class='row'><div class='col-md-12'><b>".$row['name'].":</b><span class='pull-right'>".$row['comment_date']."</span><p>".$row['comment_text']."</p></div></div>";

	}  
?>                    
                </div>

            </div>

        </div>

</div>




<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script> 

<script type="text/javascript">
    function AddComment()
    {
           
        $("#comment_button").blur();   
        $comment = $("#comment").val();
        $item_id = $("#itemId").text();
        $item_title = $("#itemTitle").text();
        //alert($comment);
        //alert($item_id);
        //alert($item_title);
        
            $.ajax({
              type: 'post',
              url: '/scripts/AddComment.php',
              data: {
                  'comment':$comment, 
                  'item_id':$item_id,
                  'item_title': $item_title,
              },
              success: function(data){ 
                  if (JSON.parse(data)['completed'] == "false")
                      {
                          myalert("Ââåäèòå òåêñò êîììåíòàðèÿ!"); 
                      }else{
                          location.reload();
                      }
                     
             }
           });

     }
    
    function AddFavorite(obj)
    {
        $("#"+obj.id).attr("disabled", true);
        
        $item_id = $("#itemId").text();

        //alert($item_id);
        
            $.ajax({
              type: 'post',
              url: '/scripts/AddFavorite.php',
              data: {
                  'item_id':$item_id
              },
              success: function(data){ 
                  //alert(data);
                  if (JSON.parse(data)['completed'] == "false")
                      {
                          //alert("ÎØÈÁÊÀ"); 
                      }else{
                          //alert("ÓÑÏÅÕ")
                          location.reload();
                      }
                     
             }
           });

     }    
    
     function myalert(text){

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
          
</script>

@stop


