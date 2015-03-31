<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>SIMONTIK</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/themes/start/jquery-ui.css">
    <script type="text/javascript" src="<?=base_url()?>public/js/jquery.js"></script>
    <script type="text/javascript" src="<?=base_url()?>public/js/jquery-ui.js"></script>
    <!--<script type="text/javascript" src="<?=base_url()?>public/js/js_login.js"></script> -->
</head>
<body>
<div id="wrap">
    <div id="main">
        <div id="header">
            <div id="logo">
                <img src="<?=base_url()?>public/img/depkeu_Logo.png" class="img-rounded" />
            </div>
            <div id="text_logo">
                <h3>KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h3> 
                <h2>DIREKTORAT JENDERAL PERBENDAHARAAN NEGARA</h2>
                <h1>DIREKTORAT SISTEM PERBENDAHARAAN</h1>
                
            </div>
        </div><!-- end header -->
        <div id="container2">
            <div id="container1">
                <div id="col1">
                    <div class="pad">
                        <img src="<?=base_url()?>public/img/login.png" class="img-rounded" />
                    </div>
                </div> <!-- end col1 -->
                <div id="col2">
                    <div style="border:1px solid #D3D3D3"> 
                        <div id="form_login">
                            <div id="pre_sirekan"><h3>Aplikasi Inventarisasi dan Monitoring Perangkat TIK</h3></div>
                            &nbsp;
                            <div id="col3">
                                <!-- <form method="post" id="frm_login" action="<?php echo base_url();?>login/process"> -->
                                <?php echo form_open('login/process'); ?>
                                    <table border="0" align="center">
                                        <tr>
                                            <td><label for="user">Username</label></td>
                                            <td><input type="text" id="user" name="user" title="Masukan username" /></td>
                                            <td><span id="x"></span></td>
                                        </tr>
                                        <tr>    
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><label for="pass">Password</label></td>
                                            <td><input type="password" id="pass" name="pass" title="Masukan password" /></td>
                                            <td><span id="x"></span></td>
                                        </tr>
                                        <!--<tr>
                                            <td><label for="captcha">Masukkan Kode</label></td>
                                            <td><input type="text" id="cap" name="cap" /></td>
                                            <td><img src="controller/cont.captcha.php"><span id="x"></span></td>
                                        </tr>-->
                                    </table>
        							<center style="color:#ff0000"><div id="error">
                                    <?php
                                        if (isset($logout_message)) {
                                            echo "<div class='message'>";
                                            echo $logout_message;
                                            echo "</div>";
                                        }
                                        if (isset($message_display)) {
                                            echo "<div class='message'>";
                                            echo $message_display;
                                            echo "</div>";
                                        }
                                        if (isset($error_message)) {
                                            echo $error_message;
                                        }
                                        echo validation_errors();
                                    ?>
                                    </div></center>
                                    <br/>
                                    <table border="0" align="center">
                                        <tr>
                                            <td align="center"><input class="btn" type="submit" value="Login" id="btn_login" name="btn_login" /></td>
                                             <!-- <td align="center"><a href="#" style="text-decoration:none;" id="btn_daftar">Daftar</a></td> -->
                                            <td align="center"><input class="btn" type="reset" value="Reset" id="btn_reset"/></td>
                                        </tr>
                                        <!-- <tr>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><h4>Untuk Mendaftar <a href="#" style="text-decoration:none;" id="daftar">KLIK DISINI</a></h4></td>
                                        <tr> -->
                                    </table>
                                <!-- </form> -->
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col2 -->
            </div> <!-- end container1 -->
        </div> <!-- end container2 -->
    </div> <!-- end main -->
    <div id="footer">
        Copyright 2014 by potatosaladz
    </div>
</div> <!-- end wrapper -->

<div id="spinner" class="spinner" style="display:none;">
    <img id="img-spinner" src="<?=base_url()?>public/img/loader.gif" alt="Loading"/>
</div>

<div id="loading_dialog"></div>
</body>
</html>
