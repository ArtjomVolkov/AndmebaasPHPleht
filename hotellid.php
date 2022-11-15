<?php
require_once ('connect.php');
global $yhendus;
if (isset($_REQUEST["lisamisvorm"]) && !empty($_REQUEST['nimi'])){
    $paring=$yhendus->prepare("INSERT INTO hotellid(hotelliNimi,maksInimesteArv,aadress,kasumlikkusKuus,pilt) VALUES (?,?,?,?,?)");
    $paring->bind_param('sisis',$_REQUEST['nimi'],$_REQUEST['inimesteArv'],$_REQUEST['aadress'],$_REQUEST['kasumlikkusKuus'],$_REQUEST['pilt']);
    //"s" - string,$_REQUEST['nimi'] - tekstkasti nimega nimi
    //sdi, s - stirng, d- double, i - integer
    $paring->execute();
}
if (isset($_REQUEST["kustuta"])){
    $paring=$yhendus->prepare("DELETE FROM hotellid WHERE hotellidID=?");
    $paring->bind_param('i',$_REQUEST["kustuta"]);
    $paring->execute();
}
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Hotellid</title>
    <link href="hotelli.css" rel="stylesheet" />
</head>
<body>
<h1>Hotellid</h1>
<div id="meny">
    <ul>
        <?php
        //näitab loomade loetelu tabelist loomad
        $paring=$yhendus->prepare("SELECT hotellidID,hotelliNimi FROM hotellid");
        $paring->bind_result($id,$nimi);
        $paring->execute();
        while($paring->fetch()) {
            echo "<li><a href='?id=$id'>$nimi</a></li>";
        }
        echo "</ul>";
        echo "<a href='?lisahotell=jah'>Lisa hotell</a>";
        echo "<br><a href='https://github.com/'>GitHub</a>";
        ?>
</div>
<div id="sisu">
    <?php
    if (isset($_REQUEST["id"])){
        $paring=$yhendus->prepare("SELECT hotelliNimi,maksInimesteArv,aadress,kasumlikkusKuus,pilt FROM hotellid WHERE hotellidID=?");
        $paring->bind_param('i',$_REQUEST["id"]);
        //? küsimärki asemel aadressiribalt tuleb id
        $paring->bind_result($nimi,$inim,$aadress,$kasum,$pilt);
        $paring->execute();
        if ($paring->fetch()){
            echo "<div><h2>".htmlspecialchars($nimi)."</h2>";
            echo "<br><strong>maksInimeste:</strong> ".htmlspecialchars($inim).",";
            echo "<br><strong>Address:</strong> ".htmlspecialchars($aadress).",";
            echo "<br><strong>KasumlikkusKuus:</strong> ".htmlspecialchars($kasum);
            echo "<br><img src='$pilt' alt='pilt' width='300px' height='150px'>";
            echo "<br><a href='?kustuta=".$_REQUEST["id"]."'>Kustuta hotell<a/>";
            echo "</div>";
        }
    }
    else{
        echo"<h3>Siia tuleb hotelli info..</h3>";
    }
    if(isset($_REQUEST["lisahotell"])){
        ?>
        <h2>Uue hotelli lisamine</h2>
        <form name="uushotell" method="post" action="?">
            <input type="hidden" name="lisamisvorm" value="jah">
            <input type="text" name="nimi" placeholder="Hotelli nimi">
            <input type="number" name="inimesteArv" max="50000" placeholder="MaksInimesteArv">
            <input type="text" name="aadress" placeholder="Aadress hotelli">
            <input type="number" name="kasumlikkusKuus" max="1000000" placeholder="kasumlikkusKuus">
            <textarea name="pilt" placeholder="Siia lisa pildi aadress"></textarea>
            <input type="submit" value="OK">
        </form>
        <?php
    }
    $yhendus->close();
    ?>
</div>
</body>
</html>
