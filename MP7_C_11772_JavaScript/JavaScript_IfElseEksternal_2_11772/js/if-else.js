var iHari;
var sAnggota;
iHari = prompt("masukkan jumlah hari keterlambatan.", 1);
sAnggota = prompt("Anggota perpustakan? (Y)a atau (T)idak.", "Y");

if (iHari > 7) {
    if (sAnggota == "Y") {
        alert("Denda Rp 10.000, peminjaman dibekukan");
    } else {
        alert("Denda Rp 20.000, peminjaman dibekukan");
    }
} else {
    if (sAnggota == "Y") {
        alert("Denda Rp 2.000");
    } else {
        alert("Denda Rp 5.000");
    }
}