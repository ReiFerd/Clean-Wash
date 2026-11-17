// Hitung total biaya laundry otomatis (jQuery)
$(function () {
    function rupiah(angka) {
        return 'Rp ' + Math.round(angka).toLocaleString('id-ID');
    }

    function hitungTotal() {
        var harga = parseFloat($('#id_layanan option:selected').data('harga')) || 0;
        var berat = parseFloat(String($('#berat_cucian').val()).replace(',', '.')) || 0;

        $('#harga_per_kg').text(rupiah(harga));
        $('#total_biaya').text(rupiah(harga * berat));
    }

    $('#id_layanan').on('change', hitungTotal);
    $('#berat_cucian').on('input keyup change', hitungTotal);
    hitungTotal();
});