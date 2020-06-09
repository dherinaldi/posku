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
				<th>Nama</th>
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
					<td><?php echo $dt->nama;?></td>
					<td>
						<button type="button" class="btn btn-primary btn-sm btn_modal" data-toggle="modal" data-target="#myModal" data-id="<?php echo $dt->id; ?>" data-act="lihat">Lihat</button>
						<button type="button" class="btn btn-info btn-sm btn_modal" data-toggle="modal" data-target="#myModal" data-id="<?php echo $dt->id; ?>" data-act="ubah">Ubah</button>
						<button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?php echo $dt->id;?>')">Hapus</button>
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