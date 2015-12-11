<style>
  #a {
      background-color: #FFFFFF;
      /*border-color: #E26A8D;*/
  }
  #b {
      background-color: #DCDCDC;
      /*border-color: #E26A8D;*/
  }
  .topic{
    margin-top:5px;
  }
  #pic{
    margin-top: 20px;
    margin-bottom: 20px;
  }
  .btn-pink{
    background-color: #E26A8D;
    border-color: #E26A8D;
  } 


</style>
</br>
<h1>
  <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
  <font color="ED6188">
  <b>
    <?php
       if(isset($content_text)){
         echo ' '.$content_text;
       }
    ?> 
  </b>
  </font>
</h1>
<?php if($this->session->userdata('mem_id') == Null){ ?>
<div class="row">
  <div class="col-md-8">
  </div>
  <div class="col-md-4 text-right">
    <form action="<?php echo base_url();?>index.php/sell/feed" method="post" >
        <div class="input-group">
          <input type="text" class="form-control" placeholder="ชื่อสินค้า" name="key"/>
          <span class="input-group-btn">
            <button class="btn btn-pink" id="search" type="summit"><span class="glyphicon glyphicon-search"></span></button>
          </span>
        </div>
    </form>
  </div>
</div>
<?php } ?>
  
<?php
/*$xml=simplexml_load_file("http://www.dit.go.th/pricestat/index3.asp?m=A&p=%A1%C3%D0%E0%A8%D5%EA%C2%BA%E1%B4%A7%20%E1%CB%E9%A7");
echo "<pre>";
print_r($xml);
echo "</pre>";*/
 //echo "555  ".$this->session->userdata('lat');
?>
  
  <ul class="nav nav-tabs">
    <li class="active"><a href="#A" data-toggle="tab">ล่าสุด</a></li>
    <li><a href="#B" data-toggle="tab">ระยะทาง</a></li>
    <li><a href="#C" data-toggle="tab">ยอดนิยม</a></li>
  </ul>


  <div class="tabbable">
    <div class="tab-content">
      <div class="tab-pane active " id="A">
        </br>
      
        <?php foreach ($feed_new as $key) { ?>
            <div class="col-xs-12 well"  <?php if($key['sel_status'] == 0){echo 'id="b"';}else{echo 'id="a"';}?>>
                <?php if($key['sel_promotion'] != null ){?>
                <div class="ribbon"><span>โปรโมชั่น</span></div>
                <?php } ?>
                <div class="col-md-4" id="pic">
                    <center><a href="<?php echo base_url();?>index.php/sell/detail/<?php echo $key['sel_id'];?>"><img src="<?php echo base_url($key['sel_pic'])?>"   height="250" width="95%"></a></center>
                </div>

                <div class="col-md-8">
                    <div class="col-xs-12">
                      <a href="<?php echo base_url();?>index.php/sell/detail/<?php echo $key['sel_id'];?>"><h2 class = "topic"><?php if($key['sel_status'] == 0){echo "[ปิดการขาย] ";}?><?php echo $key['sel_topic'];?></h2></a>
                      <div class="well">
                        <table class="table table-striped" >
                          <tbody>
                            <tr>
                              <td class="col-xs-4"><b>รายละเอียดสินค้า</b></td>
                              <td class="col-xs-8"><?php echo $key['sel_explain']?></td>
                            </tr>
                            <?php if($key['sel_promotion'] != null ){?>
                            <tr>
                              <td class="col-xs-4"><b>โปรโมชั่น</b></td>
                              <td class="col-xs-8"><?php echo $key['sel_promotion'];?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                              <td class="col-xs-4"><b>ราคา</b></td>
                              <td class="col-xs-8"><FONT SIZE=4><?php echo number_format($key['sel_price']);?></FONT>&nbsp&nbsp บาท</td>
                            </tr>
                            <tr>
                              <td class="col-xs-4"><b>ระยะทางโดยประมาณ</b></td>
                              <td class="col-xs-8"><FONT SIZE=4><?php echo $key['dis_val']?></FONT>&nbsp&nbsp กม.</td>
                            </tr>
                            <tr>
                              <td class="col-xs-4"><b>ความนิยม</b></td>
                              <td class="col-xs-8"><FONT SIZE=4><?php echo $key['count_like']?></FONT></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                 
                    <div class="col-xs-12" >
                      <div class="media">
                        <div class="media-body">
                          <div class="text-right">
                          <h3 class="media-heading"><?php echo $key['mem_first_name'].' '.$key['mem_last_name']?></h3>
                          <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>&nbsp<?php echo $key['sel_tambon'].' '.$key['sel_amphoe'].' '.$key['sel_changwat']?>
                        </div>
                        </div>
                        <div class="media-right">
                          <a href="#">
                            <img class="media-object img-circle" src="<?php echo base_url()?><?php echo $key['mem_pic']?>" width="60" height="60">
                          </a>
                        </div>
                      </div>
                    </div>
                </div><!-- col-8 -->
              </div><!-- col-12 -->
       
  
        <?php } ?>
      </div>

      <div class="tab-pane" id="B">
        <!--</br>

         <?php $j=1;$num_arr_2=count($feed_distance);foreach ($feed_distance as $key) { ?>

          <?php if( $j%3 ==1){echo '<div class="row">';}?>

          <div class="col-md-4">
              <div class="thumbnail">
                <a href="<?php echo base_url();?>index.php/sell/detail/<?php echo $key['sel_id'];?>"  id="ok" data-value="<?php echo $key['sel_id'];?>"><img src="<?php echo base_url($key['sel_pic'])?>" ></a>
                <div class="caption">
                  <a href="<?php echo base_url();?>index.php/sell/detail/<?php echo $key['sel_id'];?>" id="ok" data-value="<?php echo $key['sel_id'];?>"><h2><?php echo $key['sel_topic']?></h2></a>
               
                  <p>
                    <div class="row">
                      <div class="col-xs-2"> 
                        <img src="<?php echo base_url();?>upload/img/Price Tag-32.png">
                      </div>
                      <div class="col-xs-10"> 
                        <FONT SIZE=5><?php echo number_format($key['sel_price'])?></FONT><FONT SIZE=3>&nbsp&nbsp บาท.</FONT>
                      </div>
                    </div>
                  </p>
                  <p>
                    <div class="row">
                      <div class="col-xs-2"> 
                        <img src="<?php echo base_url();?>upload/img/Length-24.png">
                      </div>
                      <div class="col-xs-10"> 
                        ระยะห่างโดยประมาณ &nbsp&nbsp<FONT SIZE=3><?php echo $key['dis_val']?>&nbsp&nbsp กม.</FONT>
                      </div>
                    </div>  
                  </p>
                  <hr>
               
                  <p>
                    <div class="row">
                      <div class="col-xs-3"> 
                        <img src="<?php echo base_url()?><?php echo $key['mem_pic']?>" class="img-circle" alt="Pic" width="80%" height="80%">
                      </div>
                      <div class="col-xs-9"> 
                        <div class="row-fluid">
                          <div class="span8"><?php echo $key['mem_first_name'].' '.$key['mem_last_name']?></div>
                          <div class="span8"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>&nbsp<?php echo $key['sel_tambon'].' '.$key['sel_amphoe'].' '.$key['sel_changwat']?></div>
                        </div>
                    </div>
                  </div>
                  </p>
                </div>
              </div>
            </div>

            <?php if($j%3 == 0 && $j != $num_arr){echo '</div>';}?>
            <?php if($j == $num_arr && $j=1){echo '</div>';}?>

            

            <?php $j++?>
            
          <?php } ?>-->

          </br>
        <?php foreach ($feed_distance as $key) { ?>
            <div class="col-xs-12 well" id="a">
                <?php if($key['sel_promotion'] != null ){?>
                <div class="ribbon"><span>โปรโมชั่น</span></div>
                <?php } ?>
                <div class="col-md-4" id="pic">
                    <center><a href="<?php echo base_url();?>index.php/sell/detail/<?php echo $key['sel_id'];?>"><img src="<?php echo base_url($key['sel_pic'])?>"  height="250" width="95%"></a></center>
                </div>

                <div class="col-md-8">
                    <div class="col-xs-12">
                      <a href="<?php echo base_url();?>index.php/sell/detail/<?php echo $key['sel_id'];?>"><h2 class = "topic"><?php if($key['sel_status'] == 0){echo "[ปิดการขาย] ";}?><?php echo $key['sel_topic']?></h2></a>
                      <div class="well">
                        <table class="table table-striped">
                          <tbody>
                            <tr>
                              <td class="col-xs-4"><b>รายละเอียดสินค้า</b></td>
                              <td class="col-xs-8"><?php echo $key['sel_explain']?></td>
                            </tr>
                            <?php if($key['sel_promotion'] != null ){?>
                            <tr>
                              <td class="col-xs-4"><b>โปรโมชั่น</b></td>
                              <td class="col-xs-8"><?php echo $key['sel_promotion'];?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                              <td class="col-xs-4"><b>ราคา</b></td>
                              <td class="col-xs-8"><FONT SIZE=4><?php echo number_format($key['sel_price']);?></FONT>&nbsp&nbsp บาท</td>
                            </tr>
                            <tr>
                              <td class="col-xs-4"><b>ระยะทางโดยประมาณ</b></td>
                              <td class="col-xs-8"><FONT SIZE=4><?php echo $key['dis_val']?></FONT>&nbsp&nbsp กม.</td>
                            </tr>
                            <tr>
                              <td class="col-xs-4"><b>ความนิยม</b></td>
                              <td class="col-xs-8"><FONT SIZE=4><?php echo $key['count_like']?></FONT></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                 
                    <div class="col-xs-12" >
                      <div class="media">
                        <div class="media-body">
                          <div class="text-right">
                          <h3 class="media-heading"><?php echo $key['mem_first_name'].' '.$key['mem_last_name']?></h3>
                          <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>&nbsp<?php echo $key['sel_tambon'].' '.$key['sel_amphoe'].' '.$key['sel_changwat']?>
                        </div>
                        </div>
                        <div class="media-right">
                          <a href="#">
                            <img class="media-object img-circle" src="<?php echo base_url()?><?php echo $key['mem_pic']?>" width="60" height="60">
                          </a>
                        </div>
                      </div>
                    </div>
                </div><!-- col-8 -->
              </div><!-- col-12 -->
       
  
        <?php } ?>
      
      


      </div>

      <div class="tab-pane" id="C">
        </br>
        <?php foreach ($feed_like as $key) { ?>
            <div class="col-xs-12 well" id="a">
                <?php if($key['sel_promotion'] != null ){?>
                <div class="ribbon"><span>โปรโมชั่น</span></div>
                <?php } ?>
                <div class="col-md-4" id="pic">
                    <center><a href="<?php echo base_url();?>index.php/sell/detail/<?php echo $key['sel_id'];?>"><img src="<?php echo base_url($key['sel_pic'])?>" height="250" width="95%"></a></center>
                </div>

                <div class="col-md-8">
                    <div class="col-xs-12">
                      <a href="<?php echo base_url();?>index.php/sell/detail/<?php echo $key['sel_id'];?>"><h2 class = "topic"><?php if($key['sel_status'] == 0){echo "[ปิดการขาย] ";}?><?php echo $key['sel_topic']?></h2></a>
                      <div class="well">
                        <table class="table table-striped">
                          <tbody>
                            <tr>
                              <td class="col-xs-4"><b>รายละเอียดสินค้า</b></td>
                              <td class="col-xs-8"><?php echo $key['sel_explain']?></td>
                            </tr>
                            <?php if($key['sel_promotion'] != null ){?>
                            <tr>
                              <td class="col-xs-4"><b>โปรโมชั่น</b></td>
                              <td class="col-xs-8"><?php echo $key['sel_promotion'];?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                              <td class="col-xs-4"><b>ราคา</b></td>
                              <td class="col-xs-8"><FONT SIZE=4><?php echo number_format($key['sel_price']);?></FONT>&nbsp&nbsp บาท</td>
                            </tr>
                            <tr>
                              <td class="col-xs-4"><b>ระยะทางโดยประมาณ</b></td>
                              <td class="col-xs-8"><FONT SIZE=4><?php echo $key['dis_val']?></FONT>&nbsp&nbsp กม.</td>
                            </tr>
                            <tr>
                              <td class="col-xs-4"><b>ความนิยม</b></td>
                              <td class="col-xs-8"><FONT SIZE=4><?php echo $key['count_like']?></FONT></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                 
                    <div class="col-xs-12" >
                      <div class="media">
                        <div class="media-body">
                          <div class="text-right">
                          <h3 class="media-heading"><?php echo $key['mem_first_name'].' '.$key['mem_last_name']?></h3>
                          <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>&nbsp<?php echo $key['sel_tambon'].' '.$key['sel_amphoe'].' '.$key['sel_changwat']?>
                        </div>
                        </div>
                        <div class="media-right">
                          <a href="#">
                            <img class="media-object img-circle" src="<?php echo base_url()?><?php echo $key['mem_pic']?>" width="60" height="60">
                          </a>
                        </div>
                      </div>
                    </div>
                </div><!-- col-8 -->
              </div><!-- col-12 -->
       
  
        <?php } ?>
      
      
      </div> <!-- tab C-->

    </div><!-- tab content -->
  </div><!-- tab -->
<input type="hidden" id="check" value="<?php echo $this->session->userdata('lat') ?>">
<script>
    if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(position){
                //alert(position.coords.latitude+"  "+position.coords.longitude);
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                $("#lat").val(latitude);
                $("#lon").val(longitude);

                $.ajax({
                  url:"<?php echo base_url()?>index.php/home/test",
                  data:"lat="+latitude+"&log="+longitude,
                  type:"POST",
                  //dataTypr:"json",
                  success:function(res){
                    //alert(res);
                    var check = $("#check").val();
                    if(check == null || check == ""){
                     // alert(check);
                      location.reload();
                    }
                    //alert(check);
                  },
                  error:function(err){

                  }
                });  

            },function() {
                // คำสั่งทำงาน ถ้า ระบบระบุตำแหน่ง geolocation ผิดพลาด หรือไม่ทำงาน
               // alert('ไม่สามารถระบุตำแหน่งปัจจุบันของคุณได้ ระบบจะระบุตำแหน่งที่ "อนุสาวรีชัยสมรภูมิ"');
                $.ajax({
                    url:"<?php echo base_url()?>index.php/home/test",
                    data:"lat="+13.765205+"&log="+100.538306,
                    type:"POST",
                    //dataTypr:"json",
                    success:function(res){
                       // alert(res);
                      var check = $("#check").val();
                      if(check == null || check == ""){
                       // alert(check);
                        location.reload();
                      }
                    },
                    error:function(err){

                    }
                 });
            });
    }else{
        // คำสั่งทำงาน ถ้า บราวเซอร์ ไม่สนับสนุน ระบุตำแหน่ง
        ///alert('ไม่สามารถระบุตำแหน่งปัจจุบันของคุณได้ ระบบจะระบุตำแหน่งที่ "อนุสาวรีชัยสมรภูมิ"');
                $.ajax({
                    url:"<?php echo base_url()?>index.php/home/test",
                    data:"lat="+13.765205+"&log="+100.538306,
                    type:"POST",
                    //dataTypr:"json",
                    success:function(res){
                       // alert(res);
                      var check = $("#check").val();
                      if(check == null || check == ""){
                       // alert(check);
                        location.reload();
                      }
                    },
                    error:function(err){

                    }
                 });
    }
  
    
</script>