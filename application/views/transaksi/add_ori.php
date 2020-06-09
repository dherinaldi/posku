  <style>
  	.acontainer input {
  		width:350px;
  	}	
  	.number {
  		text-align: right;
  	}
  	.inlinecs {
  		width: 100%;
  		border: 0px;
  		font-size: 14px;
  		color: black;
  		border-bottom: 1px solid red;
  	}

  </style>
  <section class="content-header">
  	<h1>
  		<?php echo $title;?>
  	</h1>
  </section>
  <section class="content">
  	<form>
  		<div class="row">
  			<div class="col-md-4">
  				<div class="box box-success">
  					<div class="box-body">
  						<div class="table-responsive">
  							<table class="table table-hover">
  								<tbody>
  									<tr>
  										<td>Kode</td>
  										<td><input type="text" id="kode" class="form-control" value="<?php echo $nota;?>" readonly="true">
  											<input type="text" id="id_beli" value="<?php echo $id;?>">
  										</td>
  										<input type="text" id="act" value="<?php echo $act;?>">
  									</td>
  								</tr>
  								<tr>
  									<td>No Faktur</td>
  									<td><input type="text" id="no_faktur" value="<?php echo $faktur;?>" class="form-control">
  									</td>
  								</tr>
  								<tr>
  									<td>Tanggal Faktur</td>
  									<td><input type="text" id="tanggal_faktur" value="<?php echo $tanggal_faktur;?>" class="form-control">
  									</td>
  								</tr>
  							</tbody>
  						</table>
  					</div>
  				</div> <!-- /.box-body -->
  			</div> <!-- /.box -->
  		</div>

  		<div class="col-md-4">
  			<div class="box box-success">
  				<div class="box-body">
  					<table class="table table-hover">
  						<tbody>
  							<tr>
  								<td>No Kontrak</td>
  								<td><input type="text" id="no_kontrak" class="form-control" value="<?php echo $faktur?>">
  								</td>
  							</tr>
  							<tr>
  								<td>Supplier</td>
  								<td>
  									<select name="supplier" id="supplier" class="form-control">
  										<option value="0">-PILIH-</option>
  									</select>
  								</td>
  							</tr>
  							<tr>
  								<td>Jatuh Tempo</td>
  								<td><input type="text" id="jatuh_tempo" value ="<?php echo $jatuh_tempo;?>" class="form-control">
  								</td>
  							</tr>
  						</tbody>
  					</table>
  				</div> <!-- /.box-body -->
  			</div> <!-- /.box -->
  		</div>
  		<div class="col-md-4">
  			<div class="box box-success">
  				<div class="box-body">
  					<div id="kd_beli_txt"><?php echo $nota;?></div>
  					<div id="total_txt" class="number" style=" font-family: Lucida Console, Courier, monospace; font-size :30px;font-weight: bold;"></div>
  				</div> <!-- /.box-body -->
  			</div> <!-- /.box -->
  		</div>
  	</div>

  	<div class="row">
  		<div class="col-lg-12 col-md-6">
  			<div class="box box-success">
  				<table class="table table-hover">
  					<thead>
  						<tr>
  							<th>Barang</th>
  							<th>Qty</th>
  							<th>Sat</th>
  							<th>HBeli</th>
  							<th>Batch</th>
  							<th>ED</th>
  							<th>Sub</th>
  							<th>Dis(%)</th>
  							<th>Dis(Rp)</th>
  							<th>Total</th>
  							<th>HJual</th>
  							<th>Act</th>
  						</tr>
  					</thead>
  					<tbody id="detail">
  						<?php 
  						$i=0;
  						if(isset($detail)){
  							foreach ($detail as $dt) {
  								$i++;
  								?>
  								<tr id="brs-<?php echo $i;?>">
  									<td>
  										<input type="text" name="barang" id="barang-<?php echo $i;?>">
  										<input type="hidden" name="id_barang[]" id="id_barang-<?php echo $i;?>" value="<?php echo $dt->id_barang; ?>">
  									</td>
  									<td><input type="text" name="qty[]" id="qty-<?php echo $i;?>" class="number inlinecs" onkeyup="hitung(<?php echo $i;?>)"></td>
  									<td><input type="text" name="satuan[]" id="satuan-<?php echo $i;?>" class="inlinecs"></td>
  									<td><input type="text" name="hbeli[]" id="hbeli-<?php echo $i;?>" class="number inlinecs"></td>
  									<td><input type="text" name="batch[]" id="batch-<?php echo $i;?>" class="inlinecs"></td>
  									<td><input type="text" name="expired[]" id="expired-<?php echo $i;?>" class="inlinecs"></td>
  									<td><input type="text" name="subtotal[]" id="subtotal-<?php echo $i;?>" class="number inlinecs"></td>
  									<td><input type="text" name="dsc_persen[]" id="dsc_persen-<?php echo $i;?>" class="number inlinecs" onkeyup="hitung_dsc(<?php echo $i;?>)"></td>
  									<td><input type="text" name="dsc_rp[]" id="dsc_rp-<?php echo $i;?>" class="number inlinecs" onkeyup="hitung(<?php echo $i;?>)" onkeypress="eventet(event)"></td>
  									<td><input type="text" name="total[]" id="total-<?php echo $i;?>" class=" nilai_hasil number inlinecs"></td>
  									<td><input type="text" name="hjual[]" id="hjual-<?php echo $i;?>" class="number inlinecs" onkeypress="eventet(event)"></td>
  									<td>-</td>
  								</tr>
  								<?php

  							}
  						}else{
  							$i++;
  							?>
  							<tr id="brs-<?php echo $i;?>">
  								<td>
  									<input type="text" name="barang" id="barang-<?php echo $i;?>">
  									<input type="hidden" name="id_barang[]" id="id_barang-<?php echo $i;?>">
  								</td>
  								<td><input type="text" name="qty[]" id="qty-<?php echo $i;?>" class="number inlinecs" onkeyup="hitung(<?php echo $i;?>)"></td>
  								<td><input type="text" name="satuan[]" id="satuan-<?php echo $i;?>" class="inlinecs"></td>
  								<td><input type="text" name="hbeli[]" id="hbeli-<?php echo $i;?>" class="number inlinecs"></td>
  								<td><input type="text" name="batch[]" id="batch-<?php echo $i;?>" class="inlinecs"></td>
  								<td><input type="text" name="expired[]" id="expired-<?php echo $i;?>" class="inlinecs"></td>
  								<td><input type="text" name="subtotal[]" id="subtotal-<?php echo $i;?>" class="number inlinecs"></td>
  								<td><input type="text" name="dsc_persen[]" id="dsc_persen-<?php echo $i;?>" class="number inlinecs" onkeyup="hitung_dsc(<?php echo $i;?>)"></td>
  								<td><input type="text" name="dsc_rp[]" id="dsc_rp-<?php echo $i;?>" class="number inlinecs" onkeyup="hitung(<?php echo $i;?>)" onkeypress="eventet(event)"></td>
  								<td><input type="text" name="total[]" id="total-<?php echo $i;?>" class=" nilai_hasil number inlinecs"></td>
  								<td><input type="text" name="hjual[]" id="hjual-<?php echo $i;?>" class="number inlinecs" onkeypress="eventet(event)"></td>
  								<td>-</td>
  							</tr>
  							<?php 
  						}?>
  					</tbody>
  				</table>
  			</div> <!-- /.box -->
  		</div>
  	</div>
  	<div class="row">
  		<div class="col-md-3">
  			<div class="box box-success">
  				<div class="box-body">
  					<div class="table-responsive">
  						<table class="table table-hover">
  							<tbody>
  								<tr>
  									<td>Subtotal</td>
  									<td><input type="text" id="subtotal" class="form-control number" readonly="true">
  									</td>
  								</tr>
  								<tr>
  									<td>Diskon(%)</td>
  									<td><input type="text" id="diskong_persen" class="form-control number"  onkeyup="cek_diskong(1)" value="<?php echo $diskon_persen;?>">
  									</td>
  								</tr>
  								<tr>
  									<td>Diskon(Rp)</td>
  									<td><input type="text" id="diskong_rp" class="form-control number" onkeyup="cek_diskong(2)" value="<?php echo $diskon_rp;?>">
  									</td>
  								</tr>
  								<tr>
  									<td>Grand Total</td>
  									<td><input type="text" id="grand_total" class="form-control number" readonly="true" value="<?php echo $grand_total;?>">
  									</td>
  								</tr>
  							</tbody>
  						</table>
  					</div>
  				</div> <!-- /.box-body -->
  			</div> <!-- /.box -->
  		</div>
  		<div class="col-md-3">
  			<div class="box box-success">
  				<div class="box-body">
  					<div class="table-responsive">
  						<table class="table table-hover">
  							<tbody>
  								<tr>
  									<td>Cash</td>
  									<td><input type="text" id="cash" class="form-control number" onkeyup="bayar()" value="<?php echo $bayar;?>">
  									</td>
  								</tr>
  								<tr>
  									<td>Change</td>
  									<td><input type="text" id="change" class="form-control number" readonly="true" value="<?php echo $sisa;?>">
  									</td>
  								</tr>
  								<tr>
  									<td>Note</td>
  									<td><input type="text" id="note" class="form-control" value="<?php echo $note;?>">
  									</td>
  								</tr>


  							</tbody>
  						</table>
  					</div>
  				</div> <!-- /.box-body -->
  			</div> <!-- /.box -->
  		</div>

  		<div class="col-md-3">
  			<button type="button" class="btn btn-warning">Cancel</button>
  			<button type="button" class="btn btn-info" onclick="simpan_pembayaran()">Pembayaran</button>
  		</div>

  	</div>
  </form>
</section>

<script type="text/javascript">
	var baris ="<?php echo $i?>";
	$('#total_txt').number(0,2);
	$(document).ready(function () {  		
		getev();
		$('input.number,.number').number( true, 2 );

		isidetail();
		var act = $('#act').val();
		var tanggalfaktur,jatuh_tempo;
		if(act =='edit'){
			tanggalfaktur = "<?php echo $tanggal_faktur;?>";
			jatuh_tempo = "<?php echo $jatuh_tempo;?>";
		}else{
			tanggalfaktur = jatuh_tempo = new Date();
			$('input.number,.number').val(0);
		}

		$("#tanggal_faktur").datepicker({
			format:"dd-mm-yyyy"
		}).datepicker("setDate", tanggalfaktur);

		$("#jatuh_tempo").datepicker({
			format:"dd-mm-yyyy"
		}).datepicker("setDate", jatuh_tempo);

		var selected_id = "<?php echo $supp;?>";
		$.getJSON("<?php echo base_url("beli/ambil_supplier")?>", function(data) {
			var option = '';
			var sel ='';
			for (var i=0; i<data.length; i++){
				if(selected_id==data[i].id_supp){
					sel = 'selected';
				}else{
					sel ='';
				}
				option += '<option value="'+ data[i].id_supp + '" '+sel+'>'+data[i].kode +' '+ data[i].nama + '</option>';
			}
			$('#supplier').append(option);
			// notify the plugin we've updated the options.
			$("#supplier").trigger("chosen:updated");
		});

		$('#supplier').chosen({width: "100%",
			search_contains: true});

	});

  function simpan_pembayaran(){
  	var kode = $('#kode').val();
  	var no_faktur = $('#no_faktur').val();
  	var tanggal_faktur = $('#tanggal_faktur').val();
  	var no_kontrak = $('#no_kontrak').val();
  	var supplier = $('#supplier').val();
  	var jatuh_tempo = $('#jatuh_tempo').val();
  	var subtotal = $('#subtotal').val();
  	var diskong_persen = $('#diskong_persen').val();
  	var diskong_rp = $('#diskong_rp').val();
  	var grand_total = $('#grand_total').val();
  	var cash = $('#cash').val();
  	var change = $('#change').val();
  	var note = $('#note').val();


  	var id_barang = $('input[name="id_barang[]"]').map(function(){return $(this).val();}).get();
  	var qty = $('input[name="qty[]"]').map(function(){return $(this).val();}).get();
  	var satuan = $('input[name="satuan[]"]').map(function(){return $(this).val();}).get();
  	var hbeli = $('input[name="hbeli[]"]').map(function(){return $(this).val();}).get();
  	var hjual = $('input[name="hjual[]"]').map(function(){return $(this).val();}).get();
  	var batch = $('input[name="batch[]"]').map(function(){return $(this).val();}).get();
  	var expired = $('input[name="expired[]"]').map(function(){return $(this).val();}).get();
  	var subtotal = $('input[name="subtotal[]"]').map(function(){return $(this).val();}).get();
  	var dsc_persen = $('input[name="dsc_persen[]"]').map(function(){return $(this).val();}).get();
  	var dsc_rp = $('input[name="dsc_rp[]"]').map(function(){return $(this).val();}).get();
  	var total = $('input[name="total[]"]').map(function(){return $(this).val();}).get();
  	var hjual = $('input[name="hjual[]"]').map(function(){return $(this).val();}).get();
  	var param  = {
  		kode : kode,
  		no_faktur : no_faktur,
  		tanggal_faktur : tanggal_faktur,
  		no_kontrak : no_kontrak,
  		supplier : supplier,
  		jatuh_tempo : jatuh_tempo,
  		subtotal : subtotal,
  		diskong_persen : diskong_persen,
  		diskong_rp : diskong_rp,
  		grand_total : grand_total,
  		cash : cash,
  		change : change,
  		note : note,
  		id_barang : id_barang,
  		qty:qty,
  		satuan:satuan,
  		hbeli:hbeli,
  		hjual:hjual,
  		batch:batch,
  		expired:expired,
  		subtotal:subtotal,
  		dsc_persen:dsc_persen,
  		dsc_rp:dsc_rp,
  		total:total,
  	}
  	console.log(param);
  	$.ajax({
  		url:"<?php echo site_url('beli/simpan');?>",
  		type:"POST",
  		data:param,
  		cache:false,
  		success:function(html){
  			alert(`Data sudah tersimpan !!!`);
  				//window.location = "<?php echo base_url('beli')?>";
  			},
  			error: function(e){
  				alert('Error: ' + e);
  			}
  		});
  }

  function autocompleted(baris){
  		/*$("#expired-"+baris).datepicker({
  			format:"dd-mm-yyyy"
  		});*/
  var barang = $("#barang-"+baris).tautocomplete({
  	width: '500px',
  	columns: ['ID','nama','kode','satuan','jenis','stok', 'hbeli','hjual'],
  	hide: [false,true,true,true,true,true,true,true,true,false],
  	placeholder: "Cari Barang ",
  	theme: "white",
  	id:"barang-"+baris,
  	norecord: "No Records Found",
  	ajax: {
  		url: "<?php echo base_url('beli/barang_get')?>",
  		type: "GET",
  		data: function () {
  			return { term: barang.searchdata(), limit:15};
  		},
  		success: function (data) {
  			return data;
  		}
  	},
  	onchange: function () {
  		var all = barang.all();
  		console.log(all);
  		$('#id_barang-'+baris).val(`${barang.id()}`);
  		$('#satuan-'+baris).val(`${all.satuan}`);
  		$('#hbeli-'+baris).val(`${all.hbeli}`);
  		$('#hjual-'+baris).val(`${all.hjual}`);
  		/*grandtotal();*/
  	}
  });
}

function isidetail(){
  for (var i = 1; i <= baris; i++) {
    autocompleted(baris);
  };
	
}

function eventet(e){
	if(e.keyCode == 13) addrow();
}

function addrow(){
	var val=0;
	baris++;
	$('#detail').append(`<tr id="brs-${baris}">
		<td>
			<input type="text" name="barang" id="barang-${baris}" class="form-control">
			<input type="hidden" name="id_barang[]" id="id_barang-${baris}">
		</td>
		<td><input type="text" name="qty[]" id="qty-${baris}" class="number inlinecs" onkeyup= "hitung(${baris})"></td>
		<td><input type="text" name="satuan[]" id="satuan-${baris}" class="inlinecs"></td>
		<td><input type="text" name="hbeli[]" id="hbeli-${baris}" class="number inlinecs"></td>
		<td><input type="text" name="batch[]" id="batch-${baris}" class="inlinecs"></td>
		<td><input type="text" name="expired[]" id="expired-${baris}" class="inlinecs"></td>
		<td><input type="text" name="subtotal[]" id="subtotal-${baris}" class="number inlinecs" value=${val}></td>
		<td><input type="text" name="dsc_persen[]" id="dsc_persen-${baris}" class="number inlinecs"  onkeyup="hitung_dsc(${baris})" value=${val}></td> 
		<td><input type="text" name="dsc_rp[]" id="dsc_rp-${baris}" class="number inlinecs" onkeypress="eventet(event)" onkeyup="hitung(${baris})" value=${val}></td>
		<td><input type="text" name="total[]" id="total-${baris}" class="nilai_hasil number inlinecs" value=${val}></td>
		<td><input type="text" name="hjual[]" id="hjual-${baris}" class="number inlinecs" value=${val}></td>
		<td><button type="button" class="btn btn-danger btn-sm" onclick="rembrs(${baris})"><i class="fa fa-trash"></i></button></td>
	</tr>`);
  $('input.number').number(true, 2 );
  autocompleted(baris);  
  getev();
 /* getev();
 grandtotal();
 */
}

function hitung(brs){
	var qty = parseInt($('#qty-'+brs).val());
	var hbeli = parseFloat($('#hbeli-'+brs).val());
	var dsc_rp = parseFloat($('#dsc_rp-'+brs).val());
	var hasil  = qty*hbeli;
	var dsc_persen = (dsc_rp/hasil)*100;
	var total = hasil - dsc_rp;
	$('#dsc_persen-'+brs).val(dsc_persen);
	$('#subtotal-'+brs).val(hasil);
	$('#total-'+brs).val(total);
	grandtotal();
}

function rembrs(baris){
	$('#brs-'+baris).remove();
	grandtotal();
}

function hitung_dsc(brs){
	var dsc_persen = parseFloat($('#dsc_persen-'+brs).val());
	var hasil = parseFloat($('#subtotal-'+brs).val());
	var dsc_rp = (dsc_persen/100) * hasil;
	var total = hasil - dsc_rp;
	$('#dsc_rp-'+brs).val(dsc_rp);
	$('#total-'+brs).val(total);
	grandtotal();
}

function bayar(){
	var grand_total = parseFloat($('#grand_total').val());
	var cash = parseFloat($('#cash').val());
	var change = cash - grand_total;
	$('#change').val(change);
}

function grandtotal(){
	var hasil = grand_total = 0;
	$('.nilai_hasil').each(function(i, obj) {
		hasil = parseFloat($(this).val())+hasil;
	});
	var diskong_rp = parseFloat($('#diskong_rp').val());
	grand_total = hasil - diskong_rp;
	$('#subtotal').val(hasil);
	$('#grand_total').val(grand_total);
	$('#total_txt').number(grand_total,2);	
}

function cek_diskong(tipe){
	var subtotal = $('#subtotal').val();
	var diskong_rp=diskong_persen =0;
	if(tipe==1){
		diskong_persen = parseFloat($('#diskong_persen').val());
		diskong_rp =  (diskong_persen/100) * subtotal;
		$('#diskong_rp').val(diskong_rp);
	}else{		
		diskong_rp =  parseFloat($('#diskong_rp').val());
		diskong_persen = (diskong_rp/subtotal)*100;
		$('#diskong_persen').val(diskong_persen);
	}
	grandtotal();
}

function getev(){
	$('input, select').on("keypress", function(e) {
		/* ENTER PRESSED*/
		if (e.keyCode == 13) {
			/* FOCUS ELEMENT */
			var inputs = $(this).parents("form").eq(0).find(":input, select");
			var idx = inputs.index(this);

			if (idx == inputs.length - 1) {
				inputs[0].focus()
			} else {
				if( inputs[idx + 1].nodeName == 'SELECT' ) {
					inputs[idx + 1].focus();
				}else{
					inputs[idx + 1].select();
				}

			}
			return false;
		}
	});
}


</script>