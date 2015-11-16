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
  
<div class="well">
    <div class="row">
      <div class="col-md-6">
        <?php $num_pic = count($pic);?>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <?php for($i=1;$i<=$num_pic;$i++){?>
              <?php if($i==1){?>
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <?php }else{ ?> 
                <li data-target="#myCarousel" data-slide-to="<?php echo $i-1; ?>"></li>
              <?php } ?>
            <?php }?>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">

            <?php $j=1;foreach ($pic as $value) { ?>
              <?php if($j==1){?>
                <div class="item active">
                  <img src="<?php echo base_url($value['pic_path'])?>" alt="Chania" width="555" height="345">
                </div>
              <?php }else{ ?>
                <div class="item">
                  <img src="<?php echo base_url($value['pic_path'])?>" alt="Chania" width="555" height="345">
                </div>
              <?php } $j++?>
            <?php } ?>
          
          </div>

          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
     
      </div>
      <div class="col-md-6">
        <div class="col-md-12">
        <h1><b><?php echo $detail[0]['sel_topic'];?></b></h1>
         </br>
         <table class="table table-striped">
          <tbody>
            <tr>
              <td class="col-xs-4">รายละเอียดสินค้า</td>
              <td class="col-xs-8"><?php echo $detail[0]['sel_explain']?></td>
            </tr>
            <tr>
              <td class="col-xs-4">ประเภทการขาย</td>
              <td class="col-xs-8"><?php echo $detail[0]['typ_name']?></td>
            </tr>
            <tr>
              <td class="col-xs-4">ราคา</td>
              <td class="col-xs-8"><?php echo number_format($detail[0]['sel_price']).' '.'บาท';?></td>
            </tr>
            <tr>
              <td class="col-xs-4">ผู้ประกาศ</td>
              <td class="col-xs-8"><?php echo $detail[0]['mem_first_name'].' '.$detail[0]['mem_last_name']?></td>
            </tr>
            <tr>
              <?php $num_con = count($contact);?>
              <td class="col-xs-4" rowspan="<?php echo $num_con;?>">ติดต่อ</td>
              <?php $n=1;foreach ($contact as $value) { ?>
              <?php if($n==1){?>
              <td class="col-xs-8"><?php echo $value['con_data'];?></td>
            </tr>
              <?php }else{?>
              <tr>
                <td class="col-xs-8"><?php echo $value['con_data'];?></td>
              </tr>
              <?php }} ?>
          </tbody>
        </table>
      </div>
    </div>
  </div> 
</div> 