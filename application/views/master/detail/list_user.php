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
				<th>Username</th>
				<th>Role</th>
				<th>Opsi</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$no=1;
			if($q_data->num_rows()>0){
				foreach ($q_data->result() as $dt) {
					?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $dt->nama;?></td>
						<td><?php echo $dt->u_name;?></td>
						<td><?php echo $dt->role;?></td>
						<td>
							<div class="btn-group">
							<button type="button" class="btn btn-primary btn-sm btn_modal" data-toggle="modal" data-target="#myModal" data-id="<?php echo $dt->u_id; ?>" data-nama = "<?php echo $dt->nama; ?>" data-u_name = "<?php echo $dt->u_name; ?>" data-id_role = "<?php echo $dt->id_role; ?>"  data-act="lihat">Lihat</button>
								<button type="button" class="btn btn-info btn-sm btn_modal" data-toggle="modal" data-target="#myModal" data-id="<?php echo $dt->u_id; ?>" data-nama = "<?php echo $dt->nama; ?>" data-u_name = "<?php echo $dt->u_name; ?>" data-id_role = "<?php echo $dt->id_role; ?>"  data-act="ubah">Ubah</button>
								<button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?php echo $dt->u_id;?>')">Hapus</button>
								
							</div>
						</td>
					</tr>
					<?php
					$no++;
				}
			}
			?>
		</tbody>

	</table>
</div>