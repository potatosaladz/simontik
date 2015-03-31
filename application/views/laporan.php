<label>Filter&nbsp;</label>
<?php
if(isset($ref_jenis) && $ref_jenis!=null){
	if(isset($all) && $all==false){
		echo form_open('laporan/perjenis');
	}else{
		echo form_open('laporan/summary');
	}
?>
	<label>Jenis</label>
	<select name="jenis">
		<option value="" selected>--</option>
		<?php
		
			foreach ($ref_jenis as $row) {
				echo "<option value=".$row['id'].">".$row['nmjenis']."</option>";
			}
		
		?>
	</select>
	<?php
	if(isset($all) && $all==false){
	?>
	<input type="hidden" name="param_jenis" value="<?php echo $param_jenis;  ?>">
	<input type="submit" value="Tayang">


<?php
}
if(isset($all) && $all==false){
	echo form_close();
}
}
if(isset($ref_kppn) && $ref_kppn!=null){
	if(isset($all) && $all==false){
		echo form_open('laporan/perkppn');
	}
?>
	<label>KPPN</label>
	<select name="kppn">
	<option value="" selected>--</option>
		<?php
		
			foreach ($ref_kppn as $row) {
				echo "<option value=".$row['unit2'].">".$row['kantor']." (".$row['kdkppn'].")</option>";
			}
		
		?>
	</select>
	<?php
	if(isset($all) && $all==false){
	?>
	<input type="hidden" name="param_jenis" value="<?php echo $param_jenis;  ?>">
	<input type="submit" value="Tayang">


<?php
}
if(isset($all) && $all==false){
	echo form_close();
}
}
if(isset($ref_kanwil) && $ref_kanwil!=null){
if(isset($all) && $all==false){
	echo form_open('laporan/perkanwil');
}
?>
	<label>Kanwil</label>
	<select name="kanwil">
	<option value="" selected>--</option>
		<?php
		
			foreach ($ref_kanwil as $row) {
				echo "<option value=".$row['unit2'].">".$row['kantor']." (".$row['kdkanwil'].")</option>";
			}
		
		?>
	</select>
	<?php
	if(isset($all) && $all==false){
	?>
	<input type="hidden" name="param_jenis" value="<?php echo $param_jenis;  ?>">
	<input type="submit" value="Tayang">


<?php
}
if(isset($all) && $all==false){
	echo form_close();
}
}

if(isset($ref_tahun) && $ref_tahun!=null){
if(isset($all) && $all==false){
	echo form_open('laporan/pertahun');
}
?>
	<label>Tahun</label>
	<select id="tahun" name="tahun">
	<option value="" selected>--</option>
        <?php 
            $year = date("Y") - 11; 
            for ($i = 0; $i <= 10; $i++) {
                $year++; 
                if(isset($hardware)){
                    if($year==$tahun_ubah){
                        echo "<option selected>$year</option>";
                    }else{
                        echo "<option>$year</option>";
                    }
                }else{
                    echo "<option>$year</option>";
                } 
            }
        ?>
    </select>
    <?php
	if(isset($all) && $all==false){
	?>
    <!-- <input type="hidden" name="param_jenis" value="<?php echo $param_jenis;  ?>"> -->
	<input type="submit" value="Tayang">
<?php
}
if(isset($all) && $all==false){
	echo form_close();
}
}
if(isset($ref_kondisi) && $ref_kondisi!=null){
if(isset($all) && $all==false){
	echo form_open('laporan/perkondisi');
}
?>
	<label>Kondisi</label>
	<select name="kondisi">
	<option value="" selected>--</option>
		<?php
		
			foreach ($ref_kondisi as $row) {
				echo "<option value=".$row['id'].">".$row['nmkondisi']."</option>";
			}
		
		?>
	</select>
	<?php
	if(isset($all) && $all==false){
	?>
	<input type="hidden" name="param_jenis" value="<?php echo $param_jenis;  ?>">
	<input type="submit" value="Tayang">
	<?php
	}else{
	?>
	<input type="submit" value="Tayang">
	<?php	
	}
	?>


<?php
	echo form_close();
}
?>


