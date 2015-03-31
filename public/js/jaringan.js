$(document).ready(function() {

	var unit=null;

	loadHardware(unit);

	$( "#btn_rekam" ).click(function() {
        //$("#loading_dialog").loading();
        //$("#loading_dialog").loading("loadStart");

        allFields.removeClass( "ui-state-error" );
        allFields.removeAttr('value');
        tips.empty();
        
        
        populate();

        

        dialog.dialog( "open" );
        //$("#loading_dialog").loading("loadStop");
    });


	function addHardware() {

		var valid = true;
        allFields.removeClass( "ui-state-error" );


        valid = valid && checkLength( ip_ce, "ip", 1, 100 );
        valid = valid && checkLength( ip_pe, "ip", 1, 100 );
        valid = valid && checkLength( ip_lan, "ip", 1, 100 );
/*        valid = valid && cekIp(ip_ce);
        valid = valid && cekIp(ip_pe);
        valid = valid && cekIp(ip_lan);*/
        
		var e = document.getElementById('migrasi');
        var migrasi = e.options[e.selectedIndex].value;

        var f = document.getElementById('mikrotik');
        var mikrotik = f.options[f.selectedIndex].value;

        var g = document.getElementById('router');
        var router = g.options[g.selectedIndex].value;

        var h= document.getElementById('labeling');
        var labeling = h.options[h.selectedIndex].value;

        var j = document.getElementById('boxing');
        var boxing = j.options[j.selectedIndex].value;

        if(valid){
        	$.post($('#frm_rekam').attr('action'),{rekam_jaringan:true,ip_ce:ip_ce.val(),ip_pe:ip_pe.val(),ip_lan:ip_lan.val(),bandwith:bandwith.val(),
                        migrasi:migrasi,mikrotik:mikrotik,router:router,labeling:labeling,boxing:boxing},function(data){
	            if(!data.result){
	                updateTips(data.reason);
	            }else{
	                alert(data.reason);
	                dialog.dialog( "close" );
	                loadHardware(unit);
	            }
        	},'json');
        }
        return valid;
	}

	var tips = $( ".validateTips" );
	var form;
	var dialog;
	var ip_ce=$("#ip_ce"),ip_pe=$("#ip_pe"),ip_lan=$("#ip_lan"),bandwith=$("#bandwith");
	var allFields = $( [] ).add( ip_ce ).add( ip_pe ).add( ip_lan ).add(bandwith);

	dialog =$( "#dialog" ).dialog({
	        autoOpen: false,
	        height: 550,
	        width: 550,
	        modal: true,
	        show: {
	            effect: "blind",
	            duration: 1000
	        },
	        hide: {
	            effect: "blind",
	            duration: 1000
	        },
	        buttons: {
	        	"Simpan" : addHardware,
	            "Batal": function() {
					dialog.dialog( "close" );
					}
	        }
    	});

    form = dialog.find( "form" ).on( "submit", function( event ) {
		event.preventDefault();
		addHardware();
	});

	function updateTips( t ) {
        tips
        .text( t )
        .addClass( "ui-state-highlight" );
        setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
        }, 500 );
    }

    function checkLength( o, n, min, max ) {
        if ( o.val().length > max || o.val().length < min ) {
            o.addClass( "ui-state-error" );
            updateTips( "Harus Diisi" );
            return false;
        } else {
            return true;
        }
    }

    function cekIp(ip){
       var CheckIP = /^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/;
       if(CheckIP.test(ip.val()))
       {
             return true;
       }
       else
       {
            ip.addClass( "ui-state-error" );
            updateTips( "IP Salah");
       }
	}


    $.widget("artistan.loading", $.ui.dialog, {
        options: {
            // your options
            spinnerClassSuffix: 'spinner',
            spinnerHtml: 'Loading',// allow for spans with callback for timeout...
            maxHeight: false,
            maxWidth: false,
            minHeight: 80,
            minWidth: 220,
            height: 80,
            width: 220,
            modal: true
        },

        _create: function() {
            $.ui.dialog.prototype._create.apply(this);
            // constructor
            $(this.uiDialog).children('*').hide();
            var self = this,
            options = self.options;
            self.uiDialogSpinner = $('.ui-dialog-content',self.uiDialog)
                .html(options.spinnerHtml)
                .addClass('ui-dialog-'+options.spinnerClassSuffix);
        },
        _setOption: function(key, value) {
            var original = value;
            $.ui.dialog.prototype._setOption.apply(this, arguments);
            // process the setting of options
            var self = this;

            switch (key) {
                case "innerHeight":
                    // remove old class and add the new one.
                    self.uiDialogSpinner.height(value);
                    break;
                case "spinnerClassSuffix":
                    // remove old class and add the new one.
                    self.uiDialogSpinner.removeClass('ui-dialog-'+original).addClass('ui-dialog-'+value);
                    break;
                case "spinnerHtml":
                    // convert whatever was passed in to a string, for html() to not throw up
                    self.uiDialogSpinner.html("" + (value || '&#160;'));
                    break;
            }
        },
        _size: function() {
            $.ui.dialog.prototype._size.apply(this, arguments);
        },
        // other methods
        loadStart: function(newHtml){
            if(typeof(newHtml)!='undefined'){
                this._setOption('spinnerHtml',newHtml);
            }
            this.open();
        },
        loadStop: function(){
            this._setOption('spinnerHtml',this.options.spinnerHtml);
            this.close();
        }
    });

	$('#grid tbody').on('click', 'td', function(data) {
       var id = $(this).closest('tr').attr('class');
       populate();
       $.getJSON('controller/list.php?edit_jaringan='+id,function(data){
       		allFields.removeClass( "ui-state-error" );
	        allFields.removeAttr('value');
	        tips.empty();
			
	        dialog =$( "#dialog" ).dialog({
		        autoOpen: false,
		        height: 550,
		        width: 550,
		        modal: true,
		        show: {
		            effect: "blind",
		            duration: 1000
		        },
		        hide: {
		            effect: "blind",
		            duration: 1000
		        },
		        buttons: {
		        	"Update" : updateHardware,
		        	"Hapus" : deleteHardware,
		            "Batal": function() {
						dialog.dialog( "close" );
						dialog =$( "#dialog" ).dialog({
					        buttons: {
					        	"Simpan" : addHardware,
					            "Batal": function() {
									dialog.dialog( "close" );
									}
					        }
				    	});
					}
		        }
		    });

            document.getElementById('id').value =data.id;
            document.getElementById('ip_ce').value =data.ip_ce;
            document.getElementById('ip_pe').value =data.ip_pe;
            document.getElementById('ip_lan').value =data.ip_lan;
            document.getElementById('bandwith').value =data.bandwith;
			

            $('#mikrotik').val(data.mikrotik);
            $('#migrasi').val(data.migrasi);
            $('#router').val(data.router);
            $('#labeling').val(data.labeling);
            $('#boxing').val(data.boxing);

	        dialog.dialog( "open" );

       });
	});

    function updateHardware(){
        var valid = true;
        var id=$('#id').val();
        allFields.removeClass( "ui-state-error" );

        valid = valid && checkLength( ip_ce, "ip", 1, 100 );
        valid = valid && checkLength( ip_pe, "ip", 1, 100 );
        valid = valid && checkLength( ip_lan, "ip", 1, 100 );
        
        var e = document.getElementById('migrasi');
        var migrasi = e.options[e.selectedIndex].value;

        var f = document.getElementById('mikrotik');
        var mikrotik = f.options[f.selectedIndex].value;

        var g = document.getElementById('router');
        var router = g.options[g.selectedIndex].value;

        var h= document.getElementById('labeling');
        var labeling = h.options[h.selectedIndex].value;

        var j = document.getElementById('boxing');
        var boxing = j.options[j.selectedIndex].value;

        if(valid){
            $.post('controller/update.php',{update_jaringan:true,ip_ce:ip_ce.val(),ip_pe:ip_pe.val(),ip_lan:ip_lan.val(),bandwith:bandwith.val(),
                        migrasi:migrasi,mikrotik:mikrotik,router:router,labeling:labeling,boxing:boxing,id:id},function(data){
                if(!data.result){
                    updateTips(data.reason);
                }else{
                    alert(data.reason);
                    dialog.dialog( "close" );
                    loadHardware(unit);
                }
            },'json');
        }
        return valid;
    }

    function deleteHardware(){
        var id=$('#id').val();
        $.post('controller/delete.php',{delete_jaringan:true,id:id},function(data){
            if(!data.result){
                updateTips(data.reason);
            }else{
                alert(data.reason);
                dialog.dialog( "close" );
                loadHardware(unit);
            }
        },'json');
    }
	
	

});

function loadHardware(unit){
	$.getJSON('controller/list.php?jaringan',function(data){
		$("#grid tbody").empty();
		if(data.result){
			$.each(data.hardware, function(index, hardware) { 
				var migrasinya,mikrotiknya,routernya,labelnya,boxingnya;
				$.each(data.migrasi,function(index,migrasi){
					if(hardware.migrasi==migrasi.id){
						migrasinya=migrasi.nmstatus;
					}
				});
                $.each(data.mikrotik,function(index,mikrotik){
                    if(hardware.mikrotik==mikrotik.id){
                        mikrotiknya=mikrotik.nmstatus;
                    }
                });
                $.each(data.router,function(index,router){
                    if(hardware.router==router.id){
                        routernya=router.nmstatus;
                    }
                });
                $.each(data.labeling,function(index,labeling){
                    if(hardware.labeling==labeling.id){
                        labelnya=labeling.nmstatus;
                    }
                });
                $.each(data.boxing,function(index,boxing){
                    if(hardware.boxing==boxing.id){
                        boxingnya=boxing.nmstatus;
                    }
                });
				
	            $('#grid tbody').append(

                    '<tr id="row" class="'+hardware.id+'">' +
                    '<td>' + hardware.ip_ce + '</td>' +
                    '<td>' + hardware.ip_pe + '</td>' +
                    '<td>' + hardware.ip_lan + '</td>' +
                    '<td>' + hardware.bandwith + '</td>' +
                    '<td>' + migrasinya + '</td>' +
                    '<td>' + mikrotiknya + '</td>' +
                    '<td>' + routernya + '</td>' +
                    '<td>' + labelnya + '</td>' +
                    '<td>' + boxingnya + '</td>'
                    // '<td>' + hardware.id + '</td>'
                    + '</tr>'
                );
        	});

            var otable = $('#grid').dataTable({
                "bProcessing": true,
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": false,
                "bSort": false,
                "bAutoWidth": false,
                "bJQueryUI": false,
                "iDisplayLength": 10,
                // "aaSorting": [[1, 'desc'], [0, 'asc'], [2, 'asc']],
                // "sPaginationType" : "full_numbers",
                "sDom": '<"top">rt<"bottom"flp><"clear">',
                "aoColumns": [
                    {"mData": "IPCE"},
                    {"mData": "IPLE"},
                    {"mData": "IPLAN"},
                    {"mData": "BANDWITH"},
                    {"mData": "MIGRASI"},
                    {"mData": "MIKROTIK"},
                    {"mData": "ROUTER"},
                    {"mData": "LABELING"},
                    {"mData": "BOXING"},
                ]
            });
		}else{
			$("#grid tbody").append(
				'<tr><td colspan="13">Kosong</td></tr>'
				);
		}
	});
}

function populate(){
	$('#migrasi').empty();
    $('#mikrotik').empty();
    $('#router').empty();
    $('#labeling').empty();
    $('#boxing').empty();


	$.getJSON('controller/ref.php?migrasi', function(data) {
         $.each(data, function(index, data) {
             var option = $('<option />');
             option.attr('value', data.id).text(data.nmstatus);
             $('#migrasi').append(option);
         });
    });
    $.getJSON('controller/ref.php?mikrotik', function(data) {
         $.each(data, function(index, data) {
             var option = $('<option />');
             option.attr('value', data.id).text(data.nmstatus);
             $('#mikrotik').append(option);
         });
    });
    $.getJSON('controller/ref.php?router', function(data) {
         $.each(data, function(index, data) {
             var option = $('<option />');
             option.attr('value', data.id).text(data.nmstatus);
             $('#router').append(option);
         });
    });
    $.getJSON('controller/ref.php?labeling', function(data) {
         $.each(data, function(index, data) {
             var option = $('<option />');
             option.attr('value', data.id).text(data.nmstatus);
             $('#labeling').append(option);
         });
    });
    $.getJSON('controller/ref.php?boxing', function(data) {
         $.each(data, function(index, data) {
             var option = $('<option />');
             option.attr('value', data.id).text(data.nmstatus);
             $('#boxing').append(option);
         });
    });
}



