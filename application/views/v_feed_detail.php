<?php
  if(isset($feed_new)){
    $data = $feed_new;
  }
  if(isset($feed_distance)){
    $data = $feed_distance;
  }
  if(isset($feed_like)){
    $data = $feed_like;
  }

  print_r($data);die;
?>

</br>
        <?php $i=1;$num_arr=count($data);foreach ($data as $key) { ?>
            <div class="col-xs-12 well" id="a">
                <?php if($key['sel_promotion'] != null ){?>
                <div class="ribbon"><span>โปรโมชั่น</span></div>
                <?php } ?>
                <div class="col-md-4" id="pic">
                    <center><a href="<?php echo base_url();?>index.php/sell/detail/<?php echo $key['sel_id'];?>"><img src="<?php echo base_url($key['sel_pic'])?>"  width="100%" height="250" ></a></center>
                </div>

                <div class="col-md-8">
                    <div class="col-xs-12">
                      <a href="<?php echo base_url();?>index.php/sell/detail/<?php echo $key['sel_id'];?>"><h2 class = "topic"><?php echo $key['sel_topic']?></h2></a>
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