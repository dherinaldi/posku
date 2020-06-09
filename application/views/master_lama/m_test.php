<?php
$s_jenis_belanja = "select * from m_jenis_belanja jb where id_user=5";
$q_jenis_belanja = $this->db->query($s_jenis_belanja);
?>

<div class="table-responsive">
	<table class="table table-hover">
		<tbody>
		<tr>
			<th>ID</th>
			<th>Nama</th>
			<th>Ket</th>
		</tr>
			<?foreach ($q_jenis_belanja->result() as $key) {
				$id_jenis_belanja = $key->id_jenis_belanja;
				$nama_jenis_belanja = $key->nama_jenis_belanja;
				$id_user = $key->id_user;
				?>
				<tr bgcolor="#000">
					<td><?=$id_jenis_belanja;?></td>
					<td style='color:#fff; font-weight:bold'><?=$nama_jenis_belanja;?></td>
					<td></td>
				</tr>				
				<?
				$s_sub_jenis_belanja = "select * from m_sub_jenis_belanja where id_jenis_belanja=".$id_jenis_belanja." and id_user=".$id_user."";
				echo $s_sub_jenis_belanja;
				$q_sub_jenis_belanja =$this->db->query($s_sub_jenis_belanja);
				if($q_sub_jenis_belanja->num_rows()>0){
					foreach ($q_sub_jenis_belanja->result() as $key) {
						$id_sub_jenis_belanja = $key->id_sub_jenis_belanja;
						$nama_sub_jenis = $key->nama_sub_jenis;
						echo "<tr bgcolor='#C3EEFF'>
						<td></td>
						<td style='padding-left:30px'>".$nama_sub_jenis."</td>
						<td></td>
					</tr>";
					$s_barang = "select * from m_barang where id_sub_jenis_belanja = ".$id_sub_jenis_belanja."" ;
					$q_barang = $this->db->query($s_barang);
					if($q_barang->num_rows()>0){
						foreach ($q_barang->result() as $key) {
							$id_barang = $key->id_barang;
							$kode_barang = $key->kode_barang;
							$nama_barang = $key->nama_barang;
							echo "<tr>
							<td></td>
							<td style='padding-left:50px' >".$kode_barang."</td>
							<td>".$nama_barang."</td>
						</tr>";
					}

				}/*else{
					echo "<tr>
					<td></td>
					<td>0</td>
					<td></td>
				</tr>";
			}*/
		}
	}else{
		echo "<tr>
		<td></td>
		<td>kosong</td>
	</tr>";
}

}?>
</tbody>
</table>
</div>