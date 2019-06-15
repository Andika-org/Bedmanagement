<?php

$awal = date("d F Y",strtotime($tglawal));
$akhir = date("d F Y",strtotime($tglakhir));

header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=Data_Pasien_Ranap_$awal-$akhir.xls");

?>

<div class="" style="padding-left:0px;padding-top:0px;overflow: auto;" >


<center><h2 style="" class="pull-" align="center"><b>Data Pasien Ranap Pada Tanggal <?php echo date('d F Y',strtotime($tglawal)) ?>  Sampai <?php echo date('d F Y',strtotime($tglakhir)) ?> </b></h2></center>

	<legend>
	</legend>
	
	
           <table class="table table-striped table-bordered" style="width:100%">
        <thead>
                <tr>
					<th style="vertical-align:middle;border:1px solid black;"><center>MR</center></th>
					<th style="vertical-align:middle;border:1px solid black;"><center>Nama Pasien</center></th>
					<th style="vertical-align:middle;border:1px solid black;"><center>Tanggal Masuk</center></th>
					<th style="vertical-align:middle;border:1px solid black;"><center>Tanggal Keluar</center></th>
					<th style="vertical-align:middle;border:1px solid black;"><center>Lama Di Rawat</center></th>
					<th style="vertical-align:middle;border:1px solid black;"><center>Kelas</center></th>
					
					
					
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



