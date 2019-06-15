
<!-- end popup -->

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
<div class="container" >	
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
	
	
	
	
</div>
		
	 </div>
	  </div>
 </div>
 </div>
<!-- sampe sini -->

<div class="" style="padding-left:0px;padding-top:0px;overflow: auto;" >


<center><h2 style="color:brown" class="pull-" align="center"><b>Data Bed Yang Akan Kosong Pada Hari Ini  </b></h2></center>

	<legend>
	</legend>


<!--			
<div class="col-md-12">
&nbsp;
</div>
-->
           <table id="table_id" class="table table-striped table-bordered" style="width:100%">
        <thead>
                <tr>
					<th style="vertical-align:middle;"><center>Nama Bed</center></th>
					<th style="vertical-align:middle;"><center>Tanggal Check In</center></th>
					<th style="vertical-align:middle;"><center>Tanggal Check out</center></th>
					<th style="vertical-align:middle;"><center>Estimasi Waktu Pulang</center></th>
					
					
					
					<!--<th style="width:125px;">Action
						</p>
					</th>
					-->
                </tr>
              </thead>
			  
        <tbody>
                    <?php foreach($listbed as $list){
						 //////////// tgl cekin ////////////
					$tglcekin = $list->TgLIsi;
						  if($tglcekin){
							$tglisi = date("d F Y",strtotime($list->TgLIsi))." ".$list->JamIsi;
						  }else{
							$tglisi = " "; 
						  } 	
					 //////////// tgl cekout ////////////
					$tglcekout = $list->TglKeluar;
						  if($tglcekout){
							$tglkeluar = date("d F Y",strtotime($list->TglKeluar))." ".$list->JamKeluar;
						  }else{
							$tglkeluar = " "; 
						  }	
					//////////// estimasi pulang /////////////////
				$datatglcekout = date("Y-m-d H:i:s",strtotime($list->TglKeluar." ".$list->JamKeluar));
				$awal  = date_create($datatglcekout);
				$akhir = date_create(); // waktu sekarang
				$diff  = date_diff( $awal, $akhir );

				$hasilestimasi = $diff->m . ' bulan, '.$diff->d . ' hari '.'<br>'.$diff->h . ' jam, '.$diff->i . ' menit, '.$diff->s . ' detik';
				//$hasilestimasi = $diff->d . ' hari, '.$diff->h . ' jam, '.$diff->i . ' menit, '.$diff->s . ' detik';
			
						
					?>
					
					
					
					<tr style="background:white;">
						<td style="vertical-align:middle;">
				
						<div style="width:100%px;" class="info-box bg-red">
							<span class="info-box-icon" style="cursor:pointer;" >
							<i class="fa fa-bed" onclick="ambilpasien('<?php echo $list->MR?>','<?php echo $list->Dokter?>','<?php echo $list->KodeBed?>','<?php echo $list->NamaBed?>')"></i>
							
							</span>
							
							
								<div class="info-box-content">
									<small><?php echo $list->NamaBed; ?></b></small>
									<legend></legend>
									<span>MR : <?php echo $list->MR?></span>
									
								</div><!-- /.info-box-content -->
						</div><!-- /.info-box --></td>
						<td style="vertical-align:middle;"><center><?php echo $tglisi; ?></td>
						<td style="vertical-align:middle;"><center><?php echo $tglkeluar; ?></td>
						<td style="vertical-align:middle;"><center><?php echo $hasilestimasi; ?></td>
						
					</tr>
					
					<?php }?>	
								
				
              </tbody>
		</table>
        </div>
		
<!-- layout print langsung -->		
<div id="print" style="display:none;">
<div class="col-md-12">
<table>
	<tr>
		<td>
			 <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-bed"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Sedang Kosong</span>
                  <span class="info-box-number"><?php echo $datakosong['Kosong']?> Bed</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: <?php echo $datakosong['Kosong']?>%"></div>
                  </div>
                  <span class="progress-description">
                   
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
			  
		</td>
		<td>
			<div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-bed"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Sedang Dibersihkan</span>
                  <span class="info-box-number"><?php echo $datadibersihkan['Dibersihkan']?> Bed</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: <?php echo $datadibersihkan['Dibersihkan']?>%"></div>
                  </div>
                  <span class="progress-description">
                    
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
		</td>
		<td>
			 <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-bed"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Sedang Terisi</span>
                  <span class="info-box-number"><?php echo $dataterisi['Isi']?> Bed</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: <?php echo $dataterisi['Isi']?>%"></div>
                  </div>
                  <span class="progress-description">
                    
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
		</td>
		<td>
		 <div class="info-box bg-primary">
                <span class="info-box-icon"><i class="fa fa-bed"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Tidak Dapat Digunakan</span>
                  <span class="info-box-number"><?php echo $datatidakaktif['Tidakaktif']?> Bed</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: <?php echo $datatidakaktif['Tidakaktif']?>%"></div>
                  </div>
                  <span class="progress-description">
                   
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
		</td>
		<td>
		<div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-bed"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Sedang Diboking</span>
                  <span class="info-box-number">0</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 0%"></div>
                  </div>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
	
		</td>
	</tr>
</table>
	
	
	
	</div>

           <table id="" class="table table-striped table-bordered" style="width:100%">
        <thead>
                <tr>
					<th ><center>Kode Ruangan</center></th>
					<th><center>Nama Ruangan</center></th>
					<th><center>Nama Kelas</center></th>
					<th><center>Nama Kamar</center></th>
					
					
					
					<!--<th style="width:125px;">Action
						</p>
					</th>
					-->
                </tr>
              </thead>
			  
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
      $('#table_idbad').DataTable({
		  //"pageLength":1000
		  "lengthMenu":[[10,50,100,-1],[10,50,100,'ALL']]
	  });
  } );
  
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

 function ambilpasien(mr,kodedokter,kodebed,namabed)
    {
		 // $('#myModal').modal('show');
		//alert('helo');
     // save_method = 'update';
     //$('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('Controlbed/ajaxambilpasienpulangsekarang/')?>/" + mr +"/"+kodedokter+"/"+kodebed,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

		    $('#NamaKamar2').html(data);
			 $('#Namabed').html('No Data');
			 $('#namakamar').html('Data Bed');
			 $('#namaruang').html('Data Pasien Pada Bed '+namabed);
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



