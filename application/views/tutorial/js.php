
<style type="text/css">
	#box {
		width: 300px;
		height: 80px;
		background-color: pink;
		border: 2px solid black;
	}
	#box1 {
		width: 300px;
		height: 80px;
		background-color: pink;
		border: 2px solid black;
	}

	#box14 {
		width: 300px;
		height: 80px;
	}
	.add_warna {
		background-color: pink;
	}
	.add_border {
		border: 2px solid black;
	}
	.add_bayang {
		box-shadow: 7px 7px silver;
	}

	#box15 {
		width: 300px;
		height: 80px;
		background-color: pink;
		border: 2px solid black;
	}

	#box17 {
		width: 300px;
		height: 80px;
		background-color: pink;
		border: 2px solid black;
	}

	/* style untuk moddal jquery */
	#modal-kotak{
		margin:5% 30% 30% 30%;
		width: 500px;	
		height: 200px;
		position: absolute;
		position:fixed; 
		z-index:1002;
		display: none;
		background: white;	
	}
	#atas{
		font-size: 15pt;
		padding: 20px;	
		height: 80%;
	}
	#bawah{
		background: #fff;
	}

	#tombol-tutup{	
		background: #e74c3c;
	}
	#tombol-tutup,#tombol{
		height: 30px;
		width: 100px;
		color: #fff;
		border: 0px;
	}
	#bg{
		opacity:.80;
		position: absolute;
		display: none;
		position: fixed;
		top: 0%;
		left: 0%;
		width: 100%;
		height: 100%;
		background-color: #000;
		z-index:1001;
		opacity: 0.8;
	}
	#tombol{
		background: #e74c3c;        
	}

</style>
<div class="row">
	<div class="col-md-6">
		13. Cara Menambahkan Kode CSS Dinamis dengan jQuery
		<div id="box"></div>
		<br>
		<button id="ambil">Ambil Property CSS</button>
		<p id="tekape"></p>
	</div>
	<div class="col-md-6">
		<div id="box1"></div>
		<br>
		<button id="tukar">Change!</button>
	</div>
	<div class="col-md-6">
		14. Cara Mengubah Class CSS elemen HTML dengan jQuery
		<div id="box14"></div>
		<br>
		<button id="tambah_warna">Tambah Warna</button>
		<button id="tambah_border">Tambah Border</button>
		<button id="tambah_bayang">Tambah Bayang</button>

		<button id="remove_warna">Remove Warna</button>
		<button id="remove_border">Remove Border</button>
		<button id="remove_bayang">Remove Bayang</button>

		<button id="toggle_warna">Toggle Warna</button>
		<button id="toggle_border">Toggle Border</button>
		<button id="toggle_bayang">Toggle Bayang</button>

	</div>
	<div class="col-md-6">
		15. Cara Mengubah Lebar dan Tinggi HTML dengan jQuery
		<div id="box15"></div>
		<br>
		<button id="kurangi_lebar">Kurangi Lebar</button>
		<button id="kurangi_tinggi">Kurangi Tinggi</button>
		<button id="tambah_lebar">Tambah Lebar</button>
		<button id="tambah_tinggi">Tambah Tinggi</button>
		<br><br>
	</div>

	<div class="col-md-6">
		16. Pengertian Variabel $(this) dalam jQuery
		<div id="box16"></div>
	</div>

	<div class="col-md-6">
		17. Cara Membuat Efek Show dan Hide jQuery
		<button id="tombol_hide">Hide</button>
		<button id="tombol_show">Show</button>
		<button id="toggle">Hide/Show</button>
		<br><br>
		<div id="box17"></div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		Show Hide Form Password Dengan JQuery

		<div class="kotak">
			<form>
				<!-- <input class="form-password" type="password"> -->
				<input type="password" id="input" class="form-control form-password">
				<br/>
				<br/>
				<!-- <input type="checkbox" class="form-checkbox"> Show password -->
				<div class="checkbox">
					<label>
						<input type="checkbox" value="" class="form-checkbox">
						Show password
					</label>
				</div>
				<br/>
				<br/>			
				<input class="form-submit" type="submit" value="Login">
			</form>
		</div>
	</div>

	<!-- contoh modal JQuery -->
	<div class="col-md-6">
		<center>Membuat modal dialog dengan JQuery</center>

		<button id="tombol">KLIK SAYA !!</button> 
		KLIK TOMBOL UNTUK MENAMPILKAN MODAL DIALOG

		<div id="bg"></div>
		<div id="modal-kotak">
			<div id="atas">
				Halo . ini adalah modal dialog 
			</div>
			<div id="bawah">
				<button id="tombol-tutup">CLOSE</button>
			</div>
		</div>	
	</div>
</div>

<div class="row">
	<!-- Trigger the modal with a button -->
	<?php 
	for ($i=1; $i <=5 ; $i++) {?>	
	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?=$i?>">Open Modal <?=$i;?></button>

	<!-- Modal -->
	<div id="myModal<?=$i?>" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Modal Header<?=$i;?></h4>
				</div>
				<div class="modal-body">
					<p>Some text in the modal.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	<?}?>
</div>

<script type="text/javascript" charset="utf-8">
	
	$(document).ready(function() {
		//contoh modal JQuery
		$('#tombol').click(function(){
			$('#modal-kotak , #bg').fadeIn("slow");
		});
		$('#tombol-tutup').click(function(){
			$('#modal-kotak , #bg').fadeOut("slow");
		});
		/*show hide password*/
		var cek = $('.form-checkbox').val();
		$('.form-checkbox').click(function() {
			if ($(this).is(':checked')) {
				$('.form-password').attr('type', 'text');
			} else {
				$('.form-password').attr('type', 'password');
			}
		});

		/*end show*/

		$("#ambil").click(function() {
			var nilai1 = $("#box").css("width");
			var nilai2 = $("#box").css("height");
			var nilai3 = $("#box").css("background-color");
			$("#tekape").html(nilai1+"<br>"+nilai2+"<br>"+nilai3);
			//alert(nilai1+nilai2+nilai3);
		});

		$("#tukar").click(function() {
			$("#box1").css("width","500px");
			$("#box1").css("height","120px");
			$("#box1").css("background-color","yellow");
		});

		//tambah class elemen HTML
		$("#tambah_warna").click(function() {
			$("#box14").addClass("add_warna");
		});

		$("#tambah_border").click(function() {
			$("#box14").addClass("add_border");
		});

		$("#tambah_bayang").click(function() {
			$("#box14").addClass("add_bayang");
		});

		//remove class elemen HTML
		$("#remove_warna").click(function() {
			$("#box14").removeClass("add_warna");
		});

		$("#remove_border").click(function() {
			$("#box14").removeClass("add_border");
		});

		$("#remove_bayang").click(function() {
			$("#box14").removeClass("add_bayang");
		});

		//hide show/toggle class elemen HTML
		$("#toggle_warna").click(function() {
			$("#box14").toggleClass("add_warna");
		});

		$("#toggle_border").click(function() {
			$("#box14").toggleClass("add_border");
		});

		$("#toggle_bayang").click(function() {
			$("#box14").toggleClass("add_bayang");
		});

		/*ini tutorial ke 15*/
		$("#kurangi_lebar").click(function() {
			var lebar_box = $("#box15").width();
			$("#box15").width(lebar_box - 10);
		})

		$("#kurangi_tinggi").click(function() {
			var tinggi_box = $("#box15").height();
			$("#box15").height(tinggi_box - 10);
		})

		$("#tambah_lebar").click(function() {
			var lebar_box = $("#box15").width();
			$("#box15").width(lebar_box + 10);
		})

		$("#tambah_tinggi").click(function() {
			var tinggi_box = $("#box15").height();
			$("#box15").height(tinggi_box + 10);
		})

		/*end 15;*/

		/*example 16*/
		$("div").click(function() {
			var lebar_box = $(this).width();
			var tinggi_box = $(this).height();
			$(this).width(lebar_box + 10);
			$(this).height(tinggi_box + 10);
		});
		/*end 16*/

		/*example 17*/
		$("#tombol_hide").click(function() {
			$("#box17").hide(1000);
		})

		$("#tombol_show").click(function() {
			$("#box17").show(1000);
		})

		$("#toggle").click(function() {
			$("#box17").toggle(1000);
		})
		/*end*/
	});
</script>