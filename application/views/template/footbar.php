            </div>
            </div>
            </div>
            <!-- END: Content-->

            <!-- BEGIN: Footer-->
            <footer class="footer footer-static footer-dark navbar-shadow">
                <p class="clearfix blue-grey lighten-2 mb-0">
                    <span class="float-md-left d-block d-md-inline-block mt-25"><strong>&copy;
                            <?php $fromYear = $this->config->item("fromYear");
                            $thisYear = (int)date('Y');
                            echo $fromYear . (($fromYear != $thisYear) ? ' - ' . $thisYear : ''); ?>
                            <a href="https://sambugroup.com/" target="_blank"><?= $this->config->item("nama_perusahaan"); ?></a> All rights
                            reserved.</strong></span>
                    <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>
                </p>
            </footer>
            <!-- END: Footer-->


            <!-- BEGIN: Vendor JS-->
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/vendors.min.js">
            </script>
            <!-- BEGIN Vendor JS-->

            <!-- BEGIN: Page Vendor JS-->
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/ui/jquery.sticky.js">
            </script>
            <!-- <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/charts/apexcharts.min.js"></script> -->
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/tables/datatable/pdfmake.min.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/tables/datatable/vfs_fonts.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/tables/datatable/datatables.min.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/tables/datatable/buttons.html5.min.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/tables/datatable/buttons.print.min.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/forms/select/select2.full.min.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/pickers/pickadate/picker.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/pickers/pickadate/picker.date.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/pickers/pickadate/picker.time.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/pickers/pickadate/legacy.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/extensions/dropzone.min.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/tables/datatable/dataTables.select.min.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/extensions/dragula.min.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js">
            </script>
            <!-- END: Page Vendor JS-->

            <!-- BEGIN: Theme JS-->
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/js/core/app-menu.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/js/core/app.js"></script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/js/scripts/components.js">
            </script>
            <!-- END: Theme JS-->

            <!-- BEGIN: Page JS-->
            <!-- <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/js/scripts/pages/dashboard-ecommerce.js"></script> -->
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/js/scripts/datatables/datatable.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/js/scripts/modal/components-modal.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/js/scripts/forms/select/form-select2.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/js/scripts/ui/data-list-view.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/js/scripts/pages/app-todo.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/js/scripts/extensions/drag-drop.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/js/scripts/extensions/sweet-alerts.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/extensions/toastr.min.js">
            </script>
            <script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/js/scripts/extensions/toastr.js">
            </script>
            <script src="<?= base_url(); ?>assets/datepicker/dist/js/bootstrap-datepicker.min.js"></script>
            <script src="<?= base_url(); ?>assets/mask/dist/jquery.mask.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/New_AddRow.js"></script>
            <script src="<?= base_url(); ?>assets/js/Freeze.js"></script>
            <script src="<?= base_url(); ?>assets/js/Sticky_Header.js"></script>
            <script src="<?= base_url(); ?>assets/js/get_spec_forminput.js"></script>

            <script type="text/javascript" src="<?= base_url('assets/js/bootstrap-datetimepicker.js') ?>" charset="UTF-8"></script>

            <script src="<?php echo base_url('assets/clockpicker/dist/bootstrap-clockpicker.js') ?>" type="text/javascript"></script>
            <script src="<?php echo base_url('assets/clockpicker/dist/bootstrap-clockpicker.min.js') ?>" type="text/javascript"></script>

            <script type="text/javascript">
                $(document).on('focus', '.clockpicker', function() {
                    $(this).clockpicker();
                });
            </script>
            <!-- END: Page JS-->

            <script type="text/javascript">
                $(document).ready(function() {
                    $('.datepicker').datepicker({
                        format: 'dd-mm-yyyy',
                        todayBtn: "linked",
                        todayHighlight: 'TRUE',
                        autoclose: true,
                        orientation: "bottom",
                    });
                    $(document).on('focus', '.datepicker_row', function() {
                        $(this).datepicker({
                            format: 'dd-mm-yyyy',
                            todayBtn: "linked",
                            todayHighlight: 'TRUE',
                            autoclose: true,
                            orientation: "bottom",
                        });
                    });
                    $('.datepicker_month').datepicker({
                        language: "id",
                        format: 'mm',
                        todayBtn: "linked",
                        todayHighlight: 'TRUE',
                        autoclose: true,
                        orientation: "bottom",
                        viewMode: "months"
                    });
                    $('.datepicker_monthandyear').datepicker({
                        format: 'mm-yyyy',
                        todayBtn: "linked",
                        todayHighlight: 'TRUE',
                        autoclose: true,
                        orientation: "bottom",
                    });
                    $('.datepicker_year').datepicker({
                        format: 'yyyy',
                        todayBtn: "linked",
                        todayHighlight: 'TRUE',
                        autoclose: true,
                        orientation: "bottom",
                    });

                    $('.maskdate').mask("00-00-0000", {
                        placeholder: "dd-mm-yyyy"
                    });

                    $('.maskmonthandyear').mask("00-0000", {
                        placeholder: "mm-yyyy"
                    });

                    $('.maskmonth').mask("00", {
                        placeholder: "mm"
                    });
                    $('.maskyear').mask("0000", {
                        placeholder: "yyyy"
                    });
                    $('.masktime').mask("00:00", {
                        placeholder: "__:__"
                    });
                    $(document).on('change', '[class*=masktime]', function() {
                        if ($(this).val().trim() != '') {
                            var dtjam = $(this);
                            var jam1 = dtjam.val();
                            if (jam1.trim() != '') {
                                var patternjam = /^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;
                                var checkArray = jam1.match(patternjam);
                                if (checkArray == null) {
                                    Swal.fire(
                                        'Opps...!!',
                                        'Format Jam : 00:00 - 23:59 !!',
                                        'error'
                                    )
                                    dtjam.val('');
                                    dtjam.focus();
                                }
                            }
                        }
                    });
                });
            </script>

            <script type="text/javascript">
                // tipe 1 : success
                // tipe 2 : error

                function notif_berhasil_simpan() {
                    Swal.fire({
                        type: 'success',
                        title: 'Data Berhasil disimpan',
                        showConfirmButton: false,
                        timer: 2000,
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                    })
                }

                function notif_gagal_simpan() {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Gagal Menyimpan data!',
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                    })
                }

                function notif_flash_custom(tipe, pesan) {
                    Swal.fire({
                        type: tipe,
                        title: pesan,
                        showConfirmButton: false,
                        timer: 2000,
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                    })
                }

                function notif_btnconfirm_custom(tipe, pesan) {
                    Swal.fire({
                        type: tipe,
                        title: pesan,
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                    })
                }

                function formatDateId(date) {
                    var d = new Date(date),
                        month = '' + (d.getMonth() + 1),
                        day = '' + d.getDate(),
                        year = d.getFullYear();

                    if (month.length < 2)
                        month = '0' + month;
                    if (day.length < 2)
                        day = '0' + day;

                    return [day, month, year].join('-');
                }
                function zeroPad(num, places) {
                    var zero = places - num.toString().length + 1;
                    return Array(+(zero > 0 && zero)).join("0") + num;
                }
            </script>