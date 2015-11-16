<style>
/* css กำหนดความกว้าง ความสูงของแผนที่ */
#map_canvas { 
	width:100%;
	height:450px;
	/*margin:auto;
	margin-top:100px;*/
}
</style>

<div id="page-content-wrapper">
    <?php
        if(isset($content_text)){
            echo '<h1><b>'.$content_text.'</b></h1>';
        }
    ?>       
    <div class="col-lg-12 well">
        <div class="row">
            <div class="col-xs-1">
            </div>
            <div class="col-xs-10">
                <?php echo validation_errors(); ?>

                <?php echo form_open('home/contact', 'class="form-horizontal"');?>
                
            
                <div class="row">
                    <div class="form-group">
                        <div class="col-xs-6">
                                <h3><label>ชื่อ</label></h3>
                                <input type="text" class="form-control" name="f_name" value="<?php echo set_value('f_name'); ?>" >
                        </div>
                        <div class="col-xs-6">
                                <h3><label>นามสกุล</label></h3>
                                <input type="text" class="form-control" name="l_name" value="<?php echo set_value('l_name'); ?>" >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <h3><label>อีเมล</label></h3>
                    <input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" >
                </div> 
                
                <div class="form-group">
                    <h3><label>เบอร์ติดต่อ</label></h3>
                </div>
                <div id="items_tel">
                    <?php 
                        for ($i=0; $i < $count_tel ; $i++) { 
                            //echo $tel[$i];
                            if($i == 0){
                    ?>

                        <div class="form-group row">
                            <p class="col-xs-5">
                                <input type="text" class="form-control"  placeholder="เบอร์โทร" name="tel[]" id="tel" value="<?php echo set_value('tel[0]'); ?>">
                            </p>
                            <p class="col-xs-6">
                                <button type="button" class="btn btn-info" id="add_tel">เพิ่มเบอร์</button>
                            </p>
                        </div>
                 
                    <?php
                            }else{
                    ?>
                        <div class="form-group row">
                            <p class="col-xs-5">
                                <input type="text" class="form-control"  placeholder="เบอร์โทร" name="tel[]" value="<?php echo set_value('tel['.$i.']') ?>">
                            </p>
                            <p class="col-xs-6">
                                <button type="button" class="btn btn-danger" id="delete_tel">ลบเบอร์</button>
                            </p>
                        </div>
                    <?php
                        }
                        }
                    ?>
                   
                </div>
                <div class="form-group">
                    <h3><label>ที่อยู่</label></h3>
                    <!--<a href="#myModal" data-toggle="modal"><textarea class="form-control" rows="3" name="" id="address" value=""></textarea></a>-->
                </div>
                <div class="form-group">
                	<div id="map_canvas"></div>
                    <input name="lat_value" class="form-control" type="hidden" id="lat_value" value="0" >   
                    <input name="lon_value" class="form-control" type="hidden" id="lon_value" value="0" >
                </div>
               				  
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h2 class="modal-title">Modal Header</h2>
                          </div>
                          <div class="modal-body">
                           <!-- <p>Some text in the modal.</p> 
 							<div class="form-group">
			                	<div id="map_canvas"></div>
			                    <input name="lat_value" class="form-control" type="text" id="lat_value" value="0" >   
			                    <input name="lon_value" class="form-control" type="text" id="lon_value" value="0" >
			                </div>-->

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" data-dismiss="modal">Save changes</button>
                          </div>
                        </div>
                    </div>
                </div>  
                
                <hr width='70%'>
                <div class="form-group">
                      <button type="submit" class="btn btn-success btn-block">บันทึก</button>
                </div>
            </div>
            <div class="col-xs-1">
            </div>
        </div>

    </div>
</div> 


  
<script>

$("#add_tel").click(function (e) {
            var max_num = 3;
            var html = '<div class="row form-group"><p class="col-xs-5"><input type="text" class="form-control"  placeholder="เบอร์โทร" name="tel[]" value=""></p><p class="col-xs-2"><button type="button" class="btn btn-danger" id="delete_tel">ลบเบอร์</button></p></div>';
            //Append a new row of code to the "#items" div
            var n = $("#items_tel div").length;
            //alert(n);
            var check = $("#tel").val();
            
            if(check == ""){
                alert("กรุณากรอกเบอร์โทรก่อน");
            }else{
                var n = $("#items_tel div").length;
                //alert(n);
                if (n < max_num) {
                    $("#items_tel").append(html);
                }
                else{
                    alert("ใส่่เบอร์ได้ 3 เบอร์โทร");
                } 
            };
        });

        $("body").on("click", "#delete_tel", function (e) {
            //alert("5555555555")
            //e.preventDefault();
            $(this).parent().parent('div').remove();
            //$(this).parent(".row form-group div").remove();
        });

var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น

function initialize() { // ฟังก์ชันแสดงแผนที่
	// เรียกใช้คุณสมบัติ ระบุตำแหน่ง ของ html 5 ถ้ามี
	if(navigator.geolocation){
			navigator.geolocation.getCurrentPosition(function(position){
				//alert(position.coords.latitude+"  "+position.coords.longitude);
				var latitude = position.coords.latitude;
				var longitude = position.coords.longitude;
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
							
						},function() {
							// คำสั่งทำงาน ถ้า ระบบระบุตำแหน่ง geolocation ผิดพลาด หรือไม่ทำงาน
						});
				}else{
					 // คำสั่งทำงาน ถ้า บราวเซอร์ ไม่สนับสนุน ระบุตำแหน่ง
				}

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
