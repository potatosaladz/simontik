<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <span class="glyphicon glyphicon-tag"></span>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="#">Laporan</a></li>
            <li><a href="#">Cetak</a></li>
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
<?php
    if(isset($jaringan) && $jaringan==false){
?>
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
                            <th>ID</th>
                            <th>UNIT</th>
                            <th>MERK</th>
                            <?php if($param_jenis==6)  echo "<th>JENIS PRINTER</th>"; ?>
                            <th>TIPE</th>
                            <th>SERIAL NUMBER</th>
                            <?php if($param_jenis==1 or $param_jenis==2 or $param_jenis==3)  echo "<th>SISTEM OPERASI</th>"; ?>
                            <th>TAHUN</th>
                            <?php if($param_jenis==1 or $param_jenis==2 or $param_jenis==3)  echo "<th>IP</th>"; ?>
                            <?php if($param_jenis==1 or $param_jenis==2 or $param_jenis==3)  echo "<th>PROSESOR</th>"; ?>
                            <?php if($param_jenis==1 or $param_jenis==2 or $param_jenis==3)  echo "<th>RAM</th>"; ?>
                            <?php if($param_jenis==1 or $param_jenis==2 or $param_jenis==3)  echo "<th>HDD</th>"; ?>
                            <th>KONDISI</th>
                            <?php if($param_jenis==1 or $param_jenis==2 or $param_jenis==3)  echo "<th>ANTIVIRUS</th>"; ?>
                            <th>KETERANGAN</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- Start: list_row -->
                        <?php
                            if(isset($hasil) && $hasil!=null){
                                if(sizeof($hasil)>0){
                                    foreach ($hasil as $row)
                                    {
                                        $id=$row['id'];
                                        echo "<tr>";
                                        echo "<td>".$row['id_hardware']."</td>";
                                        echo "<td>".$row['kantor']."</td>";
                                        echo "<td>".$row['nmmerk']."</td>";
                                        if($row['jenis']==6 ) echo "<td>".$row['nmprinter']."</td>";
                                        echo "<td>".$row['tipe']."</td>";
                                        echo "<td>".$row['sn']."</td>";
                                        if($row['jenis']==1 or $row['jenis']==2 or $row['jenis']==3) echo "<td>".$row['nmos']."</td>";
                                        echo "<td>".$row['tahun']."</td>";
                                        if($row['jenis']==1 or $row['jenis']==2 or $row['jenis']==3) echo "<td>".$row['ip']."</td>";
                                        if($row['jenis']==1 or $row['jenis']==2 or $row['jenis']==3) echo "<td>".$row['prosesor']."</td>";
                                        if($row['jenis']==1 or $row['jenis']==2 or $row['jenis']==3) echo "<td>".$row['memori']."</td>";
                                        if($row['jenis']==1 or $row['jenis']==2 or $row['jenis']==3) echo "<td>".$row['hdd'];
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
                    <!-- End: list_row -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
}else{
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-usd"></i>
                    <span>The World's billionaries</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="expand-link">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content no-padding">
                <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
                    <thead>
                        <tr>
                            <th>UNIT</th>
                            <th>MERK</th>
                            <th>TIPE</th>
                            <th>PORT</th>
                            <th>IP</th>
                            <th>SERIAL NUMBER</th>
                            <th>TAHUN</th>
                            <th>KONDISI</th>
                            <th>KETERANGAN</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- Start: list_row -->
                        <?php
                                if(isset($hasil) && $hasil!=null){
                                    if(sizeof($hasil)>0){
                                        foreach ($hasil as $row)
                                        {
                                            $id=$row['id'];
                                            echo "<tr>";
                                            echo "<td>".$row['kantor']."</td>";
                                            echo "<td>".$row['nmmerk']."</td>";
                                            echo "<td>".$row['tipe']."</td>";
                                            echo "<td>".$row['port']."</td>";
                                            echo "<td>".$row['ip']."</td>";
                                            echo "<td>".$row['sn']."</td>";
                                            echo "<td>".$row['tahun']."</td>";
                                            echo "<td>".$row['nmkondisi']."</td>";
                                            echo "<td>".$row['keterangan']."</td>";
                                            echo "</tr>";
                                        }
                                    }else{
                            ?>
                                    <tr>
                                        <td colspan="18">Data Kosong</td>
                                    </tr>
                            <?php           
                                    }
                                }else{
                            ?>
                                    <tr>
                                        <td colspan="18">Data Kosong</td>
                                    </tr>
                            <?php
                                }
                           ?>
                    <!-- End: list_row -->
                    </tbody>
<!--                     <tfoot>
                        <tr>
                            <th>UNIT</th>
                            <th>MERK</th>
                            <th>TIPE</th>
                            <th>PORT</th>
                            <th>IP</th>
                            <th>SERIAL NUMBER</th>
                            <th>TAHUN</th>
                            <th>KONDISI</th>
                            <th>KETERANGAN</th>
                        </tr>
                    </tfoot> -->
                </table>
            </div>
        </div>
    </div>
</div>


<?php   
}
    echo form_open('laporan/cetakLaporan');
    if(isset($filter) && $filter!=null){
        $filter_cetak=$filter;
    }
    if(isset($jenisnya) && $jenisnya!=null){
        $id_cetak=$jenisnya;
    }
?>
    <select name="opsi">
        <option value=1 selected>PDF</option>
        <option value=2>Excel</option>
        <!-- <option value=3>Barcode</option> -->
    </select>
    <input type="hidden" id="parameter" name="parameter" value="<?php echo $filter_cetak; ?>"/>
    <input type="hidden" id="parameter_id" name="parameter_id" value="<?php echo $id_cetak; ?>"/>
    <input type="submit" value="cetak" />
<?php
    echo form_close();
?>


