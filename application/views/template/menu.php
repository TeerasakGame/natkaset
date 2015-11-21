<style>
   a#colerfont {
        color: #ffffff;
        font-family:'TH SarabunPSK';
        font-size: 22px
    }
    a:hover#colerfont, a:focus#colerfont {
        color: #E26A8D;
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
    

      <ul class="nav navbar-nav " id="sidenav01">
        <li>
          <a href="#" data-toggle="collapse" data-target="#toggleDemo" class="collapsed" id="colerfont">
          <span class="glyphicon glyphicon-cloud"></span>   ฟีดรายการสินค้า<span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleDemo" style="height: 0px;">
            <ul class="nav nav-list">
              <li>
                <a href="<?php echo base_url(); ?>index.php/sell/feed" id="colerfont">ผลไม้</a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>index.php/sell/feed" id="colerfont">ผัก</a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>index.php/sell/feed" id="colerfont">สัตว์เศษรฐกิจ</a>
              </li>
               <li>
                <a href="<?php echo base_url(); ?>index.php/sell/feed" id="colerfont">ไม้ดอกไม้ประดับ</a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>index.php/sell/feed" id="colerfont">พิชเศรษฐกิจ</a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>index.php/sell/feed" id="colerfont">สินค้าอื่นๆ</a>
              </li>
            </ul>
          </div>
        </li>
        <li><a href="#" id="colerfont"><span class="glyphicon glyphicon-lock"></span> Normalmenu</a></li>
        <li><a href="#" id="colerfont"><span class="glyphicon glyphicon-calendar"></span> WithBadges <span class="badge pull-right">42</span></a></li>
        <li><a href="" id="colerfont"><span class="glyphicon glyphicon-cog"></span> PreferencesMenu</a></li>
      </ul>

</div>
