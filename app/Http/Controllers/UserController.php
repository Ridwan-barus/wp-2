<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ImageHelper;

class UserController extends Controller
{
    public function edit($id){
        if(Auth::user()->id != $id){
            return redirect()->back()->with('error', 'Akses ditolak.');
        }
        $user = User::findOrFail($id);
        return view('frontend.user.edit', compact('user'));
    }

    public function update(Request $request, $id){
        //dd("Masuk controller update");
        $user = User::findOrFail($id);

        $rules = [
            'nama' => 'required|max:255',
            // 'role' => 'required',
            // 'status' => 'required',
            'hp' => 'required|min:10|max:13',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
            'password' => 'nullable|min:6|confirmed',
        ];

        if ($request->email != $user->email) {
            $rules['email'] = "required|email|max:255|unique:user,email,$id";
        }
        $validated = $request->validate($rules);


        //update foto jika ada
        if($request->file('foto')){
            //hapus foto lama
            if($user->foto){
                $pathLama = public_path('storage/img-user/' . $user->foto);
                if(file_exists($pathLama)){
                    unlink($pathLama);
                }
            }
            
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();

            $fileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;

            ImageHelper::uploadAndResize(
                $file,
                'storage/img-user/',
                $fileName,
                385, //width
                400 //height auto
            );
            $validated['foto'] = $fileName;
        }

        //update password jika diisi
        if($request->password){
            $validated['password'] = bcrypt($request->password);
        } else{
            //tetap gunakan password lama jika tak ada input
            $validated['password'] = $user->password;
        }

        //update field lain
        $validated['nama'] = $request->nama;
        $validated['email'] = $request->email;
        $validated['hp'] = $request->hp;

        $user->update($validated);

        return redirect()->route('beranda')->with('success', 'Profil berhasil diperbarui.');
    }
}
