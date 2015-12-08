<style>
  .well{
      background-color: #FFFFFF;
      /*border-color: #E26A8D;*/
  }

/* css กำหนดความกว้าง ความสูงของแผนที่ */
  #map_canvas { 
    width:95%;
    height:350px;
    margin:auto;
    margin-top:15px;
  }

  #scorebar {
   /*background-color: #00FFFF;*/
    height: 450px;
    overflow:auto;
}

</style>

</br>
<h1>
  <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
  <font color="ED6188">
  <b>
    <?php
       if(isset($content_text)){
         echo ' '.$content_text;
       }
    ?> 
  </b>
  </font>
</h1>


<div class="well">
  
 <?php if($detail[0]['sel_promotion'] != null ){?>
    <div class="ribbon_detail"><span>โปรโมชั่น</span></div>
  <?php } ?>

    <div class="row">
      <div class="col-md-5">
        <?php $num_pic = count($pic);?>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <?php for($i=1;$i<=$num_pic;$i++){?>
              <?php if($i==1){?>
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <?php }else{ ?> 
                <li data-target="#myCarousel" data-slide-to="<?php echo $i-1; ?>"></li>
              <?php } ?>
            <?php }?>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">

            <?php $j=1;foreach ($pic as $value) { ?>
              <?php if($j==1){?>
                <div class="item active">
                  <center><img src="<?php echo base_url($value['pic_path'])?>"  width="100%"  height="350" ></center>
                </div>
              <?php }else{ ?>
                <div class="item">
                  <center><img src="<?php echo base_url($value['pic_path'])?>"   width="100%" height="350"></center>
                </div>
              <?php } $j++?>
            <?php } ?>
          
          </div>

          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-md-5">
        <div class="col-md-12">
          <div class="row">
            <div class="col-xs-9">
              <h1><b><?php if($detail[0]['sel_status'] == 0){echo "[ปิดการขาย] ";}?><?php echo $detail[0]['sel_topic']?></b></h1>
            </div>
            <?php if($this->session->userdata('mem_id') != Null){ ?>
            <div class="col-xs-3 text-right" id="div_pic">
              <?php if($like == false){?>
                <h2>
                <a href="#" id="like"><img src="<?php echo base_url();?>upload/img/Dis Like Filled-32.png" id="pic"></a>
                <b id ="count"><?php echo $count_like[0]['count_like']?></b>
                </h2>
              <?php }else{ ?>
              <?php if($like[0]['lik_status'] == 0){?>
                 <h2>
                <a href="#" id="like"><img src="<?php echo base_url();?>upload/img/Dis Like Filled-32.png" id="pic"></a>
                <b id ="count"><?php echo $count_like[0]['count_like']?></b>
                </h2>
              <?php }else{ ?>
                <h2>
                <a href="#" id="like"><img src="<?php echo base_url();?>upload/img/Like Filled-32.png" id="pic"></a>
                <b id ="count"><?php echo $count_like[0]['count_like']?></b>
                </h2>
              <?php } ?>
              <?php } ?>
            </div>
            <?php } ?>
          </div>
         </br>
         <table class="table table-striped">
          <tbody>
            <tr>
              <td class="col-xs-4">รายละเอียดสินค้า</td>
              <td class="col-xs-8"><?php echo $detail[0]['sel_explain']?></td>
            </tr>
            <tr>
              <td class="col-xs-4">ประเภทการขาย</td>
              <td class="col-xs-8"><?php echo $detail[0]['typ_name']?></td>
            </tr>
            <?php if($detail[0]['sel_promotion'] != null ){?>
            <tr>
              <td class="col-xs-4" rowspan="2">โปรโมชั่น</td>
              <td class="col-xs-8"><?php echo $detail[0]['sel_promotion']?></td>
            </tr>
            <tr>
              <td>ระยะเวลา <?php echo date("d/m/Y",strtotime($detail[0]['sel_pro_start']))?> ถึง <?php echo date("d/m/Y",strtotime($detail[0]['sel_pro_stop']))?></td>
            </tr>
            <?php } ?>
            <tr>
              <td class="col-xs-4">ราคา</td>
              <td class="col-xs-8"><?php echo number_format($detail[0]['sel_price']).' '.'บาท';?></td>
            </tr>
            <tr>
              <td class="col-xs-4">ผู้ประกาศ</td>
              <td class="col-xs-8"><?php echo $detail[0]['mem_first_name'].' '.$detail[0]['mem_last_name']?></td>
            </tr>
            <tr>
              <?php $num_con = count($contact);?>
              <td class="col-xs-4" rowspan="<?php echo $num_con;?>">ติดต่อ</td>
              <?php $n=1;foreach ($contact as $value) { ?>
              <?php if($n==1){?>
              <td class="col-xs-8"><?php echo $value['con_data'];?></td>
            </tr>
              <?php }else{?>
              <tr>
                <td class="col-xs-8"><?php echo $value['con_data'];?></td>
              </tr>
              <?php }} ?>
          </tbody>
        </table>




      </div>
    </div>
    
    <div class="col-md-2">
      <h3><b>สินค้าที่ใกล้เคียง</b></h3>
      <?php if($resemble == '' || $resemble == null){echo "ไม่พบสินค้าใกล้เคียง";}?>
      <?php foreach ($resemble as $key) { ?>
          <h3>
            <a href="<?php echo base_url();?>index.php/sell/detail/<?php echo $key['sel_id'];?>"><img src="<?php echo base_url();?><?php echo $key['sel_pic'];?>" height="50"></a>
            <a href="<?php echo base_url();?>index.php/sell/detail/<?php echo $key['sel_id'];?>"><?php echo $key['sel_topic'];?></a>
            <hr>
          </h3>
      <?php } ?>

    </div>

  </div> 
</div> 

<?php if($this->session->userdata('mem_id') != Null){ ?>
<div class="row">
  <div class="col-md-7">
    <div class="thumbnail">
    <h1>
      <img src="<?php echo base_url();?>upload/img/Treasure Map-50.png">
      <font color="ED6188">
      <b>
        การเดินทาง
      </b>
      </font>
    </h1>
    <!--<input name="namePlaceGet" type="text" id="namePlaceGet" >-->
    <center><h3><p id="distance"></p></h3></center>
    <div id="map_canvas"></div>
    <div class="container">
      <div class="form-group">
        <h3><label><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>จุดเริ่มต้น</label></h3>
        <div class="input-group col-xs-12">
          <p id="namePlaceGet"></p>
        </div>
      </div>
      <div class="form-group">
        <h3><label><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>จุดหมาย</label></h3>
        <div class="input-group col-xs-12">
          <p id="toPlaceGet"></p>
        </div>
      </div>
    </div>
    </div>
  </div>

  <div class="col-md-5">
    <div class="thumbnail" >
      <h1>
      <img src="<?php echo base_url();?>upload/img/Comments-50.png">
      <font color="ED6188">
      <b>
        ความคิดเห็น
      </b>
      </font>
      </h1>
      <div class="row" >
        <div class="col-md-12">
          <div class="panel panel">
            <div class="panel-body" id="scorebar">
              <ul class="media-list" id='add_comment'>
                <?php if($comment == Null){echo "<br><center><h1>--- ไม่มีความคิดเห็น ---</h1></center>";}?>
                <?php foreach ($comment as $key) { ?>
                <li class="media">
                  <div class="media-body">
                    <div class="media">
                      <a class="pull-left" href="#">
                          <img class="media-object img-circle " src="<?php echo base_url($key['mem_pic']);?>" />
                      </a>
                      <div class="media-body" >
                          <?php echo $key['com_message'];?>
                          <br />
                         <small class="text-muted"><?php echo $key['mem_first_name']." ".$key['mem_last_name']." | ".date("H:m น., d F Y ",strtotime($key['com_create']));?></small>
                          <hr />
                      </div>
                    </div>
                  </div>
                </li>
                <?php } ?>

              </ul>
            </div>
            <div class="panel-footer">
              <!--<form action="<?php echo base_url()?>index.php/sell/add_comment/<?php// echo $detail[0]['sel_id']?>" method="post">-->
              <div class="input-group">
                <input type="text" class="form-control" placeholder="ความคิดเห็น" name="message" id="message" value=""/>
                <span class="input-group-btn">
                  <button class="btn btn-info" type="button" id="comment">ส่ง</button>
                </span>
              </div>
            <!--</form>-->
            </div>
        </div>
    </div>
  </div>
      <!--<div class="fb-comments" data-href="<?php// echo base_url();?>/index.php/sell/detail/<?php //echo $detail[0]['sel_id']?>" data-width="420" data-numposts="10"></div>-->
    
  </div>
  </div>  
</div>
<?php } ?>


<!-- Map -->
<script>
  var directionShow; // กำหนดตัวแปรสำหรับใช้งาน กับการสร้างเส้นทาง
  var directionsService; // กำหนดตัวแปรสำหรับไว้เรียกใช้ข้อมูลเกี่ยวกับเส้นทาง
  var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
  var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
  var my_Latlng; // กำหนดตัวแปรสำหรับเก็บจุดเริ่มต้นของเส้นทางเมื่อโหลดครั้งแรก
  var initialTo; // กำหนดตัวแปรสำหรับเก็บจุดปลายทาง เมื่อโหลดครั้งแรก
  var searchRoute; // กำหนดตัวแปร ไว้เก็บฃื่อฟังก์ชั้น ให้สามารถใช้งานจากส่วนอื่นๆ ได้
  var makeMarker; // 
  var icons;
  function initialize() { // ฟังก์ชันแสดงแผนที่
    GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
    
    // Start/Finish icons
    icons = {
      start: new GGM.MarkerImage(
      // URL
      "<?php echo base_url('upload/img/Boy-50.png')?>",
      // (width,height)
      new GGM.Size( 100, 50 ),
      // The origin point (x,y)
      new GGM.Point( 0, 0 ),
      // The anchor point (x,y)
      new GGM.Point( 35, 32 )
      ),
      end: new GGM.MarkerImage(
      // URL
      "<?php echo base_url('upload/img/Flag Filled -50.png')?>",
      // (width,height)
      new GGM.Size( 100, 50 ),
      // The origin point (x,y)
      new GGM.Point( 0, 0 ),
      // The anchor point (x,y)
      new GGM.Point( 22, 50 )
      )
    };
      
    directionShow=new  GGM.DirectionsRenderer({suppressMarkers:true});
  //  directionShow=new  GGM.DirectionsRenderer({
  //    draggable:true,
  //    markerOptions:{
  //        draggable: true,
  //        raiseOnDrag: false,      
  //        dragCrossMove:true
  //    }
  //  }); 
    
    directionsService = new GGM.DirectionsService();
    // กำหนดจุดเริ่มต้นของแผนที่
    my_Latlng  = new GGM.LatLng(<?php echo $this->session->userdata('lat')?>,<?php echo $this->session->userdata('log')?>);
    // กำหนดตำแหน่งปลายทาง สำหรับการโหลดครั้งแรก
    initialTo=new GGM.LatLng(<?php echo $detail[0]['sel_lagitude']?>,<?php echo $detail[0]['sel_longitude']?>); 
    var my_mapTypeId=GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง
    // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
    var my_DivObj=$("#map_canvas")[0];
    // กำหนด Option ของแผนที่
    var myOptions = {
      zoom: 13, // กำหนดขนาดการ zoom
      center: my_Latlng , // กำหนดจุดกึ่งกลาง จากตัวแปร my_Latlng
      mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่ จากตัวแปร my_mapTypeId
    };
    map = new GGM.Map(my_DivObj,myOptions); // สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map
    directionShow.setMap(map); // กำหนดว่า จะให้มีการสร้างเส้นทางในแผนที่ที่ชื่อ map
    
    if(map){ // เงื่่อนไขถ้ามีการสร้างแผนที่แล้ว
       searchRoute(my_Latlng,initialTo); // ให้เรียกใช้ฟังก์ชัน สร้างเส้นทาง
    }
    
    // กำหนด event ให้กับเส้นทาง กรณีเมื่อมีการเปลี่ยนแปลง 
    GGM.event.addListener(directionShow, 'directions_changed', function() {
      var results=directionShow.directions; // เรียกใช้งานข้อมูลเส้นทางใหม่ 
        
      // นำข้อมูลต่างๆ มาเก็บในตัวแปรไว้ใช้งาน
      var addressStart=results.routes[0].legs[0].start_address; // สถานที่เริ่มต้น
      var addressEnd=results.routes[0].legs[0].end_address;// สถานที่ปลายทาง
      var distanceText=results.routes[0].legs[0].distance.text; // ระยะทางข้อความ
      var distanceVal=results.routes[0].legs[0].distance.value;// ระยะทางตัวเลข
      var durationText=results.routes[0].legs[0].duration.text; // ระยะเวลาข้อความ
      var durationVal=results.routes[0].legs[0].duration.value; // ระยะเวลาตัวเลข   
      // นำค่าจากตัวแปรไปแสดงใน textbox ที่ต้องการ
     // $("#namePlaceGet").val(addressStart);
     // $("#toPlaceGet").val(addressEnd);
      $("#distance_text").val(distanceText);
      $("#distance_value").val(distanceVal);
      $("#duration_text").val(durationText);
      $("#duration_value").val(durationVal);  

      $("#namePlaceGet").html(addressStart); 
      $("#toPlaceGet").html(addressEnd); 
      $("#distance").html('ระยะทางที่ใช้ในการเดินทาง '+distanceText+' ใช้เวลาทั้งหมด '+durationText);
    });


  }
  $(function(){
    // ส่วนของฟังก์ชัน สำหรับการสร้างเส้นทาง
    searchRoute=function(FromPlace,ToPlace){ // ฟังก์ชัน สำหรับการสร้างเส้นทาง
      if(!FromPlace && !ToPlace){ // ถ้าไม่ได้ส่งค่าเริ่มต้นมา ให้ใฃ้ค่าจากการค้นหา
        var FromPlace=$("#namePlace").val();// รับค่าชื่อสถานที่เริ่มต้น
        var ToPlace=$("#toPlace").val(); // รับค่าชื่อสถานที่ปลายทาง
      }
      // กำหนด option สำหรับส่งค่าไปให้ google ค้นหาข้อมูล
      var request={
        origin:FromPlace, // สถานที่เริ่มต้น
        destination:ToPlace, // สถานที่ปลายทาง
        travelMode: GGM.DirectionsTravelMode.DRIVING // กรณีการเดินทางโดยรถยนต์
      };
      // ส่งคำร้องขอ จะคืนค่ามาเป็นสถานะ และผลลัพธ์
      directionsService.route(request, function(results, status){
        if(status==GGM.DirectionsStatus.OK){ // ถ้าสามารถค้นหา และสร้างเส้นทางได้
          directionShow.setDirections(results); // สร้างเส้นทางจากผลลัพธ์


  //        console.log(directionShow);
  //        console.log(results.routes[0].legs[0]);
  //        directionShow.markerOptions.icon=icons.start;       
  //        directionShow.markerOptions.icon=icons.end;   
          var leg = results.routes[0].legs[0];
          makeMarker(leg.start_location, icons.start, "ตำแหน่งของคุณ" );
          makeMarker(leg.end_location, icons.end, '<?php echo $detail[0]['sel_topic'];?>' );        
          
          // นำข้อมูลต่างๆ มาเก็บในตัวแปรไว้ใช้งาน 
          var addressStart=results.routes[0].legs[0].start_address; // สถานที่เริ่มต้น
          var addressEnd=results.routes[0].legs[0].end_address;// สถานที่ปลายทาง
          var distanceText=results.routes[0].legs[0].distance.text; // ระยะทางข้อความ
          var distanceVal=results.routes[0].legs[0].distance.value;// ระยะทางตัวเลข
          var durationText=results.routes[0].legs[0].duration.text; // ระยะเวลาข้อความ
          var durationVal=results.routes[0].legs[0].duration.value; // ระยะเวลาตัวเลข   
          // นำค่าจากตัวแปรไปแสดงใน textbox ที่ต้องการ
          //$("#namePlaceGet").val(addressStart);
          $("#toPlaceGet").val(addressEnd);
          $("#distance_text").val(distanceText);
          $("#distance_value").val(distanceVal);
          $("#duration_text").val(durationText);
          $("#duration_value").val(durationVal);    
          // $("#toPlaceGet").html("'<p>'+addressStart+'</p>'");  
          // ส่วนการกำหนดค่านี้ จะกำหนดไว้ที่ event direction changed ที่เดียวเลย ก็ได้
          
        }else{
          // กรณีไม่พบเส้นทาง หรือไม่สามารถสร้างเส้นทางได้
          // โค้ดตามต้องการ ในทีนี้ ปล่อยว่าง
        }
      });
    }
    
    // ส่วนควบคุมปุ่มคำสั่งใช้งานฟังก์ชัน
    $("#SearchPlace").click(function(){ // เมื่อคลิกที่ปุ่ม id=SearchPlace 
      searchRoute();  // เรียกใช้งานฟังก์ชัน ค้นหาเส้นทาง
    });

    $("#namePlace,#toPlace").keyup(function(event){ // เมื่อพิมพ์คำค้นหาในกล่องค้นหา
      if(event.keyCode==13 && $(this).val()!=""){ //  ตรวจสอบปุ่มถ้ากด ถ้าเป็นปุ่ม Enter 
        searchRoute();    // เรียกใช้งานฟังก์ชัน ค้นหาเส้นทาง
      }   
    });
    
    $("#iClear").click(function(){
      $("#namePlace,#toPlace").val(""); // ล้างค่าข้อมูล สำหรับพิมพ์คำค้นหาใหม่
    });


    makeMarker=function(position,icon,title){
       new GGM.Marker({
  //        draggable: true,
  //        raiseOnDrag: false,      
  //        dragCrossMove:true,
          position: position,
          map: map,
          icon: icon,
          title: title
       });
    }

    
  });
  $(function(){
    // โหลด สคริป google map api เมื่อเว็บโหลดเรียบร้อยแล้ว
    // ค่าตัวแปร ที่ส่งไปในไฟล์ google map api
    // v=3.2&sensor=false&language=th&callback=initialize
    //  v เวอร์ชัน่ 3.2
    //  sensor กำหนดให้สามารถแสดงตำแหน่งทำเปิดแผนที่อยู่ได้ เหมาะสำหรับมือถือ ปกติใช้ false
    //  language ภาษา th ,en เป็นต้น
    //  callback ให้เรียกใช้ฟังก์ชันแสดง แผนที่ initialize  
    $("<script/>", {
      "type": "text/javascript",
      src: "http://maps.google.com/maps/api/js?v=3.2&sensor=false&language=th&callback=initialize"
    }).appendTo("body");  
  });
</script>


<!-- script -->
<script>

    $("#like").click(function(){
        //alert("ชอบ");
        var img = $("#pic").attr("src");
        if (img == "<?php echo base_url('upload/img/Like Filled-32.png')?>"){
          //alert("ไม่ชอบ");
          $.ajax({
            url:"<?php echo base_url('index.php/sell/like')?>",
            data:"sel_id="+"<?php echo $detail[0]['sel_id']?>"+"status=1",
            type:"POST",
            success:function(res){
              //alert(res);
              $("#pic").attr("src", "<?php echo base_url('upload/img/Dis Like Filled-32.png')?>");
              $("#count").html(res);
           
            },
            error:function(err){

            }
          });
        }else{
          //alert("ชอบ");
          $.ajax({
            url:"<?php echo base_url('index.php/sell/like')?>",
            data:"sel_id="+"<?php echo $detail[0]['sel_id']?>"+"&status=0",
            type:"POST",
            success:function(res){
             // alert(res);
              $("#pic").attr("src", "<?php echo base_url('upload/img/Like Filled-32.png')?>");
              $("#count").html(res);
            },
            error:function(err){

            }
          });
        }
       
    });

  $("#comment").click(function(){
    var message = $("#message").val();
    //alert(message);
    if(message != ""){
          $.ajax({
            url:"<?php echo base_url('index.php/sell/add_comment')?>",
            data:"sel_id="+"<?php echo $detail[0]['sel_id']?>"+"&message="+message,
            type:"POST",
            success:function(res){
              //alert(res);
              $("#add_comment").html(res);
              $("#message").val("");
            },
            error:function(err){

            }
          });
    }
    
  });

  $(function(){  
    setInterval(function(){ // เขียนฟังก์ชัน javascript ให้ทำงานทุก ๆ 30 วินาที  
        // 1 วินาที่ เท่า 1000  
        // คำสั่งที่ต้องการให้ทำงาน ทุก ๆ 3 วินาที  
        $.ajax({ // ใช้ ajax ด้วย jQuery ดึงข้อมูลจากฐานข้อมูล  
                url:"<?php echo base_url('index.php/sell/get_comment')?>", 
                data:"sel_id="+"<?php echo $detail[0]['sel_id']?>", 
                type:"POST",  
                success:function(getData){  
                   // alert(getData);
                    $("#add_comment").html(getData); // ส่วนที่ 3 นำข้อมูลมาแสดง  
                }  
        }).responseText;  
    },2000);      
  }); 


</script>




