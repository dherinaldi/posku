<div class="box-body">
	<div>
		<table style="height: 55px;font-size:12px;font-family:Monospace" width="100%" border="1" cellpadding="0" cellspacing="0">
			<thead>
				<tr bgcolor="silver">
					<th>No</th>
					<th>BKU</th>
					<th>MAK</th>
					<th>URAIAN</th>
					<th>AKUN</th>
					<th>JUM</th>
					<th>JNS</th>
					<th>TUJ</th>
					<th>SD</th>
					<th>TGL</th>
					<th>OPSI</th>
				</tr>
			</thead>
			<tbody>
				<?
				$no=1;
				foreach ($q_dt->result() as $key) {
					?>
					<tr>
						<td><?=$no;?></td>
						<td><?=$key->no_bku;?></td>
						<td><?=$key->mak;?></td>
						<td><?=$key->uraian;?></td>
						<td><?=$key->nama_akun;?></td>
						<td align="right"><?=digit2($key->nominal);?></td>
						<td><?=$key->nama_jenis;?></td>
						<td><?=$key->nama_tuj;?></td>
						<td><?=$key->nama_sd;?></td>
						<td><?=converttgl1($key->tgl);?></td>
						<td></td>
					</tr>
					<?
					$no++;
				}?>
			</tbody>

			<tfoot>

			</tfoot>

		</table>
	</div>
</div>