<div class="col-lg-3">

</div>
<div class="col-lg-6 well">
	<?php
	    if(isset($content_text)){
	        echo '<center><h1><b>'.$content_text.'</b></h1></center>';
	    }
	?> 
	<hr>
	<div class="container col-lg-12">
		
		<?php echo validation_errors(); ?>

		<?php echo form_open('auth/register', 'class="form-horizontal"');?>
		<!--<form class="form-horizontal" data-toggle="validator" action = "<?php echo base_url(); ?>index.php/auth/add_register" method = "post">-->
			<div class="form-group">
			   <label>ชื่อ</label>
			   <input type="text" class="form-control"  placeholder="ชื่อจริง" name = "f_name" value="<?php echo set_value('f_name'); ?>">
			</div>
			<div class="form-group">
			   <label>นามสกุล</label>
			   <input type="text" class="form-control" placeholder="นามสกุล" name = "l_name" value="<?php echo set_value('l_name'); ?>">
			</div>
			<div class="form-group">
				<label>อีเมล</label>
				<input type="email" class="form-control"  placeholder="test@test.com" name = "email" value="<?php echo set_value('email'); ?>">
			</div>
			<div class="form-group">
				<label>รหัสผ่าน</label>
				<input type="password" class="form-control"  placeholder="รหัสผ่าน" name = "password1" value="<?php echo set_value('password1'); ?>">
			</div>
			<div class="form-group">
				<label>ยืนยันรหัสผ่าน</label>
				<input type="password" class="form-control"  placeholder="รหัสผ่าน" name = "password2" value="<?php echo set_value('password2'); ?>">
			</div>
		</br>
			<div class="form-group footer"> 
				<center><button type="submit" class="btn btn-success btn-block">สมัครใช้บริการ</button></center>
			</div>
		</form>
	</div>
</div>
<!--<div class="col-lg-8">
	<div class="container col-lg-12 well">
		<h1>สมัครสมาชิกแล้วได้อะไร</h1>

	</div>

</div>-->

<div class="col-lg-3">

</div>

