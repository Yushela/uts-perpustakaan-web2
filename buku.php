<?php
class Buku
{
    public $id_buku;
    public $judul;
    public $penulis;
    public $tahun_terbit;
    public $status = false;

    public function __construct($id_buku, $judul, $penulis, $tahun_terbit, $status)
    {
        $this->id_buku = $id_buku;
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->tahun_terbit = $tahun_terbit;
        $this->status = $status;
    }

    public function getIdBuku(){
        return $this->id_buku;
    }
    public function getJudul(){
        return $this->judul;
    }

    public function getPenulis(){
        return $this->penulis;
    }

    public function getTahunTerbit(){
        return $this->tahun_terbit;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setIdBuku($id_buku){
        $this->id_buku = $id_buku;
    }

    public function setJudul($judul){
        $this->judul = $judul;
    }

    public function setPenulis($penulis){
        $this->penulis = $penulis;
    }

    public function setTahunTerbit($tahun_terbit){
        $this->tahun_terbit = $tahun_terbit;
    }

    public function setStatus($status){
        $this->status = $status;
    }
    
}
