
	

</body>
</html>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap-3.3.7-dist-1/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap-3.3.7-dist-1/bootstrap-3.3.7-dist/datatables/dataTables.bootstrap4.min.css">
	<link href="<?php echo base_url()?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>
 
  

<div class="" style="padding-left:0px;padding-top:0px;overflow: auto;" >


<center><h2 style="color:brown" class="pull-" align="center"><b>Update Status Dibersihkan</b></h2></center>

	<legend>
	</legend>
	<form class="form-signin" method="POST" action="<?php echo base_url();?>Controlbed/simpanstatuspembersihanbed/" enctype="multipart/form-data">
	
	
	<input type="hidden" name="KodeBed" value="<?php echo $kodebed; ?>" class="form form-control" readonly >
	<input type="hidden" name="KodeKamar" value="<?php echo $kodekamar; ?>" class="form form-control" readonly >
	<input type="hidden" name="KodeRuang" value="<?php echo $koderuang; ?>" class="form form-control" readonly >
	<input type="hidden" name="KodeKelas" value="<?php echo $kodekelas; ?>" class="form form-control" readonly >
	
	<div class="col-xs-12">
		<div class="Compose-Message">               
			<div class="panel panel-primary">
				<div class="panel-heading" style="">
                       
				<b>Form Update Pembersihan Bed <button type="submit" class="pull-right btn btn-success glyphicon glyphicon-floppy-disk"> Save Data</button></b>
								
				</div>
		<div class="panel-body">
        <br>
		 <table class="table table-bordered" style="width:">
        <thead>
                <tr>
					<td style="vertical-align:middle;">Koordinator Kebersihan</center></td>
					<td style="vertical-align:middle;"><center><input type="text" value="<?php echo $this->session->userdata["USER_ID"]; ?>" name="User_Id" class="form form-control" readonly ></center></td>
                </tr>
				<tr>
					<td style="vertical-align:middle;">Nama Bed</center></td>
					<td style="vertical-align:middle;"><center><input type="text" value="<?php echo $namabed; ?>" class="form form-control" readonly ></center></td>
                </tr>
				<tr>
					<td style="vertical-align:middle;">Nama Kamar</center></td>
					<td style="vertical-align:middle;"><center><input type="text" value="<?php echo $namakamar; ?>" class="form form-control" readonly ></center></td>
                </tr>
				<tr>
					<td style="vertical-align:middle;">Nama Ruangan</center></td>
					<td style="vertical-align:middle;"><center><input type="text" value="<?php echo $namaruang; ?>" class="form form-control" readonly ></center></td>
                </tr>
				<tr>
					<td style="vertical-align:middle;">Nama Kelas</center></td>
					<td style="vertical-align:middle;"><center><input type="text" value="<?php echo $namakelas; ?>" class="form form-control" readonly ></center></td>
                </tr>
				<tr>
					<td style="vertical-align:middle;">Tanggal Dan Jam Bersih</center></td>
					<td style="vertical-align:middle;"><center><input type="text" value="<?php echo date("d F Y H:i:s",strtotime($tanggalbersih)); ?>" name="tanggaldanjambersih" class="form form-control" readonly ></center></td>
                </tr>
				<tr>
					<td style="vertical-align:middle;">Petugas Kebersihan</center></td>
					<td style="vertical-align:middle;"><center><textarea name="PetugasKebersihan" class="form form-control"></textarea></center></td>
                </tr>
			
              </thead>
		</table>
		
		</form>
		
		</div>
		</div>
	</div>
	</div>
	
          
	</div>
<!-- sampe sini -->
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-3.3.7-dist-1/bootstrap-3.3.7-dist/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-3.3.7-dist-1/bootstrap-3.3.7-dist/datatables/dataTables.bootstrap.js"></script>


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



