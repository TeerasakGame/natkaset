<style>
  .well{
      background-color: #FFFFFF;
      /*border-color: #E26A8D;*/
  }
</style>

</br>
<h1>
  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
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
  <table class="table table-bordered">
    <thead>
      <tr>
        <th width="10%"><center>ลำดับ</center></th>
        <th width="15%"><center>รูป</center></th>
        <th width="20%"><center>ชื่อหัวข้อ</center></th>
        <th width="35%"><center>รายละเอียด</center></th>
        <th width="20%"><center>สถานะ</center></th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; foreach ($sell as $row) { ?>
      <tr <?php if($row['sel_status']==0){echo 'bgcolor="#F5F5F5"';}?>>
        <td><center><?php echo $i; ?></center></td>
        <td><center><img src="<?php echo base_url($row['sel_pic'])?>" height="85" width="80%"></center></td>
        <td><?php echo $row['sel_topic']?></td>
        <td>
          <ul>
            <li>รายละเอียด : <?php echo $row['sel_explain']?></li>
            <li>ราคา : <?php echo $row['sel_price']?> บาท</li>
            <?php if($row['sel_promotion'] != null ){ ?>
              <li>โปรโมชั่น : <?php echo $row['sel_promotion']?></li>
            <?php } ?>
            <li>ที่อยู่สินค้า : <?php echo $row['sel_tambon']." ".$row['sel_amphoe']." ".$row['sel_changwat']?></li>
          </ul>
        </td>
        <td align = "center"><a>แก้ไข</a> | <?php if($row['sel_status']==1){?>
          <a href="<?php echo base_url()?>index.php/manage/close_sel/<?php echo $row['sel_id']?>" OnClick='return chk();'>ปิดการขาย</a>
          <?php }else{ ?>
          <a href="<?php echo base_url()?>index.php/manage/open_sel/<?php echo $row['sel_id']?>" OnClick='return chkO();'>เปิดการขาย</a>
          <?php } ?></td>
      </tr>
    <?php $i++ ;} ?>
    </tbody>
  </table>


</div>

<script>
  function chk(){
    if(confirm(' กรุณายืนยันการปิดการขายอีกครั้ง !!! ')){
      return true; // ถ้าตกลง OK โปรแกรมก็จะทำงานต่อไป 
      }else{
      return false; // ถ้าตอบ Cancel ก็คือไม่ต้องทำอะไร 
      }
    }
  function chkO(){
    if(confirm(' กรุณายืนยันการเปิดการขายอีกครั้ง !!! ')){
      return true; // ถ้าตกลง OK โปรแกรมก็จะทำงานต่อไป 
      }else{
      return false; // ถ้าตอบ Cancel ก็คือไม่ต้องทำอะไร 
      }
    }
</script>