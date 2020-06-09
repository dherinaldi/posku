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
				<th>Kota</th>
				<th>Telp1</th>
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
					<td><?php echo $dt->kode;?></td>
					<td><?php echo $dt->nama;?></td>
					<td><?php echo $dt->kota;?></td>
					<td><?php echo $dt->tlp1;?></td>
					<td>
						<button type="button" class="btn btn-primary btn-sm btn_modal" data-toggle="modal" data-target="#myModal" data-id="<?php echo $dt->id_supp; ?>" data-act="lihat">Lihat</button>
						<button type="button" class="btn btn-info btn-sm btn_modal" data-toggle="modal" data-target="#myModal" data-id="<?php echo $dt->id_supp; ?>" data-act="ubah">Ubah</button>
						<button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?php echo $dt->id_supp;?>')">Hapus</button>
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