<?php

$awal = date("d F Y",strtotime($tglawal));
$akhir = date("d F Y",strtotime($tglakhir));

header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=BOR_Grafik_Ranap_Pada_$awal-$akhir.xls");

?>

           <table id="" class="table table-striped table-bordered" style="width:100%">
        
        <tbody>
                    <?php echo $test;
								//$attendance_list = isset ( $attendance_list ) ? $attendance_list : [ ];
								?>								
								
				
              </tbody>
		</table>
        



