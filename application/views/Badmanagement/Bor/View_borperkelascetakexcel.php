<?php

$awal = $tglawal;
$akhir = $tglakhir;

header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=BOR_Ranap_PerKelas_$awal-$akhir.xls");

?>

<div class="" style="padding-left:0px;padding-top:0px;overflow: auto;" >


<center><h2 class="pull-" align="center"><b>Data BOR Per Kelas Rawat Inap Pada Tanggal <?php echo date("d F Y",strtotime($tglawal)); ?> Sampai <?php echo date("d F Y",strtotime($tglakhir)); ?></b></h2></center>

	<legend>
	</legend>
           <table class="table table-striped table-bordered" style="width:100%">
        <thead>
                <tr>
					<th style="vertical-align:middle;border:1px solid black;"><center>Nama Kelas</center></th>
					<th style="vertical-align:middle;border:1px solid black;"><center>Bed Allocated</center></th>
					<th style="vertical-align:middle;border:1px solid black;"><center>Bed Occupied</center></th>
					<th style="vertical-align:middle;border:1px solid black;"><center>Total BOR Persentase</center></th>

                </tr>
              </thead>
			  
        <tbody>
                    <?php echo $test; ?>								
								
				
              </tbody>
		</table>
        </div>		
    </div>
</div>



