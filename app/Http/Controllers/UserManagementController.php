<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super_admin,admin');
    }

    public function index()
    {
        $users = User::with('creator')
            ->orderBy('role')
            ->orderBy('name')
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $currentUser = Auth::user();

        // GUNAKAN KONSTANTA DARI MODEL
        $roles = $currentUser->isSuperAdmin()
            ? [
                User::ROLE_ADMIN => 'Admin',
                User::ROLE_KASIR => 'Kasir'
            ]
            : [
                User::ROLE_KASIR => 'Kasir'
            ];

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $currentUser = Auth::user();

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:' . User::ROLE_ADMIN . ',' . User::ROLE_KASIR,
            'phone'    => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Hanya super admin yang bisa membuat admin
        if ($request->role === User::ROLE_ADMIN && !$currentUser->isSuperAdmin()) {
            abort(403, 'Unauthorized to create admin accounts.');
        }

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => $request->role,
            'phone'      => $request->phone,
            'is_active'  => true,
            'created_by' => $currentUser->id,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $currentUser = Auth::user();

        // CEK AKSES
        if (!$currentUser->isSuperAdmin() && $user->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit admin.');
        }

        // CEK JANGAN SAMPAI SUPER ADMIN DIEDIT
        if ($user->isSuperAdmin() && !$currentUser->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit Super Admin.');
        }

        $roles = $currentUser->isSuperAdmin()
            ? [
                User::ROLE_ADMIN => 'Admin',
                User::ROLE_KASIR => 'Kasir'
            ]
            : [
                User::ROLE_KASIR => 'Kasir'
            ];

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $currentUser = Auth::user();

        // CEK AKSES
        if (!$currentUser->isSuperAdmin() && $user->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate admin.');
        }

        if ($user->isSuperAdmin() && !$currentUser->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate Super Admin.');
        }

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role'      => 'required|in:' . User::ROLE_ADMIN . ',' . User::ROLE_KASIR,
            'phone'     => 'nullable|string|max:20',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // CEK PERUBAHAN ROLE
        if ($request->role === User::ROLE_ADMIN && !$currentUser->isSuperAdmin()) {
            abort(403, 'Unauthorized to assign admin role.');
        }

        // JANGAN BIARKAN SUPER ADMIN DIGANTI ROLE-NYA
        if ($user->isSuperAdmin() && $request->role !== User::ROLE_SUPER_ADMIN) {
            abort(403, 'Tidak dapat mengubah role Super Admin.');
        }

        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'is_active' => $request->has('is_active'),
        ];

        // HANYA SUPER ADMIN YANG BISA MENGAKTIFKAN/NONAKTIFKAN ADMIN
        if ($user->isAdmin() && !$currentUser->isSuperAdmin()) {
            unset($data['is_active']); // HAPUS is_active dari update
        }

        // UPDATE ROLE HANYA JIKA BERBEDA DAN DIIZINKAN
        if ($user->role !== $request->role) {
            if ($user->isSuperAdmin()) {
                abort(403, 'Tidak dapat mengubah role Super Admin.');
            }
            $data['role'] = $request->role;
        }

        $user->update($data);

        // UPDATE PASSWORD JIKA ADA
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8|confirmed']);
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        $currentUser = Auth::user();

        if (!$currentUser->isSuperAdmin()) {
            abort(403, 'Hanya Super Admin yang bisa menghapus user.');
        }

        if ($user->isSuperAdmin()) {
            abort(403, 'Tidak bisa menghapus Super Admin.');
        }

        if ($user->id === $currentUser->id) {
            abort(403, 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    public function toggleActive(User $user)
    {
        $currentUser = Auth::user();

        if (!$currentUser->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access.'
            ], 403);
        }

        // CEK JIKA YANG DITOGGLE ADALAH ADMIN DAN BUKAN SUPER ADMIN
        if ($user->isAdmin() && !$currentUser->isSuperAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk mengubah status admin.'
            ], 403);
        }

        // JANGAN BIAARKAN SUPER ADMIN DINONAKTIFKAN
        if ($user->isSuperAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat mengubah status Super Admin.'
            ], 403);
        }

        $user->update([
            'is_active' => !$user->is_active
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Status user berhasil diubah.',
            'is_active' => $user->is_active
        ]);
    }
}
