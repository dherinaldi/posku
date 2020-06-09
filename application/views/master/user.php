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
								<td>Nama</td>
								<td>
									<input type="text" id="nama" class="form-control">
								</td>
								<td>Username</td>
								<td><input type="text" id="username" class="form-control">
								</td>

							</tr>
							<tr>
								<td>Role</td>

								<td>
									<input type="text"  id="role" class="form-control">
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
	<div class="col-md-8">
		<div class="box-body" id="msg_hasil">
		</div>
	</div>
</div>

<div class="row">
	<div id='loading' style="display:none;">
		Load data <img src="<?= base_url();?>assets/img/ajax-loader-2.gif"/>
	</div>
</div>

<div class="row">
	<div class="col-md-8">
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
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Tambah User</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="">Nama</label>
					<input type="text" class="form-control nama"  placeholder="Ketikkan Nama">
				</div>
				<div class="form-group">
					<label for="">Username</label>
					<input type="text" class="form-control username" placeholder="Ketikkan Username">
				</div>
				<div class="form-group">
					<label for="">Role</label>
					<?php 
					$s_role = "select id_role, role from tb_role";
					$q_data = $this->db->query($s_role);
					?>
					<select name="role"  class="form-control role" required="required">
						<option value="0">-Pilih-</option>
						<?php
						foreach ($q_data->result() as $dt) {?>
						<option value="<?php echo $dt->id_role;?>"><?php echo $dt->role?></option>
						<?
					}
					?>
				</select>
			</div>

		</div>
		<div class="modal-footer">
			<input type="hidden" class="act">
			<input type="hidden" class="u_id">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary simpan" id="simpan" onclick="simpan()">Simpan Data</button>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
	$(document).ready(function () {
		$.ajax({
			url: '<?php echo base_url("master/list_data")?>',
			data: {term :''},
			method: 'POST',
			success: function(data){
				console.log(data);
				$('#hasil').html(data);
			},
			error:function(event, textStatus, errorThrown) {
				alert('Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
			}
		});
		$("#cari").click(function(){
			var nama = $("#nama").val();
			var role = $("#role").val();
			var username = $("#username").val();

			var param = {
				nama : nama, role : role, username:username
			};

			$.ajax({
				url: '<?php echo base_url("master/list_data")?>',
				data: param,
				method: 'POST',
				success: function(data){
					console.log(data);
					$('#hasil').html(data);
				},
				error:function(event, textStatus, errorThrown) {
					alert('Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
				}
			});
		})
	});

	$(document).ajaxStart(function(){
		$('#loading').show();
	}).ajaxStop(function(){
		$('#loading').hide();
	});

	function hapus(id){
		if (confirm(`Akan Menghapus data ini ??`)){
			$.ajax({
				url: '<?php echo base_url("master/hapus")?>',
				data: {id:id},
				method: 'POST',
				success: function(data){
					alert(data)
					window.location.href = window.location.href;
				},
				error:function(event, textStatus, errorThrown) {
					alert('Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
				}
			});
		}
	}

	function simpan(){
		var act = $(".act").val();
		var nama = $(".nama").val();
		var username = $(".username").val();
		var id_role = $(".role").val();
		var u_id = $(".u_id").val();

		var param ={
			act :act,
			nama : nama,
			username : username,
			id_role : id_role,
			u_id : u_id,
		}
		
		$.ajax({
			url: '<?php echo base_url("master/simpan")?>',
			data: param,
			method: 'POST',
			success: function(data){
				alert(data);
				$('#msg_hasil').html(data);
				$('#myModal').modal('hide');
				window.location.href = window.location.href;
				
			},
			error:function(event, textStatus, errorThrown) {
				alert('Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
			}
		});
	}
	$(document).on( "click", '.btn_modal',function(e) {
		var u_id = $(this).data('id');
		var act = $(this).data('act');
		var nama = $(this).data('nama');
		var u_name = $(this).data('u_name');
		var id_role = $(this).data('id_role');
		//get class dari atribut modal
		if(act==='ubah'){
			$(".modal-title").text(`Ubah User `);
			$(".nama, .username,.role").attr('readonly', false);
			$(".simpan").show();
		}else if(act==='lihat'){
			$(".modal-title").text(`Lihat User `);
			$(".nama, .username,.role").attr('readonly', true);
			$(".simpan").hide();
		}
		else{
			$(".modal-title").text(`Tambah User`);
			$(".nama, .username,.role").attr('readonly', false);
			$(".simpan").show();
		}
		$(".act").val(act);
		$(".u_id").val(u_id);
		$(".nama").val(nama);
		$(".username").val(u_name);
		$(".role").val(id_role);
	});
</script>