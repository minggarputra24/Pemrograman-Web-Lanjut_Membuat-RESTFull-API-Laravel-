<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;

class MahasiswaController extends Controller
{
    //Fungsi index digunakan untuk menampilkan semua data mahasiswa 
    public function index(){
        $data = Mahasiswa::all();

        //Cek data tidak kosong
        if(count($data) > 0){
            $res['message'] = "Success!";
            $res['value'] = $data;
            return response($res);
        }
        //Jika data kosong
        else{
            $res['message']="Kosong!";
            return response($res);
        }
    }

    //Fungsi untuk menampilkan data dari sebuah ID
    public function getId($id){
        $data = Mahasiswa::where('id', $id)->get();

        //Cek jika data ditemukan
        if(count($data) > 0){
            $res['message'] = "Success!";
            $res['value'] = $data;
            return response($res);
        }
        //Jika data tidak ditemukan
        else{
            $res['message'] = "Gagal!";
            return response($res);
        }
    }

    //Fungsi untuk Menambah Data
    public function create(Request $request){
        $mhs = new Mahasiswa();
        $mhs->nama = $request->nama;
        $mhs->nim = $request->nim;
        $mhs->email = $request->email;
        $mhs->jurusan = $request->jurusan;

        //Jika data berhasil tersimpan
        if($mhs->save()){
            $res['message'] = "Data Berhasil Ditambahkan!";
            $res['value'] = "$mhs";
            return response($res);
        }

        //Jika data tidak lengkap diisi
        // else{
        //     $res['message'] = "Data Gagal Ditambahkan! Silahkan lengkapi Data Kembali!";
        //     return response($res);
        // }
    }

    //Fungsi Untuk Mengubah / update Data
    public function update(Request $request, $id){
        
        // $mhs = new Mahasiswa();
        $nama = $request->nama;
        $nim = $request->nim;
        $email = $request->email;
        $jurusan = $request->jurusan;

        $mhs = Mahasiswa::find($id);
        $mhs->nama = $nama;
        $mhs->nim = $nim;
        $mhs->email = $email;
        $mhs->jurusan = $jurusan;
    
        //Jika data berhasil tersimpan
        if($mhs->save()){
            $res['message'] = "Data Berhasil Diubah!";
            $res['value'] = "$mhs";
            return response($res);
        }

        else{
            $res['message'] = "Data Gagal Diubah!";
            return response($res);
        }
    }

    //Fungsi untuk menghapus Data
    public function delete($id){
        $mhs = Mahasiswa::where('id', $id);

        if($mhs->delete()){
            $res['message'] = 'Data Berhasil Dihapus!';
            return response($res);
        }
        else{
            $res['message'] = "Data Gagal Dihapus!";
            return response($res);
        }
    }
}
