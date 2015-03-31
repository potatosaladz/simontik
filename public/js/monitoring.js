$(document).ready(function() {
    
    $.getJSON('controller/monitoring.php?kondisi_pie', function(data) {
		var warna = ['black','green','red','blue'];
		var arr=[];
		var i=0;
		$.each(data.hardware,function(index,hardware){
			arr[i]={label: hardware.nama, data: parseInt(hardware.jml,10), color: warna[i]};
			i++;
		});
        drawPieUser('#div1', '#title', 'Kondisi Hardware Jaringan', arr);
    });

    $.getJSON('controller/monitoring.php?kondisi_pie', function(data) {
		var warna = ['black','green','red','blue'];
		var arr=[];
		var i=0;
		$.each(data.hardware,function(index,hardware){
			arr[i]={label: hardware.nama, data: parseInt(hardware.jml,10), color: warna[i]};
			i++;
		});
        drawPieUser('#div1_pie2', '#title2', 'Kondisi Hardware Komputer', arr);
    });
	$.getJSON('controller/ref.php?jenis', function(data) {
		var option2=$('<option />');
		option2.attr('value','all').text('Semua');
		$('#jenis').append(option2);
         $.each(data, function(index, data) {
             var option = $('<option />');
             option.attr('value', data.id).text(data.nmjenis);
             $('#jenis').append(option);
         });
    });
	
	$("#jenis").change(function(){
        var e = document.getElementById('jenis');
        var jenis = e.options[e.selectedIndex].value;
	    $.getJSON('controller/monitoring.php?kondisi_jenis_pie='+jenis, function(data) {
			var warna = ['black','green','red','blue'];
			var arr=[];
			var i=0;
			$.each(data.hardware,function(index,hardware){
				arr[i]={label: hardware.nama, data: parseInt(hardware.jml,10), color: warna[i]};
				i++;
			});
	        drawPieUser('#div1_pie2', '#title2', 'Kondisi Hardware Komputer', arr);
	    });
		
	});


});

function displayBenar(data) {
    if (data === true) {
        return 'Benar';
    } else {
        return 'Salah';
    }
}

function drawPieUser(divnya, tmp_judul, judul, data) {

    var placeholder = $(divnya);

    placeholder.unbind();

    $(tmp_judul).text(judul);

    $.plot(placeholder, data, {
        series: {
            pie: {
                show: true,
                radius: 1,
                label: {
                    show: true,
                    radius: 1 / 2,
                    formatter: labelFormatter,
                    background: {
                        opacity: 0.5
                    }
                }
            }
        },
        legend: {
            show: true
        },
        grid: {
            hoverable: true
        }
    });
}

function labelFormatter(label, series) {
    return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" +
            Math.round(series.percent) + "% (" + series.data[0][1] + " Buah)</div>";
}

function iconDrawer(stat, bul) {

    var bulan = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'ags', 'sep', 'okt', 'nov', 'des'];

    var tgl = new Date();
    var bln_ini = tgl.getMonth();

    var bln_lewat = bulan.slice(0, bln_ini + 1);

    if (stat === false && ($.inArray(bul, bln_lewat)) === -1) {
        return 'not_yet';
    } else if (stat === false && ($.inArray(bul, bln_lewat)) === 0) {
        return 'wrong';
    } else if (stat === '2') {
        return 'ok';
    } else {
        return 'wrong';
    }
}
