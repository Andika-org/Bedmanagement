<?php

$awal = date("d F Y",strtotime($tglawal));
$akhir = date("d F Y",strtotime($tglakhir));

header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=Data_Bor_Pada_Tanggal_$awal-$akhir.xls");

?>
           <table class="table table-striped table-bordered" style="width:100%">
        <thead>
				<tr>
					<th colspan="<?php echo $span+3; ?>" style="vertical-align:middle;background:#90EE90;border:1px solid black;"><center>Data Bor Pada Tanggal <?php echo date("d F Y",strtotime($tglawal)); ?> Sampai <?php echo date("d F Y",strtotime($tglakhir)); ?></center></th>
                </tr>
                <tr>
					<th rowspan="2" style="vertical-align:middle;background:#FFEBCD;border:1px solid black;"><center>Nama Kelas</center></th>
					<th rowspan="2" style="vertical-align:middle;background:#FFEBCD;border:1px solid black;"><center>Bed Allocated</center></th>
					<th style="vertical-align:middle;background:#D3D3D3;border:1px solid black;" colspan="<?php echo $span; ?>"><center>Tanggal</center></th>
					<th rowspan="2" style="vertical-align:middle;background:#FFEBCD;border:1px solid black;"><center>Jumlah</center></th>
                </tr>
				<tr>
				<?php for($i=$tanggalcolomawal+1-1;$i<=$tanggalcolomakhir;$i++){ ?>
					<th style="vertical-align:middle;background:#87CEFA;border:1px solid black;"><center><?php echo $i; ?></center></th>
				<?php } ?>
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
    



