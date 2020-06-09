<script src="<?php echo base_url('assets/js/bootstrap-treeview.min.js')?>"></script>
<style type="text/css">
	.inlinecs {
		width: 100%;
		border: 0px;
		font-size: 14px;
		color: black;
		border-bottom: 1px solid red;
	}
</style>

<div class="row">
	<div class="col-md-6">

		<div class="box box-success">
			<div class="box-header">
				<h3 class="box-title"><?php echo $judul;?></h3>
				<button type="button" name="tambah" id="tambah" class="btn btn-primary btn-sm">
					<i class="fa fa-plus"></i> Tambah
				</button>
			</div><!-- /.box-header -->
			<div class="box-body">
				
				<div id="treeview_json"></div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="box box-success">
			<div class="box-header">
				<h3 class="box-title">Menu Akses POS</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				
				<div id="hasil"></div>
				<div id="selectable-output">
					<form method="post" class="form-data" id="form-data">
						<input type="hidden" name="id" id="id">
						<input type="hidden" name="act" id="act" value="0">				

						<div class="form-group">
							<label>Parent</label>
							<div class="radio">
								<label>
									<input type="radio" name="parent" id="parent1" value="0" class="parent">
									Ya
								</label>
								<label>
									<input type="radio" name="parent" id="parent2" value="1" class="parent">
									Tidak
								</label>
							</div>
							<p class="text-danger" id="err_parent"></p>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label>List Parent</label>
								
								<select name="list_parent" id="list_parent" class="form-control" required="required">
									<option value="0">--Pilih--</option>
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label>Menu</label>
								<input type="text" name="submenu" id="submenu" class="form-control" required="true">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label>Menu Link</label>
								<input type="text" name="submenu_link" id="submenu_link" class="form-control" required="true">
							</div>
						</div>
						<div class="col-sm-12">
							<?php $s_query = $this->db->query("select id_role,role from tb_role")?>
							<label>Roles</label>
							<div class="checkbox">
								<?php 
								foreach ($s_query->result() as $dt) {
									?>
									<label>
										<input type="checkbox" value="<?php echo $dt->id_role?>" name="roles" id="roles<?php echo $dt->id_role;?>" class="roles">
										<?php echo $dt->role;?>
									</label>
									<?php
								}
								?>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label>Status</label>
								<select name="aktif" id="aktif" class="form-control" required="required">
									<option value="0">Non Aktif</option>
									<option value="1">Aktif</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<button type="button" name="simpan" id="simpan" class="btn btn-primary btn-sm">
								<i class="fa fa-save"></i> Simpan
							</button>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#selectable-output').hide();
		$.ajax({
			url: '<?php echo base_url("pengaturan/get_menu")?>',
			//url:'<?php echo base_url("assets/data/treeData.txt")?>',
			method: 'GET',
			dataType: 'json',
			success: function(data){
				console.log(data);
				initSelectableTree(data);
			}
		});

		$.getJSON("<?php echo base_url("pengaturan/ambil_menu")?>", function(data) {
			var option = '';
			for (var i=0; i<data.length; i++){
				option += '<option value="'+ data[i].parent_id + '">' + data[i].nama + '</option>';
			}
			$('#list_parent').append(option);
			// notify the plugin we've updated the options.
			$("#list_parent").trigger("chosen:updated");
		});

		$('#list_parent').chosen({width: "100%"});

		$("#tambah").click(function(){
			console.log('tambah');
			$('#act').val(0);
			$('#id').val("");
			$('#submenu').val("");
			$('#submenu_link').val("");
			$('#list_parent').val(0);
			$('#list_parent').trigger("chosen:updated");
			$('#aktif').val(0);
			$('.parent').prop('checked', false);
			$('.roles').prop('checked', false);
			$('#selectable-output').show();
			$('#hapus').hide();
			//$("input[name=roles]:unchecked").val();
		});

		$('input[type=radio][name=parent]').change(function() {
			if(this.value==1){
				$('#list_parent').prop('disabled', false);
			}else{
				$('#list_parent').prop('disabled', true);
			}
			$("#err_parent").text('');
		});

		$("#simpan").click(function(){
			//var data = $('.form-data').serialize();
			var id = $("#id").val();
			var parent_id =$("#list_parent").val();
			var submenu = $("#submenu").val();
			var submenu_link = $("#submenu_link").val();
			var aktif = $("#aktif").val();
			var act = $("#act").val();
			var parent = $("input[name=parent]:checked").val();
			var roles = $("input[name=roles]:checked").map(
				function () {return this.value;}).get().join(",");

			var param ={
				id:id,submenu:submenu, submenu_link:submenu_link,aktif:aktif, roles:roles, act:act,
				parent_id:parent_id, parent:parent
			}
			if(parent==undefined){
				$("#err_parent").text('Harap dipilih salah satu parent !!!');
				return false;				
			}

			$.ajax({
				url:"<?php echo site_url('pengaturan/simpan_menu');?>",
				type:"POST",
				data:param,
				cache:false,
				success:function(html){
					/*var pathtopage = window.location.pathname;					
					$('#treeview_json').load(pathtopage);*/
					alert(html);
					location.reload();
					
				},
				error: function(e){
					alert('Error: ' + e);
				}
			});
		});
});
var initSelectableTree = function(treeData) {
	return $('#treeview_json').treeview({
		data: treeData,
		showTags:true,
		enableLinks: false,
		onNodeSelected: function(event, node) {
			var role, parent;
			role = (node.id_roles).split(',');
			for (var i=0; i<role.length; i++) {
				$('#roles'+role[i]).prop('checked', true);
			}
			if(node.parent_id!=0){
				parent=1;
			}else{
				parent=0;
			}

			console.log(node);

			$('input[name=parent]').val([parent]);
			$('#act').val(1);
			$('#id').val(node.id);
			$('#submenu').val(node.text);
			$('#submenu_link').val(node.href);
			$('#aktif').val(node.aktif);
			$('#parent').val(parent);
			$('#list_parent').val(node.parent_id);
			$("#list_parent").trigger("chosen:updated");
			$('#selectable-output').show();
		},
		onNodeUnselected: function (event, node) {
				//untuk unselected item dari node treejs
				var role;
				role = (node.id_roles).split(',');
				for (var i=0; i<role.length; i++) {
					$('#roles'+role[i]).prop('checked', false);
				}
			}
		});
};
</script>
