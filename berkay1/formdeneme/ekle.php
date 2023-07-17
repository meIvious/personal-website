<?php 
include("vt.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz. 
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Veritabanı İşlemleri</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<script>
function meşaz(){
    alert("Veri Eklendi")
}
function sil()
{
alert("Veri Silindi")
}
</script>
<div class="container">
<div class="col-md-6">
<form action="" method="post">
    
    <table class="table">
        <h4>Basit Kayıt Gönderme-Veritabanı Kaydı</h4>
        <tr>
            <td>Ad-Soyad</td>
            <td><input type="text" name="baslik" class="form-control" ></td>
        </tr>

        <tr>
            <td>E-mail</td>
            <td><input type="text" name="icerik" class="form-control" ></td>
        </tr>
		<tr>
           <tr>
            <td>Tel no</td>
            <td><input type="text" name="tel" class="form-control" ></td>
        </tr>
		<tr>
		 <tr>
            <td>Mesaj</td>
            <td><textarea name="mesaj"  cols="30" rows="7" class="form-control" placeholder=""></textarea></td>
        </tr>
		<tr>
            <td></td>
            <td><input class="btn btn-success" onclick="meşaz()"  type="submit" value="Ekle"></td>
        </tr>

    </table>

</form>

<!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->

<?php 

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

    // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
    $baslik = $_POST['baslik']; 
    $icerik = $_POST['icerik'];
	$tel = $_POST['tel'];
	$mesaj = $_POST['mesaj'];

    if ($baslik<>"" && $icerik<>"" && $tel<>""  && $mesaj<>""  ) { 
    // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.
        
         // Veri ekleme sorgumuzu yazıyoruz.
        if ($baglanti->query("INSERT INTO makale (baslik, icerik,tel,mesaj) VALUES ('$baslik','$icerik','$tel','$mesaj')")) 
        {
            echo "Veri Eklendi"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
        }
 
        else
        {
            echo "Hata oluştu";
        }

    }

}

?>
</div>
<!-- ############################################################## -->

<!-- Veritabanına eklenmiş verileri sıralamak için önce üst kısmı hazırlayalım. -->
<div class="col-md-7">
<table class="table">
    
    <tr>
        <th>#</th>
        <th>Ad-Soyad</th>
        <th>E-mail</th>
		<th>Tel no</th>
		<th>Mesaj</th>
    </tr>

<!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

<?php 

$sorgu = $baglanti->query("SELECT * FROM makale"); // Makale tablosundaki tüm verileri çekiyoruz.

while ($sonuc = $sorgu->fetch_assoc()) { 

$id = $sonuc['id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
$baslik = $sonuc['baslik'];
$icerik = $sonuc['icerik'];
$tel = $sonuc['tel'];
$mesaj = $sonuc['mesaj'];



// While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz. 
?>
    
    <tr>
        <td><?php echo $id; // Yukarıda tanıttığımız gibi alanları dolduruyoruz. ?></td>
        <td><?php echo $baslik; ?></td>
        <td><?php echo $icerik; ?></td>
		<td><?php echo $tel; ?></td>
		<td><?php echo $mesaj; ?></td>
        <td><a href="duzenle.php?id=<?php echo $id; ?>" class="btn btn-primary">Düzenle</a></td>
        <td><a href="sil.php?id=<?php echo $id; ?>" class="btn btn-danger" onclick="sil()">Sil</a></td>
    </tr>

<?php 
} 
// Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz. 
?>

</table>
</div>
</div>
</body>
</html>