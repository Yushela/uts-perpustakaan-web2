<?php

require_once 'buku.php';
class BukuReferensi extends Buku
{
    public $isbn;
    public $penerbit;

    public function __construct($id_buku, $judul, $penulis, $tahun_terbit, $status, $isbn, $penerbit)
    {
        parent::__construct($id_buku, $judul, $penulis, $tahun_terbit, $status);
        $this->isbn = $isbn;
        $this->penerbit = $penerbit;
    }
}
