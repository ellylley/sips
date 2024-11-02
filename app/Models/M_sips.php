<?php

namespace App\Models;
use CodeIgniter\Model;

Class M_sips extends Model
{
  public function tampil($tabel,$id){
    return $this->db->table($tabel)
                    ->orderby ($id,'desc') 
                    ->get()
                    ->getResult();
  } 
  public function join($tabel, $tabel2, $on, $id){
    return $this->db->table($tabel)
                    ->join($tabel2,$on,'left')
                    ->orderby ($id,'desc') 
                    ->get()
                    ->getResult();
                    
  }

  public function join2($tabel, $tabel2, $on, $id){
    return $this->db->table($tabel)
                    ->select('*, user.id_kelas as id_kelas_user, kelas.id_kelas as id_kelas_kelas')
                    ->join($tabel2,$on,'left')
                    ->orderby ($id,'desc') 
                    ->get()
                    ->getResult();
                    
  }

  public function join3($tabel, $tabel2, $on, $id, $where = []){
    $query = $this->db->table($tabel)
                      ->select('*, user.id_kelas as id_kelas_user, kelas.id_kelas as id_kelas_kelas')
                      ->join($tabel2, $on, 'left')
                      ->where($where) // Tambahan where
                      ->orderby($id, 'desc')
                      ->get()
                      ->getResult();
                      
    return $query;
}


public function join4($tabel, $tabel2, $on, $id, $where = []){
  $query = $this->db->table($tabel)
                    ->select('*, user.id_user as id_user, kelas.id_user as id_wali')
                    ->join($tabel2, $on, 'left')
                    ->where($where) // Tambahan where
                    ->orderby($id, 'desc')
                    ->get()
                    ->getResult();
                    
  return $query;
}

public function searchActivityLogs($id_user = null, $nama_user = null, $activity = null, $timestamp = null)
{
    $builder = $this->db->table('activity_log')
                        ->join('user', 'user.id_user = activity_log.id_user');

    if ($id_user) {
        $builder->like('activity_log.id_user', $id_user);
    }
    if ($nama_user) {
        $builder->like('user.nama_user', $nama_user);
    }
    if ($activity) {
        $builder->like('activity_log.activity', $activity);
    }
    if ($timestamp) {
        $builder->like('activity_log.timestamp', $timestamp);
    }

    $builder->orderBy('activity_log.timestamp', 'DESC');

    return $builder->get()->getResult();
}

  
 
// Di dalam M_projek2.php
public function getBackupUser($id_user)
{
    return $this->db->table('backup_user')->where('id_user', $id_user)->get()->getRow();
}
public function getBackupKelas($id_kelas)
{
    return $this->db->table('backup_kelas')->where('id_kelas', $id_kelas)->get()->getRow();
}
public function getBackupPengumuman($id_pengumuman)
{
    return $this->db->table('backup_pengumuman')->where('id_pengumuman', $id_pengumuman)->get()->getRow();
}

  public function joinkondisi($tabel, $tabel2, $on, $id, $where = [])
{
    $builder = $this->db->table($tabel)
                        ->join($tabel2, $on, 'left')
                        ->orderby($id, 'desc');

    // Jika ada kondisi where, tambahkan ke query
    if (!empty($where)) {
        $builder->where($where);
    }

    return $builder->get()->getResult();
}
public function joinkondisi3($tabel, $tabel2, $tabel3, $on,$on2, $id, $where = [])
{
    $builder = $this->db->table($tabel)
                        ->join($tabel2, $on, 'left')
                        ->join($tabel3, $on2, 'left')
                        ->orderby($id, 'desc');

    // Jika ada kondisi where, tambahkan ke query
    if (!empty($where)) {
        $builder->where($where);
    }

    return $builder->get()->getResult();
}

  public function joinWhereresult($tabel, $tabel2, $on, $where){
    return $this->db->table($tabel)
            ->join($tabel2, $on, 'left')
            ->where($where)
            ->get()
            ->getResult(); // Mengembalikan array objek
}
 


  public function getUserById2($id_user) {
    $this->db->where('id_user', $id_user);
    $query = $this->db->get('user'); // Sesuaikan dengan nama tabel
    return $query->row();
}
   public function joinempat($tabel, $tabel2, $tabel3, $tabel4, $on, $on2, $on3, $id){
     return $this->db->table($tabel)
                    ->join($tabel2, $on,'left')
                    ->join($tabel3, $on2,'left')
                    ->join($tabel4, $on3,'left')
                    ->orderby($id,'desc')
                    ->get()
                    ->getResult();
}

public function jointiga($tabel, $tabel2, $tabel3, $on, $on2, $id){
     return $this->db->table($tabel)
                    ->join($tabel2, $on,'left')
                    ->join($tabel3, $on2,'left')
                    ->orderby($id,'desc')
                    ->get()
                    ->getResult();
}  
    public function joinWhere($tabel, $tabel2, $on, $where){
    return $this->db->table($tabel)
            ->join($tabel2,$on,'left')
            ->getWhere($where)
            ->getRow();
  }
  public function joinWherebaru($tabel, $tabel2, $on, $where) {
    return $this->db->table($tabel)
            ->join($tabel2, $on, 'left')
            ->where($where)
            ->get()
            ->getResult(); // Mengambil banyak hasil
}
  public function getWhere($tabel,$where){
    return $this->db->table($tabel)
             ->getWhere($where)
             ->getRow();
             
}


public function getWhereres($tabel, $where)
{
    $query = $this->db->table($tabel)->getWhere($where);
    // Cek jika hasil query tidak false atau tidak null
    if ($query && $query->getNumRows() > 0) {
        return $query->getResult();  // Mengembalikan hasil jika ada
    }
    return [];  // Kembalikan array kosong jika query gagal atau tidak ada hasil
}

public function tambahBatch($table, $data)
{
    return $this->db->table($table)->insertBatch($data);
}
public function cari($tabel,$tabel2, $on, $awal, $akhir, $field){
    return $this->db->table($tabel)
            ->join($tabel2,$on,'left')
            ->getWhere("tgl_pesanan between '$awal' and '$akhir'")
            ->getResult();
}

public function carik($tabel,$tabel2, $on, $awal, $akhir, $field){
    return $this->db->table($tabel)
            ->join($tabel2,$on,'left')
            ->getWhere("tanggal_k between '$awal' and '$akhir'")
            ->getResult();
}

public function caritiga($tabel,$tabel2,$tabel3, $on, $on2, $awal, $akhir, $field){
    return $this->db->table($tabel)
            ->join($tabel2,$on,'left')
            ->join($tabel3, $on2,'left')
            ->getWhere("tgl_pesanan between '$awal' and '$akhir'")
            // ->getWhere($field. "between '$awal' and '$akhir'")
  // return $this->db->query ("select*from brg_msk join barang on brg_msk.id_brg=barang.id_brg")
                    ->getResult();
}

  public function upload($photo){
    
        $imageName = $photo->getName();
        $photo->move(ROOTPATH .'public/images', $imageName);
    }  

public function joinn($tabel, $tabel2, $tabel3,$tabel4, $on, $on2,$on3, $id, $where){
 return $this->db->table($tabel)
 ->join($tabel2, $on,'left')
 ->join($tabel3, $on2,'left')
 ->join($tabel4, $on3,'left')
 ->orderby($id,'desc')
 ->getWhere($where)
 ->getResult();
 
}
public function jointigawhere($tabel, $tabel2, $tabel3, $on, $on2, $id, $where){
     return $this->db->table($tabel)
                    ->join($tabel2, $on,'left')
                    ->join($tabel3, $on2,'left')
                    ->orderby($id,'desc')
                    ->getWhere($where)
                    ->getResult();
}
public function joinempatwhere($tabel, $tabel2, $tabel3, $tabel4, $on, $on2, $on3, $id, $where){
  return $this->db->table($tabel)
                 ->join($tabel2, $on,'left')
                 ->join($tabel3, $on2,'left')
                 ->join($tabel4, $on3,'left')
                 ->orderby($id,'desc')
                 ->getWhere($where)
                 ->getResult();
}
public function joinduawhere($tabel, $tabel2, $on, $id, $where){
     return $this->db->table($tabel)
                    ->join($tabel2, $on,'left')
                    ->orderby($id,'desc')
                    ->getWhere($where)
                    ->getResult();
}
public function getWherecon($table, $conditions)
{
    return $this->db->table($table)->where($conditions)->get()->getResult();
}

public function getPassword($userId)
{
  return $this->db->table('user')
                        ->select('password')
                        ->where('id_user', $userId)
                        ->get()
                        ->getRow()
                        ->password;

}



  
  public function tambah($tabel, $isi){
    return $this->db->table($tabel)
                    ->insert($isi);
  }
  public function edit($tabel, $isi, $where){
    return $this->db->table($tabel)
                    ->update($isi,$where);
  }
  
  public function hapus($tabel, $where){
    return $this->db->table($tabel)
                    ->delete($where);
                    
  }
  public function getLastOrderNumber($tanggal)
{
    // Query untuk mendapatkan nomor urut terakhir pada hari tertentu
    $query = $this->db->table('pesanan')
                      ->select('kode_pesanan')
                      ->like('kode_pesanan', $tanggal, 'after')
                      ->orderBy('kode_pesanan', 'DESC')
                      ->get()
                      ->getRow();

    if ($query) {
        // Ambil 3 digit terakhir dari kode_pesanan
        return (int)substr($query->kode_pesanan, -3);
    } else {
        // Jika tidak ada pesanan pada hari tersebut, kembalikan 0
        return 0;
    }
}




public function getActivityLogs()
{
    return $this->db->table('activity_log')
                    ->join('user', 'activity_log.id_user = user.id_user', 'left')
                    ->select('activity_log.*, user.nama_user')
                    ->orderBy('activity_log.timestamp', 'DESC')
                    ->get()
                    ->getResult();
}


public function carilaporan($tabel, $tabel2, $on, $awal, $akhir, $field)
{
    return $this->db->table($tabel)
        ->join($tabel2, $on, 'left')
        ->where("{$field} >=", $awal)
        ->where("{$field} <=", $akhir)
        ->where('pesanan.isdelete', 0) // Pastikan filter ini hanya berlaku jika diperlukan
        ->get()
        ->getResult();
}
public function getKelasById($id)
{
    return $this->db->table('kelas')->where('id_kelas', $id)->get()->getRow();
}
public function getPengumumanById($id)
{
    return $this->db->table('pengumuman')->where('id_pengumuman', $id)->get()->getRow();
}


public function getUserById($id)
{
    return $this->db->table('user')->where('id_user', $id)->get()->getRow();
}




}