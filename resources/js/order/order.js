 document.addEventListener("DOMContentLoaded", function() {
        const hargaList = {
            0: 14000, 4: 16500, 6: 18000, 
            8: 19500, 10: 21000, 12: 22500, 
            14: 24000, 16: 25500, 18: 27000,
            20: 28500, 22: 30000, 24: 31500,
            26: 33000, 28: 34500, 30: 36000
        };

        function formatRupiah(angka) {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0
            }).format(angka);
        }

        function hitungTotal() {
            let jumlahIsi = parseInt(document.getElementById("jumlah_plastik").value) || 0;
            let jumlahPcs = parseInt(document.getElementById("jumlah_pcs").value) || 0;
            let hargaPerPlastik = hargaList[jumlahIsi] || 0;
            let totalHarga = hargaPerPlastik * jumlahPcs;
            document.getElementById("total_harga").value = formatRupiah(totalHarga);
        }

        document.getElementById("jumlah_plastik").addEventListener("change", hitungTotal);
        document.getElementById("jumlah_pcs").addEventListener("input", hitungTotal);
    });