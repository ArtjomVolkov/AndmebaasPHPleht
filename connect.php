<?php
$kasutaja='tarpv21'; //d113378_artjom
$server='localhost'; //d113378.mysql.zonevs.eu
$andmebaas='tarpv21'; //d113378_baasvolk
$salasyna='123456';
//teeme käsk mis ühendab andmebaasiga
$yhendus=new mysqli($server,$kasutaja,$salasyna,$andmebaas);
$yhendus->set_charset('UTF8');
/*
 * create table loomad(
    id int primary key AUTO_INCREMENT,
    loomanimi varchar(20) UNIQUE,
    vanus int,
    pilt text)
INSERT INTO loomad(loomanimi,vanus,pilt)
VALUES ('kass Fedor',11,'https://s3.webestudio.ru/topcat/cat_images/8/1/7/81737553dbb58e023692114ee8e7250d.jpg');
INSERT INTO loomad(loomanimi,vanus,pilt)
VALUES ('koer Klim',15,'https://www.rodomar.ee/pood/22821-large_default/7181-tige-koer-koikuva-peaga.jpg');
*/
?>

