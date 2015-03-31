        </div>
        <!--End Content-->
    </div>
</div>






<!--<script src="<?php //echo base_url('assets/js/jquery.min.js') ?>"></script>
  <script src="<?php //echo base_url('assets/js/bootstrap.min.js') ?>"></script> -->

<script src="<?=base_url()?>public/bootstrap/plugins/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>public/bootstrap/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?=base_url()?>public/bootstrap/plugins/bootstrap/bootstrap.min.js"></script>
<script src="<?=base_url()?>public/bootstrap/plugins/justified-gallery/jquery.justifiedGallery.min.js"></script>
<!-- <script src="<?=base_url()?>public/bootstrap/plugins/tinymce/tinymce.min.js"></script>
<script src="<?=base_url()?>public/bootstrap/plugins/tinymce/jquery.tinymce.min.js"></script> -->
<!-- All functions for this theme + document.ready processing -->
<script src="<?=base_url()?>public/bootstrap/js/devoops.js"></script> 

<script type="text/javascript">
// Run Datables plugin and create 3 variants of settings
function AllTables(){
    TestTable1();
    TestTable2();
    //TestTable3();
    LoadSelect2Script(MakeSelect2);
}
function MakeSelect2(){
    $('select').select2();
    $('.dataTables_filter').each(function(){
        $(this).find('label input[type=text]').attr('placeholder', 'Search');
    });
}
function TestTable1(){
    $('#datatable-1').dataTable( {
        "aaSorting": [[ 0, "asc" ]],
        "sDom": "<'box-content'<'col-sm-6'f><'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sSearch": "",
            "sLengthMenu": '_MENU_'
        }
    });
}
//
// Function for table, located in element with id = datatable-2
//
function TestTable2(){
    var asInitVals = [];
    var oTable = $('#datatable-2').dataTable( {
        "aaSorting": [[ 0, "asc" ]],
        "sDom": "<'box-content'<'col-sm-6'f><'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sSearch": "",
            "sLengthMenu": '_MENU_'
        },
        bAutoWidth: false
    });
    var header_inputs = $("#datatable-2 thead input");
    header_inputs.on('keyup', function(){
        /* Filter on the column (the index) of this element */
        oTable.fnFilter( this.value, header_inputs.index(this) );
    })
    .on('focus', function(){
        if ( this.className == "search_init" ){
            this.className = "";
            this.value = "";
        }
    })
    .on('blur', function (i) {
        if ( this.value == "" ){
            this.className = "search_init";
            this.value = asInitVals[header_inputs.index(this)];
        }
    });
    header_inputs.each( function (i) {
        asInitVals[i] = this.value;
    });
}
//
// Function for table, located in element with id = datatable-3
//
function LoadDataTablesScripts(callback){
    function LoadDatatables(){
        $.getScript('<?=base_url()?>public/bootstrap/plugins/datatables/jquery.dataTables.js', function(){
            $.getScript('<?=base_url()?>public/bootstrap/plugins/datatables/ZeroClipboard.js', function(){
                $.getScript('<?=base_url()?>public/bootstrap/plugins/datatables/TableTools.js', function(){
                    $.getScript('<?=base_url()?>public/bootstrap/plugins/datatables/dataTables.bootstrap.js', callback);
                });
            });
        });
    }
    if (!$.fn.dataTables){
        LoadDatatables();
    }
    else {
        if (callback && typeof(callback) === "function") {
            callback();
        }
    }
}

function TinyMCEStart(elem, mode){
    var plugins = [];
    if (mode == 'extreme'){
        plugins = [ "advlist anchor autolink autoresize autosave bbcode charmap code contextmenu directionality ",
            "emoticons fullpage fullscreen hr image insertdatetime layer legacyoutput",
            "link lists media nonbreaking noneditable pagebreak paste preview print save searchreplace",
            "tabfocus table template textcolor visualblocks visualchars wordcount"]
    }
    tinymce.init({selector: elem,
        theme: "modern",
        plugins: plugins,
        //content_css: "css/style.css",
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [
            {title: 'Header 2', block: 'h2', classes: 'page-header'},
            {title: 'Header 3', block: 'h3', classes: 'page-header'},
            {title: 'Header 4', block: 'h4', classes: 'page-header'},
            {title: 'Header 5', block: 'h5', classes: 'page-header'},
            {title: 'Header 6', block: 'h6', classes: 'page-header'},
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ]
    });
}


    $(document).ready(function() {
    // Load Datatables and run plugin on tables 
    LoadDataTablesScripts(AllTables);
    TinyMCEStart('#isi', null);
    // Add Drag-n-Drop feature
    WinMove();
});


</script>
</body>
</html>