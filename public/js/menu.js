$(document).ready(function() {
    $('#isinya').html('<img src="../img/loader.gif" alt="loader" />').show();
    $('#isinya').load('monitoring.php');

    $("ul#menu_parent li a, ul#menu_parent li > ul li a").click(function() {
        //$('#loader').html('<img src="img/loader.gif" alt="loader" />').show();
        var hal = $(this).attr('href');
        if (hal === '') {
            return false;
        }
        $('#isinya').load(hal + '.php');
        return false;
    });

    $("a#logout").click(function() {
        var hal = $(this).attr('href');
        if (hal === '') {
            return false;
        }
        window.location = hal + '.php';
        return false;
    });
    
    $.getJSON('controller/utama.php?profil', function(data) {
        if(data.result){
            $('#profil').html(data.unit.kantor);
            // $('#akses').html(data.unit.unit);
        }
    });

    // $.getJSON('controller/cont.menu.php?admin', function(data) {
    //     if (data === '1') {
    //         $('li#admin').show();
    //         $('li#admin_rekon').show();
    //         $('li#satker').hide();
    //     }else if(data === '3'){
    //         $('li#admin').show();
    //         $('li#admin_rekon').hide();
    //         $('li#satker').hide();
    //     }else{
    //         $('li#admin').hide();
    //         $('li#admin_rekon').hide();
    //     }
    // });
});