<?php

	//Get Data Kabupaten
$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"key: 7cf558c7df1c3cd152ed1836e5990630"
		),
	));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

echo "<label>Kota Asal</label><br>";
echo "<select name='asal' id='asal'>";
echo "<option>Pilih Kota Asal</option>";
$data = json_decode($response, true);
for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
	echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
}
echo "</select><br><br><br>";
	//Get Data Kabupaten


	//-----------------------------------------------------------------------------

	//Get Data Provinsi
$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"key: 7cf558c7df1c3cd152ed1836e5990630"
		),
	));

$response = curl_exec($curl);
$err = curl_error($curl);

echo "Provinsi Tujuan<br>";
echo "<select name='provinsi' id='provinsi'>";
echo "<option>Pilih Provinsi Tujuan</option>";
$data = json_decode($response, true);
for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
	echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."'>".$data['rajaongkir']['results'][$i]['province']."</option>";
}
echo "</select><br><br>";
	//Get Data Provinsi

?>

<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<style type="text/css">
	.notify{
		border: 1px solid red;
	}
</style>

<body>

	<label>Kabupaten Tujuan</label><br>
	<select id="kabupaten" name="kabupaten"></select><br><br>

	<label>Kurir</label><br>
	<select id="kurir" name="kurir">
		<option value="jne">JNE</option>
		<option value="tiki">TIKI</option>
		<option value="pos">POS INDONESIA</option>
	</select><br><br>

	<label>Berat (gram)</label><br>
	<input id="berat" type="text" name="berat" value="500" />
	<br><br>
	<input type="search" name="search" id="search" value="" />
	<div id="placeholder"></div>
	<input id="cek" type="submit" value="Cek"/>

	<button type="button" class="btn btn-info" id="cek_fathimah">Cek Fathimah Bot</button>
	<input type="search" name="search1" id="search1" value="" />

	<div id="ongkir"></div>



</body>
</html>


<script type="text/javascript">

	$(document).ready(function(){
		$('#provinsi').change(function(){

			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var prov = $('#provinsi').val();

			$.ajax({
				type : 'GET',
           		//url : 'http://localhost/rajaongkir/cek_kabupaten.php',
           		url : "<?php echo base_url('data_source/cek_kabupaten')?>",
           		data :  'prov_id=' + prov,
           		success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#kabupaten").html(data);
				}
			});
		});

		$("#cek").click(function(){
			//Mengambil value dari option select provinsi asal, kabupaten, kurir, berat kemudian parameternya dikirim menggunakan ajax
			var asal = $('#asal').val();
			var kab = $('#kabupaten').val();
			var kurir = $('#kurir').val();
			var berat = $('#berat').val();

			$.ajax({
				type : 'POST',
				url : "<?php echo base_url('data_source/cek_ongkir')?>",
				dataType: "json",
				data :  {'kab_id' : kab, 'kurir' : kurir, 'asal' : asal, 'berat' : berat},
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam element div ongkir
					//$("#ongkir").text(data);
					$.each(data, function(index, element) {
						$("#ongkir").text('code='+element.results[0].code+'&name='+element.results[0].name+'&service='+element.results[0].costs[0].service+element.results[0].costs[0].description+'&cost='+element.results[0].costs[0].cost[0].value+'&estimasi='+element.results[0].costs[0].cost[0].etd+'berat='+element.query.weight
							);
						var cost = element.results[0].costs;
						var no=1;
						console.log(cost.length);
						for (var i = 0; i < cost.length; i++) {
							var cost_data = cost[i];
							var cost_service = cost[i].service;
							var cost_description = cost[i].description;
							var cost_value = cost[i].cost[0].value;
							var cost_etd = cost[i].cost[0].etd;
							console.log(cost_service+' '+cost_description+' '+cost_value+' '+cost_etd);
							$("#ongkir").append(`<br> ${no} servisnya: ${cost_service} desc ${cost_description} biaya ${cost_value} estimasi ${cost_etd} hari`);
							no=no+1;
						};
					});



}
});
});

$("#cek_fathimah").click(function(){
	$.ajax({
		type : 'GET',
		url : 'https://api.banghasan.com/quran/format/json/surat',
		dataType: "json",
		success: function (data) {
			var limit = 10;
			var data = data.hasil.slice(0, limit);
			$.each(data, function(index, element) {
				var asma = element.asma;
				var nama = element.nama;
				var arti = element.arti;
				var keterangan = element.keterangan;
				var output;
				output = `<ul><li>nama ${nama} asma ${asma} arti ${arti} keterangan ${keterangan}</li></ul>`;

				$('#ongkir').append(output);

			});

		}

	});
});

$("#search1").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$("#ongkir *").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	});
});

/*setInterval(function() {
	$.ajax({
		type: 'get',
		url: 'https://api.banghasan.com/quran/format/json/surat',
		cache: false,
		dataType: "json",
		success: function (data) {
			var limit = 10;
			var data = data.hasil.slice(0, limit);
			var output;
			$.each(data, function(index, element) {
				var asma = element.asma;
				var nama = element.nama;
				var arti = element.arti;
				var keterangan = element.keterangan;
				
				output = output + `<ul><li>nama ${nama} asma ${asma} arti ${arti} keterangan ${keterangan}</li></ul>`;
			});			$('#ongkir').html(output);

		}
	})
}, 3000);*/

});

var data = {
	"users": [{
		"firstName": "Ray",
		"lastName": "Villalobos",
		"joined": {
			"month": "January",
			"day": 12,
			"year": 2012
		}
	}, {
		"firstName": "John",
		"lastName": "Jones",
		"joined": {
			"month": "April",
			"day": 28,
			"year": 2010
		}
	}]
}


$(data.users).each(function () {
	var output = "<ul><li>" + this.firstName + " " + this.lastName + "--" + this.joined.month + "</li></ul>";
	$('#placeholder').append(output);
});
$('#search').keyup(function () {
	var yourtext = $(this).val();
	if (yourtext.length > 0) {
		$("li:not(:contains(" + yourtext + "))").hide();
	}
	else{

		$("li").show();
	}
});

</script>