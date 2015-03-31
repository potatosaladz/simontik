$(document).ready(function() {
    $('#btn_login').click(function() {


        var user = $('#user').val();
        var pass = $('#pass').val();

        if (user === '' || pass === '') {
            //$('input[type="text"]').css({
            //    "background-color": "red",
            //    "border": "1px solid yellow"
            //});
            $('span#x').html('<img src="img/wrong.png" alt="loader" />').fadeIn(500).delay(2500).fadeOut(500);
            $('span#x').html('<img src="img/wrong.png" alt="loader" />').fadeIn(500).delay(2500).fadeOut(500);
            $('#error').html("Username dan Password harus diisi").fadeIn(500).delay(2500).fadeOut(500);
        }
        else {
            $.post($('#frm_login').attr("action"), {login:true,user:user,pass:pass}, function(data) {
                if (data.result) {
                    window.location = 'utama.php';
                } else {
                    $('#error').html(data.reason).fadeIn(500).delay(2500).fadeOut(500);
                }
            },'json');
        }

        //$.post('loginC.php',$('#frm_login').serialize(),function(data){
        //$('#error').html(data).fadeIn(500).delay(5000).fadeOut(500);

        return false;
    });

    $('#btn_reset').click(function() {
        $('#error').html("");
    });

    // $('#daftar').click(function() {
    //     $("#myform #valueFromMyButton").text($(this).val().trim());
    //     $("#myform input[type=text]").val('');
    //     $("#valueFromMyModal").val('');
    //     $("#myform").show(500);
    // });
    // $("#btnOK").click(function() {
    //     $("#valueFromMyModal").val($("#myform input[type=text]").val().trim());
    //     $("#myform").hide(400);
    // });
    

     $( "#dialog" ).dialog({
        autoOpen: false,
        height: 430,
        width: 850,
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
            "Simpan": addUser,
            "Batal": function() {
                $( "#dialog" ).dialog( "close" );
            }
        }
    });
    $( "#btn_daftar" ).click(function() {
        $("#loading_dialog").loading();
        $("#loading_dialog").loading("loadStart");
        allFields.removeClass( "ui-state-error" );
        allFields.removeAttr('value');
        tips.empty();
        $.getJSON('controller/unit.php?unit', function(data) {
            $.each(data, function(index, data) {
                var option = $('<option />');
                option.attr('value', data.unit2).text(data.kantor);
                $('#unit').append(option);
            });
        });

        $( "#dialog" ).dialog( "open" );
        $("#loading_dialog").loading("loadStop");
    });

    $('#unit').change(function(){
        $("#loading_dialog").loading();
        $("#loading_dialog").loading("loadStart");
        // $('#spinner').show();
        var e = document.getElementById('unit');
        var subunit = e.options[e.selectedIndex].value;
        $('#subunit').empty();
        $.getJSON('controller/unit.php?subunit='+subunit, function(data) {
            $.each(data, function(index, data) {
                var option = $('<option />');
                option.attr('value', data.unit2).text(data.kantor);
                $('#subunit').append(option);
            });
        });
        $("#loading_dialog").loading("loadStop");
        // $('#spinner').hide();
    });

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
    
    var user=$("#user_baru");
    var pass=$("#pass_baru");
    var pass2=$("#pass2");
	var nip=$("#nip_baru");
    var allFields = $( [] ).add( $("#user_baru") ).add( $("#pass_baru") ).add( $("#pass2").add(tips).add($("#nip_baru")) );
    var tips = $( ".validateTips" );
    
    function addUser() {
        

        var valid = true;
        allFields.removeClass( "ui-state-error" );
        // allFields.removeAttr('value');

        valid = valid && checkLength( user, "Username", 5, 16 );
        valid = valid && checkLength( pass, "Password", 5, 16 );
		valid = valid && checkLength(nip,"NIP",18,18);
        valid = valid && checkPass( pass, pass2 );
        valid = valid && checkRegexp( user, /^[a-z]([0-9a-z_\s])+$/i, "Username hanya bisa of a-z, 0-9, dan dimulai dengan huruf." );
        valid = valid && checkRegexp( pass, /^([0-9a-zA-Z])+$/, "Password hanya : a-z 0-9" );

        if ( valid ) {
            allFields.removeClass( "ui-state-error" );
            tips.empty();
            var e = document.getElementById('unit');
            var unit = e.options[e.selectedIndex].value;

            var f = document.getElementById('subunit');
            var subunit = f.options[f.selectedIndex].value;

            $.post($('#frm_daftar').attr('action'),{rekam_user:true,unit:unit,subunit:subunit,username:user.val(),pass:pass.val(),nip:nip.val()},function(data){
                if(!data.result){
                    updateTips(data.reason);
                }else{
                    alert(data.reason);
                    $( "#dialog" ).dialog( "close" );
                }
            },'json');
        }
        
        return valid;
    }

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
            updateTips( "Jumlah Karakter : " + n + " seharusnya minimal " +
            min + " dan maksimal " + max + "." );
            return false;
        } else {
            return true;
        }
    }

    function checkPass( o, n ) {
        if ( o.val()!=n.val() ) {
            o.addClass( "ui-state-error" );
            n.addClass( "ui-state-error" );
            updateTips( "Password Tidak Sama" );
            return false;
        } else {
            return true;
        }
    }

    function checkRegexp( o, regexp, n ) {
        if ( !( regexp.test( o.val() ) ) ) {
            o.addClass( "ui-state-error" );
            updateTips( n );
            return false;
        } else {
            return true;
        }
    }

});

