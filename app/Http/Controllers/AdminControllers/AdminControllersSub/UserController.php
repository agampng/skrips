<?php

namespace App\Http\Controllers\AdminControllers\AdminControllersSub;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Museum;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $museum = Museum::all();
        return view('admin.adminsub.insertusers', compact('museum'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if (isset($request->email)) {
            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => 'unique:users',
                'password' => 'required|string|min:6|confirmed',
                'roles' => 'required'
            ]);
        } else {
            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:6|confirmed',
                'roles' => 'required'
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'roles' => $data['roles'],
            'museum_id' => $data['museum_id'],
        ]);

        return redirect()->back()->with('message', 'Admin Berhasil Disimpan!');
    }

    public function show(Request $request)
    {
        $user = User::findOrFail($request->get('id'));

        return response()->json($user);
    }

    public function edit()
    {
        $museum = Museum::all();
        $user = User::where('id', '!=', auth()->user()->id)->get();

        return view('admin.adminsub.updateusers', compact('museum', 'user'));
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $item = User::findOrFail($data['select_admin']);
        if (isset($request->email)) {
            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => ['nullable', Rule::unique('users')->ignore($item, 'id')],
                'password' => 'nullable|string|min:6|confirmed',
                'roles' => 'required',
                'museum_id' => 'required'

            ]);
        } else {
            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'password' => 'nullable|string|min:6|confirmed',
                'roles' => 'required',
                'museum_id' => 'required'
            ]);
        }
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->password) {
            $data['password'] =  bcrypt($request->password);
        } else {
            unset($data['password']);
            unset($data['password_confirmation']);
        }

        $item->update($data);

        return redirect()->back()->with('message', 'Admin Berhasil Diperbarui!');
    }

    public function destroy(Request $request)
    {
        $item = User::findorFail($request->select_admin);
        $item->delete();

        return redirect()->back()->with('message','Penghapusan berhasil!');
    }

    public function showDelete()
    {
        $user = User::where('id', '!=', auth()->user()->id)->get();

        return view('admin.adminsub.deleteusers', compact('user'));
    }
}
