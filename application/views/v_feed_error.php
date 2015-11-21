<style>
  #a {
      background-color: #FFFFFF;
      /*border-color: #E26A8D;*/
  }
  #b {
      background-color: #DCDCDC;
      /*border-color: #E26A8D;*/
  }
  .topic{
    margin-top:5px;
  }
  #pic{
    margin-top: 20px;
    margin-bottom: 20px;
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

  <ul class="nav nav-tabs">
    <li class="active"><a href="#A" data-toggle="tab">ล่าสุด</a></li>
    <li><a href="#B" data-toggle="tab">ระยะทาง</a></li>
    <li><a href="#C" data-toggle="tab">ยอดนิยม</a></li>
  </ul>

  <div class="tabbable">
    <div class="tab-content">
      <div class="tab-pane active " id="A">
        </br>
        <?php if(isset($error) != null){ echo "<center><h1>--- ".$error." ---</h1><center>";}?>
      </div>

      <div class="tab-pane" id="B">
        </br>
        <?php if(isset($error) != null){ echo "<center><h1>--- ".$error." ---</h1><center>";}?>
      </div>

      <div class="tab-pane" id="C">
        </br>
        <?php if(isset($error) != null){ echo "<center><h1>--- ".$error." ---</h1><center>";}?>
      </div> <!-- tab C-->

    </div><!-- tab content -->
  </div><!-- tab -->
