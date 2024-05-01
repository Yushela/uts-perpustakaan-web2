<?php

require_once 'buku.php';
class Pengguna
{
    public $id_pengguna;
    public $username;
    public $buku_dipinjam;

    public function __construct($id_pengguna, $username)
    {
        $this->id_pengguna = $id_pengguna;
        $this->username = $username;
        $this->buku_dipinjam = array();
    }

    public function getIdPengguna(){
        return $this->id_pengguna;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getBukuDipinjam(){
        return $this->buku_dipinjam;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function setBukuDipinjam($buku_dipinjam){
        $this->buku_dipinjam = $buku_dipinjam;
    }
    
    public function tambahBukuDipinjam($buku){
        $this->buku_dipinjam[] = $buku;
    }

    public function kembaliBukuDipinjam($bukuId){
        foreach($this->buku_dipinjam as $key => $buku){
            if($buku->id_buku == $bukuId){
                unset($this->buku_dipinjam[$key]);
                return true;
            }
        }
        return false;
    }

}
