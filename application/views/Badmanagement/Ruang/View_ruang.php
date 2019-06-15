   
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap-3.3.7-dist-1/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap-3.3.7-dist-1/bootstrap-3.3.7-dist/datatables/dataTables.bootstrap4.min.css">
	<link href="<?php echo base_url()?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>


<!-- data -->
<div class="container" >
<!-- untuk Tambah Bahan Baku-->	
<!-- untuk Tambah Bahan Baku-->		
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
	  
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="color:brown"><b>Data Update Check In/Out</b></h2>
        </div>
<div class="modal-body">
    <table id="table_idpopup" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th><center>Tanggal Awal</th>
			<th><center>Tanggal Akhir</th>
			<th><center>Tanggal Update</th>
			<th><center>Tools</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($dataupdatetelat as $datajumlah){ ?>
		</tr>
			<td><center><?php echo date("d F Y",strtotime($datajumlah->Tanggal_Awal)); ?></td>
			<td><center><?php echo date("d F Y",strtotime($datajumlah->Tanggal_Akhir)); ?></td>
			<td><center><?php echo date("d F Y",strtotime($datajumlah->Tanggal_Update)); ?></td>
			<td><center>
				<form action="<?php print site_url();?>ControlAbsensi/previewdatatelat" method="POST">
					<input type="hidden" value="<?php echo $datajumlah->Tanggal_Awal;?>" name="Tanggal_Awal" class="form form-control">
					<input type="hidden" value="<?php echo $datajumlah->Tanggal_Akhir;?>" name="Tanggal_Akhir" class="form form-control">
					<button type="submit" class="btn btn-primary glyphicon glyphicon-search"> Search</button>
				</form>
			</td>
		</tr>
		</tbody>
		<?php } ?>
	</table>

</div>
		
	 </div>
	  </div>
 </div>
 </div>
 
  <!-- Bootstrap modal -->

<!-- sampe sini -->

<div class="container" style="padding-left:0px;padding-top:0px;overflow: auto;" > 
<h2 style="color:brown" align="center"><b>Data Bad </b></h2>
	<legend>
	</legend>
	
		<div class="navbar-header pull-right "  >
			&nbsp <span style="margin-left:10px;" onclick="listupdate();" class="btn btn-primary glyphicon glyphicon-folder-open" > Data Update</span>
		</div>
		<br>
		<br>
		<br>
			
           <table id="table_id" class="table table-striped table-bordered" style="width:100%">
        <thead>
                <tr>
					<th><center>No.</center></th>
					<th><center>Nomor Urut</center></th>
					<th><center>Kode Ruangan</center></th>
					<th><center>Nama Bed</center></th>
					<th><center>Status Kamar</center></th>
					<th><center>No. MR</center></th>
					<th><center>Dokter</center></th>
					<th><center>Tanggal Isi</center></th>
					<th><center>Tanggal Keluar</center></th>
					<th><center>Tools</center></th>
					
					<!--<th style="width:125px;">Action
						</p>
					</th>
					-->
                </tr>
              </thead>
			  
        <tbody>
                    <?php
								$attendance_list = isset ( $attendance_list ) ? $attendance_list : [ ];
								?>								
								<?php
								foreach ( $attendance_list as $attendance ) {
									/*
									$attendance_datetime = $attendance ['attendance_datetime'];
									$datetimes = implode ( "<br><p style='margin-top:10px;'>", $attendance_datetime );
									
									$timedept = $attendance ['jam_departement'];
									$timesdepartement = implode ( "<br><p style='margin-top:10px;'>", $timedept );
									
									$timedepttime = $attendance ['time_departement'];
									$timesdepartementtime = implode ( "<br><p style='margin-top:10px;'>", $timedepttime );
									*/
									?>
                      <tr>
							<td style="vertical-align:middle;"><?php echo $attendance["nomor"];?></td>
							<td style="vertical-align:middle;"><?php echo $attendance["nourut"];?></td>
							<td style="vertical-align:middle;"><?php echo $attendance["koderuang"];?></td>
							<td style="vertical-align:middle;"><?php echo $attendance["namabed"];?></td>
							<td style="vertical-align:middle;"><?php echo $attendance["statuskamar"];?></td>
							<td style="vertical-align:middle;"><?php echo $attendance["mr"];?></td>
							<td style="vertical-align:middle;"><?php echo $attendance["dokter"];?></td>
							<td style="vertical-align:middle;"><?php echo $attendance["tglisi"]." ".$attendance["jamisi"];?></td>
							<td style="vertical-align:middle;"><?php echo $attendance["tglkeluar"]." ".$attendance["jamkeluar"];?></td>
							<td style="vertical-align:middle;"></td>
					  </tr>
                    <?php }?>
				
              </tbody>
		</table>
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
		}
	</script>
<script type="text/javascript">
 function listupdate()
    {
      //save_method = 'add';
      //$('#form')[0].reset(); // reset form on modals
      $('#myModal').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

</script>

<script type="text/javascript">
	$(document).ready( function () {
		$('.new').click(function(){
			$('.upload').toggle();
		   $('.submit').toggle();
	  });
	});
 </script>
<script type="text/javascript">
  $(document).ready( function () {
      $('#table_id').DataTable({
		  //"pageLength":1000
		  "lengthMenu":[[10,50,100,-1],[10,50,100,'ALL']]
	  });
  } );
  
</script>
<script type="text/javascript">
  $(document).ready( function () {
      $('#table_idpopup').DataTable({
		  //"pageLength":1000
		  "lengthMenu":[[10,50,100,-1],[10,50,100,'ALL']]
	  });
  } );
  
</script>
<script type="text/javascript">
  $(document).ready( function () {
      $('#table_id_data').DataTable({
		  //"pageLength":1000
		  "lengthMenu":[[10,50,100,250,500,-1],[10,50,100,250,500,"ALL"]]
	  });
  } );
  
</script>

 <script type="text/javascript">

 function deleteupload(id,namafile) {
	// if(hakakses == "Kepala Gudang"){
	//	 $("#aksesinformation").modal("show");
	 //}else{
		if (confirm("Are you sure delete this data ?")) {
        $.ajax({
            url: "<?php echo base_url('ControlAbsensi/deleteuploadabsensi/')?>" + id + "/" + namafile,
            //type: 'post',
            data: id,
            success: function () {
				window.location.href="<?php echo base_url('ControlAbsensi/uploadabsensi/')?>";
            },
            error: function () {
                alert('ajax failure');
            }
        });
    } else {
        alert(id + " not process");
    } 
	
 //}
    
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



