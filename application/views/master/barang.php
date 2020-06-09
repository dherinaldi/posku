<style>
	@media screen and (min-width: 768px) {
		.modal-dialog {
			width: 700px; /* New width for default modal */
		}
		.modal-sm {
			width: 400px; /* New width for small modal */
		}
	}
	@media screen and (min-width: 992px) {
		.modal-lg {
			width: 950px; /* New width for large modal */
		}
	}
	.number {
		text-align: right;
	}
</style>

<div class="row">
	<div class="col-md-8">
		<div class="box box-success">
			<div class="box-header">
				<h3 class="box-title"><?php echo $title;?></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<tbody>
							<tr>
								<td>Kode</td>
								<td><input type="text" id="kode" class="form-control">
								</td>
								<td>Nama</td>
								<td><input type="text" id="nama" class="form-control">
								</td>
							</tr>
							<tr>
								<td>Jenis</td>
								<td><input type="text" id="jenis" class="form-control">
								</td>
								<td>Satuan</td>
								<td><input type="text" id="satuan" class="form-control">
								</td>
							</tr>
							<tr>
								<td>Limit</td>
								<td>
									<select name="limit" id="limit" class="form-control" required="required">
										<option value="100">100</option>
										<option value="500">500</option>
										<option value="1000">1000</option>
										<option value="all">Semua</option>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<button type="submit" class="btn btn-sm btn-primary" id="cari">Cari</button>
									<button type="button" class="btn btn-sm btn-warning btn_modal" id="tambah" data-toggle="modal" data-target="#myModal" data-act="add">Tambah</button>
								</td>

							</tr>

						</tbody>
					</table>
				</div>

			</div> <!-- /.box-body -->
		</div> <!-- /.box -->
	</div>
</div>


<div class="row">
	<div id='loading' style="display:none;">
		Load data <img src="<?= base_url();?>assets/img/ajax-loader-2.gif"/>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-6">
		<div class="box box-success">
			<div class="box-header">
				<h3 class="box-title">List Data </h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<div id="hasil"></div>

			</div>
		</div>
	</div>
</div>


<div class="modal" id="myModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Tambah Barang</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="">Kode</label>
					<input type="text" class="form-control kode"  placeholder="Ketikkan Kode" readonly="true">
				</div>
				<div class="form-group">
					<label for="">Nama</label>
					<input type="text" class="form-control nama"  placeholder="Ketikkan Nama">
				</div>
				<div class="form-group">
					<label for="">Jenis</label>
					<?php 
					$s_jenis =  "select * from m_jenis";
					$q_jenis = $this->db->query($s_jenis);
					?>
					<select name="jenis" class="form-control jenis" required="required">
						<option value="0">-Pilih-</option>
						<?php
						foreach ($q_jenis->result() as $dt) {
							echo '<option value="'.$dt->id.'">'.$dt->nama.'</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Satuan</label>
					<?php
					$s_satuan = "select DISTINCT(satuan), LOWER(satuan) val from m_barang where satuan !=''";
					$q_satuan = $this->db->query($s_satuan);
					?>
					<select name="satuan" class="form-control satuan" required="required">
						<option value="0">-Pilih-</option>
						<?php
						foreach ($q_satuan->result() as $dt) {
							echo '<option value="'.$dt->val.'">'.$dt->satuan.'</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Hpp</label>
					<input type="text" class="form-control hpp number"  placeholder="Ketikkan Hpp">
				</div>
				<div class="form-group">
					<label for="">HJual</label>
					<input type="text" class="form-control hjual number"  placeholder="Ketikkan Harga Jual">
				</div>
			</div>

		</div>
		<div class="modal-footer">
			<input type="text" class="act">
			<input type="text" class="id">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary simpan" id="simpan" onclick="simpan()">Simpan Data</button>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<div class="modal" id="modalBarcode">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Lihat Barcode</h4>
			</div>
			<div class="modal-body">
				<div id="tampil_barcode"></div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->


	<script type="text/javascript">
		$(document).ready(function () {
			$('#limit').val(100);
			$('.jenis,.satuan').chosen({width: "100%"});
			$('input.number,.number').number( true, 2 );

			var param = {
				kode:'',nama : '', jenis : '', satuan:'',limit:$('#limit').val()
			};
			axios.post("<?php echo base_url('master/list_barang')?>",param)
			.then(function (response) {
				$('#hasil').html(response.data);
			})
			.catch(function (error) {
				swal(error);
			});

			$("#cari").click(function(){
				var kode = $("#kode").val();
				var nama = $("#nama").val();
				var jenis = $("#jenis").val();
				var satuan = $("#satuan").val();
				var limit = $("#limit").val();

				var param = {
					kode:kode,nama : nama, jenis : jenis, satuan:satuan,limit:limit
				};
				axios.post("<?php echo base_url('master/list_barang')?>",param)
				.then(function (response) {
					$('#hasil').html(response.data);
				})
				.catch(function (error) {
					swal(error);
				});
			})
		});

		function hapus(id){
			if (confirm(`Akan Menghapus data ini ??`)){
				$.ajax({
					url: '<?php echo base_url("master/hapus_barang")?>',
					data: {id:id},
					method: 'POST',
					success: function(data){
						swal(data);
						setTimeout(function(){ 
							window.location.href = window.location.href;
						},2500);
					},
					error:function(event, textStatus, errorThrown) {
						alert('Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
					}
				});
			}
		}



		function simpan(){
			var act = $('.act').val();
			var id = $('.id').val();
			var kode = $('.kode').val();
			var id_jenis = $('.jenis').val();
			var nama = $('.nama').val();
			var satuan = $('.satuan').val();
			var hpp = $('.hpp').val();
			var hjual = $('.hjual').val();

			var param ={
				act :act,
				id:id,
				nama : nama,
				kode:kode,
				id_jenis:id_jenis,
				satuan:satuan,
				hpp:hpp,
				hjual:hjual
			}
			axios.post("<?php echo base_url('master/simpan_barang')?>",param)
			.then(function (response) {
				swal(response.data);
				setTimeout(function(){ 
					window.location.href = window.location.href;
				},2500);
			})
			.catch(function (error) {
				swal(error);
			});

		}
		$(document).ajaxStart(function(){
			$('#loading').show();
		}).ajaxStop(function(){
			$('#loading').hide();
		});

		$(document).on( "click", '.btn_modal',function(e) {
			var generate_kode = '<?php echo $generate_kode;?>'
			var id = $(this).data('id');
			var kode = $(this).data('kode');
			var act = $(this).data('act');
			var id_jenis = $(this).data('id_jenis');
			var nama = $(this).data('nama');
			var satuan = $(this).data('satuan');
			var hpp = $(this).data('hpp');
			var hjual = $(this).data('hjual');

			console.log(`${generate_kode}`);
		//get class dari atribut modal
		if(act==='ubah'){
			$(".modal-title").text(`Ubah Barang `);
			$(".nama,.jenis,.satuan,.hpp,.hjual").attr('readonly', false);
			$(".simpan").show();
		}else if(act==='lihat'){
			$(".modal-title").text(`Lihat Barang `);
			$(".nama, .kode,.jenis,.satuan,.hpp,.hjual").attr('readonly', true);
			$(".simpan").hide();
		}
		else{
			$(".modal-title").text(`Tambah Barang `);
			$(".nama,.jenis,.satuan,.hpp,.hjual").attr('readonly', false);
			$(".kode").val(generate_kode);
			$(".simpan").show();
		}

		if(act=='add'){
			$(".kode").val(generate_kode);
		}else{
			$(".kode").val(kode);
		}
		$(".act").val(act);
		$(".id").val(id);
		$(".nama").val(nama);
		$(".jenis").val(id_jenis);
		$(".jenis").trigger("chosen:updated");
		$(".satuan").val(satuan);
		$(".satuan").trigger("chosen:updated");
		$(".hpp").val(hpp);
		$(".hjual").val(hjual);
	});
$(document).on( "click", '.btn_modal_barcode',function(e) {
	var kode = $(this).data('kode');
	var image ='';
	image = `<img src="<?=base_url();?>assets/plugins/php-barcode/barcode.php?text=${kode}&size=60&print=true&sizefactor=2" />`;
	$('#tampil_barcode').html(image);
});
</script>