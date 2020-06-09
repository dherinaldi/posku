<script type="text/javascript" >
	$(document).ready(function() {
		$('#lap_master_barang').dataTable();

		$("#end").datepicker({ format: 'dd-mm-yy' });
		$("#start").datepicker({ format: 'dd-mm-yy' }).bind("change",function(){
			var minValue = $(this).val();
			minValue = $.datepicker.parseDate("dd-mm-yy", minValue);
			minValue.setDate(minValue.getDate()+1);
			$("#end").datepicker( "option", "minDate", minValue );
		});
	});
</script>
<div class="row">
	<div class="col-md-12">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Laporan Master Barang</h3>
        	    <!-- <div class="box-tools pull-right">
        	                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        	                    </div> --><!-- /.box-tools -->
        	                </div><!-- /.box-header -->
        	                <div class="box-body">
        	                	<div class="table-responsive">
        	                		<table class="table table-hover" id="lap_master_barang">
        	                			<thead>
        	                				<tr>
        	                					<th>No</th>
        	                					<th>Data Barang</th>
        	                					<th>Sat</th>
        	                					<th>Tanggal</th>
        	                					<th>Kode Pengadaan</th>
        	                					<th>Jumlah Barang</th>
        	                					<th>Harga Satuan</th>
        	                					<th>Jumlah Harga</th>
        	                					<th>Tanggal</th>
        	                					<th>Kode Pengeluaran</th>
        	                					<th>Jumlah Barang</th>
        	                					<th>Harga Satuan</th>
        	                					<th>Jumlah Harga</th>
        	                				</tr>
        	                			</thead>
        	                			<tbody>
        	                				<?php 
        	                				$no=1;
        	                				$i=1;
        	                				$tmp_hasil=0;
        	                				/*$id_dist = array();*/
        	                				$id= array();
        	                				$sisa=array();
        	                				$tmp=array();

        	                				foreach ($dt_laporan->result() as $dt) {
        	                					$id_barang = $dt->id_barang;
        	                					$banyak_barang = $dt->banyak_barang;
        	                					$banyak_barang_keluar = $dt->banyak_barang_keluar;
        	                					$sisa[$no]=$banyak_barang-$banyak_barang_keluar;
        	                					if ($banyak_barang>$sisa[$no]){
        	                						$tmp[$no] = $banyak_barang_keluar;
        	                						$tmp_hasil= $tmp[$no];
        	                						echo "idbarang".$id_barang."-".$banyak_barang.">".$sisa[$no]."tmp".$tmp[$no];
        	                						echo "<br>";
        	                					}
        	                					else{
        	                						$banyak_barang."=<".$sisa[$no];
        	                						echo "<br>";
        	                					}

        	                					?>
        	                					<tr>
        	                						<td><?php echo $no;?></td>
					<td><?php //echo $dt->id_barang." ".$dt->nama_barang;
						echo $dt->nama_barang;
						?></td>
						<td><?php echo $dt->nama_satuan;?></td>
						<td><?php echo $dt->tanggal_pengadaan;?></td>
					<td><?php //echo $dt->id_pengadaan." ".$dt->kd_pengadaan;
						echo $dt->kd_pengadaan;?></td>
						<td><?php echo $dt->banyak_barang;?></td>
						<td align="right"><?php echo $dt->harga;?></td>
						<td align="right"><?php echo $dt->subtotal;?></td>
						<td><?php echo $dt->tanggal_pengeluaran;?></td>
					<td><?php //echo $dt->id_pengeluaran." ".$dt->kd_pengeluaran;
						echo $dt->kd_pengeluaran?></td>
						<td><?php echo $dt->banyak_barang_keluar;?></td>
						<td align="right"><?php echo $dt->harga_keluar;?></td>
						<td align="right"><?php echo $dt->subtotal_keluar;?></td>
					</tr>
					<?
					$no++;
					$i++;
				}
				?>

				
			</tbody>
		</table>
	</div>
</div>
</div>
</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="box box-warning box-solid">
			
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-hover">			
						<tbody>
							<tr>
								<td colspan="3">Total</td>
								<td>Pengadaan</td>
								<?
								foreach ($total ->result() as $dat) {
									$total_pengadaan = $dat->total;
									$total_pengeluaran = $dat->total_pengeluaran;
								}?>
								<td colspan="4" align="right"><div style="font-size:20px;"><strong><?php echo convertrp($total_pengadaan);?></strong></div></td>
								<td>Pengeluaran</td>
								<td colspan="4" align="right"><div style="font-size:20px;"><strong><?php echo convertrp($total_pengeluaran);?></strong></div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>