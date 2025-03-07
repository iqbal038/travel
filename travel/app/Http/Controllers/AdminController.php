<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Supir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use TheSeer\Tokenizer\Exception;
use Illuminate\Database\QueryException;

use Session;
use Throwable;
session_id('travel-iqbal');
session_start();

class AdminController extends Controller
{
    public function index()
    {
        return view('layouts.admin-dashboard');
    }

    public function supir() {
        $supir = Supir::all();
        $userSupir = User::where('type', 'supir')->get();

        return view('pages.supir', compact('supir', 'userSupir'));
    }

    public function view_pengguna() {
        $users = User::all();

        return view('pages.pengguna', compact('users'));
    }

    public function tambah_pengguna(Request $request) {
        try {
            $this->validate($request, [
                'email' => 'required|unique:users'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'type' => $request->type
            ]);

            $type = $request->type;
            if($type == 'supir')
            {
                Supir::create([
                    'nama_supir' => $request->name,
                    'status' => 'Available',
                    'id_user' => $user->id
                ]);
            }

            return redirect()->to('pengguna')->with('success', 'Data berhasil ditambah');
        } catch(Exception $e)
        {
            return redirect()->to('pengguna')->with('error', $e->getMessage());
        }
    }

    public function update_pengguna(Request $request, User $user, $id) {
        $cek = User::findOrFail($id);
        if($cek)
        {
            try {
                $this->validate($request, [
                    'email' => 'unique:users'.',id,'.$user->id
                ]);
                
                User::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'type' => $request->type
                ]);

                $type = $request->type;
                if($type == 'supir')
                {
                    Supir::where('id_user', $id)->update([
                        'nama_supir' => $request->name,
                    ]);
                }

                return redirect()->to('pengguna')->with('success', 'Data berhasil diubah');
            } catch(Exception $e)
            {
                throw new Exception($e->getMessage());
            }
        } else {
            return redirect()->to('pengguna')->with('error', 'Data tidak ditemukan');
        }
    }

    public function delete_pengguna($id) {
        $cek = User::findOrFail($id);
        if($cek)
        {
            try {
                $type = $cek->type;
                if($type == 'supir')
                {
                    Supir::where('id_user', $id)->delete();
                }

                User::where('id', $id)->delete();

                return redirect()->to('pengguna')->with('success', 'Data berhasil dihapus');
            } catch(QueryException $exception)
            {
                // throw new Exception($e->getMessage());
                if ($exception instanceof QueryException) {
                    // Check if the exception message contains the specific error message
                    if (strpos($exception->getMessage(), 'Integrity constraint violation') !== false) {
                        // Redirect to a specific route when the integrity constraint violation occurs
                        return redirect()->to('pengguna')->with('error', 'Data ini sedang digunakan');
                    }
                }
            }
        } else {
            return redirect()->to('pengguna')->with('error', 'Data tidak ditemukan');
        }
    }

    public function ubah_password()
    {
        return view('pages.ubah-password-admin');
    }

    public function update_password(Request $request, $id)
    {
        $cek = User::findOrFail($id);

        if($cek)
        {
            // cek password lama
            if(Hash::check($request->password_lama, $cek->password))
            {
                if($request->password_baru == $request->konfirmasi_password_baru)
                {
                    $cek->update([
                        'password' => bcrypt($request->password_baru)
                    ]);

                    return redirect()->to('ubah-password-admin')->with('success', 'Password berhasil diubah');
                } else {
                    return redirect()->to('ubah-password-admin')->with('error', 'Konfirmasi password tidak sesuai.');
                }
            } else {
                return redirect()->to('ubah-password-admin')->with('error', 'Password lama tidak sesuai.');
            }
        } else {
            return redirect()->to('ubah-password-admin')->with('error', 'Data tidak ditemukan');
        }
    }

    public function update_supir(Request $request, $id)
    {
        $cek = Supir::where('id_user', $id)->first();
        if($cek)
        {
            try {
                Supir::where('id_user', $id)->update([
                    'nama_supir' => $request->nama_supir,
                    'ttl_supir' => $request->ttl_supir,
                    'no_telpon' => $request->no_telpon,
                    'jenis_kendaraan' => $request->jenis_kendaraan,
                    'jml_kursi' => $request->jml_kursi,
                    'jml_sisa_kursi' => $request->jml_kursi,
                    'status' => $request->status
                ]);

                User::where('id', $id)->update([
                    'name' => $request->nama_supir
                ]);

                return redirect()->to('supir')->with('success', 'Data berhasil diubah');
            } catch(Exception $e)
            {
                throw new Exception($e->getMessage());
            }
        } else {
            return redirect()->to('supir')->with('error', 'Data tidak ditemukan');
        }
    }
}
