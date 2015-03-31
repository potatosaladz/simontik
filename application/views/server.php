<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <span class="glyphicon glyphicon-tag"></span>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="#">Hardware</a></li>
            <li><a href="#">Server</a></li>
        </ol>
<!--         <div id="social" class="pull-right">
            <a href="#"><i class="fa fa-google-plus"></i></a>
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-youtube"></i></a>
        </div> -->
    </div>
</div>
<div id="loading_dialog"></div>
<div id="div_grid">
<!--    <input type="text" id="cari" placeHolder="Cari Satker"/>-->
<div class='message'>
    <?php
        if (isset($message_display)) {
            echo $message_display;
        }
        if (isset($error_message)) {
            echo $error_message;
        }
    ?>
</div>
<a type="button" class="btn btn-primary" href="
<?php  echo site_url("server/rekam/".$param_jenis); 
?>" style="text-decoration:none;" id="btn_rekam">Rekam</a>
 <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <span class="glyphicon glyphicon-hdd"></span>
                    <span>Data Hardware</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <span class="glyphicon glyphicon-chevron-up"></span>
                    </a>
                    <a class="expand-link">
                        <span class="glyphicon glyphicon-expand"></span>
                    </a>
                    <a class="close-link">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content no-padding">
                <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
        <thead>
            <tr>
                <th>UBAH</th>
                <th >HAPUS</th>
                <th>BARCODE</th>
                <th >ID</th>
                <!--<th >UNIT</th>
                <th >MERK</th>-->
                <?php if($param_jenis==6)  echo "<th>JENIS PRINTER</th>"; ?>
                <th >BMN</th>
                <th >TIPE</th>
                <th >SERIAL NUMBER</th>
                <?php if($param_jenis==1 or $param_jenis==2 or $param_jenis==3)  echo "<th>SISTEM OPERASI</th>"; ?>
                <th>TAHUN</th>
                <?php if($param_jenis==1 or $param_jenis==2 or $param_jenis==3)  echo "<th>IP</th>"; ?>
                <?php ////if($param_jenis==1 or $param_jenis==2 or $param_jenis==3)  echo "<th>PROSESOR</th>"; ?>
                <?php //if($param_jenis==1 or $param_jenis==2 or $param_jenis==3)  echo "<th>RAM</th>"; ?>
                <?php //if($param_jenis==1 or $param_jenis==2 or $param_jenis==3)  echo "<th>HDD</th>"; ?>
                <th>KONDISI</th>
                <?php if($param_jenis==1 or $param_jenis==2 or $param_jenis==3)  echo "<th>ANTIVIRUS</th>"; ?>
                <th>KETERANGAN</th>
            </tr>
        </thead>
        <tbody>

               <?php
                    if(isset($server) && $server!=null){
                        if(sizeof($server)>0){
                            foreach ($server as $row)
                            {
                                $id=$row['id'];
                                echo "<tr>";
                                echo "<td  align=\"center\"><a href=\"". site_url("server/ubah/".$id."/".$row['jenis'])."\" style=\"text-decoration:none;\" id=\"btn_ubah\"><span class=\"glyphicon glyphicon-edit\"></span></a></td>";
                                echo "<td  align=\"center\"><a href=\"". site_url("server/hapus/".$id."/".$row['jenis'])."\" style=\"text-decoration:none;\" id=\"btn_hapus\"><span class=\"glyphicon glyphicon-floppy-remove\"></span></a></td>";
                                echo "<td  align=\"center\"><a href=\"". site_url("laporan/barcode/".$id."/".$row['jenis'])."\" style=\"text-decoration:none;\" id=\"btn_hapus\"><span class=\"glyphicon glyphicon-qrcode\"></span></a></td>";
                                echo "<td>".$row['id_hardware']."</td>";
                                //echo "<td>".$row['kantor']."</td>";
                                //echo "<td>".$row['nmmerk']."</td>";
                                if($row['jenis']==6 ) echo "<td>".$row['nmprinter']."</td>";
                                echo "<td>".$row['bmn']."</td>";
                                echo "<td>".$row['tipe']."</td>";
                                echo "<td>".$row['sn']."</td>";
                                if($row['jenis']==1 or $row['jenis']==2 or $row['jenis']==3) echo "<td>".$row['nmos']."</td>";
                                echo "<td>".$row['tahun']."</td>";
                                if($row['jenis']==1 or $row['jenis']==2 or $row['jenis']==3) echo "<td>".$row['ip']."</td>";
                                //if($row['jenis']==1 or $row['jenis']==2 or $row['jenis']==3) echo "<td>".$row['prosesor']."</td>";
                                //if($row['jenis']==1 or $row['jenis']==2 or $row['jenis']==3) echo "<td>".$row['memori']."</td>";
                                //if($row['jenis']==1 or $row['jenis']==2 or $row['jenis']==3) echo "<td>".$row['hdd'];
                                echo "<td>".$row['nmkondisi']."</td>";
                                if($row['jenis']==1 or $row['jenis']==2 or $row['jenis']==3) echo "<td>".$row['nmstatus']."</td>";
                                echo "<td>".$row['keterangan']."</td>";
                                echo "</tr>";
                            }
                        }else{
                ?>
                        <tr>
                            <td >Data Kosong</td>
                        </tr>
                <?php           
                        }
                    }else{
                ?>
                        <tr>
                            <td >Data Kosong</td>
                        </tr>
                <?php
                    }
               ?>
        </tbody>
               </table>
            </div>
        </div>
    </div>
</div>
<!--    <a id="prev" href="">Prev</a>|<span id="hal"></span>|<a id="next" href="">Next</a>-->

</div>

<script>
    $(document).ready(function() {
    // Load Datatables and run plugin on tables 
    LoadDataTablesScripts(AllTables);
    TinyMCEStart('#isi', null);
    // Add Drag-n-Drop feature
    WinMove();   
</script>






  


