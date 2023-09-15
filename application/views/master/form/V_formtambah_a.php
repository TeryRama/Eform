<?php
if (isset($query)) {
    foreach ($query->result_array() as $row) {
        $dt_formid = $row['formid'];
        $dt_formnm = $row['formnm'];
        $dt_formkd = $row['formkd'];
        $dt_formversi = $row['formversi'];
        $dt_formefective = $row['formefective'];
        $dt_formjudul = $row['formjudul'];
        $dt_formket = $row['formket'];
        $dt_formstatus = $row['formstatus'];
        $dt_formjnsid = $row['formjnsid'];
        $dt_formkategoriid = $row['formkategoriid'];
        $dt_formkategori2id = $row['formkategori2id'];
        $dt_formkategori3id = $row['formkategori3id'];
        $dt_formkategori4id = $row['formkategori4id'];
        $dt_efective_parameter = $row['efective_parameter'];
        $dt_approval_parameter = $row['approval_parameter'];
        $dt_approval_kategori = $row['approval_kategori'];
        $dt_approval_frekuensi = $row['approval_frekuensi'];
        $dt_form_owner = $row['form_owner'];
        $dt_form_owner_dept = $row['form_owner_dept'];
        $dt_status_input = $row['status_input'];
        $dt_status_dataharian = $row['status_dataharian'];
        $dt_status_lap = $row['status_lap'];
        $dt_status_app = $row['status_app'];
    }
} else {
    $dt_formid = '';
    $dt_formnm = '';
    $dt_formkd = '';
    $dt_formversi = '';
    $dt_formefective = '';
    $dt_formjudul = '';
    $dt_formket = '';
    $dt_formstatus = '';
    $dt_formjnsid = '';
    $dt_formkategoriid = '';
    $dt_formkategori2id = '';
    $dt_formkategori3id = '';
    $dt_formkategori4id = '';
    $dt_efective_parameter = '';
    $dt_approval_parameter = '';
    $dt_approval_kategori = '';
    $dt_approval_frekuensi = '';
    $dt_form_owner = '';
    $dt_form_owner_dept = '';
    $dt_status_input = '';
    $dt_status_dataharian = '';
    $dt_status_lap = '';
    $dt_status_app = '';
}
?>

<!-- basic scripts -->
<!--tambahkan custom js disini-->
<script type="text/javascript">
    $(document).ready(function() {
        $('#formjnsid').change(function() {
            var formjnsid = $("#formjnsid").val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>index.php/master/form/C_formmenu/getFormKat",
                data: "formjnsid=" + formjnsid,
                success: function(data) {
                    $("#formkategoriid").html(data);
                }
            });
        });

        $('#formkategoriid').change(function() {
            var formkategoriid = $("#formkategoriid").val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>index.php/master/form/C_formmenu/getFormKat2",
                data: "formkategoriid=" + formkategoriid,
                success: function(data) {
                    $("#formkategori2id").html(data);
                }
            });
        });

        $('#formkategori2id').change(function() {
            var formkategori2id = $("#formkategori2id").val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>index.php/master/form/C_formmenu/getFormKat3",
                data: "formkategori2id=" + formkategori2id,
                success: function(data) {
                    $("#formkategori3id").html(data);
                }
            });
        });

        $('#formkategoriid').mousedown(function() {
            var formjnsid = $("#formjnsid").val();
            var formkategoriid = $("#formkategoriid").val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>index.php/master/form/C_formmenu/getFormKat",
                data: {
                    formjnsid: formjnsid,
                    formkategoriid: formkategoriid
                },
                success: function(data) {
                    $("#formkategoriid").html(data);
                }
            });
        });

        $('#formkategori2id').mousedown(function() {
            var formkategoriid = $("#formkategoriid").val();
            var formkategori2id = $("#formkategori2id").val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>index.php/master/form/C_formmenu/getFormKat2",
                data: {
                    formkategoriid: formkategoriid,
                    formkategori2id: formkategori2id
                },
                success: function(data) {
                    $("#formkategori2id").html(data);
                }
            });
        });

        $('#formkategori3id').mousedown(function() {
            var formkategori2id = $("#formkategori2id").val();
            var formkategori3id = $("#formkategori3id").val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>index.php/master/form/C_formmenu/getFormKat3",
                data: {
                    formkategori2id: formkategori2id,
                    formkategori3id: formkategori3id
                },
                success: function(data) {
                    $("#formkategori3id").html(data);
                }
            });
        });
        $('#formkategori4id').mousedown(function() {
            var formkategori3id = $("#formkategori3id").val();
            var formkategori4id = $("#formkategori4id").val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>index.php/master/form/C_formmenu/getFormKat4",
                data: {
                    formkategori3id: formkategori3id,
                    formkategori4id: formkategori4id
                },
                success: function(data) {
                    $("#formkategori4id").html(data);
                }
            });
        });
    });
    $(window).on('load', function() {
        $('#formkategoriid').trigger('mousedown');
        $('#formkategori2id').trigger('mousedown');
        $('#formkategori3id').trigger('mousedown');
        $('#formkategori4id').trigger('mousedown');
    });
</script>
<div class="form-group">
    <label class="col-md-5 control-label">Form Nama</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-6">
        <input type="text" name="formnm" class="form-control" placeholder="Input Nama Form" required value="<?= $dt_formnm; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label">Form Kode</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-6">
        <input type="text" name="formkd" class="form-control" placeholder="Input Kode Form" required value="<?= $dt_formkd; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label">Form Versi</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-6">
        <input type="text" name="formversi" class="form-control" placeholder="Input Versi Form" required value="<?= $dt_formversi; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label">Form Efective</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-6">
        <div class="input-group date form_date col-sm-12" data-date="" data-date-format="yyyy-mm-dd">
            <input class="form-control dttgl date" data-date-format="yyyy-mm-dd" type="text" name="formefective" id="formefective" placeholder="Input Form Efectiven" required autocomplete="off" value="<?= $dt_formefective; ?>">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label">Form Judul</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-6">
        <input type="text" name="formjudul" class="form-control" placeholder="Input Judul Form" required value="<?= $dt_formjudul; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label">Form Keterangan</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-6">
        <select name="formket" class="form-control">
            <option value="">-- Pilih --</option>
            <option value="Complete" <?= $dt_formket == 'Complete' ? "selected" : ""; ?>>Complete</option>
            <option value="In-Progress" <?= $dt_formket == 'In-Progress' ? "selected" : ""; ?>>In-Progress</option>
            <option value="Modified" <?= $dt_formket == 'Modified' ? "selected" : ""; ?>>Modified</option>
            <option value="Not Applicable" <?= $dt_formket == 'Not Applicable' ? "selected" : ""; ?>>Not Applicable</option>
            <option value="Prioritas" <?= $dt_formket == 'Prioritas' ? "selected" : ""; ?>>Prioritas</option>
            <option value="Ready" <?= $dt_formket == 'Ready' ? "selected" : ""; ?>>Ready</option>
            <option value="Trial" <?= $dt_formket == 'Trial' ? "selected" : ""; ?>>Trial</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label">Form Status</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-6">
        <select name="formstatus" class="form-control" required>
            <option value="">-- Pilih --</option>
            <option value="1" <?= $dt_formstatus == '1' ? "selected" : ""; ?>>Aktif</option>
            <option value="0" <?= $dt_formstatus == '0' ? "selected" : ""; ?>>Non Aktif</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label">Form Jenis</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-6">
        <select class="form-control" name="formjnsid" id="formjnsid" placeholder="Input Jenis Form" required>
            <?php echo '<option value="">-- Pilih --</option>';
            foreach ($jnsid as $jnsrow) { ?>
                <option value="<?= $jnsrow->submenuid; ?>" <?= $dt_formjnsid == $jnsrow->submenuid ? "selected" : ""; ?>><?= $jnsrow->submenunm; ?></option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label">Form Kategori</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-6">
        <select class="form-control" name="formkategoriid" id="formkategoriid">
            <?php echo '<option value=' . $dt_formkategoriid . '>' . $dt_formkategorinm . '</option>'; ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label">Form Kategori 2</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-6">
        <select class="form-control" name="formkategori2id" id="formkategori2id">
            <?php echo '<option value=' . $dt_formkategori2id . '>' . $dt_formkategori2nm . '</option>'; ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label">Form Kategori 3</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-6">
        <select class="form-control" name="formkategori3id" id="formkategori3id">
            <?php echo '<option value=' . $dt_formkategori3id . '>' . $dt_formkategori3nm . '</option>'; ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label">Form Kategori 4</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-6">
        <select class="form-control" name="formkategori4id" id="formkategori4id">
            <?php echo '<option value=' . $dt_formkategori4id . '>' . $dt_formkategori4nm . '</option>'; ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label">Parameter Tanggal Efektif</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-6">
        <input type="text" name="efective_parameter" class="form-control" placeholder="Parameter Tanggal Efektif" required value="<?= $dt_efective_parameter; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label">Parameter Tanggal Approval</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-6">
        <input type="text" name="approval_parameter" class="form-control" placeholder="Parameter Tanggal Approval" value="<?= $dt_approval_parameter; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label">Approval Kategori</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-6">
        <select name="approval_kategori" class="form-control">
            <option value="">-- Pilih --</option>
            <option value="SHIFT" <?= $dt_approval_kategori == 'SHIFT' ? "selected" : ""; ?>>SHIFT</option>
            <option value="NON SHIFT" <?= $dt_approval_kategori == 'NON SHIFT' ? "selected" : ""; ?>>NON SHIFT</option>
            <option value="PERSHIFT" <?= $dt_approval_kategori == 'PERSHIFT' ? "selected" : ""; ?>>PERSHIFT (OPR & KS)</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label">Approval Frekuensi</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-6">
        <select name="approval_frekuensi" class="form-control">
            <option value="">-- Pilih --</option>
            <option value="Hari" <?= $dt_approval_frekuensi == 'Hari' ? "selected" : ""; ?>>Hari</option>
            <option value="Minggu" <?= $dt_approval_frekuensi == 'Minggu' ? "selected" : ""; ?>>Minggu</option>
            <option value="Bulan" <?= $dt_approval_frekuensi == 'Bulan' ? "selected" : ""; ?>>Bulan</option>
            <option value="Tahun" <?= $dt_approval_frekuensi == 'Tahun' ? "selected" : ""; ?>>Tahun</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label">Form Owner</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-6">
        <select class="form-control" name="form_owner" id="form_owner" placeholder="Form Owner" required>
            <?php echo '<option value="">-- Pilih --</option>';
            foreach ($bagid as $bagidrow) { ?>
                <option value="<?= $bagidrow->bag_id; ?>" <?= $dt_form_owner == $bagidrow->bag_id ? "selected" : ""; ?>><?= $bagidrow->bag_nm; ?></option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label">Form Owner Departmen</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-6">
        <select class="form-control" name="form_owner_dept" id="form_owner_dept" placeholder="Form Owner" required>
            <?php echo '<option value="">-- Pilih --</option>';
            foreach ($deptid as $deptidrow) { ?>
                <option value="<?= $deptidrow->dept_id; ?>" <?= $dt_form_owner_dept == $deptidrow->dept_id ? "selected" : ""; ?>><?= $deptidrow->dept_abbr; ?></option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label">Status</label>
    <label class="col-md-1 control-label">:</label>
    <div class="col-md-3">
        <label>
            <input type="checkbox" name="status_input" <?= $dt_status_input == '1' ? "checked" : ""; ?>> Input
        </label>
    </div>
    <div class="col-md-3">
        <label>
            <input type="checkbox" name="status_dataharian" <?= $dt_status_dataharian == '1' ? "checked" : ""; ?>> Data Harian
        </label>
    </div>
</div>
<div class="form-group">
    <label class="col-md-5 control-label"></label>
    <label class="col-md-1 control-label"></label>
    <div class="col-md-3">
        <label>
            <input type="checkbox" name="status_lap" <?= $dt_status_lap == '1' ? "checked" : ""; ?>> Laporan
        </label>
    </div>
    <div class="col-md-3">
        <label>
            <input type="checkbox" name="status_app" <?= $dt_status_app == '1' ? "checked" : ""; ?>> Approval
        </label>
    </div>
</div>