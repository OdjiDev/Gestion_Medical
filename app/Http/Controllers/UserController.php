<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;




class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->q;
        $users = User::where('name', 'like', "%$q%")
        ->orWhere('email', 'like', "%$q%")
        ->paginate(10);
        //$usersCount = User::count();
      
    return view('partials.users', compact('users')); // envoie la variable $users à la vue
    
        //
        //  $users = Users::paginate(10);
    // return view('users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $roles = Role::pluck('name');
    return view('partials.Ajout_user', compact('roles'));
}

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email',
        'telephone' => 'required|string|min:8|max:8|regex:/^[0-9]+$/',
        'role' => 'required|string',
        'password' => 'required|string|min:6',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'telephone' => $validated['telephone'],
        'password' => bcrypt($validated['password']),
        'avatar' => 'undraw_profile.svg',
    ]);

    // assignation rôle Spatie
    $user->syncRoles([$validated['role']]);

    return redirect('/users')->with('success', 'Utilisateur créé avec succès');
}

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        return view('partials.profile', compact('user'));
        
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
          return view('partials.edit_user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'telephone' => 'required|string',
        'role' => 'required|string',
        'password' => 'nullable|string|min:6',
    ]);

    $data = [
        'name' => $validated['name'],
        'email' => $validated['email'],
        'telephone' => $validated['telephone'],
    ];

    // password si rempli
    if (!empty($validated['password'])) {
        $data['password'] = bcrypt($validated['password']);
    }

    // update user
    $user->update($data);

    // update role Spatie
    $user->syncRoles([$validated['role']]);

    return redirect('/users')->with('success', 'Utilisateur modifié avec succès');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return redirect('/users')->with('delete','Utilisateur supprimer avec succès');
    }

   public function photo(Request $request , $id )
{
    $request->validate([
        'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);
$user = User::findOrFail($id);
//dd($user);
    if ($request->hasFile('avatar')) {

        $file = $request->file('avatar');

        $filename = time().'_'.$user->id.'.'.$file->extension();

        // stockage correct
        $file->storeAs('avatars', $filename, 'public');

        // update DB
        $user->avatar = $filename;
        $user->save();
    }

    return back()->with('success', 'Photo mise à jour');
}
public function logout(Request $request)
{
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
}



    }

    
    

