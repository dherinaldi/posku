
<div class="row">
	<!--datagrid-->
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><?php  echo $title;?></h3>

			</div><!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-hover" id="tb_data">
						<thead>
							<tr>
								<th>No</th>
								<th>TGL</th>
								<th>BKU</th>
								<th>MAK</th>
								<th class="wd100">URAIAN</th>
								<th>SD</th>
								<th>NOMINAL</th>
								<?php 
								if($sd==1){
									?>
									<th>SALDO BANK</th>
									<th>TUNAI</th>
									<th>KELUAR</th>
									<th>SALDO</th>
									<th>KAT</th>
									<?php 
								}else{?>
								<th>TUNAI</th>
								<th>BANK</th>
								<th>PERSEKOT</th>
								<th>SALDO</th>
								<th>KODE</th>

								<?php }?>
							</tr>
						</thead>
						<tbody>
							<?php 
							if($sd==1){
								$no=1;
								$bank =$tunai=$keluar=$jum_saldo=0;
								foreach ($s_data->result() as $key) {
									$tipe = $key->fk_tipe_saldo_kppn;
									$nominal = $key->nominal;
									if($tipe==1){
										$bank = $bank+$nominal;
										$tunai = $tunai+0;
										$keluar = $keluar+0;
									}else if($tipe==2){
										$bank = $bank-$nominal;
										$tunai = $tunai+$nominal;
										$keluar = $keluar+0;

									}
									else if($tipe==3){
										$bank = $bank+0;
										$tunai = $tunai-$nominal;
										$keluar = $keluar+$nominal;

									}
									else if($tipe==4){
										$bank = $bank+$nominal;
										$tunai = $tunai+0;
										$keluar = $keluar-$nominal;

									}
									else{
										$bank=$tunai=$keluar=0;
									}

									$jum_saldo = $bank+$tunai+$keluar;
									if($jum_saldo>400000000 or $jum_saldo<0 ){
										$style  = 'style="color:red;font-size: 15px;font-weight:bold; "';
									}else{
										$style  = '';
									}

									?>
									<tr>
										<td><?php  echo $no;?></td>
										<td><?php  echo $key->tgl;?></td>
										<td></td>
										<td><?php  echo $key->mak;?></td>
										<td><?php  echo $key->uraian;?></td>
										<td><?php  echo $key->fk_sd;?></td>
										<td align="right"><?php  echo digit21($key->nominal);?></td>
										<td align="right">
											<?php  echo digit21($bank);?>
										</td >
										<td align="right">
											<?php  echo digit21($tunai);?>
										</td>
										<td align="right">
											<?php  echo digit21($keluar);?>
										</td>
										<td align="right">
											<?php 

									//echo "bank=".$bank."&tunai=".$tunai."&keluar=".$keluar;
											?>
											<div <?php  echo $style;?>><?php  echo digit21($jum_saldo);?></div>
										</td>
										<td>
											<?php  echo $key->fk_tipe_saldo_kppn;?>
										</td>
									</tr>
									<?php 
									$no++;
								}
							}else{
								$no=1;
								$sawal_tunai =$sawal_bank=$sawal_persekot=0;
								$n_tunai = $n_bank =$n_persekot=0;
								$sisa_tunai = $sisa_bank =$sisa_persekot=$sisa=$jum_saldo=0;

								/*$sawal_tunai = $sa_tunai;
								$sawal_bank = $sa_bank;
								$sawal_persekot = $sa_persekot;*/

								foreach ($s_data->result() as $key) {
									if($no == 1){
										$sa = 0;
										$sawal_tunai = $sa_tunai;
										$sawal_bank = $sa_bank;
										$sawal_persekot = $sa_persekot;

										/*$sisa_tunai =$sawal_tunai+$n_tunai;
										$sisa_bank =$sawal_bank+$n_bank;
										$sisa_persekot =$sawal_persekot+$n_persekot;*/
									}
									



									$kd = $key->kd_trans;
									if($key->masuk!=0){
										$nominal =$key->masuk;
									}else{
										$nominal =$key->keluar;
									}

									//echo "sisa_tunai=".$sisa_tunai."&sawal_tunai=".$sawal_tunai."&n_tunai=".$n_tunai."&nominal=".$nominal."&kode=".$kd."&sa=".$sa."<br>";
									$sisa_tunai =$sawal_tunai+$n_tunai;
									$sisa_bank =$sawal_bank+$n_bank;
									$sisa_persekot =$sawal_persekot+$n_persekot;

									/*if(($kd==11)or ($kd==21)){
										$sisa_tunai=$n_tunai;
									}elseif(($kd==24)or ($kd==26) or ($kd==61)){
										$sisa_tunai =$sawal_tunai-$n_tunai;
									}else{
										$sisa_tunai =$sawal_tunai+$n_tunai;
									}*/
									
									//Tunai
									if(($kd==11)or ($kd==21)){
										$n_tunai=$sisa_tunai;
									}elseif(($kd==24)or ($kd==26) or ($kd==61)){
										$n_tunai=$sisa_tunai+$nominal;
									}else{
										$n_tunai=$sisa_tunai-$nominal;
									}

									//BANK
									if(($kd==62)or ($kd==21)){
										$n_bank=$sisa_bank+$nominal;
									}elseif(($kd==24)){
										$n_bank=$sisa_bank-$nominal;
									}else{
										$n_bank=$sisa_bank;
									}

									//Persekot
									if(($kd==61)){
										$n_persekot=$sisa_persekot+$nominal;
									}elseif(($kd==63)){
										$n_persekot=$sisa_persekot-$nominal;
									}else{
										$n_persekot=$sisa_persekot;
									}

									$jum_saldo = $n_tunai+$n_bank+$n_persekot;

									
									?>
									<tr>
										<td><?php  echo $no;?></td>
										<td><?php  echo $key->tgl;?></td>
										<td><?php  echo $key->no_bku;?></td>
										<td><?php  echo $key->mak;?></td>
										<td><div class="wrap wd300"><?php  echo $key->uraian;?></div></td>
										<td><?php  echo $key->fk_sd;?></td>
										<td align="right"><?php  echo digit21($nominal);?></td>
										<td align="right"><?php  echo digit21($n_tunai);?></td>
										<td align="right"><?php  echo digit21($n_bank);?></td>
										<td align="right"><?php  echo digit21($n_persekot);?></td>
										<td align="right"><?php  echo digit21($jum_saldo);?></td>
										<td><?php  echo $kd;?></td>
									</tr>
									<?php 
									$sawal_tunai=$sawal_bank=$sawal_persekot=$sa;
									/*$sawal_bank=$sisa_bank;
									$sawal_persekot=$sisa_persekot;*/
									$no++;
								}
							}?>
						</tbody>
						<tfoot>

						</tfoot>

					</table>
				</div>
			</div> <!-- /.box-body -->
		</div> <!-- /.box -->
	</div> <!-- /.col-xs-12 -->
</div> <!-- /.row -->

<script type="text/javascript">
	$(document).ready(function(){
		$("#tb_data").dataTable();
	});
</script>
