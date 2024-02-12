<?php

namespace App\Http\Controllers;

use App\Models\User;
use Database\Seeders\UserSeeer;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = [
            'title' => 'List User'
        ];

        if($request->get('q')){
            $users = User::where('type', '!=', 'super_admin')->where('name', 'like', "%" . $request->get('q') ."%")->paginate(15);
            $data['users'] = $users;
            $data['q'] = $request->get('q'); 
        } else {
            $users = User::where('type', '!=', 'super_admin')->paginate(15);
            $data['users'] = $users;
        }   

        return view('super_admin.list_data', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('super_admin.add', [
            'title' => 'List User'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'type' => 'required',
            'password'=> 'required'
        ]);
        

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'type' => $request->type,
            'password' => Hash::make($request->password)
        ]);
        return redirect('/e-container-content/users');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('super_admin.edit', [
            'user' => $user,
            'title' => 'List User'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'type' => 'required',
        ]);

        $user->name = $request->post('name');
        $user->username = $request->post('username');
        $user->type = $request->post('type');
        $user->save();
        
        return redirect('/e-container-content/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return back();
    }
}
