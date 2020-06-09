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
					<th>NO</th>
					<th>KODE</th>
					<th>PAJAK</th>
					<th>NOMINAL</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no=1;
				foreach ($q_dt->result() as $key) {
					?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $key->kode_pajak;?></td>
						<td><?php echo $key->nama_pajak;?></td>
						<td align="right"><?php echo digit21($key->hasil);?></td>
					</tr>
					<?php
					$no++;
				}
				?>
			</tbody>

			<tfoot>

			</tfoot>

		</table>
	</div>
</div>