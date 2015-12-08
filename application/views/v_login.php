<div class="col-lg-4">

</div>

<div class="col-lg-4 well ">
	<center><h2>เข้าสู่ระบบ</h2></center>
	<hr>
	<div class="container col-lg-12 ">
		<?php echo validation_errors(); ?>
		<?php echo form_open('auth/login', 'class="form-horizontal"');?>
	        <div class="form-group">
	           <label>อีเมล</label>
	           <input type="email" class="form-control"  placeholder="test@test.com" name="email" value="<?php echo set_value('email'); ?>">
	        </div>
	        <div class="form-group">
	           <label>รหัสผ่าน</label>
	           <input type="password" class="form-control"  placeholder="รหัสผ่าน" name="password" value="<?php echo set_value('password'); ?>">
	        </div>
	        <div class="form-group">
	          <button type="submit" class="btn btn-success btn-block">ตกลง</button>
	      	</div>
	    
	    <!--<center><h2>--- OR ---</h2></center>
	    <div class="form-group">	
	    	<a href = "<?php echo base_url()?>index.php/auth/login_facebook"><button type="button" class="btn btn-primary btn-block">เข้าสู่ระบบด้วย Facebook</button></a>
	    </div>-->
	    </form>
	</div>
</div>

<div class="col-lg-4">

</div>