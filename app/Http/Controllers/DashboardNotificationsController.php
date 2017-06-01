<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;

class DashboardNotificationsController extends Controller
{
    /**
     * DashboardNotificationsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = tap(auth()->user(), function (User $user) {
            $user->setRelation('notifications', $user->notifications()->paginate(15));
        });

        return view('dashboard.notifications.index', compact('user'));
    }

    public function destroy($id)
    {
        auth()->user()->notifications()->where('id', $id)->firstOrFail()->markAsRead();
    }

    public function destroyAll()
    {
        auth()->user()->unreadNotifications()->update(['read_at' => Carbon::now()]);

        flash()->info(__('All notifications have been marked as read.'));

        return redirect()->back();
    }
}
