</br></br></br>
<div class="well"> 
    <form class="form-horizontal" role="form">
        <h1>
        	<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
        	<font color="ED6188"><b>
        	<?php
		     	if(isset($content_text)){
		       	 	echo ' '.$content_text;
		    	}
			?> 
			</b></font>
		</h1>

		<?php echo validation_errors(); ?>

		<?php echo form_open_multipart('sell', 'class="form-horizontal"');?>
        
        <h3><label>ประเภทสินค้าที่ประกาศขาย</label></h3>
        <div class="row" >
				<div class="col-xs-4">
					<label>ประเภทหลัก(ตลาดที่จะวางขาย)</label>
			        <select id="cate" class="form-control col-xs-3" name="cate" required>
			        	<option value="">---กรุณาเลือก---</option>
			          	<?php foreach ($category->result_array() as $row) { ?>
					    	<option value="<?php echo $row['cat_code'];?>"><?php echo $row['cat_name']?></option>
					    <?php } ?>
			        </select>
		  		</div>
		  		<div class="col-xs-4" id="div_cate"></div>
		  		<div class="col-xs-4" id="div_cate2"></div>
		</div>
		
		<h3><label>ชื่อสินค้า</label></h3>
		<input type="text" class="form-control"  placeholder="ชื่อสินค้าหรือที่ประกาศขาย เช่น แตงโมจินตรา ข้าวหอมมะลิแท้ เป็นต้น" name="topic" value="<?php echo set_value('topic'); ?>" required>

		<h3><label>ประเภทการประกาศขาย</label></h3>
		<div class="col-xs-12">
		    <?php foreach ($type->result_array() as $row) { ?>
		    	<label class="radio-inline" >
		    		<input type="radio" data-toggle="tooltip" data-placement="auto" title="<?php echo $row['typ_explan'];?>" value="<?php echo $row['typ_id'];?>" name="type" required>
		    		<?php echo $row['typ_name'];?>
		    	</label>
		    <?php } ?>
		</div>
		</br></br>
		<h3><label>รายละเอียดสินค้า</label></h3>
		<textarea class="form-control" rows="5" placeholder="อธิบายเกี่ยวกับ ขนาด ลักษณะ หรืออื่นๆที่สื่อถึงสินค้า" name="explan" required><?php echo set_value('explan'); ?></textarea>

		<h3><label class="control-label">รูปสินค้า</label></h3>
		<div id="items_pic">
			<div class="row form-group">
				<p class="col-xs-8">
					 <input type="file" accept="image/png, image/jpeg, image/gif" name="pic[]" required>
				</p>
				<p class="col-xs-4">
					
				</p>
			</div>
		</div>
		
		<button type="button" class="btn btn-info " id="add_pic"> + เพิ่มรูป</button>
	

        <button class="btn btn-success pull-right" type="button">Post</button>
        <ul class="list-inline">
        	<li><a href="#"></a></li>
        </ul>
    </form>
</div>


<script>
	$(document).ready(function(){
	    
		$("#cate").change(function(){
			//alert("555");
			var value = $(this).val();

			$.ajax({
				url:"get_category",
				data:"code="+value,
				type:"POST",
				//dataTypr:"json",
				success:function(res){
					$("#div_cate").html(res);	
				},
				error:function(err){

				}
			});
		});



	});
</script>