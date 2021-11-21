<!-- jQuery library -->

<div class="row" id="basic-table">
    <div class="col-10 col-md-9">
        <div class="card">
            <!-- <div class="card-header">
                <h4 class="fas fa-money-bill">Pembayaran Tahunan</h4>
            </div> -->
            <div class="card-content">

                <div class="card-body">

                    <!-- Table with outer spacing -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Bulan</th>
                                    <th>Biaya Tahunan</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Metode</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = 1;
                                foreach ($pem_tahunan as $u) {
                                ?>
                                <tr>
                                    <td><?php echo $id++ ?></td>
                                    <?php
                                        if ($u->id_bulan <= 12) {
                                            $tahun = substr($u->tahun_ajaran, 0, 4);
                                        } else {
                                            $tahun = substr($u->tahun_ajaran, 0, 4);
                                        }
                                        ?>
                                    <td><?php echo $u->nama_bulan . ' ' . $tahun ?></td>
                                    <td><?php echo 'Rp. ' . number_format($u->jumlah, 0, ',', '.'); ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($u->tgl_bayar)); ?></td>
                                    <td><?php echo $u->metode_pembayaran ?></td>
                                    <td><?php echo ($u->status == '0' ? 'Lunas' : ($u->status == '1' ? 'Pending' : 'Error')) ?>
                                    </td>

                                    <td>
                                        <!-- hapus tahunan -->
                                        <?php echo anchor('bayar_ditempat/hapusTahunan/' . $u->id_transaksi . '/' . $u->id_siswa . '/' . $id_tahunan, '<input type=reset class="btn btn-outline-danger btn-sm" value=\'Hapus\'>'); ?>

                                        <!-- cetak kwitansi pembayaran tahunan -->
                                        <?php echo anchor('bayar_ditempat/kwitansiTahunan/' . $u->nis . '/' . $u->id_siswa, 'Kwitansi', array('title' => 'Cetak Kwitansi Pembayaran', 'class' => 'btn btn-outline-info btn-sm')); ?>
                                        <br>

                                        <?php
                                            #untuk cek status transaksi
                                            if ($u->status == '1' || $u->status == '2') {
                                                echo '<a href="javascript:void(0)" onclick="cekStatusTransaksi(\'' . $u->id_transaksi . '\',\'' . $u->nis . '\',\'' . $u->order_id . '\')"><input type=reset class="btn btn-warning" value=\'Cek Transaksi\'></a>';
                                            }
                                            ?>
                                    </td>
                                    <?php { ?>
                                    <td>
                                    </td>
                                    <?php } ?>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bagian Penambahan Pembayaran Biaya Tahunan -->
    <div class="col-12 col-md-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Biaya Tahunan</h4>
            </div>
            <div class="card-content">

                <?php foreach ($siswa as $u) { ?>
                <form id="form-tahunan" class="form-inline" method="post"
                    action="<?= base_url('bayar_ditempat/tambah_Tahunan/'); ?>">
                    <input name="id" class="form-control" type="text" value="<?= $user['id']; ?>" hidden>
                    <input name="id_siswa" class="form-control" type="text" value="<?php echo $u->id_siswa ?>" hidden>
                    <input name="nis" id="nis" class="form-control" type="text" value="<?php echo $u->nis ?>" hidden>
                    <input name="nama_siswa" id="nama_siswa" class="form-control" type="text"
                        value="<?php echo $u->nama ?>" hidden>
                    <input name="id_transaksi" class="form-control" type="text" value="<?php echo $id_transaksi; ?>"
                        hidden>
                    <input name="tgl_bayar" class="form-control" type="text" value="<?php echo $tgl_bayar; ?>" hidden>
                    <input name="id_tahunan" class="form-control" type="text" value="<?php echo $id_tahunan; ?>" hidden>
                    <input type="hidden" name="result_type" id="result-type" value="">
                    <input type="hidden" name="result_data" id="result-data" value="">
                    <div class="form-group col-12">
                        <label>Tahun Ajaran</label>
                        <select name="tahun_ajaran" id="tahun_ajaran" class="form-control" required>
                            <option name="besar_tahunan" id="besar_tahunan" value="">Pilih Tahun Ajaran</option>
                            <?php
                                foreach ($this->M_transaksi->tampil_datatahun()->result() as $tahun) { /*$this->m_transaksi->tampil_datatahun()->result() */
                                    #filter tahun ajaran
                                    if ($tahun->id_tahun != $thaj) continue;
                                ?>
                            <option name="besar_tahunan" id="besar_tahunan" value="<?php echo $tahun->id_tahun ?>">
                                <?php echo $tahun->tahun_ajaran . ' | Rp. ' . number_format($tahun->besar_tahunan, 0, ',', '.'); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-12 mt-3">
                        <label>Bulan</label>
                        <select class="bootstrap-select strings" title="Bulan" name="bulan[]" id="bulan"
                            data-actions-box="true" data-virtual-scroll="false" data-live-search="true" multiple
                            required>
                            <?php
                                foreach ($this->M_transaksi->tampil_databulan()->result() as $bulan) {
                                ?>
                            <option name="jumbulan" id="jumbulan" value="<?php echo $bulan->id_bulan ?>">
                                <?php echo  $bulan->nama_bulan ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-6 mt-2">
                        <label>Jumlah Total</label>
                        <td colspan="4"><b class="pull-right" name="total" id="total"
                                style="margin-right: 22%;">Rp.<?php echo number_format($this->cart->total(), 3, ',', '.'); ?></b>
                        </td>
                    </div>
                    <div class="form-group col-12">
                        <label>Metode Pembayaran</label>
                        <select id="metode-pembayaran" class="form-control" name="metode_pembayaran" required>
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="Online">Online</option>
                            <?php if ($_SESSION["role_id"] == "1") { ?>
                            <option value="Manual">Bayar Ditempat</option>
                            <?php } ?>
                        </select>
                    </div>

                    <?php if ($_SESSION["role_id"] == "1") { ?>

                    <div class="form-group col-md-5">

                        <br><br> &nbsp;<input type="submit" name="bayar" value="BAYAR" class="btn btn-primary mb-2">

                    </div>

                    &nbsp;<a href="<?= base_url('bayar_ditempat'); ?>" class="btn btn-danger mb-2"><i
                            class="fas fa-backward"> Back</i></a>

                    <?php } ?>

                </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>



<script type="text/javascript">
$(document).ready(function() {
    $('.bootstrap-select').selectpicker();

    //GET UPDATE
    $('.update-record').on('click', function() {
        var package_id = $(this).data('package_id');
        var package_name = $(this).data('package_name');
        $(".strings").val('');
        $('#UpdateModal').modal('show');
        $('[name="edit_id"]').val(package_id);
        $('[name="package_edit"]').val(package_name);

        //AJAX REQUEST TO GET SELECTED PRODUCT
        $.ajax({
            url: "<?= base_url('package/get_product_by_package'); ?>",
            method: "POST",
            data: {
                package_id: package_id
            },
            cache: false,
            success: function(data) {
                var item = data;
                var val1 = item.replace("[", "");
                var val2 = val1.replace("]", "");
                var values = val2;
                $.each(values.split(","), function(i, e) {
                    $(".strings option[value='" + e + "']").prop("selected", true)
                        .trigger('change');
                    $(".strings").selectpicker('refresh');

                });
            }

        });
        return false;
    });

    //GET CONFIRM DELETE
    $('.delete-record').on('click', function() {
        var package_id = $(this).data('package_id');
        $('#DeleteModal').modal('show');
        $('[name="delete_id"]').val(package_id);
    });

});
</script>


<!-- <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key=""></script>
<script type="text/javascript"> -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key=""></script>
<script type="text/javascript">
//S: hendi

//json ini untuk keperluan filter bulan yang sudah bayar tidak boleh muncul lg
var _tahunanrinci = <?= json_encode($pem_tahunan) ?>;
var _issubmit = false;
$(document).ready(function() {
    //$('select#tahun_ajaran').trigger("change");
    $('select#tahun_ajaran').on('change', function() {
        var _idtahun = $(this).val();
        //cari bulan berdasarkan _idtahun yang sudah bayar
        var _filterdata = $.grep(_tahunanrinci, function(element, index) {
            return element.id_tahun == _idtahun;
        });

        //kosongkan bulan
        $('select.bootstrap-select').selectpicker('val', '');
        $('select.bootstrap-select').selectpicker('refresh');
        $('select.bootstrap-select option').attr('disabled', false);
        $('select.bootstrap-select').selectpicker('refresh');
        for (var i = 0; i < _filterdata.length; i++) {
            var _bln = _filterdata[i].id_bulan;
            $('select.bootstrap-select option[value=' + _bln + ']').attr('disabled', true);
        }
        $('select.bootstrap-select').selectpicker('refresh');
        //hitung
        var _total = hitungTotalTAHUNAN();
        $('b#total').html('Rp. ' + numberFormat(_total, 0, ',', '.'));
    });

    $('select.bootstrap-select').on('change', function() {
        var _total = hitungTotalTAHUNAN();
        $('b#total').html('Rp. ' + numberFormat(_total, 3, ',', '.'));
    });

    //submit
    $("#form-tahunan").submit(function(e) {
        e.preventDefault();
        if ($('#metode-pembayaran').val() == 'Online' && _issubmit === false) {
            _issubmit = true;
            var _nis = $('#nis').val();
            var _namasiswa = $('#nama_siswa').val();
            var _bulan = $('select.bootstrap-select').val();
            var _jmltahunan = $('#tahun_ajaran option:selected').text().split('|')[1].replace('Rp. ',
                '').replace('.', '');
            var _total = hitungTotalTAHUNAN();
            //alert('a');exit;
            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>snap_tahunan/token',
                data: {
                    nis: _nis,
                    nama_siswa: _namasiswa,
                    bulan: _bulan,
                    jml_tahunan: _jmltahunan,
                    total_tahunan: _total
                },
                cache: false,
                success: function(data) {
                    console.log('token = ' + data);
                    //alert(data);exit;
                    var resultType = document.getElementById('result-type');
                    var resultData = document.getElementById('result-data');

                    function changeResult(type, data) {
                        $("#result-type").val(type);
                        $("#result-data").val(JSON.stringify(data));
                        //resultType.innerHTML = type;
                        //resultData.innerHTML = JSON.stringify(data);
                    }

                    snap.pay(data, {
                        onSuccess: function(result) {
                            changeResult('success', result);
                            console.log(result.status_message);
                            console.log(result);
                            //alert('success');
                            $("#form-tahunan").submit();
                        },
                        onPending: function(result) {
                            changeResult('pending', result);
                            console.log(result.status_message);
                            //alert('pending');
                            $("#form-tahunan").submit();
                        },
                        onError: function(result) {
                            changeResult('error', result);
                            console.log(result.status_message);
                            //alert('error');
                            $("#form-tahunan").submit();
                        }
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('status code: ' + jqXHR.status + ' errorThrown: ' + errorThrown +
                        ' responseText: ' + jqXHR.responseText);
                }
            });
        } else {
            this.submit();
        }
    });
});


//hitung total Tahunan	
function hitungTotalTAHUNAN() {
    var _selected = $('select.bootstrap-select').val();
    var _jmlbln = _selected.length;
    var _jmltahunan = $('#tahun_ajaran option:selected').text().split('|')[1].replace('Rp. ', '').replace('.', '');
    var _total = parseInt(_jmlbln) * parseInt(_jmltahunan);
    return _total;
}


//format angka
var numberFormat = function(number, decimals, dec_point, thousands_sep) {
    //  discuss at: http://phpjs.org/functions/number_format/
    // original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: davook
    // improved by: Brett Zamir (http://brett-zamir.me)
    // improved by: Brett Zamir (http://brett-zamir.me)
    // improved by: Theriault
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // bugfixed by: Michael White (http://getsprink.com)
    // bugfixed by: Benjamin Lupton
    // bugfixed by: Allan Jensen (http://www.winternet.no)
    // bugfixed by: Howard Yeend
    // bugfixed by: Diogo Resende
    // bugfixed by: Rival
    // bugfixed by: Brett Zamir (http://brett-zamir.me)
    //  revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    //  revised by: Luke Smith (http://lucassmith.name)
    //    input by: Kheang Hok Chin (http://www.distantia.ca/)
    //    input by: Jay Klehr
    //    input by: Amir Habibi (http://www.residence-mixte.com/)
    //    input by: Amirouche
    //   example 1: number_format(1234.56);
    //   returns 1: '1,235'
    //   example 2: number_format(1234.56, 2, ',', ' ');
    //   returns 2: '1 234,56'
    //   example 3: number_format(1234.5678, 2, '.', '');
    //   returns 3: '1234.57'
    //   example 4: number_format(67, 2, ',', '.');
    //   returns 4: '67,00'
    //   example 5: number_format(1000);
    //   returns 5: '1,000'
    //   example 6: number_format(67.311, 2);
    //   returns 6: '67.31'
    //   example 7: number_format(1000.55, 1);
    //   returns 7: '1,000.6'
    //   example 8: number_format(67000, 5, ',', '.');
    //   returns 8: '67.000,00000'
    //   example 9: number_format(0.9, 0);
    //   returns 9: '1'
    //  example 10: number_format('1.20', 2);
    //  returns 10: '1.20'
    //  example 11: number_format('1.20', 4);
    //  returns 11: '1.2000'
    //  example 12: number_format('1.2000', 3);
    //  returns 12: '1.200'
    //  example 13: number_format('1 000,50', 2, '.', ' ');
    //  returns 13: '100 050.00'
    //  example 14: number_format(1e-8, 8, '.', '');
    //  returns 14: '0.00000001'

    number = (number + '')
        .replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + (Math.round(n * k) / k)
                .toFixed(prec);
        };

    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
        .split('.');

    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }

    if ((s[1] || '')
        .length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1)
            .join('0');
    }

    return s.join(dec);
}

function cekStatusTransaksi(_idtransaksi, _nis, _orderid) {
    $.ajax({
        type: 'POST',
        url: '<?= base_url() ?>snap_tahunan/cekStatusTransaksi/' + _idtransaksi + '/' + _nis + '/' + _orderid,
        data: {},
        cache: false,
        success: function(result) {
            alert(result);
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('status code: ' + jqXHR.status + ' errorThrown: ' + errorThrown + ' responseText: ' +
                jqXHR.responseText);
        }
    });
}
</script>