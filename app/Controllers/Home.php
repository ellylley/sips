<?php

namespace App\Controllers;

use Codeigniter\Controllers;
use App\models\M_sips;
use CodeIgniter\Session\Session;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\LevelPermissionModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use CURLFile;
// Tambahkan namespace Twilio di bagian atas file PHP Anda
use Twilio\Rest\Client;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('level')>0){
            $model= new M_sips();
            $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman dashboard'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       
            $where=array(
                'id_setting'=> 1
              );
              $data['setting'] = $model->getWhere('setting',$where);
        echo view('header', $data);
        echo view('menu', $data);
        echo view('dashboard', $data);
        echo view('footer');
    }else{
        return redirect()->to('home/login');
 
    } 
    }

    public function login()
    {
        $model= new M_sips();
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
        echo view('header', $data);
        echo view('login', $data);

} 
public function aksilogin()
{
    $name = $this->request->getPost('nama');
    $pw = $this->request->getPost('password');
    $captchaResponse = $this->request->getPost('g-recaptcha-response');
    $backupCaptcha = $this->request->getPost('backup_captcha');
    
    $secretKey = '6LdLhiAqAAAAAPxNXDyusM1UOxZZkC_BLCgfyoQf'; // Ganti dengan secret key Anda yang sebenarnya
    $recaptchaSuccess = false;

    $captchaModel = new M_sips();

    // Cek koneksi internet
    if ($this->isInternetAvailable()) {
        // Verifikasi reCAPTCHA
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captchaResponse");
        $responseKeys = json_decode($response, true);
        $recaptchaSuccess = $responseKeys["success"];
    }
    
    if ($recaptchaSuccess) {
        // reCAPTCHA berhasil
        $where = [
            'nama_user' => $name,
            'password' => md5($pw),
        ];

        $model = new M_sips();
        $check = $model->getWhere('user', $where);

        if ($check) {
            session()->set('id', $check->id_user);
            session()->set('nama', $check->nama_user);
            session()->set('level', $check->level);
            session()->set('foto', $check->foto);
            session()->set('id_kelas', $check->id_kelas);
            session()->set('editmodul', $check->editmodul);
            return redirect()->to('home');
        } else {
            return redirect()->to('home/login')->with('error', 'Invalid username or password.');
        }
    } else {
        // Validasi CAPTCHA offline
        $storedCaptcha = session()->get('captcha_code'); // Retrieve stored CAPTCHA from session
        
        if ($storedCaptcha !== null) {
            if ($storedCaptcha === $backupCaptcha) {
                // CAPTCHA valid
                $where = [
                    'nama_user' => $name,
                    'password' => md5($pw),
                ];

                $model = new M_sips();
                $check = $model->getWhere('user', $where);

                if ($check) {
                    session()->set('id', $check->id_user);
                    session()->set('nama', $check->nama_user);
                    session()->set('level', $check->level);
                    session()->set('foto', $check->foto);
                    session()->set('id_kelas', $check->id_kelas);
                    session()->set('editmodul', $check->editmodul);

                    return redirect()->to('home');
                } else {
                    return redirect()->to('home/login')->with('error', 'Invalid username or password.');
                }
            } else {
                // CAPTCHA tidak valid
                return redirect()->to('home/login')->with('error', 'Invalid CAPTCHA.');
            }
        } else {
            return redirect()->to('home/login')->with('error', 'CAPTCHA session is not set.');
        }
    }
}




    public function generateCaptcha()
{
    $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

    // Store the CAPTCHA code in the session
    session()->set('captcha_code', $code);

    // Generate the image
    $image = imagecreatetruecolor(120, 40);
    $bgColor = imagecolorallocate($image, 255, 255, 255);
    $textColor = imagecolorallocate($image, 0, 0, 0);

    imagefilledrectangle($image, 0, 0, 120, 40, $bgColor);
    imagestring($image, 5, 10, 10, $code, $textColor);

    // Set the content type header - in this case image/png
    header('Content-Type: image/png');

    // Output the image
    imagepng($image);

    // Free up memory
    imagedestroy($image);
}

private function isInternetAvailable()
{
    $connected = @fsockopen("www.google.com", 80);
    if ($connected) {
        fclose($connected);
        return true;
    }
    return false;
}

public function logout()
        {
           session()->destroy();
            return redirect()->to('Home/login');
    

}

//log

public function log() 
{
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_sips();

        // Menambahkan log aktivitas ketika user mengakses halaman log
        $id_user = session()->get('id');
        $activity = 'Mengakses halaman log aktivitas';
        $this->addLog($id_user, $activity);
        
        // Ambil data pencarian dari input GET
        $id_user_search = $this->request->getGet('id_user');
        $nama_user_search = $this->request->getGet('nama_user');
        $activity_search = $this->request->getGet('activity');
        $timestamp_search = $this->request->getGet('timestamp');

        // Mengambil data log aktivitas dengan filter
        $data['logs'] = $model->searchActivityLogs($id_user_search, $nama_user_search, $activity_search, $timestamp_search);
        
        // Menambahkan data pencarian ke array data
        $data['id_user'] = $id_user_search;
        $data['nama_user'] = $nama_user_search;
        $data['activity'] = $activity_search;
        $data['timestamp'] = $timestamp_search;

        // Ambil setting seperti biasa
        $where = array('id_setting' => 1);
        $data['setting'] = $model->getWhere('setting', $where);

        $data['currentMenu'] = 'log';
        echo view('header', $data);
        echo view('menu', $data);
        echo view('log', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    }
}


    public function addLog($id_user, $activity)
{
    $model = new M_sips(); // Gunakan model M_kedaikopi
    $id_user = session()->get('id');
    $data = [
        'id_user' => $id_user,
        'activity' => $activity,
        'timestamp' => date('Y-m-d H:i:s'),
    ];
    $model->tambah('activity_log', $data); // Pastikan 'activity_log' adalah nama tabel yang benar
}


//setting

public function setting()
{
    // Memeriksa level akses user
    if (session()->get('level') == 0||session()->get('level') == 1 ) {
      
        $model = new M_sips();
        
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman setting'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       

    
        $id = 1; // id_toko yang diinginkan

        // Menyusun kondisi untuk query
        $where = array('id_setting' => $id);

        // Mengambil data dari tabel 'toko' berdasarkan kondisi
        $data['user'] = $model->getWhere('setting', $where);
 
        // Memuat view
        $where=array(
          'id_setting'=> 1
        );
        $data['setting'] = $model->getWhere('setting',$where);
        $data['currentMenu'] = 'setting'; 
        echo view('header', $data);
        echo view('menu', $data);
        echo view('setting', $data);
        echo view('footer', $data);
    } else {
        return redirect()->to('home/error');
    } 
}

public function aksisetting()
{
    $model = new M_sips();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah data setting'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
      
    
       
    $nama = $this->request->getPost('nama');
    $alamat = $this->request->getPost('alamat');
    $nohp = $this->request->getPost('nohp');
    $sekolah = $this->request->getPost('sekolah');
    $id = $this->request->getPost('id');
    $uploadedFile = $this->request->getFile('foto');

    $where = array('id_setting' => $id);

    $isi = array(
        'nama_setting' => $nama,
        'alamat' => $alamat,
        'nohp' => $nohp,
        'nama_sekolah'=> $sekolah,
        'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    );

    // Cek apakah ada file yang diupload
    if ($uploadedFile && $uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
        $foto = $uploadedFile->getName();
        $model->upload($uploadedFile); // Mengupload file baru
        $isi['logo'] = $foto; // Menambahkan nama file baru ke array data
    }

    $model->edit('setting', $isi, $where);

    return redirect()->to('home/setting/'.$id);
}


//profile

public function profile($id)
{
    if (session()->get('level') == 0||session()->get('level') == 1||session()->get('level') == 2||session()->get('level') == 3||session()->get('level') == 4||session()->get('level') == 5||session()->get('level') == 6||session()->get('level') == 7  ) {
        $model = new M_sips();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman profile'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        
        $where= array('user.id_user'=>$id);
        $where=array('id_user'=>session()->get('id'));
        
        $data['user']=$model->getWhere('user',$where);
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);

        echo view('header',$data);
        echo view ('menu',$data);
        echo view('profile',$data);
        echo view ('footer');
        }else{
        return redirect()->to('home/error');
        }
        
}
public function aksieprofile() 
{
    $model = new M_sips();

    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah data profile'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       

    $a = $this->request->getPost('nama');
    $b = $this->request->getPost('email');
    $c = $this->request->getPost('nohp');
    $id = $this->request->getPost('id');
    $fotoName = $this->request->getPost('old_foto'); // Mengambil nama foto lama
    $foto = $this->request->getFile('foto');

    if ($foto && $foto->isValid()) {
        // Generate a new name for the uploaded file
        $newName = $foto->getRandomName();
        // Move the file to the target directory
        $foto->move(ROOTPATH . 'public/images', $newName);
        // Set the new file name to be saved in the database
        $fotoName = $newName;
    }

    $backupWhere = ['id_user' => $id];
    $existingBackup = $model->getWhere('backup_user', $backupWhere);

    if ($existingBackup) {
        // Hapus data lama di user_backup jika ada
        $model->hapus('backup_user', $backupWhere);
    }

    // Ambil data user lama berdasarkan id_user
    $userLama = $model->getUserById($id);

    // Simpan data user lama ke tabel user_backup
    $backupData = (array) $userLama;  // Ubah objek menjadi array
    $model->tambah('backup_user', $backupData);

    

    $isi = array(
        'nama_user' => $a,
        'email' => $b,
        'nohp' => $c,
        'foto' => $fotoName,
        'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    );

    $where = array('id_user' => $id);
    $model->edit('user', $isi, $where);

    return redirect()->to('home/profile/'.$id);
}

public function aksi_changepass() {
    $model = new M_sips();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'mengubah password profile'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
       
    $oldPassword = $this->request->getPost('old');
    $newPassword = $this->request->getPost('new');
   

    // Dapatkan password lama dari database
    $currentPassword = $model->getPassword($id_user);

    // Verifikasi apakah password lama cocok
    if (md5($oldPassword) !== $currentPassword) {
        // Set pesan error jika password lama salah
        session()->setFlashdata('error', 'Password lama tidak valid.');
        return redirect()->back()->withInput();
    }
 
    // Update password baru
    $data = [
        'password' => md5($newPassword),
        'updated_by' => $id_user,
        'updated_at' => date('Y-m-d H:i:s')
    ];
    $where = ['id_user' => $id_user];
    
    $model->edit('user', $data, $where);
    
    // Set pesan sukses
    session()->setFlashdata('success', 'Password berhasil diperbarui.');
    return redirect()->to('home/profile/'.$id_user);
}

//pengumuman

public function pengumuman()
{
    if (session()->get('level') == 0||session()->get('level') == 1||session()->get('level') == 1||session()->get('level') == 2||session()->get('level') == 3||session()->get('level') == 4||session()->get('level') == 5 ) {
    $model = new M_sips();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $level = session()->get('level'); // Ambil level dari session
    $activity = 'Mengakses halaman pengumuman'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);

    $data['kelas'] = $model->tampil('kelas', 'id_kelas');
    
    // Jika levelnya 5, hanya tampilkan pengumuman yang dibuat oleh user tersebut
    if ($level == 5) {
        $data['elly'] = $model->getWhereres('pengumuman', ['created_by' => $id_user]);
    } else {
        $data['elly'] = $model->tampil('pengumuman', 'id_pengumuman');
    }

    $data['backup_pengumuman'] = []; // Inisialisasi array untuk backup user

    foreach ($data['elly'] as $pengumuman) {
        $data['backup_pengumuman'][$pengumuman->id_pengumuman] = $model->getBackupPengumuman($pengumuman->id_pengumuman);
    }

    // Tidak ada $id_pengumuman yang didefinisikan sebelumnya, jika ada parameternya, sesuaikan
    // $data['satu'] = $model->getWhere('pengumuman', ['id_pengumuman' => $id_pengumuman]);

    $where = ['id_setting' => 1];
    $data['setting'] = $model->getWhere('setting', $where);
    $data['currentMenu'] = 'pengumuman'; // Sesuaikan dengan menu yang aktif
    
    echo view('header', $data);
    echo view('menu', $data);
    echo view('pengumuman', $data);
    echo view('footer');
}else{
    return redirect()->to('home/error');

} 
}


public function aksi_tambah_pengumuman()
    {
        $model = new M_sips();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menambah data pengumuman'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
       
        // $a = $this->request->getPost('kelas');
        $b = $this->request->getPost('judul');
        $c = $this->request->getPost('isi');
       
        // Cek apakah file diunggah
    $uploadedFile = $this->request->getFile('file');
    $filePath = null;

    if ($uploadedFile && $uploadedFile->isValid()) {
        // Tentukan path target dengan getRandomName
        $newFileName = $uploadedFile->getName();
        $filePath = 'pdf/' . $newFileName;
    
        // Cek apakah direktori tujuan sudah ada
        if (!is_dir('pdf/')) {
            mkdir('pdf/', 0777, true); // Buat folder jika belum ada
        }
    
        try {
            $uploadedFile->move('pdf/', $newFileName);
        } catch (\Exception $e) {
            die("Gagal memindahkan file: " . $e->getMessage());
        }
    }
    
       
        
        $isi = array(
            // 'id_kelas' => $a,
            'judul' => $b,
            'isi_pengumuman' => $c,
            'file' => $filePath, // Menyimpan path file
            'created_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
            'created_by' => $id_user // ID user yang login
            
            

        );
        $model ->tambah('pengumuman', $isi);
        
        return redirect()->to('home/pengumuman');
    }

    public function aksi_edit_pengumuman()
{
    $model = new M_sips();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Mengubah data pengumuman'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    $b = $this->request->getPost('judul');
    $c = $this->request->getPost('isi');
    $id = $this->request->getPost('id');
   
    $backupWhere = ['id_pengumuman' => $id];
    $existingBackup = $model->getWhere('backup_pengumuman', $backupWhere);

    if ($existingBackup) {
        // Hapus data lama di backup_pengumuman jika ada
        $model->hapus('backup_pengumuman', $backupWhere);
    }

    // Ambil data pengumuman lama berdasarkan id_pengumuman
    $pengumumanLama = $model->getPengumumanById($id);

    // Simpan data pengumuman lama ke tabel backup_pengumuman
    $backupData = (array) $pengumumanLama;  // Ubah objek menjadi array
    $model->tambah('backup_pengumuman', $backupData);
    
    // Cek apakah ada file yang diunggah
    $uploadedFile = $this->request->getFile('file');
    $filePath = $pengumumanLama->file; // Default ke file lama jika tidak ada file baru

    if ($uploadedFile && $uploadedFile->isValid()) {
        // Tentukan nama file baru dan path
        $newFileName = $uploadedFile->getName();
        $filePath = 'pdf/' . $newFileName;
    
        // Cek apakah direktori tujuan sudah ada
        if (!is_dir('pdf/')) {
            mkdir('pdf/', 0777, true); // Buat folder jika belum ada
        }
    
        try {
            // Pindahkan file ke folder tujuan dan hapus file lama jika ada
            $uploadedFile->move('pdf/', $newFileName);
            if ($pengumumanLama->file && file_exists($pengumumanLama->file)) {
                unlink($pengumumanLama->file); // Hapus file lama
            }
        } catch (\Exception $e) {
            die("Gagal memindahkan file: " . $e->getMessage());
        }
    }
    
    // Array data yang akan diperbarui
    $isi = array(
        'judul' => $b,
        'isi_pengumuman' => $c,
        'file' => $filePath, // Simpan path file baru
        'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    );

    $where = array('id_pengumuman' => $id);
    $model->edit('pengumuman', $isi, $where);
    
    return redirect()->to('home/pengumuman');
}


    public function aksi_unedit_pengumuman()
{
    $model = new M_sips();
    $id = $this->request->getPost('id'); // Ambil ID dari POST data
    
    if (!$id) {
        return redirect()->to('home/pengumuman')->with('error', 'ID user tidak ditemukan.');
    }
    
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Merestore pengumuman yang diedit'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    // Ambil data dari tabel user_backup berdasarkan id_user
    $backupData = $model->getWhere('backup_pengumuman', ['id_pengumuman' => $id]);

    if ($backupData) {
        // Konversi data backup menjadi array
        $restoreData = (array) $backupData;

        // Hapus id_user dari array karena id_user tidak perlu di-update
        unset($restoreData['id_pengumuman']);

        // Update data di tabel user dengan data dari user_backup
        $model->edit('pengumuman', $restoreData, ['id_pengumuman' => $id]);

        // Hapus data dari tabel user_backup setelah di-restore
        $model->hapus('backup_pengumuman', ['id_pengumuman' => $id]);
    }

    return redirect()->to('home/pengumuman');
}

public function hapuspengumuman($id){
    $model = new M_sips();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menghapus data pengumuman'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    $data = [
        'isdelete' => 1,
        'deleted_by' => $id_user,
        'deleted_at' => date('Y-m-d H:i:s') // Format datetime untuk deleted_at
    ];
      
    $model->edit('pengumuman', $data, ['id_pengumuman' => $id]);

    // Hapus data dari tabel backup_kelas
$where = array('id_pengumuman' => $id);
$model->hapus('backup_pengumuman', $where);
    return redirect()->to('home/pengumuman');
}

public function restore_pengumuman()
    {   
        if (session()->get('level') == 0 || session()->get('level') == 1) {
    	$model= new M_sips();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman restore pengumuman'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        $data['elly'] = $model->tampil('pengumuman','id_pengumuman');
        
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
          $data['currentMenu'] = 'restore_user'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view ('menu',$data);
        echo view('restore_pengumuman',$data);
        echo view ('footer');
         }else{
        return redirect()->to('home/error');
 
    } 
    }

    public function aksi_restore_pengumuman($id) {
        $model = new M_sips();
         $id_user = session()->get('id'); // Ambil ID user dari session
            $activity = 'Merestore pengumuman'; // Deskripsi aktivitas
            $this->addLog($id_user, $activity);
        
        // Data yang akan diupdate untuk mengembalikan produk
        $data = [
            'isdelete' => 0,
            'deleted_by' => null,
            'deleted_at' => null
        ];
    
        // Update data produk dengan kondisi id_produk sesuai
        $model->edit('pengumuman', $data, ['id_pengumuman' => $id]);
    
        return redirect()->to('home/restore_pengumuman');
    }

//kelas

public function kelas()
    {   
        if (session()->get('level') == 0||session()->get('level') == 1 ) {
    	$model= new M_sips();
        
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman kelas'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        $where= array('id_kelas'=>$id);
        $data['satu']=$model->getwhere('kelas',$where);
      
        $data['elly'] = $model->join3('kelas', 'user', 'kelas.id_user = user.id_user', 'kelas.id_kelas', ['kelas.isdelete' => 0]);

       
        $data['backup_kelas'] = []; // Inisialisasi array untuk backup user

        foreach ($data['elly'] as $kelas) {
            $data['backup_kelas'][$kelas->id_kelas_kelas] = $model->getBackupKelas($kelas->id_kelas_kelas);
        }

        // Ambil data user dengan level 5 (untuk wali kelas)
        $whereUser = ['level' => 5, 'isdelete' => 0];
        $data['guru'] = $model->getWhereres('user', $whereUser); // Ambil data user dengan level 5

        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
          $data['currentMenu'] = 'kelas'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view ('menu',$data);
        echo view('kelas',$data);
        echo view ('footer');
         }else{
        return redirect()->to('home/error');
 
    } 
    }

    public function aksi_tambah_kelas()
{
    $model = new M_sips();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menambah data kelas'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
   
    // Ambil inputan kelas
    $kelas_input = $this->request->getPost('kelas');
    $jurusan = $this->request->getPost('jurusan') ?: '';

    $wali = $this->request->getPost('wali');
    // Ekstrak angka Romawi dari inputan menggunakan regex
    preg_match('/\b(I|II|III|IV|V|VI|VII|VIII|IX|X|XI|XII)\b/', $kelas_input, $matches);
   
    // Jika ditemukan angka Romawi, ambil nilainya, jika tidak, anggap tidak diketahui
    $kelas = isset($matches[0]) ? $matches[0] : 'Tidak Diketahui';
   
    // Tentukan jenjang berdasarkan angka Romawi
    $jenjang = '';
    switch ($kelas) {
        case 'I':
        case 'II':
        case 'III':
        case 'IV':
        case 'V':
        case 'VI':
            $jenjang = 'SD';
            break;
        case 'VII':
        case 'VIII':
        case 'IX':
            $jenjang = 'SMP';
            break;
        case 'X':
        case 'XI':
        case 'XII':
            $jenjang = 'SMK';
            break;
        default:
            $jenjang = 'Tidak Diketahui'; // Jika kelas tidak dikenali
    }

    $isi = array(
        'nama_kelas' => $kelas_input, // Simpan input kelas lengkap
        'id_user' => $wali, // Simpan input kelas lengkap
        'jurusan' => $jurusan, // Simpan input kelas lengkap
        'jenjang' => $jenjang, // Tambahkan jenjang ke dalam array
        'created_at' => date('Y-m-d H:i:s'), // Waktu saat data dibuat
        'created_by' => $id_user // ID user yang login
    );
    
    $model->tambah('kelas', $isi);
    
    return redirect()->to('home/kelas');
}


    

public function aksi_edit_kelas()
{
    $model = new M_sips();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Mengubah data kelas'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    $kelas_input = $this->request->getPost('kelas');
    $jurusan = $this->request->getPost('jurusan');
    $wali = $this->request->getPost('wali');
    $id = $this->request->getPost('id');
    

    $backupWhere = ['id_kelas' => $id];
    $existingBackup = $model->getWhere('backup_kelas', $backupWhere);

    if ($existingBackup) {
        // Hapus data lama di backup_kelas jika ada
        $model->hapus('backup_kelas', $backupWhere);
    }

    // Ambil data kelas lama berdasarkan id
    $kelasLama = $model->getKelasById($id);
    
    // Simpan data kelas lama ke tabel backup_kelas
    $backupData = (array) $kelasLama;  // Ubah objek menjadi array
    $model->tambah('backup_kelas', $backupData);
    
    // Ekstrak angka Romawi dari inputan menggunakan regex
    preg_match('/\b(I|II|III|IV|V|VI|VII|VIII|IX|X|XI|XII)\b/', $kelas_input, $matches);
   
    // Jika ditemukan angka Romawi, ambil nilainya, jika tidak, anggap tidak diketahui
    $kelas = isset($matches[0]) ? $matches[0] : 'Tidak Diketahui';
   
    // Tentukan jenjang berdasarkan angka Romawi
    $jenjang = '';
    switch ($kelas) {
        case 'I':
        case 'II':
        case 'III':
        case 'IV':
        case 'V':
        case 'VI':
            $jenjang = 'SD';
            break;
        case 'VII':
        case 'VIII':
        case 'IX':
            $jenjang = 'SMP';
            break;
        case 'X':
        case 'XI':
        case 'XII':
            $jenjang = 'SMK';
            break;
        default:
            $jenjang = 'Tidak Diketahui'; // Jika kelas tidak dikenali
    }

    $isi = array(
        'nama_kelas' => $kelas_input, // Simpan input kelas lengkap
        'id_user' => $wali, // Simpan input kelas lengkap
        'jurusan' => $jurusan, // Simpan input kelas lengkap
        'jenjang' => $jenjang, // Tambahkan jenjang ke dalam array
        'updated_at' => date('Y-m-d H:i:s'), // Waktu saat data diperbarui
        'updated_by' => $id_user // ID user yang login
    );

    

    $where = array('id_kelas' => $id);
    print_r($where);
    $model->edit('kelas', $isi, $where);
    
     return redirect()->to('home/kelas');
}


    public function hapuskelas($id){
        $model = new M_sips();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menghapus data kelas'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        $data = [
            'isdelete' => 1,
            'deleted_by' => $id_user,
            'deleted_at' => date('Y-m-d H:i:s') // Format datetime untuk deleted_at
        ];
       
        
          
        $model->edit('kelas', $data, ['id_kelas' => $id]);

        //Hapus data dari tabel backup_kelas
    $where = array('id_kelas' => $id);
    $model->hapus('backup_kelas', $where);

        return redirect()->to('home/kelas');
   }

   public function aksi_unedit_kelas()
{
    $model = new M_sips();
    $id = $this->request->getPost('id'); // Ambil ID dari POST data
    
    if (!$id) {
        return redirect()->to('home/kelas')->with('error', 'ID kelas tidak ditemukan.');
    }
    
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Merestore kelas yang diedit'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    // Ambil data dari tabel user_backup berdasarkan id_user
    $backupData = $model->getWhere('backup_kelas', ['id_kelas' => $id]);

    if ($backupData) {
        // Konversi data backup menjadi array
        $restoreData = (array) $backupData;

        // Hapus id_user dari array karena id_user tidak perlu di-update
        unset($restoreData['id_kelas']);

        // Update data di tabel user dengan data dari user_backup
        $model->edit('kelas', $restoreData, ['id_kelas' => $id]);

        // Hapus data dari tabel user_backup setelah di-restore
        $model->hapus('backup_kelas', ['id_kelas' => $id]);
    }

    return redirect()->to('home/kelas');
}

public function restore_kelas()
    {   
        if (session()->get('level') == 0 || session()->get('level') == 1) {

    	$model= new M_sips();
        
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman restore kelas'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
      
        $data['elly'] = $model->join3('kelas', 'user', 'kelas.id_user = user.id_user', 'kelas.id_kelas', ['kelas.isdelete' => 1]);
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
          $data['currentMenu'] = 'restore_kelas'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view ('menu',$data);
        echo view('restore_kelas',$data);
        echo view ('footer');
         }else{
        return redirect()->to('home/error');
 
    } 
    }

    public function aksi_restore_kelas($id) {
        $model = new M_sips();
         $id_user = session()->get('id'); // Ambil ID user dari session
            $activity = 'Merestore kelas'; // Deskripsi aktivitas
            $this->addLog($id_user, $activity);
        
        // Data yang akan diupdate untuk mengembalikan produk
        $data = [
            'isdelete' => 0,
            'deleted_by' => null,
            'deleted_at' => null
        ];
    
        // Update data produk dengan kondisi id_produk sesuai
        $model->edit('kelas', $data, ['id_kelas' => $id]);
    
        return redirect()->to('home/restore_kelas');
    }


    //user

    public function user()
{
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_sips();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

        $data['kelas'] = $model->tampil('kelas', 'id_kelas');
        $data['elly'] = $model->tampil('user', 'id_user');
        $data['backup_users'] = []; // Inisialisasi array untuk backup user

        foreach ($data['elly'] as $user) {
            $data['backup_users'][$user->id_user] = $model->getBackupUser($user->id_user);
        }



        $data['satu'] = $model->getWhere('user', ['id_user' => $id_user]);

        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'user'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('menu', $data);
        echo view('user', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    }
}


public function aksi_tambah_user()
    {
        $model = new M_sips();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menambah user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       
      
        $a = $this->request->getPost('nama');
        $b = $this->request->getPost('level');
        $c = md5($this->request->getPost('password'));
        $d = $this->request->getPost('nis');
        $e = $this->request->getPost('nisn');
        $f = $this->request->getPost('kelas');
        $g = $this->request->getPost('jk');
        $h = $this->request->getPost('lahir');
        $i = $this->request->getPost('email');
        $j = $this->request->getPost('nohp');
        $k = $this->request->getPost('nik');
        $l = $this->request->getPost('nuptk');
        
        // $g = $this->request->getPost('editmodul');
        $uploadedFile = $this->request->getFile('foto');

        // Cek apakah file foto di-upload atau tidak
        if ($uploadedFile && $uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
            $foto = $uploadedFile->getName();
            $model->upload($uploadedFile);
        } else {
            // Set foto default jika tidak ada file yang di-upload
            $foto = 'default.jpg';
        }
        
    
        
        $isi = array(
            'nama_user' => $a,
            'level' => $b,
            'password' => $c,
           'nis' => $d,
            'nisn' => $e,
            'id_kelas' => $f,
            'jk' => $g,
            'tgl_lhr' => $h,
            'email' => $i,
            'nohp' => $j,
            'nik' => $k,
            'nuptk' => $l,
            'foto' => $foto,
            'created_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
            'created_by' => $id_user // ID user yang login
            

        );
        $model ->tambah('user', $isi);
        
        return redirect()->to('home/user');
    }

    public function aksi_edit_user()
{
    $model = new M_sips();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah data user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        // Mengambil data log aktivitas dari model
       
    $a = $this->request->getPost('nama');
    $b = $this->request->getPost('level');
    $c = ($this->request->getPost('password'));
    $d = $this->request->getPost('nis');
    $e = $this->request->getPost('nisn');
    $f = $this->request->getPost('kelas');
    $g = $this->request->getPost('jk');
    $h = $this->request->getPost('lahir');
    $i = $this->request->getPost('email');
    $j = $this->request->getPost('nohp');
    $k = $this->request->getPost('nik');
    $l = $this->request->getPost('nuptk');
    // $g = $this->request->getPost('editmodul');
    $id = $this->request->getPost('id');
    $fotoName = $this->request->getPost('old_foto'); // Mengambil nama foto lama
    $foto = $this->request->getFile('foto');


    $backupWhere = ['id_user' => $id];
    $existingBackup = $model->getWhere('backup_user', $backupWhere);

    if ($existingBackup) {
        // Hapus data lama di user_backup jika ada
        $model->hapus('backup_user', $backupWhere);
    }

    // Ambil data user lama berdasarkan id_user
    $userLama = $model->getUserById($id);

    // Simpan data user lama ke tabel user_backup
    $backupData = (array) $userLama;  // Ubah objek menjadi array
    $model->tambah('backup_user', $backupData);


    if ($foto && $foto->isValid()) {
        // Generate a new name for the uploaded file
        $newName = $foto->getRandomName();
        // Move the file to the target directory
        $foto->move(ROOTPATH . 'public/images', $newName);
        // Set the new file name to be saved in the database
        $fotoName = $newName;
    }

    if ($b == 1) {
        $d = null; // NIS
        $e = null; // NISN
        $f = null; // Kelas
        $l = null;
       
    } elseif (in_array($b, [2, 3, 4,5])) {
        $f = null; // Kelas
        $d = null;
        $e = null;
    } elseif ($b == 6) {
        $k = null; // Kelas
        $l = null;
       
    } elseif ($b == 7) {
        $d = null; // NIS
        $e = null; // NISN
        $k = null; // Kelas
        $l = null;
       
    }

    $isi = array(
        'nama_user' => $a,
        'level' => $b,
        'password' => $c,
        'nis' => $d,
        'nisn' => $e,
        'id_kelas' => $f,
        'jk' => $g,
        'tgl_lhr' => $h,
        'email' => $i,
        'nohp' => $j,
        'nik' => $k,
        'nuptk' => $l,
        'foto' => $fotoName,
        'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    );

    $where = array('id_user' => $id);
    $model->edit('user', $isi, $where);

    return redirect()->to('home/user');
}

public function aksi_reset($id)
{
    $model = new M_sips();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mereset password user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       
      
    $where = array('id_user' => $id);
    
    $isi = array(
        'password' => md5('12345'),
        'updated_at' => date('Y-m-d H:i:s'),
        'updated_by' => $id_user
    );
    $model->edit('user', $isi, $where);

    return redirect()->to('home/user');
}

public function hapususer($id){
    $model = new M_sips();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menghapus data user'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    $data = [
        'isdelete' => 1,
        'deleted_by' => $id_user,
        'deleted_at' => date('Y-m-d H:i:s') // Format datetime untuk deleted_at
    ];
      
    $model->edit('user', $data, ['id_user' => $id]);

    // Hapus data dari tabel backup_kelas
$where = array('id_user' => $id);
$model->hapus('backup_user', $where);
    return redirect()->to('home/user');
}

public function restore_user()
    {   
        if (session()->get('level') == 0 || session()->get('level') == 1) {
    	$model= new M_sips();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman restore user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        
        $data['elly'] = $model->join4('user', 'kelas', 'user.id_kelas=kelas.id_kelas', 'user.id_user', ['user.isdelete' => 1]);
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
          $data['currentMenu'] = 'restore_user'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view ('menu',$data);
        echo view('restore_user',$data);
        echo view ('footer');
         }else{
        return redirect()->to('home/error');
 
    } 
    }

    public function aksi_restore_user($id) {
        $model = new M_sips();
         $id_user = session()->get('id'); // Ambil ID user dari session
            $activity = 'Merestore user'; // Deskripsi aktivitas
            $this->addLog($id_user, $activity);
        
        // Data yang akan diupdate untuk mengembalikan produk
        $data = [
            'isdelete' => 0,
            'deleted_by' => null,
            'deleted_at' => null
        ];
    
        // Update data produk dengan kondisi id_produk sesuai
        $model->edit('user', $data, ['id_user' => $id]);
    
        return redirect()->to('home/restore_user');
    }

    public function aksi_unedit_user()
{
    $model = new M_sips();
    $id = $this->request->getPost('id'); // Ambil ID dari POST data
    
    if (!$id) {
        return redirect()->to('home/user')->with('error', 'ID user tidak ditemukan.');
    }
    
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Merestore user yang diedit'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    // Ambil data dari tabel user_backup berdasarkan id_user
    $backupData = $model->getWhere('backup_user', ['id_user' => $id]);

    if ($backupData) {
        // Konversi data backup menjadi array
        $restoreData = (array) $backupData;

        // Hapus id_user dari array karena id_user tidak perlu di-update
        unset($restoreData['id_user']);

        // Update data di tabel user dengan data dari user_backup
        $model->edit('user', $restoreData, ['id_user' => $id]);

        // Hapus data dari tabel user_backup setelah di-restore
        $model->hapus('backup_user', ['id_user' => $id]);
    }

    return redirect()->to('home/user');
}


// share
public function aksi_share_pengumuman() {
    $model = new M_sips();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $user_level = session()->get('level'); // Ambil level user dari session
    $activity = 'Membagikan pengumuman'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity); // Log aktivitas

    // Ambil data dari form
    $id_pengumuman = $this->request->getPost('id');
    $jenjang = $this->request->getPost('jenjang'); // Bisa jadi array
    $kelas = $this->request->getPost('kelas');     // Bisa jadi array
    $jurusan = $this->request->getPost('jurusan'); // Bisa jadi array
    $send_to_email = $this->request->getPost('send_to_email');
    $send_to_whatsapp = $this->request->getPost('send_to_whatsapp'); // Checkbox WhatsApp

    // Ambil pengumuman yang akan dikirim
    $pengumuman = $model->getPengumumanById($id_pengumuman);

    // Array untuk menampung user yang telah difilter secara unik
    $filtered_users = [];

    if ($user_level == 5) {
        // Jika user level 5 (wali kelas), kirim langsung ke kelas yang diwalikan
        $kelas_wali = $model->getWhereres('kelas', ['id_user' => $id_user]); // Ambil kelas berdasarkan id_user (wali kelas)
        if ($kelas_wali) {
            foreach ($kelas_wali as $kelas) {
                $users = $model->getWhereres('user', ['id_kelas' => $kelas->id_kelas, 'email !=' => '', 'user.isdelete' => 0]);
                foreach ($users as $user) {
                    $filtered_users[$user->id] = $user; // Menyimpan user berdasarkan ID untuk menghindari duplikat
                }
            }
        }
    } else {
        // Jika bukan level 5, cek filter yang dipilih dan tambahkan user ke array unik
        // Cek apakah ada jenjang yang dipilih
        if ($jenjang && is_array($jenjang)) {
            foreach ($jenjang as $j) {
                $users = $model->joinWherebaru('user', 'kelas', 'kelas.id_kelas=user.id_kelas', ['jenjang' => $j, 'email !=' => '', 'user.isdelete' => 0]);
                foreach ($users as $user) {
                    $filtered_users[$user->id] = $user; // Menyimpan user berdasarkan ID untuk menghindari duplikat
                }
            }
        }

        // Cek apakah ada kelas yang dipilih
        if ($kelas && is_array($kelas)) {
            foreach ($kelas as $k) {
                $users = $model->getWhereres('user', ['id_kelas' => $k, 'email !=' => '', 'user.isdelete' => 0]);
                foreach ($users as $user) {
                    $filtered_users[$user->id] = $user; // Menyimpan user berdasarkan ID untuk menghindari duplikat
                }
            }
        }

        // Cek apakah ada jurusan yang dipilih
        if ($jurusan && is_array($jurusan)) {
            foreach ($jurusan as $jur) {
                $users = $model->joinWherebaru('user', 'kelas', 'kelas.id_kelas=user.id_kelas', ['kelas.jurusan' => $jur, 'email !=' => '', 'user.isdelete' => 0]);
                foreach ($users as $user) {
                    $filtered_users[$user->id] = $user; // Menyimpan user berdasarkan ID untuk menghindari duplikat
                }
            }
        }
    }

    // Kirim pengumuman ke semua user unik dalam filtered_users
    $this->kirimPengumuman(array_values($filtered_users), $pengumuman, $send_to_email, $send_to_whatsapp);

    // Redirect kembali ke halaman pengumuman setelah selesai
    return redirect()->to('home/pengumuman')->with('success', 'Pengumuman berhasil dibagikan.');
}




// Fungsi untuk mengirim pengumuman
private function kirimPengumuman($users, $pengumuman, $send_to_email, $send_to_whatsapp)
{
    if ($users) {
        foreach ($users as $user) {
            // Memformat isi pengumuman agar baris baru tetap terjaga
            $isiPengumuman = nl2br($pengumuman->isi_pengumuman);
            $filePengumuman = $pengumuman->file; // Mengambil file pengumuman

            // Jika checkbox email tercentang, kirim email
            if ($send_to_email) {
                $this->sendEmail($user->email, $pengumuman->judul, $isiPengumuman, $filePengumuman);
            }

            // Jika checkbox WhatsApp tercentang, kirim pesan WhatsApp
            if ($send_to_whatsapp && !empty($user->nohp)) {
                $whatsappMessage = "PENGUMUMAN: \n" . $pengumuman->judul . "\n\n" . strip_tags($pengumuman->isi_pengumuman);
                
                // Jika ada file, upload file dan tambahkan URL file ke pesan WhatsApp
                if ($filePengumuman) {
                    $uploadedFileUrl = $this->uploadFileToCDN($filePengumuman);
                    if ($uploadedFileUrl) {
                        $whatsappMessage .= "\n\nUnduh File: " . $uploadedFileUrl;
                    }
                }
                
                $this->sendWhatsApp($user->nohp, $whatsappMessage);
            }
        }
    }
}


private function uploadFileToCDN($filePath)
{
    $instanceId = 'instance98533'; // Ganti dengan Instance ID dari UltraMsg
    $apiKey = '90nr5ykha1jeuta1'; // Ganti dengan API Key dari UltraMsg
    $url = "https://api.ultramsg.com/$instanceId/media/upload";

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => [
            'file' => new CURLFile($filePath), // Menggunakan CURLFile untuk upload
            'token' => $apiKey
        ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    // Decode response to get the URL
    $responseData = json_decode($response, true);

    if (isset($responseData['success'])) { // Change 'url' to 'success'
        return $responseData['success']; // Mengembalikan URL file yang diupload
    } else {
        log_message('error', 'Gagal mengunggah file: ' . print_r($responseData, true));
        return false; // Penanganan jika upload gagal
    }
}




// Fungsi untuk mengirim email menggunakan PHPMailer
private function sendEmail($to, $subject, $body, $filePath = null)
{
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Ganti dengan SMTP server Anda
        $mail->SMTPAuth = true;
        $mail->Username = getenv('EMAIL_USERNAME');
        $mail->Password = getenv('EMAIL_PASSWORD');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('tugaselly@gmail.com', 'Sekolah Permata Harapan'); // Ganti dengan nama pengirim
        $mail->addAddress($to); // Alamat email penerima

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        // Tambahkan lampiran jika ada
        if ($filePath) {
            $fullPath = FCPATH .  $filePath; // Atur path sesuai lokasi file
            if (file_exists($fullPath)) {
                $mail->addAttachment($fullPath);
            } else {
                log_message('error', 'File tidak ditemukan: ' . $fullPath);
                return false; // Penanganan jika file tidak ditemukan
            }
        }

        // Kirim email
        $mail->send();
    } catch (Exception $e) {
        // Handle error jika email gagal dikirim
        log_message('error', 'Email gagal dikirim: ' . $mail->ErrorInfo);
        return false;
    }
    return true;
}






private function sendWhatsApp($phoneNumber, $message)
{
    $instanceId = 'instance98533'; // Ganti dengan Instance ID dari UltraMsg
    $apiKey = '90nr5ykha1jeuta1'; // Ganti dengan API Key dari UltraMsg
    $fromNumber = '+6282272729333'; // Ganti dengan nomor pengirim yang terdaftar

    $url = 'https://api.ultramsg.com/' . $instanceId . '/messages/chat';

    $data = [
        'token' => $apiKey,
        'to' => $phoneNumber,
        'body' => $message,
        'from' => $fromNumber, // Menambahkan nomor pengirim
    ];

    $options = [
        'http' => [
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        // Handle error jika pesan WhatsApp gagal dikirim
        log_message('error', 'WhatsApp gagal dikirim ke ' . $phoneNumber);
        return false;
    }

    return true;
}

//pemberitahuan



public function pemberitahuan()
{
    if (session()->get('level') >= 0 && session()->get('level') <= 7) {
        $model = new M_sips();
        $id_user = session()->get('id');
        $activity = 'Mengakses halaman pemberitahuan';
        $this->addLog($id_user, $activity);

        $data['elly'] = $model->tampil('pengumuman', 'id_pengumuman'); // Ambil data pengumuman

        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'pemberitahuan';
        
        echo view('header', $data);
        echo view('menu', $data);
        echo view('pemberitahuan', $data); // Kirim data pengumuman ke view pemberitahuan
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    }
}



}
