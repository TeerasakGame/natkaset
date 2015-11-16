
<div class="col-lg-8">
	<div class = "well">
		
	</div>
</div>

<div class="col-lg-4" >
	<div class = "well">
		<h2><b>สมัครสมาชิก</b></h2>
		<hr>
		<form class="form-horizontal well" data-toggle="validator">
			<div class="form-group">
			   <label>ชื่อ</label>
			   <input type="text" class="form-control"  placeholder="ชื่อจริง" required>
			</div>
			<div class="form-group">
			   <label>นามสกุล</label>
			   <input type="text" class="form-control" placeholder="นามสกุล" required>
			</div>
			<div class="form-group">
			   <label>E-mail</label>
			   <input type="email" class="form-control"  placeholder="test@test.com" required>
			</div>
			<div class="form-group">
			   <label>รหัสผ่าน</label>
			   <input type="password" class="form-control"  placeholder="รหัสผ่าน" required>
			</div>

			<div class="form-group"> 
			    <center><button type="submit" class="btn btn-success">สมัครใช้บริการ</button></center>
			</div>
		</form>
		<center><h3> -------------------- OR -------------------- </h3></center>
		<center><a href="<?php echo base_url();?>index.php/FB_login"><button class="btn btn-primary">Login Whith facebook</button></a></center>
	</div>
</div>
