<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        $data = User::with('lead')->orderBy('first_name')->where('user_Type', '!=', 1)->where('id', '!=', Auth::user()->id)->paginate(10);
        return view('agent.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $teamLeaders = User::orderBy('first_name')->where('user_type', 2)->paginate(10);
        return view('agent.create', compact('teamLeaders'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email', 'max:245', 'unique:users'],
            'phone' => ['required', 'string', 'max:15', 'unique:users', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'user_type' => !isset($request->team_leader) ? 2 : 3,
            'user_id' => $request->team_leader ?? null,
            'picture' => '',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ];

        // dd($data);
        User::create($data);

        return redirect()->route('agent.index')->with('success','Record created successfully');
    }

    public function show(User $user)
    {
        if (!empty($user)) {

            $data = [
                'user' => $user
            ];
            return view('agent.show', $data);

        } else {
            return redirect()->route('agent.index');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $teamLeaders = User::orderBy('first_name')->where('id', '!=', $id)->where('user_type', 2)->paginate(10);
        return view('agent.edit', compact('user', 'teamLeaders'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:150'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'user_type' => !isset($request->team_leader) ? 2 : 3,
            'user_id' => $request->team_leader ?? null,
            'picture' => '',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address ?? null,
        ];

        if ($request->has('password') && $request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        User::find($id)->update($data);
        return redirect()->route('agent.index')->with('success','Updated successfully');
    }

    public function destroy(User $user)
    {
        User::find($user->id)->delete();
        return redirect()->route('agent.index')->with('success', 'Deleted successfully');
    }
}
