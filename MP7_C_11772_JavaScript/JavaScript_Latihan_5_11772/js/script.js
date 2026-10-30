
function fn_ValForm() {

    var nama = document.getElementById("nama").value.trim();
    var email = document.getElementById("email").value.trim();
    var umur = document.getElementById("umur").value.trim();
    var kategori = document.getElementById("kategori").value;

    var error = [];

    if (nama === "") {
        error.push("Nama tidak boleh kosong!");
    }

    var polaEmail = /^[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9]@[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9]\.[a-z0-9]{2,4}$/;

    if (email === "") {
        error.push("Email tidak boleh kosong!");
    } else if (!polaEmail.test(email)) {
        error.push("Format email tidak valid! Gunakan huruf kecil.");
    }

    if (umur === "") {
        error.push("Umur tidak boleh kosong!");
    } else if (!/^[0-9]+$/.test(umur)) {
        error.push("Umur harus berupa angka!");
    } else if (Number(umur) < 7 || Number(umur) > 70) {
        error.push("Umur harus antara 7 sampai 70 tahun!");
    }

   
    if (kategori === "") {
        error.push("Koleksi favorit harus dipilih!");
    }

    
    if (error.length > 0) {
        alert(error.join("\n"));
        return false;
    }

    
    var info;

    if (Number(umur) <= 17) {
        info = "Anggota Pelajar";
    } else {
        info = "Anggota Umum";
    }

   
    var pilihan;

    switch (kategori) {
        case "F":
            pilihan = "Fiksi";
            break;

        case "N":
            pilihan = "Non-Fiksi";
            break;

        case "J":
            pilihan = "Jurnal Ilmiah";
            break;

        default:
            pilihan = "Tidak diketahui";
    }

    alert(
        "Terima kasih " + nama +
        "! Anda terdaftar di koleksi " +
        pilihan + " (" + info + ")."
    );

    return true;
}
