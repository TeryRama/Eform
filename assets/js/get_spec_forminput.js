function get_spec_per_col_forminput(col_input, parameter_spec, formkode, formversi) 
{
    // $(document).on('change', col_input, function() {
        var that = $(col_input);
        var nilaiN = that.val();

        var col_up_create_date = $('#create_date');

        var up_create_date = col_up_create_date.val();

        var parameter = parameter_spec;
        var tipe_contoh = '';
        var jenis_produk = '';
        var form_kode = formkode;
        var form_versi = formversi;

        if (up_create_date.trim() != '' && nilaiN.trim() != '') {
            $.ajax({
                type: "post",
                url: window.location.origin + "/utl/index.php/tambahan/file/C_tambahan/get_spek_forminput",
                data: {
                    up_create_date: up_create_date,
                    nilaiN: nilaiN,

                    parameter: parameter,
                    tipe_contoh: tipe_contoh,
                    jenis_produk: jenis_produk,
                    form_kode: form_kode,
                    form_versi: form_versi
                },
                success: function(data) {
                    var datan = data.trim().split("//");
                    console.log('cek spek ' + parameter + ' : max = ' + datan[1] + ', min = ' + datan[2] + ',  nilai = ' + datan[3] + ', data0 = ' + datan[0]);
                    // if (datan[3] == 'mode_audit' && datan[0] == '1') {
                    //     that.val(datan[4]);
                    //     that.css({
                    //         'background-color': ''
                    //     });
                    // } else if (datan[3] == 'mode_ori' && datan[0] == '1') {
                    //     that.css({
                    //         'background-color': '#fe7e7e'
                    //     });
                    // } else {
                    //     that.css({
                    //         'background-color': ''
                    //     });
                    // }
                    if (datan[0] == '1') {
                        that.css({
                            'background-color': '#fe7e7e'
                        });
                    } else {
                        that.css({
                            'background-color': ''
                        });
                    }
                }
            });
        }
    // });
}