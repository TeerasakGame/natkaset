</br>

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

<div class="row">
	<div class="col-md-5">
	    <div class="thumbnail">
		    <h2>
		      <img src="<?php echo base_url();?>upload/img/Treasure Map-50.png">
		      <b>
		        รายละเอียดสินค้า
		      </b>
		    </h2>
		    <div class="container-fluid">
	  		<div class="form-group" >
			    <h3><label>ประเภทสินค้าที่ประกาศขาย</label></h3>
				<div class="row">
					<div class="col-xs-12">
						<!--<label>ประเภทหลัก(ตลาดที่จะวางขาย)</label>-->
				        <select id="cate" class="form-control col-xs-10" name="cate" required>
				        	<option value="">---กรุณาเลือก---</option>
				          	
						    	<option value=""></option>
						 
				        </select>
			  		</div>
			  		<div class="col-xs-12">
						<!--<label>ประเภทหลัก(ตลาดที่จะวางขาย)</label>-->
				        <select id="cate" class="form-control col-xs-10" name="cate" required>
				        	<option value="">---กรุณาเลือก---</option>
				          	
						    	<option value=""></option>
						 
				        </select>
			  		</div>
			  		
		  		</div>
			</div>

			<div class="form-group">
		    	<h3><label>ชื่อสินค้า</label></h3>
		    	<input type="text" class="form-control"  placeholder="ชื่อสินค้าหรือที่ประกาศขาย เช่น ข้าวหอมมะลิแท้ เป็นต้น" name="topic" value="<?php echo set_value('topic'); ?>" required>
			</div>

			<div class="form-group">
		    	<h3><label>ประเภทการประกาศขาย</label></h3>
		    	<div class="input-group col-xs-12">
		    	<?php foreach ($type->result_array() as $row) { ?>
		    		<label class="radio-inline" >
		    			<input type="radio" data-toggle="tooltip" data-placement="auto" title="<?php echo $row['typ_explan'];?>" value="<?php echo $row['typ_id'];?>" name="type" required>
		    			<?php echo $row['typ_name'];?>
		    		</label>
		    	<?php } ?>
				</div>
			</div>

			<div class="form-group">
		    	<h3><label>รายละเอียดสินค้า</label></h3>
		   		<textarea class="form-control" rows="5" placeholder="อธิบายเกี่ยวกับ ขนาด ลักษณะ หรืออื่นๆที่สื่อถึงสินค้า" name="explan" required><?php echo set_value('explan'); ?></textarea>
			</div>

			<div class="form-group">
			    <h3><label>ราคา</label></h3>
				<div class="input-group col-xs-8">
					<input type="number" class="form-control" aria-describedby="basic-addon2" name="price" placeholder="ราคาต่อ 1 หน่วย" value="<?php echo set_value('price'); ?>" min="0" required>
					<span class="input-group-addon">บาท</span>
				</div>
			</div>

	    </div>
	    </div>
	 </div>

	 <div class="col-md-7">
	    <div class="row">
	    <div class="col-md-12">
		    <div class="thumbnail">
			    <h2>
			      <img src="<?php echo base_url();?>upload/img/Treasure Map-50.png">
			      <b>
			        รูปสินค้า
			      </b>
			    </h2>
			    <div class="container-fluid">
			    	<div class="row">
					    <div class="col-md-4">
					    	<center><input type="image" src="<?php echo base_url();?>upload/img/Add Image-100.png" width="100"/></center>
							<input type="file" id="my_file" style="display: none;" />
					    </div>
					    <div class="col-md-4">
					    	<center><input type="image" src="<?php echo base_url();?>upload/img/Add Image-100.png" width="100"/></center>
					    </div>
					    <div class="col-md-4">
					    	<center><input type="image" src="<?php echo base_url();?>upload/img/Add Image-100.png" width="100"/></center>
					    </div>
				    </div>
				    <div class="row">
					    <div class="col-md-4">
					    	<center><input type="image" src="<?php echo base_url();?>upload/img/Add Image-100.png" width="100"/></center>
					    </div>
					    <div class="col-md-4">
					    	<center><input type="image" src="<?php echo base_url();?>upload/img/Add Image-100.png" width="100"/></center>
					    </div>
					  
				    </div>
				   
				     
				</div>
		    
		    </div>
		</div>
		<div class="col-md-12">
		    <div class="thumbnail">
			    <h2>
			      <img src="<?php echo base_url();?>upload/img/Treasure Map-50.png">
			      <b>
			        ที่อยู่สินค้า
			      </b>
			    </h2>
		    <!--<input name="namePlaceGet" type="text" id="namePlaceGet" >-->
		    </div>
		</div>
	 </div>
	</div>
	<div class="container-fluid">
		<button type="submit" class="btn btn-success btn-block">ขายสินค้า</button>
	</div>
</div>

<script>
	$("input[type='image']").click(function() {
    	$("input[id='my_file']").click();
	});
</script>