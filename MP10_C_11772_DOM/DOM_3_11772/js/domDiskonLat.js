var totalNode;
var hematNode;

function init() {
    totalNode = document.getElementById("totalBayar").firstChild;
    hematNode = document.getElementById("infoHemat").firstChild;

    hitungTotal();
}

function hitungTotal() {

    var harga = parseFloat(document.getElementById("harga").value);
    var diskon = parseFloat(document.getElementById("diskon").value);

    if (isNaN(diskon) || !isFinite(diskon) || diskon < 0 || diskon > 100) {

        totalNode.data = "Diskon tidak valid!";
        totalNode.parentNode.style.color = "red";

        hematNode.data = "0";

    } else {

        var potongan = harga * (diskon / 100);
        var akhir = harga - potongan;

        totalNode.data = akhir;
        totalNode.parentNode.style.color = "green";

        hematNode.data = potongan;
    }
}
