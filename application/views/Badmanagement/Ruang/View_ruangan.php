   
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
<!-- data -->
<div class="container" >
<!-- untuk Tambah Bahan Baku-->	
<!-- untuk Tambah Bahan Baku-->		
  <!-- Modal -->
  <div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
	  
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h3 class="text text-danger"><b><div id="namakelas"></div></b></h3>
        </div>
<div class="modal-body">

	<div class="Compose-Message">               
			<div class="panel panel-primary">
				<div class="panel-heading" >
                       
				<b><div id="namaruang"></div></b>
								
				</div>
		<div class="panel-body" style="padding-top:10px;border:1px solid #DDDDDD">
        
		<div id="NamaKamar2">
		
		</div>
		
		</div>
		</div>
	</div>
	
	<div class="Compose-Message">               
			<div class="panel panel-primary">
				<div class="panel-heading" >
                       
				<b><div id="namakamar"></div></b>
								
				</div>
		<div class="panel-body" style="padding-top:10px;border:1px solid #DDDDDD">
        
		<div id="Namabed">
		
		</div>
		
		</div>
		</div>
	</div>
	
	<div class="Compose-Message">               
			<div class="panel panel-warning">
				<div class="panel-heading" >
                       
				<b>Detail Information Status Bed</b>
								
				</div>
		<div class="panel-body" style="padding-top:10px;border:1px solid #DDDDDD">
        
		<table class="table table-bordered">
			<tr>
				<td style="background:green;width:50%;color:white;"><b>Sedang Kosong</b></td>
				
			</tr>
			<tr>
				<td style="background:orange;width:50%;color:white;"><b>Sedang Dibersihkan</b></td>
			</tr>
			<tr>
				<td style="background:red;width:50%;color:white;"><b>Sedang Terisi</b></td>
			</tr>
			<tr>
				<td style="background:blue;width:50%;color:white;"><b>Tidak Dapat Digunakan</b></td>
			</tr>
		</table>
		
		</div>
		</div>
	</div>
	
	
	
</div>
		
	 </div>
	  </div>
 </div>
 </div>
<!-- sampe sini -->

<div class="" style="padding-left:0px;padding-top:0px;overflow: auto;" > 
<h2 style="color:brown" align="center"><b>Data Ruangan </b></h2>
	<legend>
	</legend>
	
           <table id="table_id" class="table table-striped table-bordered" style="width:100%">
        <thead>
                <tr>
					<th><center>No.</center></th>
					<th><center>Kode Ruangan</center></th>
					<th><center>Nama Ruangan</center></th>
					<th><center>Nama Kelas</center></th>
					<th><center>Kapasitas</center></th>
					<th><center>Kamar</center></th>
					<th><center>Status Ruangan</center></th>
					
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
						<?php $statuskelas = $attendance["rootkelas"];
						if($statuskelas == "Non Aktif"){?>
                      <tr style="background:red;">
							<td style="vertical-align:middle;color:white;"><center><?php echo $attendance["nomor"];?></center></td>
							<td style="vertical-align:middle;color:white;"><center><?php echo $attendance["koderuang"];?></center></td>
							<td style="vertical-align:middle;color:white;"><?php echo $attendance["namaruang"];?></td>
							<td style="vertical-align:middle;color:white;"><?php echo $attendance["namakelas"];?></td>
							<td style="vertical-align:middle;color:white;"><center><?php echo $attendance["kapasitas"];?></center></td>
							<td style="vertical-align:middle;color:white;"><center>Tidak Ada</center></td>
							<td style="vertical-align:middle;color:white;"><center><?php echo $attendance["rootkelas"];?></center></td>
					  </tr>
						<?php } else{?>
						  <tr style="background:white;">
							<td style="vertical-align:middle;"><center><?php echo $attendance["nomor"];?></center></td>
							<td style="vertical-align:middle;"><center><?php echo $attendance["koderuang"];?></center></td>
							<td style="vertical-align:middle;"><?php echo $attendance["namaruang"];?>
							</td>
							<td style="vertical-align:middle;"><?php echo $attendance["namakelas"];?> <!--<span class="pull-right glyphicon glyphicon-hand-up btn btn-primary"> </span>--></td>
							<td style="vertical-align:middle;"><center><?php echo $attendance["kapasitas"];?></center></td>
							<td style="vertical-align:middle;"><center>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="ambilkamar('<?php echo $attendance["koderuang"];?>','<?php echo $attendance["namaruang"];?>','<?php echo $attendance["namakelas"];?>')"><i class="glyphicon glyphicon-home"></i>&nbsp; Lihat Kamar</center></a>
							</td>
							<td style="vertical-align:middle;"><center><?php echo $attendance["rootkelas"];?></center></td>
					  </tr>
						<?php }}?>
				
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
      $('#table_datakamar').DataTable({
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

 function ambilkamar(idnya,namaruang,namakelas)
    {
		 // $('#myModal').modal('show');
		//alert('helo');
     // save_method = 'update';
     //$('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('Controlruang/ajaxambilkamar/')?>/" + idnya,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

		    $('#NamaKamar2').html(data);
			 $('#Namabed').html('No Data');
			 $('#namakamar').html('Data Bed');
			 $('#namaruang').html('Data Kamar Pada Ruangan '+namaruang);
			 $('#namakelas').html(namakelas);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Book'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }
	
	function ambilbed(idnya,namakamar)
    {
		 // $('#myModal').modal('show');
		//alert('helo');
     // save_method = 'update';
     //$('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('Controlruang/ajaxambilbed/')?>/" + idnya,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

		    $('#Namabed').html(data);
			$('#namakamar').html('Data Bed Pada Kamar '+namakamar);
			 

           // $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
          //  $('.modal-title').text('Edit Book'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
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



