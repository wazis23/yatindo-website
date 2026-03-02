<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage users');
    }

    public function index()
    {
        $users = User::with('roles')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
    
  
        $request->validate([
            'name' => 'required|string|max:40',

            'email' => [
                'required',
                'email:rfc,dns',
                'unique:users,email'
            ],

            'password' => [
                'required',
                'min:8',
                'regex:/[a-z]/',      // huruf kecil
                'regex:/[A-Z]/',      // huruf besar
                'regex:/[0-9]/',      // angka
                'regex:/[@$!%*#?&]/'  // simbol
            ],

            'role' => 'required|exists:roles,name',
        ], [
            // Custom Messages
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol.',
        ]);

        // PIN check jika super-admin
        // PIN check jika super-admin
        if ($request->role === 'super-admin') {

            if (!session('superadmin_pin_verified')) {
                return back()
                    ->withErrors(['pin' => 'PIN Super Admin salah'])
                    ->withInput();
            }

            session()->forget('superadmin_pin_verified');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')
            ->with('success','User berhasil dibuat');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'password' => [
                'nullable',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'role' => 'required'
        ]);

        if ($request->role === 'super-admin') {
            if ($request->pin_verified != "1") {
                return back()->withErrors(['pin' => 'PIN belum diverifikasi']);
            }
        }

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')
            ->with('success','User berhasil diperbarui');
    }

   public function destroy(User $user)
    {
        // Cegah hapus akun utama
        if ($user->id === 1) {
            return back()->withErrors([
                'error' => 'Akun Super Administrator tidak bisa dihapus'
            ]);
        }

        // Cegah hapus super-admin terakhir
        if ($user->hasRole('super-admin')) {

            $superAdminCount = User::role('super-admin')->count();

            if ($superAdminCount <= 1) {
                return back()->withErrors([
                    'error' => 'Minimal harus ada 1 Super Admin'
                ]);
            }
        }

        $user->delete();

        return back()->with('success','User berhasil dihapus');
    }

    public function verifyPin(Request $request)
    {
        if ($request->pin === env('SUPERADMIN_PIN')) {

            session(['superadmin_pin_verified' => true]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}