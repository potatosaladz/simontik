$(document).ready(function() {


	$.getJSON('controller/unit.php?filter', function(data) {
		var option2=$('<option />');
		option2.attr('value','').text('--');
		$('#unit').append(option2);
         $.each(data, function(index, data) {
             var option = $('<option />');
             option.attr('value', data.unit2).text(data.kantor);
             $('#unit').append(option);
         });
    });
	
	$.getJSON('controller/ref.php?jenis', function(data) {
		var option2=$('<option />');
		option2.attr('value','').text('Semua');
		$('#jenis').append(option2);
         $.each(data, function(index, data) {
             var option = $('<option />');
             option.attr('value', data.id).text(data.nmjenis);
             $('#jenis').append(option);
         });
    });
	
    $.getJSON('controller/ref.php?kondisi', function(data) {
		var option2=$('<option />');
		option2.attr('value','').text('Semua');
		$('#kondisi').append(option2);
         $.each(data, function(index, data) {
             var option = $('<option />');
             option.attr('value', data.id).text(data.nmkondisi);
             $('#kondisi').append(option);
         });
    });

	
	//loadHardware('','','');
	
	$("#unit").change(function(){
        var e = document.getElementById('unit');
        var subunit = e.options[e.selectedIndex].value;
		
		var g = document.getElementById('jenis');
		var jenis = g.options[g.selectedIndex].value;

		var f = document.getElementById('kondisi');
		var kondisi = f.options[f.selectedIndex].value;
		
		loadHardware(subunit,jenis,kondisi);
	});
	
	$("#jenis").change(function(){
        var e = document.getElementById('unit');
        var subunit = e.options[e.selectedIndex].value;
		
		var g = document.getElementById('jenis');
		var jenis = g.options[g.selectedIndex].value;

		var f = document.getElementById('kondisi');
		var kondisi = f.options[f.selectedIndex].value;
		
		loadHardware(subunit,jenis,kondisi);
	});
	
	$("#kondisi").change(function(){
        var e = document.getElementById('unit');
        var subunit = e.options[e.selectedIndex].value;
		
		var g = document.getElementById('jenis');
		var jenis = g.options[g.selectedIndex].value;

		var f = document.getElementById('kondisi');
		var kondisi = f.options[f.selectedIndex].value;
		
		loadHardware(subunit,jenis,kondisi);
	});

});

function loadHardware(unit,par_jenis,par_kondisi){
	$.getJSON('controller/list.php',{hardwareUnit:unit,jenisF:par_jenis,kondisiF:par_kondisi},function(data){
		$("#grid tbody").empty();		
		if(data.result){
			$.each(data.hardware, function(index, hardware) { 
				var ket = (hardware.keterangan!=null) ? hardware.keterangan : '';  
				var jen,merknya,kondisinya,osnya,antivirusnya;
				$.each(data.jenis,function(index,jenis){
					if(hardware.jenis==jenis.id){
						jen=jenis.nmjenis;
					}
				});
				$.each(data.merk,function(index,merk){
					if(hardware.merk==merk.id){
						merknya=merk.nmmerk;
					}
				});
				$.each(data.os,function(index,os){
					if(hardware.os==os.id){
						osnya=os.nmos;
					}
				});
				$.each(data.kondisi,function(index,kondisi){
					if(hardware.kondisi==kondisi.id){
						kondisinya=kondisi.nmkondisi;
					}
				});
				
				$.each(data.antivirus,function(index,antivirus){
					if(hardware.antivirus==antivirus.id){
						antivirusnya=antivirus.nmstatus;
					}
				});
	            $('#grid tbody').append(

                    '<tr id="row" class="'+hardware.id+'">' +
                    '<td>' + hardware.id_hardware + '</td>' +
                    '<td>' + jen + '</td>' +
                    '<td>' + merknya + '</td>' +
                    '<td>' + hardware.tipe + '</td>' +
                    '<td>' + hardware.sn + '</td>' +
                    '<td>' + osnya + '</td>' +
                    '<td>' + hardware.ip + '</td>' +
                    '<td>' + hardware.prosesor + '</td>' +
                    '<td>' + hardware.memori + '</td>' +
                    '<td>' + hardware.hdd + '</td>' +
                    '<td>' + kondisinya + '</td>' +
					'<td>' + antivirusnya + '</td>' +
                    '<td>' + ket + '</td>'
                    // '<td>' + hardware.id + '</td>'
                    + '</tr>'
                );
        	});

            
		}else{
			$("#grid tbody").append(
				'<tr><td colspan="13">Kosong</td></tr>'
				);
		}
	});
}