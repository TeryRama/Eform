<?php $this->load->view('template/headbar'); ?>

<?php if($aksi == 'aksi_add'){
    $id             = "";
    $kode           = "";
    $nk             = "";
    $nmdpn          = "";
    $nmlkp          = "";
    $usernm         = "";
    $passw          = "";
    $idleveluser    = "";
    $stuser         = "";
    $idcompany      = "";
    $iddivisi       = "";
    $iddept         = "";
    $idbagian       = "";
    $idjabatan      = "";
    $personalid     = "";
    $personalstatus = "";
    $status_otp     = "";
}else{
    foreach ($dtuser as $rowuser){
        $id             = $rowuser->userid;
        $nk             = $rowuser->nik;
        $nmdpn          = $rowuser->nmdepan;
        $nmlkp          = $rowuser->nmlengkap;
        $usernm         = $rowuser->username;
        $passw          = $rowuser->password;
        $idleveluser    = $rowuser->leveluserid;
        $stuser         = $rowuser->inactive;
        $idcompany      = $rowuser->id_company;
        $iddivisi       = $rowuser->id_divisi;
        $iddept         = $rowuser->id_dept;
        $idbagian       = $rowuser->id_bagian;
        $idjabatan      = $rowuser->id_jabatan;
        $personalid     = $rowuser->personalid;
        $personalstatus = $rowuser->personalstatus;
        $status_otp     = $rowuser->status_otp;
    }
} ?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">FORM USER</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <?php $this->session->flashdata('pesan') ?>
                        <form action="<?= base_url('master/user/C_menu_user/form/' . $aksi) ?>" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Status</span>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="personalstatus" id="personalstatus"
                                                class="personalstatus form-control" required>
                                                <option value="">- pilih -</option>
                                                <option value="1"
                                                    <?php if($personalstatus == '1'){ echo 'selected'; } ?>>Karyawan
                                                </option>
                                                <option value="2"
                                                    <?php if($personalstatus == '2'){ echo 'selected'; } ?>>Tenaga Kerja
                                                </option>
                                                <option value="3"
                                                    <?php if($personalstatus == '3'){ echo 'selected'; } ?>>Tamu
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="div_usertamu">
                                        <div class="col-md-4">
                                            <span>User Tamu Onelogin <i>(optional)</i></span>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="usertamu" id="usertamu"
                                                class="usertamu all_inputan form-control select2">
                                                <option value="">- pilih -</option>
                                                <?php foreach ($dttamu as $dttamu_row){ ?>
                                                <option value="<?= $dttamu_row->personalid; ?>"
                                                    <?php if($dttamu_row->personalid == $personalid){ echo 'selected'; } ?>>
                                                    <?= $dttamu_row->Nama; ?></option>
                                                <?php } ?>
                                            </select>
                                            <br>
                                            <span style="font-size:13px; color:red"><i>note : pilih user yg tersedia
                                                    untuk login menggunakan aplikasi onelogin</i></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>NIK</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="hidden" name="userid" class="userid all_inputan form-control"
                                                id="userid" value="<?= $id; ?>">
                                            <input type="hidden" name="personalid"
                                                class="personalid all_inputan form-control" id="personalid"
                                                value="<?= $personalid; ?>">
                                            <input type="text" name="nik"
                                                class="nik angkasaja_6digit all_inputan form-control" id="nik"
                                                placeholder="tuliskan NIK" value="<?= $nk; ?>" required readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Nama Depan</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="nmdepan" class="nmdepan all_inputan form-control"
                                                id="nmdepan" placeholder="Nama Depan" value="<?= $nmdpn; ?>" required
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Nama Lengkap</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="nmlengkap"
                                                class="nmlengkap all_inputan form-control" id="nmlengkap"
                                                placeholder="Nama Lengkap" value="<?= $nmlkp; ?>" required readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Company</span>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="id_company" id="id_company"
                                                class="id_company all_inputan list_selectopt form-control" required>
                                                <option value="">- pilih -</option>
                                                <?php if(isset($dtcompany)){
                                                    foreach ($dtcompany as $dtcompany_row){ ?>
                                                <option value="<?= $dtcompany_row->id_company; ?>"
                                                    <?php if($dtcompany_row->id_company == $idcompany){ echo 'selected'; } ?>>
                                                    <?= $dtcompany_row->company . ' - ' . $dtcompany_row->company_branch; ?>
                                                </option>
                                                <?php } } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Divisi</span>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="id_divisi" id="id_divisi"
                                                class="id_divisi all_inputan list_selectopt form-control" required>
                                                <option value="">- pilih -</option>
                                                <?php if(isset($dtdivisi)){
                                                    foreach ($dtdivisi as $dtdivisi_row){ ?>
                                                <option value="<?= trim($dtdivisi_row->kodedivisi); ?>"
                                                    <?php if(trim($dtdivisi_row->kodedivisi) == $iddivisi){ echo 'selected'; } ?>>
                                                    <?= $dtdivisi_row->namadivisi; ?></option>
                                                <?php } } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Departemen</span>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="id_dept" id="id_dept"
                                                class="id_dept all_inputan list_selectopt form-control" required>
                                                <option value="">- pilih -</option>
                                                <?php if(isset($dtdepartemen)){
                                                    foreach ($dtdepartemen as $dtdept_row){ ?>
                                                <option value="<?= trim($dtdept_row->deptid); ?>"
                                                    <?php if(trim($dtdept_row->deptid) == $iddept){ echo 'selected'; } ?>>
                                                    <?= $dtdept_row->deptabbr; ?></option>
                                                <?php } } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Departemen - Bagian</span>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="id_bagian" id="id_bagian"
                                                class="id_bagian all_inputan list_selectopt form-control" required>
                                                <option value="">- pilih -</option>
                                                <?php if(isset($dtbagian)){
                                                    foreach ($dtbagian as $dtbagian_row){ ?>
                                                <option value="<?= trim($dtbagian_row->bagianid); ?>"
                                                    <?php if(trim($dtbagian_row->bagianid) == $idbagian){ echo 'selected'; } ?>>
                                                    <?= $dtbagian_row->bagianabbr; ?></option>
                                                <?php } } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Jabatan</span>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="id_jabatan" id="id_jabatan"
                                                class="id_jabatan all_inputan list_selectopt form-control" required>
                                                <option value="">- pilih -</option>
                                                <?php if(isset($dtjabatan)){
                                                    foreach ($dtjabatan as $dtjabatan_row){ ?>
                                                <option value="<?= trim($dtjabatan_row->jabatanid); ?>"
                                                    <?php if(trim($dtjabatan_row->jabatanid) == $idjabatan){ echo 'selected'; } ?>>
                                                    <?= $dtjabatan_row->namajabatan; ?></option>
                                                <?php } } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Level User</span>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="leveluserid" id="leveluserid"
                                                class="leveluserid all_inputan form-control" required>
                                                <option value="">- pilih -</option>
                                                <?php if(isset($dtleveluser)){
                                                    foreach ($dtleveluser as $dtleveluser_row){ ?>
                                                <option value="<?= $dtleveluser_row->leveluserid; ?>"
                                                    <?php if($dtleveluser_row->leveluserid == $idleveluser){ echo 'selected'; } ?>>
                                                    <?= $dtleveluser_row->levelusernm; ?></option>
                                                <?php } } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Username</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="username" class="username all_inputan form-control"
                                                id="username" placeholder="Username" value="<?= $usernm; ?>" required
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Password</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="password" class="password all_inputan form-control"
                                                id="password" placeholder="Password" value="<?= $passw; ?>" required
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Status Personal</span>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="col-sm-10" id="st_personal"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Status User Onelogin</span>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="col-sm-10" id="st_onelogin"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Status User</span>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="stuser" id="stuser" class="stuser all_inputan form-control"
                                                required>
                                                <option value="">- pilih -</option>
                                                <option value="0" <?php if($stuser == '0'){ echo 'selected'; } ?>>Active
                                                </option>
                                                <option value="1" <?php if($stuser == '1'){ echo 'selected'; } ?>>Not
                                                    Active</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Penerima OTP</span>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="status_otp" id="status_otp"
                                                class="status_otp all_inputan form-control" required>
                                                <option value="">- pilih -</option>
                                                <option value="0" <?php if($status_otp == '0'){ echo 'selected'; } ?>>
                                                    Active</option>
                                                <option value="1" <?php if($status_otp == '1'){ echo 'selected'; } ?>>
                                                    Not Active</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn bg-gradient-primary btnsimpan"
                                                name="btnsimpan" id="btnsimpan" disabled>Simpan</button>
                                            <button type="button"
                                                onclick="location.href='<?= base_url('master/user/C_menu_user') ?>'"
                                                class="btn bg-gradient-dark">Kembali</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->

<?php $this->load->view('template/footbar'); ?>

<script type="text/javascript">
$(document).ready(function() {
    $('.angkasaja_6digit').mask("000000", {
        reverse: false
    });

    $(document).on('keyup', "input[type=text]", function() {
        $(this).val(function(_, val) {
            return val.toUpperCase();
        });
    });

    // status onload
    cek_statususer();
    val_personalstatus($('.personalstatus').val());

    if ('<?= $aksi ?>' == 'aksi_edit') {
        $('#btnsimpan').prop('disabled', false);
    }
    // end status onload

    $(document).on('change', '.personalstatus', function() {
        val_personalstatus($(this).val());
        $('.all_inputan').val(''); //kosongkan semua inputan
        cek_statususer();
    });

    function val_personalstatus(dtpersonalstatus) {
        if (dtpersonalstatus.trim() == '3') {
            $('#div_usertamu').show();

            $('.nik').prop('readonly', false);
            $('.nmdepan').prop('readonly', false);
            $('.nmdepan').prop('readonly', false);
            $('.username').prop('readonly', false);
        } else {
            $('#div_usertamu').hide();

            $('.nik').prop('readonly', false);
            $('.nmdepan').prop('readonly', true);
            $('.nmdepan').prop('readonly', true);
            $('.username').prop('readonly', true);
        }

        if (dtpersonalstatus.trim() == '1') {
            $('.list_selectopt > option').each(function() {
                if (!this.selected) {
                    $(this).attr('disabled', true);
                }
            });
        } else {
            $('.list_selectopt > option').each(function() {
                $(this).attr('disabled', false);
            });
        }
    }

    $(document).on('change', '.nik', function() {
        var dtnik = $(this).val();
        var dtpersonalstatus = $('.personalstatus').val();

        if (dtpersonalstatus.trim() != '' && dtpersonalstatus.trim() != '3' && dtnik.trim() != '') {
            $.ajax({
                url: "<?= base_url(); ?>index.php/master/user/C_menu_user/get_datapersonal",
                type: 'post',
                data: {
                    nik: dtnik,
                    personalstatus: dtpersonalstatus
                },
                success: function(data_html) {
                    val_personalid(dtpersonalstatus, data_html);
                },
                error: function() {
                    alert('fail');
                }
            });
        }
    });

    $(document).on('change', '.usertamu', function() {
        var dtusertamu = $(this).val();
        var dtpersonalstatus = $('#personalstatus').val();

        if (dtusertamu.trim() != '') {
            $('#nik').val('');
            $.ajax({
                url: "<?= base_url(); ?>index.php/master/user/C_menu_user/get_dtusertamu",
                type: 'post',
                data: {
                    usertamu: dtusertamu
                },
                success: function(data_html) {
                    val_personalid(dtpersonalstatus, data_html);
                },
                error: function() {
                    alert('fail');
                }
            });
        }
    });

    function val_personalid(dtpersonalstatus, data_html) {
        var html_dtuser = data_html.split("//");
        var namadepan = html_dtuser[0].split(" ");

        if (html_dtuser[0] != '') {
            if (dtpersonalstatus == '1') {
                $('.id_company').val(html_dtuser[3].trim());
                $('.id_divisi').val(html_dtuser[4].trim());
                $('.id_dept').val(html_dtuser[5].trim());
                $('.id_bagian').val(html_dtuser[6].trim());
                $('.id_jabatan').val(html_dtuser[7].trim());

                $('.list_selectopt > option').each(function() {
                    if (this.selected) {
                        $(this).attr('disabled', false);
                    }
                });

                $('.leveluserid').focus();
            } else {
                $('.id_company').val(html_dtuser[3].trim());
                $('.id_divisi').val(html_dtuser[4].trim());
                $('.id_dept').val(html_dtuser[5].trim());
                $('.id_bagian').val(html_dtuser[6].trim());
                $('.id_jabatan').val(html_dtuser[7].trim());

                $('.list_selectopt > option').each(function() {
                    $(this).attr('disabled', false);
                });

                $('.leveluserid').focus();
            }

            $('.nmdepan').val(namadepan[0]);
            $('.nmlengkap').val(html_dtuser[0]);
            $('.personalid').val(html_dtuser[2]);
            $('.username').val(namadepan[0] + '' + dtpersonalstatus + '' + html_dtuser[2]);
            $('.password').val('PASS1234');
            $('.stuser').val('0');

            $('#btnsimpan').prop('disabled', false);

            cek_statususer();

        } else {
            $('.nmdepan').val('');
            $('.nmlengkap').val('');
            $('.personalid').val('');
            $('.username').val('');
            $('.password').val('');

            $('#btnsimpan').prop('disabled', true);

            alert('maaf data personal tidak ditemukan..!!!');
        }
    }

    function cek_statususer() {
        var dtpersonalid = $('.personalid').val();
        var dtpersonalstatus = $('.personalstatus').val();

        if (dtpersonalstatus != '' && dtpersonalstatus != '3' && dtpersonalid != '') {
            $.ajax({
                url: "<?= base_url(); ?>index.php/master/user/C_menu_user/get_allstatus_user",
                type: 'post',
                data: {
                    personalid: dtpersonalid,
                    personalstatus: dtpersonalstatus
                },
                success: function(data_html) {
                    var html_dtuser = data_html.split("//");
                    $('#st_personal').empty();
                    $('#st_personal').append(html_dtuser[0]);

                    $('#st_onelogin').empty();
                    $('#st_onelogin').append(html_dtuser[1]);

                    if (html_dtuser[2] != 1 || html_dtuser[3] != 1) {
                        $('#btnsimpan').prop('disabled', true);
                    }
                },
                error: function() {
                    alert('fail');
                }
            });
        } else {
            $('#st_personal').empty();
            $('#st_onelogin').empty();
        }
    }

    // get list data        
    $(document).on('mousedown', '.id_dept', function() {
        var personalid = $(".personalid").val();
        var personalstatus = $(".personalstatus").val();

        var id_company = $(".id_company option:selected").val();
        var id_divisi = $(".id_divisi option:selected").val();
        var id_dept = $(this);

        if (personalid.trim() != '' && personalstatus.trim() != '1') { //ketika karyawab akan disabled
            if (id_company.trim() != '' && id_divisi.trim() != '') {
                $.ajax({
                    url: "<?= base_url(); ?>index.php/master/user/C_menu_user/get_list_dept",
                    type: 'post',
                    data: {
                        id_company: id_company,
                        id_divisi: id_divisi
                    },
                    success: function(data) {
                        id_dept.empty().append(data);
                    },
                    error: function() {
                        alert('fail');
                    }
                });
            }
        }
    });

    $(document).on('mousedown', '.id_bagian', function() {
        var personalid = $(".personalid").val();
        var personalstatus = $(".personalstatus").val();

        var id_company = $(".id_company option:selected").val();
        var id_divisi = $(".id_divisi option:selected").val();
        var id_dept = $(".id_dept option:selected").val();
        var id_bagian = $(this);

        if (personalid.trim() != '' && personalstatus.trim() != '1') { //ketika karyawab akan disabled
            if (id_company.trim() != '' && id_divisi.trim() != '' && id_dept.trim() != '') {
                $.ajax({
                    url: "<?= base_url(); ?>index.php/master/user/C_menu_user/get_list_bag",
                    type: 'post',
                    data: {
                        id_company: id_company,
                        id_divisi: id_divisi,
                        id_dept: id_dept
                    },
                    success: function(data) {
                        id_bagian.empty().append(data);
                    },
                    error: function() {
                        alert('fail');
                    }
                });
            }
        }
    });

    $(document).on('mousedown', '.id_jabatan', function() {
        var personalid = $(".personalid").val();
        var personalstatus = $(".personalstatus").val();

        var id_company = $(".id_company option:selected").val();
        var id_divisi = $(".id_divisi option:selected").val();
        var id_dept = $(".id_dept option:selected").val();
        var id_bagian = $(".id_bagian option:selected").val();
        var id_jabatan = $(this);

        if (personalid.trim() != '' && personalstatus.trim() != '1') { //ketika karyawab akan disabled
            if (id_company.trim() != '' && id_divisi.trim() != '' && id_dept.trim() != '' && id_bagian
                .trim() != '') {
                $.ajax({
                    url: "<?= base_url(); ?>index.php/master/user/C_menu_user/get_list_jab",
                    type: 'post',
                    data: {
                        id_company: id_company,
                        id_divisi: id_divisi,
                        id_dept: id_dept,
                        id_bagian: id_bagian
                    },
                    success: function(data) {
                        id_jabatan.empty().append(data);
                    },
                    error: function() {
                        alert('fail');
                    }
                });
            }
        }
    });

    $(document).on('mousedown', '.leveluserid', function() {
        var bagian_abbr = $(".id_bagian option:selected").text();
        var leveluserid = $(this);

        if (bagian_abbr.trim() != '') {
            $.ajax({
                url: "<?= base_url(); ?>index.php/master/user/C_menu_user/get_list_leveluser",
                type: 'post',
                data: {
                    bagian_abbr: bagian_abbr
                },
                success: function(data) {
                    leveluserid.empty().append(data);
                },
                error: function() {
                    alert('fail');
                }
            });
        }
    });
});
</script>

<?php $this->load->view('template/footbarend'); ?>