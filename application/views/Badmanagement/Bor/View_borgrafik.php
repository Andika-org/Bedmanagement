<style>
/*Loader*/
#loader-wrapper {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1000;
}

/*Text Loading */
 #kedip{
 display: block;
 position: relative;
 top: 13%;

 font-family: Brush Script Std;
 text-align: center;
 background: blue;
 color:white;
 z-index: 1001;
 animation: mymove 1.5s infinite alternate;
 }
 @keyframes mymove{
  0%{
     opacity: 100; 
  }

  100%{
     opacity: 0;
  }
}
</style>

</body>
</html>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap-3.3.7-dist-1/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap-3.3.7-dist-1/bootstrap-3.3.7-dist/datatables/dataTables.bootstrap4.min.css">
	<link href="<?php echo base_url()?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>


<!-- data -->

 
  <!-- Bootstrap modal -->
<!-- data -->

<!-- sampe sini -->

<div class="" style="padding-left:0px;padding-top:0px;overflow: auto;" >


<center><h2 style="color:brown" class="pull-" align="center"><b>Data Bor Grafik Rawat Inap </b></h2></center>

	<legend>
	</legend>
	
	<form action="<?php print site_url();?>Controlbor/borgrafik" method="POST">
	<div id="tanggal" style="display:;">
		
		
	
		<div class="navbar-header col-md-4">
            <div class="input-group date form_date col-md-11" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" >
                    <input required class="form-control" type="text" value="<?php echo date("d F Y",strtotime($tglawal)); ?>" name="Tanggal_Awal" placeholder="Tanggal Awal" readonly="readonly" id="tgl1" onchange="ajaxname();">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove" ></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar" ></span></span>
            </div>
		</div>
		
		<div class="navbar-header">
		<b style="margin:0px 20px 0px 2px;">Sampai</b>
		</div>
		
		<div class="navbar-header col-md-4">
		<div class="input-group date form_date col-md-11" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input required class="form-control" type="text" value="<?php echo date("d F Y",strtotime($tglakhir)); ?>" name="Tanggal_Akhir" placeholder="Tanggal Akhir" readonly="readonly" id="tgl2" onchange="ajaxname2();">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
		</div>		
			<div class="navbar-header"  >
			&nbsp <input type="submit" style="margin:0px 0px 0px -8px; height:34px;" class="btn btn-info " value="Search">
			</div>
			<!--
			<div class="navbar-header pull-right"  >
			&nbsp <a href="<?php echo base_url("Controlbor/borgrafikcetakexcel/".$tglawal.'/'.$tglakhir) ?>" style="margin:0px 0px 0px -8px; height:34px;" class="btn btn-primary glyphicon glyphicon-print"> Print Excel</a>
			</div>
			-->
		</div>
		
		</form>
		<br>
		<br>
		<br>
           <table id="" class="table table-striped table-bordered" style="width:100%">
        
        <tbody>
                    <?php echo $test;
								//$attendance_list = isset ( $attendance_list ) ? $attendance_list : [ ];
								?>								
								
				
              </tbody>
		</table>
        </div>		
		
<!-- sampe sini -->
    </div>
</div>


<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-3.3.7-dist-1/bootstrap-3.3.7-dist/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-3.3.7-dist-1/bootstrap-3.3.7-dist/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript">
		function printContent(el){
			var a = document.body.innerHTML;
			var b = document.getElementById(el).innerHTML;
			document.body.innerHTML = b;
			window.print();
			document.body.innerHTML = a;
			//window.location.href="<?php echo base_url('rshmbadmanagement/Controlbed/indextester')?>";
		}
	</script>


 


<!--Untuk Date Picker-->
<script type="text/javascript" src="<?php echo base_url()?>assets/bootstrap-3.3.7-dist-1/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
</script>



