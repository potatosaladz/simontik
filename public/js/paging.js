$(document).ready(function() {
$('#grid').dataTable({
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
                    {"mData": "ID"},
                    {"mData": "JENIS"},
                    {"mData": "MERK"},
                    {"mData": "TIPE"},
                    {"mData": "SN"},
                    {"mData": "OS"},
                    {"mData": "IP"},
                    {"mData": "PROSESOR"},
                    {"mData": "MEMORI"},
                    {"mData": "HDD"},
                    {"mData": "KONDISI"},
                    {"mData": "ANTIVIRUS"},
                    {"mData": "KETERANGAN"},
                ]
            });
});