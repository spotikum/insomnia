<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\User;
use App\Mail\PraktikumPrognetMail;
use Mail;
use Auth;
use Hash;

class AuthController extends Controller
{
    //menampilkan halaman login
	function loginpage(){
		return view('loginpage');
	}

    function loginadmin(){
        return view('loginadmin');
    }

    function registeradmin(){
        return view('admin.register');
    }

    function doRegAdmin(Request $req){
        $req->validate([
            'nama' => 'required',
            'username' => 'required|unique:admins',
            'pass' => 'required',            
            'phone' => 'required',
            'foto' => 'required',
        ],[
            'nama.required' => 'Nama harus diisi',
            'username.required' => 'Email harus diisi',
            'username.unique' => 'Email telah digunakan',
            'pass.required' => 'Password harus diisi',
            'phone.required' => 'Nomor Telepon harus diisi',
            'foto.required' => 'Foto harus diisi',
        ]);

        if ($req->hasFile('foto')) {
            //jika ada file
            try {
                $image      = $req->file('foto');
                $fileName   = time() . '.' . $image->getClientOriginalExtension(); //mengubah namafile
                $path = Storage::putFileAs('public/images', $req->file('foto'), $fileName); //upload file pada server
                //input user ke db
                Admin::create([
                    'username' => $req->username,
                    'password' => Hash::make($req->pass),
                    'name' => $req->nama,
                    'phone' => $req->phone,
                    'profile_image' => $fileName
                ]);
                return redirect('/login')->with('sukses', "Akun admin berhasil dibuat, Silahkan login untuk menggunakan sistem");
            } catch (Exception $e) {
                return redirect('/login')->with('gagal', "Daftar akun admin gagal");
            }
        }
    }

    //fungsi melakukan login
	function doLogin(Request $req){

        //validasi inputan
		$req->validate([
			'email' => 'required',
			'pass' => 'required',
		],[
			'email.required' => 'Email harus diisi',
			'pass.required' => 'Password harus diisi',
		]);

        //pengecekan apakah login admin atau user
		if (Auth::guard('user')->attempt(['email' => $req->email, 'password' => $req->pass])) {
            //jika yg login user
            //pengecekan apakan user terverifikasi atau belum
			if (Auth::guard('user')->user()->email_verified_at == null) {
				Auth::guard('user')->logout();
				return view('user.nonaktif');
			}else{
				return redirect()->intended('/user/home');
			}
		}else{
            //jjika salah inputan
			return redirect('/login')->with('gagal', 'Login gagal, email / password salah');
		}
	}

    function doLoginAdmin(Request $req){
        $req->validate([
            'username' => 'required',
            'pass' => 'required',
        ],[
            'username.required' => 'Username harus diisi',
            'pass.required' => 'Password harus diisi',
        ]);

        if (Auth::guard('admin')->attempt(['username' => $req->username, 'password' => $req->pass])) {
            //jika yg login admin
            return redirect()->intended('/admin/home');
        }else{
            return redirect('/login/admin')->with('gagal', 'Login gagal, username / password salah');
        }
    }

    //fungsi registrasi user
	function doRegis(Request $req){
        //validasi inputan
		$req->validate([
			'email' => 'required|unique:users',
			'password' => 'required',
			'nama' => 'required',
			'foto' => 'required',
		],[
			'email.required' => 'Email harus diisi',
			'email.unique' => 'Email telah digunakan',
			'password.required' => 'Password harus diisi',
			'nama.required' => 'Nama harus diisi',
			'foto.required' => 'Foto harus diisi',
		]);

        //cek apakah inputan terdapat file
		if ($req->hasFile('foto')) {
            //jika ada file
			try {
				$image      = $req->file('foto');
                $fileName   = time() . '.' . $image->getClientOriginalExtension(); //mengubah namafile
                $path = Storage::putFileAs('public/images', $req->file('foto'), $fileName); //upload file pada server
                //input user ke db
    			User::create([
    				'email' => $req->email,
    				'password' => Hash::make($req->password),
    				'name' => $req->nama,
    				'status' => '',
    				'profile_image' => $fileName
    			]);
                //kirim notifikasi via email, panggil fungsi sendNotif
    			$this->sendNotif($req->email, ['message' => "Selamat akun ecommerce anda berhasil dibuat. Untuk mengaktifkan akun", 'email' => 'Silahkan klik link berikut ini!', 'link' => 'http://localhost/praktikum_prognet/public/konfirmasi/'.$req->email]);
    			return redirect('/login')->with('sukses', "Daftar akun berhasil, Silahkan cek email anda untuk mengaktifkan akun");
			} catch (Exception $e) {
				return redirect('/login')->with('gagal', "Daftar akun gagal");
			}
		}
	}

    //menampilkan halaman lupa pass
	function forgotpasspage(){
		return view('user.forgotpass');
	}

    //fungsi mengirim pesan email
	function sendNotif($email, $param)
    {
        Mail::to($email)->send(new PraktikumPrognetMail($param));

        return true;
    }

    //fungsi melakukan reset password
    function doforgot(Request $req){
    	$req->validate([
    		'email' => 'required'
    	],[
    		'email.required' => 'Email harus diisi'
    	]);

    	try {
    		$cek = User::where('email', $req->email)->count();
    		if ($cek != 1) {
    			return redirect('/forgot/password')->with('gagal', "Email tidak terdaftar");
    		}else{
                //memanggil fungsi sendNotif untuk mengirim pesan email
    			$this->sendNotif($req->email, ['message' => "Layanan reset password", 'email' => 'Silahkan klik link berikut ini!', 'link' => 'http://localhost/praktikum_prognet/public/lupa/pass/'.$req->email]);
    			return redirect('/forgot/password')->with('sukses', "Silahkan cek email anda");
    		}
    	} catch (Exception $e) {
    		return redirect('/forgot/password')->with('gagal', "Reset password gagal");
    	}
    }

    //menampilkan halaman lupa password
    function lupapass($param){
    	$data['email'] = $param;
    	return view('user.changepass',$data);
    }

    //fungsi untuk mengubah password
    function ubahpass(Request $req){
    	$req->validate([
    		'pass' => 'required'
    	],[
    		'pass.required' => 'Password harus diisi'
    	]);

    	try {
    		$cek = User::where('email', $req->email)->count();
    		if ($cek != 1) {
    			return redirect('/lupa/pass/'.$req->email)->with('gagal', "Ubah password gagal");
    		}else{
    			User::where('email', $req->email)->update([
    				'password' => Hash::make($req->pass)
    			]);
    			return redirect('/')->with('sukses', "Ubah password berhasil");
    		}
    	} catch (Exception $e) {
    		return redirect('/lupa/pass/'.$req->email)->with('gagal', "Ubah password gagal");
    	}
    }

    //fungsi untuk  verifikasi user
    function confirmemail($param){
    	$cek = User::where('email', $param)->count();

    	if ($cek > 0) {
    		User::where('email', $param)->update([
    			'email_verified_at' => date('Y-m-d H:i:s', strtotime(now()))
    		]);
    		$data['msg'] = "Email berhasil diaktifkan.";
    	}else{
    		$data['msg'] = "Email gagal diaktifkan.";
    	}

    	return view('user.statusconfirm', $data);
    }

    //fungsi untuk keluar sistem
    function logout(){
    	if (Auth::guard('user')->check()) {
    		Auth::guard('user')->logout();
            return redirect('/login')->with('sukses', 'Logout berhasil');
    	}else if (Auth::guard('admin')->check()) {
    		Auth::guard('admin')->logout();
            return redirect('/login/admin')->with('sukses', 'Logout berhasil');
    	}
    }
}
