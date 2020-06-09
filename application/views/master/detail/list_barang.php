<script>
	$(document).ready(function () {
		$("#tb_data").dataTable({
			"lengthMenu": [[15,30,50, -1], [15,30,50,"All"]]
		});
	});
</script>

<div class="table-responsive">
	<table class="table table-hover" id="tb_data">
		<thead>
			<tr>
				<th>No</th>
				<th>Kode</th>
				<th>Nama</th>
				<th>Jenis</th>
				<th>Satuan</th>
				<th>Hpp</th>
				<th>HJual</th>
				<th>Opsi</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$no=1;
			if($q_data->num_rows()>0){
				foreach ($q_data->result() as $dt) {?>
				<tr>
					<td><?php echo $no;?></td>
					<td>
						<button type="button" class="btn btn-default btn-sm btn_modal_barcode" data-toggle="modal" data-target="#modalBarcode" data-kode="<?php echo $dt->kode;?>"><?php echo $dt->kode?></button>
						<!--<img src="<?=base_url();?>assets/plugins/php-barcode/barcode.php?text=<?php echo $dt->kode;?>&size=60&print=true&sizefactor=2" /> -->
					</td>
					<td><?php echo $dt->nama;?></td>
					<td><?php echo $dt->jenis;?></td>
					<td><?php echo $dt->satuan;?></td>
					<td><div class="number"><?php echo $dt->hpp;?></div></td>
					<td><div class="number"><?php echo $dt->jual1;?></div></td>
					<td>
						<button type="button" class="btn btn-primary btn-sm btn_modal" data-toggle="modal" data-target="#myModal" data-id="<?php echo $dt->id_barang; ?>" data-act="lihat" data-kode="<?php echo $dt->kode;?>" data-nama="<?php echo $dt->nama;?>" data-id_jenis="<?php echo $dt->id_jenis;?>" data-satuan="<?php echo strtolower($dt->satuan);?>" data-hpp="<?php echo $dt->hpp;?>"  data-hjual="<?php echo $dt->jual1;?>">Lihat</button>
						<button type="button" class="btn btn-info btn-sm btn_modal" data-toggle="modal" data-target="#myModal" data-id="<?php echo $dt->id_barang; ?>" data-act="ubah" data-kode="<?php echo $dt->kode;?>" data-nama="<?php echo $dt->nama;?>"
							data-id_jenis="<?php echo $dt->id_jenis;?>" data-satuan="<?php echo strtolower($dt->satuan);?>" data-hpp="<?php echo $dt->hpp;?>"  data-hjual="<?php echo $dt->jual1;?>">Ubah</button>
							<button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?php echo $dt->id_barang;?>')">Hapus</button>
						</td>
					</tr>

					<?
					$no++;
				}
			}
			?>


		</tbody>

	</table>
</div>