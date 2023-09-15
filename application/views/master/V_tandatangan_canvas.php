<?php
//$this->load->view('template/head');
?>
        <!-- DATA TABLES -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/skins/_all-skins.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- <link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.css') ?>" rel="stylesheet" type="text/css" /> -->
<!--        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/boostrap/css/canvas_ttd_style.css')?>" rel="stylesheet" type="text/css" />-->
       <link href="<?php  echo base_url('assets/AdminLTE-2.0.5/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css" />
       <style type="text/css">
           bhtml {
                overflow-y: scroll;
            }

            *{
                margin:0;
                font-family: sans-serif,Georgia;
            }

            body{
                margin:0px 0px 0px 0px;
                text-align:center;
            }
            canvas{
                cursor: crosshair;
                border:black solid 1px;
                margin-bottom:10px;
            }

            h1{
                    font-family: 'Droid Serif', serif;
                    font-weight: normal;
                    font-size: 220%;
                    color: black;
                    margin-top: 0.4em;
                    margin-bottom: 0.3em;
            }

            h2{
                    font-family: 'Droid Sans', sans-serif;
                    font-weight: normal;
                    font-size: 120%;
                    color: black;
                    margin-top:1.2em;

            }

            h3{

                font-family: 'Droid Sans', sans-serif;
                    font-weight: normal;
                    font-size: 80%;
                    color: black;
                    margin-top:1.2em;
                    margin-bottom: 0.3em;

            }
            #clr{
                margin:0 auto;
                float: left;
            }

            #clr div{
                cursor:pointer;
                cursor:hand;
                width:20px;
                height:20px;

            }
            .gambar{
                height: 100px;
                width: 100px;
                box-shadow: 0px 0.9px 2px #333333;
                margin-bottom: 14px;
                background: none;

            }

            img:hover {
                box-shadow: 0px 1px 10px #333333;
            }


            a.minimal:active {
                background: none repeat scroll 0 0 #D0D0D0;
                box-shadow: 0 0 1px 1px #E3E3E3 inset;
                color: #000000;
            }

            a.minimal {
                background: none repeat scroll 0 0 #E3E3E3;
                border: 1px solid #BBBBBB;
                border-radius: 3px 3px 3px 3px;
                box-shadow: 0 0 1px 1px #F6F6F6 inset;
                color: #333333;
                font: bold 12px/1 "helvetica neue",helvetica,arial,sans-serif;
                padding: 8px 10px 9px;
                text-align: center;
                text-shadow: 0 1px 0 #FFFFFF;
                width: 150px;
                text-decoration:none;
            }
            .btn:active {
                background: none repeat scroll 0 0 #D0D0D0;
                box-shadow: 0 0 1px 1px #E3E3E3 inset;
                color: #000000;
            }

            .btn {
                background: none repeat scroll 0 0 #E3E3E3;
                border: 1px solid #BBBBBB;
                border-radius: 3px 3px 3px 3px;
                box-shadow: 0 0 1px 1px #F6F6F6 inset;
                color: #333333;
                font: bold 12px/1 "helvetica neue",helvetica,arial,sans-serif;
                padding: 8px 10px 9px;
                text-align: center;
                text-shadow: 0 1px 0 #FFFFFF;
                width: 150px;
                text-decoration:none;
            }


            a.download:active {
                -moz-border-bottom-colors: none;
                -moz-border-image: none;
                -moz-border-left-colors: none;
                -moz-border-right-colors: none;
                -moz-border-top-colors: none;
                background: none repeat scroll 0 0 #3282D3;
                border-color: #154C8C #154C8C #0E408E;
                border-style: solid;
                border-width: 1px;
                box-shadow: 0 0 6px 3px #1657B5 inset, 0 1px 0 0 white;
                text-shadow: 0 -1px 1px #2361A4;
            }

            a.download {
                cursor:pointer;
            }

            a.download {
                background-color: #52A8E8;
                background-image: -moz-linear-gradient(center top , #52A8E8, #377AD0);
                border-color: #4081AF #2E69A3 #20559A;
                border-radius: 16px 16px 16px 16px;
                border-style: solid;
                border-width: 1px;
                box-shadow: 0 1px 0 0 #72B9EB inset, 0 1px 2px 0 #B3B3B3;
                color: #FFFFFF;
                font: 25px/1 "lucida grande",sans-serif;
                padding: 3px 5px;
                text-align: center;
                text-shadow: 0 -1px 1px #3275BC;
                width: 112px;
                display: block;
                margin: 10px auto;
                padding: 10px;
                width: 230px;
            }

            #themain{
                margin: 20px;
            }

            #btns{
                margin:20px;
            }
       </style>
  <!-- Theme style -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

<?php
$this->load->view('template/topbar2');
?>
<?php
if(isset($dt_user)){
    foreach ($dt_user as $rowuser) {
            $id = $rowuser->userid;
            $nik = $rowuser->nik;
            $nmdpn = $rowuser->nmdepan;
            $nmlkp = $rowuser->nmlengkap;
        }
}
?>

<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <fieldset>
                <legend class="text-warning">DIGITAL SIGN</legend>
            </fieldset>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-lg-12">
        <h1><?php echo $nmlkp; ?></h1
    <center>
        <div id="themain">
            <form method="post" action="simpan_foto.php" enctype="multipart/form-data">
                <canvas id="can" name="can" width="450" height="400" ></canvas>
                <div id="clr">
                    <div style="background-color:black;"></div>
                    <div style="background-color:red;"></div>
                    <div style="background-color:green;"></div>
                    <div style="background-color:orange;"></div>
                    <div style="background-color:#FFFF00;"></div>
                    <div style="background-color:#F43059;"></div>
                    <div style="background-color:#ff00ff;"></div>
                    <div style="background-color:#9ecc3b;"></div>
                    <div style="background-color:#fbd;"></div>
                    <div style="background-color:#fff460;"></div>
                    <div style="background-color:#F43059;"></div>
                    <div style="background-color:#82B82C;"></div>
                    <div style="background-color:#0099FF;"></div>
                    <div style="background-color:#ff00ff;"></div>
                    <div style="background-color:rgb(128,0,255);"></div>
                    <div style="background-color:rgb(255,128,0);"></div>
                    <div style="background-color:rgb(153,254,0);"></div>
                    <div style="background-color:rgb(18,0,255);"></div>
                    <div style="background-color:rgb(255,28,0);"></div>
                    <div style="background-color:rgb(13,54,0);"></div>

                </div><br /><br />
                Pen size: <input type="range" min="0" max="50" value="5" id="bsz"/><br />
                <br />
                Pen color: <input type="color" placeholder="#FF00FF"  value="#FF00FF" id="bcl"/><br />

            </form>
            <div id="btns">
                <a href="#themain" id="undo" class="minimal" >Undo</a>
                <a href="#themain" id="clear" class="minimal" >Hapus</a>
                <input type="button" onclick="uploadEx();" class="btn" download="<?php echo $nmlkp; ?>" value="Simpan Tanda Tangan" />
                <!-- <form id="form1" action="<?php //echo echo base_url('master/C_tandatangan/simpan_ttd'); ?>" method="post"> -->
                        <!-- <input type="file" name="myfile"> -->
                        <!-- <input type="hidden" name="hidden_data" id='hidden_data'/>
                        <input type="hidden" name="TransID" id="TransID" value="<?php //echo $id; ?>"/>
                        <input type="hidden" name="Nama" id="Nama" value="<?php //echo $nmlkp; ?>"/> -->
                <!-- </form> -->
                <form method="post" accept-charset="utf-8" name="form1" enctype="multipart/form-data">
                    <input name="hidden_data" id='hidden_data' type="hidden"/>
                    <input type="hidden" name="TransID" id="TransID" value="<?php echo $id; ?>"/>
                    <input type="text" name="Nama" id="Nama" value="<?php echo $nmlkp; ?>"/>
                </form>
            </div>
            <form action="#" method="post" id="frm">
                <input type="hidden" name="TransID" id="TransID" value="<?php echo $id; ?>"/>
                <span id="result"></span>
                <input type="hidden" name="data" id="data" />
                <a id="save" href="#themain" class="minimal">Tampilkan Tanda Tangan</a>
            </form>
        </div>
    </center>
        </div>
    </div>

</section><!-- /.content -->

<?php
$this->load->view('template/js2');

?>
<!--<script src="<?php //echo base_url('assets/AdminLTE-2.0.5/boostrap/js/app.js')?>" type="text/javascript"></script>-->
<!--<script src="<?php //echo base_url('assets/AdminLTE-2.0.5/boostrap/js/script.js')?>" type="text/javascript"></script>-->
<script type="text/javascript">
        function uploadEx() {
            var canvas = document.getElementById("can");
            var dataURL = canvas.toDataURL("image/png");
            document.getElementById('hidden_data').value = dataURL;
            var fd = new FormData(document.forms["form1"]);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo base_url('master/C_tandatangan/simpan_ttd') ?>', true);

            xhr.upload.onprogress = function(e) {
                if (e.lengthComputable) {
                    var percentComplete = (e.loaded / e.total) * 100;
                    console.log(percentComplete + '% uploaded');
                    console.log('test');
                    alert('Tanda Tangan berhasil disimpan');
                }else{
                    alert('Tanda Tangan batal disimpan');
                }
            };

            xhr.onload = function() {

            };
            xhr.send(fd);
        }

        var restorePoints = [];
        $(document).ready(function(){
            // This array will store the restoration points of the canvas

        var restorePoints = [];
        var a=false;var b,c="";var d=document.getElementById("can");
        var e=d.getContext("2d");
        e.strokeStyle="black";
        e.lineWidth=5;
        e.lineCap="round";
        e.fillStyle="rgba(0,0,0,0)";
        e.fillRect(0,0,d.width,d.height);
        $("#bsz").change(function(a){e.lineWidth=this.value});
        $("#bcl").change(function(a){e.strokeStyle=this.value});
        $("#can").mousedown(function(d){saveRestorePoint();a=true;e.save();b=d.pageX-this.offsetLeft;c=d.pageY-this.offsetTop});


        $(document).mouseup(function(){a=false});
        $(document).click(function(){a=false});

        $("#can").mousemove(function(d){
            if(a==true){
                e.beginPath();
                e.moveTo(d.pageX-this.offsetLeft,d.pageY-this.offsetTop);
                e.lineTo(b,c);
                e.stroke();
                e.closePath();
                b=d.pageX-this.offsetLeft;
                c=d.pageY-this.offsetTop}}
                );
                
        $("#clr > div").click(function(){e.strokeStyle=$(this).css("background-color");
        //$("#bcl").val($(this).css("background-color"))
            });
        $("#undo").click(function(){undoDrawOnCanvas();});

        $("#eraser").click(function(){e.strokeStyle="#fff"});
        $("#save").click(function(){$("#result").html("<img src="+d.toDataURL()+' class="gambar" /><br /><a href="#get" id="get" class="minimal" >Simpan Ke Database</a>');
            $("#data").val(d.toDataURL());
            $("#get").click(function(){$("#frm").trigger("submit");});});
        $("#clear").click(function(){e.fillStyle="rgba(0,0,0,0)";e.fillRect(0,0,d.width,d.height);e.strokeStyle="black";e.fillStyle="rgba(0,0,0,0)"})})


        function saveRestorePoint() {
            var oCanvas = document.getElementById("can");
            var imgSrc = oCanvas.toDataURL("image/png");
            restorePoints.push(imgSrc);
        }

        function undoDrawOnCanvas() {
                if (restorePoints.length > 0) {
                var oImg = new Image();
                oImg.onload = function() {
                    var canvasContext = document.getElementById("can").getContext("2d");        
                    canvasContext.drawImage(oImg, 0, 0);
                }
                oImg.src = restorePoints.pop();
            }
        }


    </script>

<!-- DATA TABES SCRIPT -->


<!-- page script -->

<?php
$this->load->view('template/foot2');
?>