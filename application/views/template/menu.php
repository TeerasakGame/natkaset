<style>
   a#colerfont {
        color: #ffffff;
        font-family:'TH SarabunPSK';
        font-size: 22px
    }
    a:hover#colerfont, a:focus#colerfont {
        color: #278FAF;
    }
    .serch{
      padding-left: 5%;
      padding-right: 5%;
    }
    .btn-blue{
    background-color: #278FAF;
    border-color: #278FAF;
    } 

    .badge {
    display: inline-block;
    min-width: 25px;
    padding: 3px 7px;
    font-size: 20px;
    font-weight: bold;
    line-height: 1;
    color: #FFF;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    background-color: #278FAF;
    border-radius: 9px;
    }
</style>

<div id="sidebar-wrapper" style="position: fixed;">

    <h1>menu</h1>           

    <div class = "text-center">
        <img src="<?php echo base_url()?><?php echo $this->session->userdata('mem_pic')?>" class="img-circle" alt="Pic" width="30%" height="30%">
    </div>  

    <div class = "text-center">
        <h3 class = "text_white"><b><?php echo $this->session->userdata('username');?></b></h3>
    </div> 

    <hr width='70%'>
    <form action="<?php echo base_url();?>index.php/sell/feed" method="post" >
    <div class="serch">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="ชื่อสินค้า" name="key"/>
        <span class="input-group-btn">
          <button class="btn btn-blue" id="search" type="summit"><span class="glyphicon glyphicon-search"></span></button>
        </span>
      </div>
    </div>
  </form>
      
      <br>

      <ul class="nav navbar-nav " id="sidenav01">
        <li>
             <a href="<?php echo base_url(); ?>index.php/sell/feed" id="colerfont"><span class="glyphicon glyphicon-home"></span>    หน้าแรก</a>
        </li>
        <li>
          <a href="#" data-toggle="collapse" data-target="#toggleDemo" class="collapsed" id="colerfont">
          <span class="glyphicon glyphicon-list"></span>   ฟีดรายการสินค้า<span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleDemo" style="height: 0px;">
            <ul class="nav nav-list">
              <li>
                <a href="<?php echo base_url(); ?>index.php/sell/feed/10" id="colerfont">ผลไม้</a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>index.php/sell/feed/11" id="colerfont">ผัก</a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>index.php/sell/feed/12" id="colerfont">สัตว์เศษรฐกิจ</a>
              </li>
               <li>
                <a href="<?php echo base_url(); ?>index.php/sell/feed/13" id="colerfont">ไม้ดอกไม้ประดับ</a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>index.php/sell/feed/14" id="colerfont">พิชเศรษฐกิจ</a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>index.php/sell/feed/15" id="colerfont">สินค้าอื่นๆ</a>
              </li>
            </ul>
          </div>
        </li>
        <li>
             <a href="<?php echo base_url(); ?>index.php/sell" id="colerfont"><span class="glyphicon glyphicon-shopping-cart"></span>    ประกาศขายสินค้า</a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/sell/guide" id="colerfont"><span class="glyphicon glyphicon-bullhorn"></span>   แนะนำสินค้า</a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/manage/sell" id="colerfont"><span class="glyphicon glyphicon-cog"></span>   จัดการสินค้า  <span id="time"></span></a>
        </li>
      </ul>

</div>

<script>
  $.ajax({
      url:"<?php echo base_url()?>index.php/manage/set_time",
      //data:"",
      //type:"POST",
      success:function(res){
       //alert(res);
       var html = res;
       $('#time').html(html);
  
      },
      error:function(err){

      }
}); 
</script>

