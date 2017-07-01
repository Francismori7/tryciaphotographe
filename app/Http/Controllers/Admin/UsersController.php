<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view all users');

        if(request()->query('search')) {
            $users = User::search(request()->query('search'))
                ->orderBy('name')
                ->paginate(25)
                ->appends(request()->query());
        }
        else {
            $users = User::orderBy('name')->paginate(25);
        }

        $totalUsers = Cache::remember('users.count', 10, function () {
            return User::count();
        });
        $weeklyNewUsers = Cache::remember('users.weeklyNewUsers', 60 * 24, function () {
            return User::where('created_at', '>=', Carbon::now()->startOfWeek())->count();
        });
        $totalActivatedUsers = Cache::remember('users.activatedCount', 10, function () {
            return User::whereNotNull('activated_at')->count();
        });

        return view('admin.users.index', compact('users', 'totalUsers', 'weeklyNewUsers', 'totalActivatedUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view all users');

        $user->load('connectedAccounts', 'roles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
