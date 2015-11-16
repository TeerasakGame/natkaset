<div class="row">
    <div class="col-lg-12">
      	<?php
            if(isset($content_text)){
                echo '<h1><b>'.$content_text.'</b></h1>';
            }
        ?> 
    </div>
</div>       
<div class="col-lg-12">
	<div class = 'well'>
        <input type"text" id="lat" value="">
        <input type"text" id="lon" value="">
	</div>
</div>
<?php
    echo $this->session->userdata('lat')." ".$this->session->userdata('log');
?>
<script>
    if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(position){
                //alert(position.coords.latitude+"  "+position.coords.longitude);
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                $("#lat").val(latitude);
                $("#lon").val(longitude);

                $.ajax({
    				url:"home/test",
    				data:"lat="+latitude+"&log="+longitude,
    				type:"POST",
    				//dataTypr:"json",
    				success:function(res){
    					//alert(res);
    				},
    				error:function(err){

    				}
			     });  

            },function() {
                // คำสั่งทำงาน ถ้า ระบบระบุตำแหน่ง geolocation ผิดพลาด หรือไม่ทำงาน
               // alert('ไม่สามารถระบุตำแหน่งปัจจุบันของคุณได้ ระบบจะระบุตำแหน่งที่ "อนุสาวรีชัยสมรภูมิ"');
                $.ajax({
                    url:"home/test",
                    data:"lat="+13.765205+"&log="+100.538306,
                    type:"POST",
                    //dataTypr:"json",
                    success:function(res){
                        //alert(res);
                    },
                    error:function(err){

                    }
                 });
            });
    }else{
        // คำสั่งทำงาน ถ้า บราวเซอร์ ไม่สนับสนุน ระบุตำแหน่ง
        ///alert('ไม่สามารถระบุตำแหน่งปัจจุบันของคุณได้ ระบบจะระบุตำแหน่งที่ "อนุสาวรีชัยสมรภูมิ"');
                $.ajax({
                    url:"home/test",
                    data:"lat="+13.765205+"&log="+100.538306,
                    type:"POST",
                    //dataTypr:"json",
                    success:function(res){
                        //alert(res);
                    },
                    error:function(err){

                    }
                 });
    }
  
    
</script>



