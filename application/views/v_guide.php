<style>
	/* css กำหนดความกว้าง ความสูงของแผนที่ */
	#map_canvas { 
		width:80%;
		height:450px;
		/*margin:auto;
		margin-top:100px;*/
	}

</style>
</br>
	<h1>
        <span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>
        <font color="#278FAF"><b>
        <?php
		     if(isset($content_text)){
		        	echo ' '.$content_text;
		   	}
		?> 
		</b></font>
	</h1>

<div id="page-content-wrapper">
	<div class="col-lg-12 ">
		
		<?php echo validation_errors(); ?>

		<?php echo form_open_multipart('sell/guide', 'class="form-horizontal"');?>
		
		<div class="form-group" >
		    <h3><label><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> ประเภทสินค้าที่ประกาศขาย</label></h3>
			<div class="row">
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
		</div>

		<div class="form-group">
		    <h3><label><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> ชื่อสินค้า</label></h3>
		    <input type="text" class="form-control"  placeholder="ชื่อสินค้าหรือที่ประกาศขาย เช่น แตงโมจินตรา ข้าวหอมมะลิแท้ เป็นต้น" name="topic" value="<?php echo set_value('topic'); ?>" required>
		</div>

		
		<div class="form-group">
		    <h3><label><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> รายละเอียดสินค้า</label></h3>
		   <textarea class="form-control" rows="5" placeholder="อธิบายเกี่ยวกับ ขนาด ลักษณะ หรืออื่นๆที่สื่อถึงสินค้า" name="explan" required><?php echo set_value('explan'); ?></textarea>
		</div>
		
		<div class="form-group">
		    <h3><label><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> รูปสินค้า</label></h3>
		</div>

		<div id="items_pic">
			<div class="row form-group">
				<p id ="pic_radio" class="col-xs-1">
					<input type="radio" name="pic_num" value="0" checked required>
				</p>
				<p class="col-xs-6">
					 <input type="file" accept="image/png, image/jpeg, image/gif" name="pic[]" required>
				</p>
				<p class="col-xs-4">
					<button type="button" class="btn btn-info" id="add_pic">เพิ่มรูป</button>
				</p>
			</div>
		</div>

		<div class="form-group">
		    <h3><label><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> ราคา</label></h3>
			<div class="input-group col-xs-6">
				<input type="number" class="form-control" aria-describedby="basic-addon2" name="price" placeholder="ราคาต่อ 1 หน่วย" value="<?php echo set_value('price'); ?>" min="0" required>
				<span class="input-group-addon">บาท</span>
			</div>
		</div>

		<div class="form-group">
		    <h3><label class="control-label"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> ที่อยู่ของสินค้า</label></h3>
		</div>

		<div class="form-group" id="map">
			<center><div id="map_canvas"></div></center>
		</div>
		
		<hr width='70%'>
		<div class="form-group">
	        <button type="submit" class="btn btn-success btn-block">แนะนำสินค้า</button>
	    </div>
	</div>

        <input name="lat_value" class="form-control" type="hidden" id="lat_value" value="0" >   
        <input name="lon_value" class="form-control" type="hidden" id="lon_value" value="0" >

	</form>
</div>

				 

<script>

	$(document).ready(function(){

		$("#cate").change(function(){
			var value = $(this).val();

			$.ajax({
				url:"get_category",
				data:"code="+value,
				type:"POST",
				//dataTypr:"json",
				success:function(res){
					//alert(res);
					/*var obj = jQuery.parseJSON(res);

					$.each(obj,function(key,val){
						//alert(val.cat_code+" "+val.cat_name);
						var html = '<option value="'+val.cat_code+'">'+val.cat_name+'</option>';

						$("#cate2").append('html');

					});*/
					$("#div_cate").html(res);
				},
				error:function(err){

				}
			});
		});
	    
	    $("#add_pic").click(function(e){

	    	var max_num = 5;
	    	var n = $("#items_pic div").length;
			var html = '<div class="row form-group"><p id ="pic_radio" class="col-xs-1"><input type="radio" name="pic_num" value="'+n+'" required></p><p class="col-xs-6"><input type="file" accept="image/png, image/jpeg, image/gif" name="pic[]" id=pic_'+n+'" /></p><p class="col-xs-4"><button type="button" class="btn btn-danger" id="delete_tel">ลบรูป</button></p></div>';
			//Append a new row of code to the "#items" div
			//alert(n);
			var check = $("#pic").val();
			
			if(check == ""){
				alert("กรุณาเลือกไฟล์รูปก่อน");
			}else{
				/*if(n==1){
					$("#pic_radio").html('<input type="radio" name="pic_num" value="0" required>');
				}*/

				var check = $("#pic[0]").val();
				//alert(n);
				if (n < max_num) {
					$("#items_pic").append(html);
				}
				else{
					alert("ใส่รูปได้ 5 รูป");
				}
			}

	    });

		$("body").on("click", "#delete_tel", function (e) {
			//alert("5555555555")
			//e.preventDefault();
			$(this).parent().parent('div').remove();
			//$(this).parent(".row form-group div").remove();
		});
	});

</script>


<script>

var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น

function initialize() { // ฟังก์ชันแสดงแผนที่
	// เรียกใช้คุณสมบัติ ระบุตำแหน่ง ของ html 5 ถ้ามี

				//alert(position.coords.latitude+"  "+position.coords.longitude);
				var latitude = <?php echo $this->session->userdata('lat') ;?>;
				var longitude = <?php echo $this->session->userdata('log') ;?>;
				$("#lat_value").val(latitude);
				$("#lon_value").val(longitude);
				
				
				GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
				// กำหนดจุดเริ่มต้นของแผนที่
				var my_Latlng  = new GGM.LatLng(latitude,longitude);

				//var my_Latlng  = new GGM.LatLng(latitude,latitude);
				var my_mapTypeId=GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง
				// กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
				var my_DivObj=$("#map_canvas")[0]; 
				// กำหนด Option ของแผนที่
				var myOptions = {
					zoom: 15, // กำหนดขนาดการ zoom
					center: my_Latlng , // กำหนดจุดกึ่งกลาง
					mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่
				};
				map = new GGM.Map(my_DivObj,myOptions);// สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map
				
				var my_Marker = new GGM.Marker({ // สร้างตัว marker
					position: my_Latlng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
					map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
					draggable:true, // กำหนดให้สามารถลากตัว marker นี้ได้
					//animation:google.maps.Animation.BOUNCE,
					title:"คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!" // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
				});
				
				// กำหนด event ให้กับตัว marker เมื่อสิ้นสุดการลากตัว marker ให้ทำงานอะไร
				GGM.event.addListener(my_Marker, 'dragend', function() {
					var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
			        map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker		
			        $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
			        $("#lon_value").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value 
			       // $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
			        $("address").val(my_Point.lat());
				});		

				// กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
				GGM.event.addListener(map, 'zoom_changed', function() {
					$("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value 	
				});
							

}
$(function(){
	// โหลด สคริป google map api เมื่อเว็บโหลดเรียบร้อยแล้ว
	// ค่าตัวแปร ที่ส่งไปในไฟล์ google map api
	// v=3.2&sensor=false&language=th&callback=initialize
	//	v เวอร์ชัน่ 3.2
	//	sensor กำหนดให้สามารถแสดงตำแหน่งทำเปิดแผนที่อยู่ได้ เหมาะสำหรับมือถือ ปกติใช้ false
	//	language ภาษา th ,en เป็นต้น
	//	callback ให้เรียกใช้ฟังก์ชันแสดง แผนที่ initialize
	$("<script/>", {
	  "type": "text/javascript",
	  src: "http://maps.google.com/maps/api/js?v=3.2&sensor=false&language=th&callback=initialize"
	}).appendTo("body");	
});

</script>
