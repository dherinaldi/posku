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
					<td>MAK</td>
					<td>NAMA</td>
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
					<td>6</td>
					<td>7</td>
					<td>8</td>
					<td>9</td>
					<td>10</td>
					<td>11</td>
					<td>12</td>
					<td>SUB</td>
				</tr>
			</thead>
			<tbody>
				<?php  

				$sub_v =0;
				$h_jan=$h_feb=$h_mar=$h_apr=$h_mei=$h_jun=$h_jul=$h_agu=$h_sep=$h_okt=$h_nov=$h_des=$h_sub=0;
				$no=1;
				foreach ($q_dt->result() as $row) {
					$sub_v = ($row->jan) +($row->feb)+($row->mar)+($row->apr)+($row->mei)+($row->jun)+($row->jul)+($row->agu)+($row->sep)+($row->okt)+($row->nov)+($row->des);
					?>
					<tr>
						<td><?php echo $no;?></td>
						<td width="100"><?php echo $row->mak_fix;?></td>
						<td width="400"><?php echo $row->nama_mak;?></td>
						<td width="100" align="right"><?php echo digit21($row->jan);?></td>
						<td width="100" align="right"><?php echo digit21($row->feb);?></td>
						<td width="100" align="right"><?php echo digit21($row->mar);?></td>
						<td width="100" align="right"><?php echo digit21($row->apr);?></td>
						<td width="100" align="right"><?php echo digit21($row->mei);?></td>
						<td width="100" align="right"><?php echo digit21($row->jun);?></td>
						<td width="100" align="right"><?php echo digit21($row->jul);?></td>
						<td width="100" align="right"><?php echo digit21($row->agu);?></td>
						<td width="100" align="right"><?php echo digit21($row->sep);?></td>
						<td width="100" align="right"><?php echo digit21($row->okt);?></td>
						<td width="100" align="right"><?php echo digit21($row->nov);?></td>
						<td width="100" align="right"><?php echo digit21($row->des);?></td>
						<td width="100" align="right"><?php echo digit21($sub_v);?></td>
					</tr>
					<?php 
					$h_jan = $h_jan + $row->jan;
					$h_feb = $h_feb + $row->feb;
					$h_mar = $h_mar +$row->mar;
					$h_apr = $h_apr +$row->apr;
					$h_mei = $h_mei +$row->mei;
					$h_jun = $h_jun +$row->jun;
					$h_jul = $h_jul +$row->jul;
					$h_agu = $h_agu +$row->agu;
					$h_sep = $h_sep +$row->sep;
					$h_okt = $h_okt +$row->okt;
					$h_nov = $h_nov +$row->nov;
					$h_des = $h_des +$row->des;
					$h_sub = $h_sub +$sub_v;
					$no++;
				}?>
				<tr>
					<td></td>
					<td colspan="2">JUMLAH</td>
					<td width="100" align="right"><?php echo digit21($h_jan);?></td>
					<td width="100" align="right"><?php echo digit21($h_feb);?></td>
					<td width="100" align="right"><?php echo digit21($h_mar);?></td>
					<td width="100" align="right"><?php echo digit21($h_apr);?></td>
					<td width="100" align="right"><?php echo digit21($h_mei);?></td>
					<td width="100" align="right"><?php echo digit21($h_jun);?></td>
					<td width="100" align="right"><?php echo digit21($h_jul);?></td>
					<td width="100" align="right"><?php echo digit21($h_agu);?></td>
					<td width="100" align="right"><?php echo digit21($h_sep);?></td>
					<td width="100" align="right"><?php echo digit21($h_okt);?></td>
					<td width="100" align="right"><?php echo digit21($h_nov);?></td>
					<td width="100" align="right"><?php echo digit21($h_des);?></td>
					<td width="100" align="right"><?php echo digit21($h_sub);?></td>
				</tr>
				
			</tbody>

			<tfoot>

			</tfoot>

		</table>
	</div>
</div>