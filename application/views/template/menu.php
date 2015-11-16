<div id="sidebar-wrapper" style="position: fixed;">
    <ul class="sidebar-nav">
        <h1>menu</h1>

        

        <div class = "text-center">
   
                <img src="<?php echo base_url()?><?php echo $this->session->userdata('mem_pic')?>" class="img-circle" alt="Pic" width="30%" height="30%">
          

        </div>  

        <div class = "text-center">
            <h3 class = "text_white"><b><?php echo $this->session->userdata('username');?></b></h3>
        </div> 

        <hr width='70%'>

        <li>
            <a href="<?php echo base_url(); ?>index.php/sell/feed" class = "menu">ฟีดรายการสินค้า</a>
        </li>
        
        <!--<li>
            <font color="#FFF2DF"><p class = "menu">โพสต์สินค้า</p></font>
        </li>
        <li class = "menu">
            <ul>
              <li><a href="<?php //echo base_url(); ?>sell">ประกาศขายสินค้า</a></li>
              <li><a href="#">Submenu 1-2</a></li>
            </ul>
        </li>-->
        <li>
            <a href="<?php echo base_url(); ?>index.php/sell" class = "menu">ประกาศขายสินค้า</a>
        </li>

        <li>
            <a href="<?php echo base_url(); ?>index.php/sell/guide" class = "menu">แนะนำสินค้า</a>
        </li>

        <li>
            <a href="<?php echo base_url(); ?>index.php/manage/sell" class = "menu">รายการสินค้าที่ประกาศขาย</a>
        </li>




    </ul>
</div>                