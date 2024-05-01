<?php

class Perpustakaan
{
    public $koleksiBuku = [];
    public $bukuDipinjam = [];
    public $dataPengguna = [];

    public function tambahBuku($buku){
        $this->koleksiBuku[] = $buku;
    }

    public function tambahPengguna($pengguna){
        array_push($this->dataPengguna, $pengguna);
    }

    public function pinjamBuku($id_pengguna, $id_buku, $tanggal_pinjam, $lama_pinjam){
        foreach($this->dataPengguna as $pengguna){
            if($pengguna->getIdPengguna() == $id_pengguna){
                foreach($this->koleksiBuku as $buku){
                    if($buku->getIdBuku() == $id_buku){
                        $pengguna->tambahBukuDipinjam($buku);
                        $this->bukuDipinjam[] = array(
                            'id_pengguna' => $id_pengguna,
                            'id_buku' => $id_buku,
                            'tanggal_pinjam' => $tanggal_pinjam,
                            'lama_pinjam' => $lama_pinjam,
                        );
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function kembalikanBuku($id_pengguna, $id_buku, $tanggal_pengembalian){
        foreach($this->bukuDipinjam as $key => $bukuPinjam){
            if($bukuPinjam['id_pengguna'] == $id_pengguna && $bukuPinjam['id_buku'] == $id_buku){
                foreach($this->dataPengguna as $pengguna){
                    if($pengguna->getIdPengguna() == $id_pengguna){
                        if ($pengguna->getIdPengguna() == $id_pengguna){
                            $pengguna->kembaliBukuDipinjam($id_buku);
                        }
                        
                        unset($this->bukuDipinjam[$key]);

                        $lamaPinjam = strtotime($bukuPinjam["lama_pinjam"]);
                        $tanggalKembali = strtotime($tanggal_pengembalian);
                        $selisih = max(0 , ceil(($tanggalKembali - $lamaPinjam) / (60 * 60 * 24)));
                        $denda = $selisih * 1000;

                        return $denda;
                    }
                }
                return false;
            }
        }
    }

    public function cariBuku($katakunci){
        $hasilCari = [];
        foreach($this->koleksiBuku as $buku){
            if(stripos($buku->judul, $katakunci) !== false || stripos($buku->penulis, $katakunci) !== false){
                $hasilCari[] = $buku;
            }
        }
        return $hasilCari;
    }
}
