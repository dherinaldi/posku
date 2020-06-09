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
				<th>Faktur</th>
				<th>Tgl</th>
				<th>Supp</th>
				<th>Total</th>
				<th>Bayar</th>
				<th>Tempo</th>
				<th>Opr</th>
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
					<td><?php echo $dt->faktur;?></td>
					<td><?php echo converttgl1($dt->tanggal);?></td>
					<td><?php echo $dt->supp;?></td>
					<td><div class="number"><?php echo digit21($dt->total);?></div></td>
					<td><div class="number"><?php echo digit21($dt->bayar);?></div></td>
					<td><?php echo converttgl1($dt->tempo);?></td>
					<td><?php echo $dt->opr;?></td>
					<td>
						<a class="btn btn-primary btn-sm" href="#" role="button">Lihat</a>
						<a class="btn btn-info btn-sm" href="<?php echo base_url('beli/edit/'.$dt->id)?>" role="button">Ubah</a>
						<a class="btn btn-danger btn-sm" href="#" role="button">Hapus</a>
						
					</td>
				</tr>
				<?php
				$no++;
			}
		}?>
	</tbody>

</table>
</div>