<?php
class Animal {
    private $nama;
    private $jenis;

    public function __construct($nama, $jenis) {
    $this->nama = $nama;
    $this->jenis = $jenis;
    }

    public function getInfo() {
    return "Nama hewan: " . $this->nama . "\nJenis hewan: " . $this->jenis;
    }
}

$kucing = new Animal("Kucing", "Mamalia");

echo $kucing->getInfo();


$dog = new Animal("anjing","Mamalia");
echo $dog->getInfo();