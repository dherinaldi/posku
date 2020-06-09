<style type="text/css">
	@media all {
		.page-break  { display: none; }
	}

	@media print {
		.page-break  { display: block; page-break-before: always; }
	}
	td {
		padding:2px;
	}
</style>
<div class="box-body">
	<div>
		<table class="table" width="50%">
			<thead>
				<tr>
					<th><?php echo $title;?></th>
				</tr>
				<tr>
					<th>Periode <?php echo $s_periode;?></th>
				</tr>
			</thead>

		</table>
	</div>
	<div>
		<table style="height: 55px;font-size:12px;font-family:Monospace" width="100%" border="1" cellpadding="0" cellspacing="0">
			<thead>
				<tr bgcolor="silver">
					<td>No</td>
					<td>Tgl</td>
					<td>No Bukti</td>
					<td>Uraian</td>
					<td>Nominal</td>
					<td>Sebelumnya</td>
					<td>Debet</td>
					<td>Kredit</td>
					<td>Saldo</td>
				</tr>
			</thead>
			<tbody>
				<?php
				//echo $sa;
				if($q_data->num_rows()>0){
					$masuk=$keluar=$sisa=0;
					$no=1;
					foreach ($q_data->result() as $key) {
						$tipe = $key->tipe_diagram;

						?>
						<tr>			
							<td><?php echo $no;?></td>
							<td><div class="wd100"><?php echo converttgl1($key->tgl);?></div></td>
							<td><?php echo $key->no_bku;?></td>
							<td><?php echo $key->uraian;?></td>
							<?php 
							if($key->masuk!=0){
								$nominal =$key->masuk;
							}else{
								$nominal =$key->keluar;
							}

							if($tipe=="1"){
								$masuk = $nominal;
								$keluar = 0;
							}elseif($tipe=="2"){
								$masuk = 0;
								$keluar = $nominal;
							}elseif($tipe=="1,2"){
								$masuk = $nominal;
								$keluar = $nominal;
							}
							else{
								$masuk = 0;
								$keluar = 0;

							}

							if($no==1){
								$sa=$sa;
							}
							$sisa = $sa+$masuk-$keluar;
							?>

							<td align="right"><?php echo digit21($nominal);?></td>
							<td align="right"><?php echo digit21($sa);?></td>
							<td align="right"><?php echo digit21($masuk);?></td>
							<td align="right"><?php echo digit21($keluar);?></td>
							<td align="right"><?php echo digit21($sisa);?></td>
						</tr>
						<?php 
						$no++;
						$sa=$sisa;
					}
				}else{
					$nominal=$masuk=$keluar=$sisa=0;
					$sisa = $sa+$masuk-$keluar;
					?>
					<tr>
						<td colspan="4" align="center">Saldo Terkini</td>
						<td align="right"><?php echo digit21($nominal);?></td>
						<td align="right"><?php echo digit21($sa);?></td>
						<td align="right"><?php echo digit21($masuk);?></td>
						<td align="right"><?php echo digit21($keluar);?></td>
						<td align="right"><?php echo digit21($sisa);?></td>
					</tr>

					<?php }?>

				</tbody>

				<tfoot>

				</tfoot>

			</table>
		</div>
	</div>