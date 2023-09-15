<?php $this->load->view('template/headbar'); ?>

<?php if (isset($dt_user)) {
    foreach ($dt_user as $rowuser) {
        $id             = $rowuser->userid;
        $nik            = $rowuser->nik;
        $nmdpn          = $rowuser->nmdepan;
        $nmlkp          = $rowuser->nmlengkap;
        $persoanl_id    = $rowuser->personalid;
        $personalstatus = $rowuser->personalstatus;
        $levelusernm    = $rowuser->levelusernm;
    }
} ?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12 mb-1">
            <h4 class="text-uppercase">Tanda Tangan User</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="row mt-2 mb-1">
                                    <div class="col-2" align="right">
                                        <label style="padding: 10px 0;">NAMA</label>
                                    </div>
                                    <div class="col-3">
                                        <input name="txtnama" id="txtnama" value="<?php echo $nmlkp; ?>" class="form-control input-sm" type="text" readonly>
                                    </div>
                                    <div class="col-2" align="right">
                                        <label style="padding: 10px 0;">User Level</label>
                                    </div>
                                    <div class="col-3">
                                        <input name="txtlevelusernm" id="txtlevelusernm" value="<?php echo $levelusernm; ?>" class="form-control input-sm" type="text" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <center>
                                    <form id="themain">
                                        <form method="post" id="ttdkontrak" action="simpan_ttdkuk.php" enctype="multipart/form-data">
                                            <canvas id="can" name="can" width="850" height="500" style="border:1px solid #ddd;" onclick="myFunction()"></canvas>
                                        </form>
                                        <div id="btns">
                                            <button type="button" id="btnclean" class="btn btn-info" onclick="myButton()">Reset</button>
                                            <button id="ttd" type="button" onclick="uploadEx();" class="btn btn-primary" download="<?php echo $nmlkp; ?>" value="Simpan Tanda Tangan" style="width:200px;">Save</button>
                                            <form method="post" accept-charset="utf-8" id="form1" action="<?php echo base_url('master/C_tandatangan/simpan_ttddokumen'); ?>">
                                                <input type="hidden" name="hidden_data" id='hidden_data' />
                                                <input type="hidden" name="refid" id="refid" value="<?php echo $id; ?>" />
                                                <input type="hidden" name="refnama" id="refnama" value="<?php echo $nmlkp; ?>" />
                                                <input type="hidden" name="refpersonalid" id="refnama" value="<?php echo $persoanl_id; ?>" />
                                                <input type="hidden" name="refpersonalstatus" id="refnama" value="<?php echo $personalstatus; ?>" />
                                            </form>
                                        </div>
                                    </form>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section><!-- /.content -->

<?php $this->load->view('template/footbar'); ?>

<script>
    $(document).ready(function() {
        var btn = document.getElementById('ttd').value;
        $('#themain').submit(function() {
            window.onbeforeunload = null;
        });

        if (btn === 'Save') {
            window.onbeforeunload = function() {
                return "YANG BERSANGKUTAN BELUM TANDA TANGAN"
            };
        }

        document.getElementById("ttd").disabled = true;
    });

    function myButton() {
        document.getElementById("ttd").disabled = true;
    }

    function myFunction() {
        document.getElementById("ttd").disabled = false;
    }
</script>
<script>
    var el, ctx, bounds, isDrawing, points = [];

    function midPointBtw(p1, p2) {
        return {
            x: p1.x + (p2.x - p1.x) / 2,
            y: p1.y + (p2.y - p1.y) / 2
        };
    }


    $('#btnclean').on('click', function(e) {
        e.preventDefault();
        ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
        points.length = 0;
    });


    function isEmptydata(datas) {
        if (datas.trim() === '') {
            return true;
        } else {
            return false;
        }
    }

    $(function() {
        el = document.getElementById('can');
        ctx = el.getContext('2d');
        ctx.lineWidth = 10;
        ctx.lineJoin = ctx.lineCap = 'round';
        
        el.onmousedown = function(e) {
            bounds = el.getBoundingClientRect();
            if (!isDrawing) {
                isDrawing = true;
            }
            points.push({
                x: e.clientX - bounds.x,
                y: e.clientY - bounds.y
            });
        };

        el.onmousemove = function(e) {
            if (!isDrawing) return;
            points.push({
                x: e.clientX - bounds.x,
                y: e.clientY - bounds.y
            });
            var p1 = points[0];
            var p2 = points[1];
            ctx.beginPath();
            ctx.moveTo(p1.x, p1.y);
            for (var i = 1, len = points.length; i < len; i++) {
                var midPoint = midPointBtw(p1, p2);
                ctx.quadraticCurveTo(p1.x, p1.y, midPoint.x, midPoint.y);
                p1 = points[i];
                p2 = points[i + 1];
            }
            ctx.lineTo(p1.x, p1.y);
            ctx.stroke();
        };

        el.onmouseup = function() {
            if (isDrawing) {
                isDrawing = false;
            }
            points.length = 0;
        };

        <?php if (isset($filedata)) { ?>
            var image = new Image();
            image.onload = function() {
                ctx.drawImage(image, 0, 0);
            };
            image.src = "<?= $filedata ?>";
        <?php } ?>
    });
</script>
<script>
    function uploadEx() {
        var canvas = document.getElementById("can");
        var dataURL = canvas.toDataURL("image/png");
        document.getElementById('hidden_data').value = dataURL;
        var fd = new FormData(document.getElementById("form1"));

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'tanda_tangan/', true);

        xhr.upload.onprogress = function(e) {
            if (e.lengthComputable) {
                var percentComplete = (e.loaded / e.total) * 100;
                console.log(percentComplete + '% uploaded');
                document.getElementById("form1").submit();
                alert('Tanda Tangan berhasil disimpan');
            }
        };

        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(fd);
    };
</script>

<?php $this->load->view('template/footbarend'); ?>