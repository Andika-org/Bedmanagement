<?php

$awal = date("d F Y",strtotime($tglawal));
$akhir = date("d F Y",strtotime($tglakhir));

header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=Bed_Dibersihkan_$awal-$akhir.xls");

?>
		<center><b>Laporan Bed Dibersihkan Pada <?php echo date("d F Y",strtotime($tglawal)); ?> Sampai <?php echo date("d F Y",strtotime($tglakhir)); ?></b>
		</center>
		<br>
		<table class="table table-bordered" style="width:100%;">
        <thead>
                <tr>
					<th style="border:1px solid black;"><center>Kelas</center></th>
					<th style="border:1px solid black;"><center>Ruangan</center></th>
					<th style="border:1px solid black;"><center>Kamar</center></th>
					<th style="border:1px solid black;"><center>Bed</center></th>
					<th style="border:1px solid black;"><center>Koordinator Kebersihan</center></th>
					<th style="border:1px solid black;"><center>Tanggal Bersih</center></th>
					<th style="border:1px solid black;"><center>Petugas Kebersihan</center></th>
                </tr>
              </thead>
			  
        <tbody>
                    <?php echo $test;
								//$attendance_list = isset ( $attendance_list ) ? $attendance_list : [ ];
								?>								
								
				
              </tbody>
		</table>
		



