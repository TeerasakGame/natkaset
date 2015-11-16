<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Natkaset - <?php if(isset($content_text)){ echo $content_text; }?> </title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>css/simple-sidebar.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/styles.css" rel="stylesheet">

    <link href="<?php echo base_url();?>css/fonts.css" rel="stylesheet"  >
    <link href="<?php echo base_url();?>css/ribbon.css" rel="stylesheet"  >

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- bootstrap-select -->
    <link rel="stylesheet" href="<?php echo base_url();?>/css/bootstrap-select.css">
    <script src="<?php echo base_url();?>/js/bootstrap-select.js"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('template/menu'); ?>
        <!-- header -->
        <?php $this->load->view('template/header'); ?>
        <!-- Page Content -->
    </br>
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                            if(isset($content_view)){
                                if(isset($content_data)){
                                    foreach($content_data as $key=>$value){$data[$key]=$value;}
                                    $this->load->view($content_view,$data); 
                                }else{
                                    $this->load->view($content_view);
                                }
                            }
                         ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url();?>js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>

    <script src="<?php echo base_url();?>js/scripts.js"></script>

    <!-- Menu Toggle Script -->
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>


</body>

</html>
