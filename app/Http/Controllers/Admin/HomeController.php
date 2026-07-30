<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use App\Models\Course;
use App\Models\Payment;
use App\Models\CourseSubscription;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);

        $title = "الاداره: ".__('messages.Dashboard');

        $first_day_year = date('Y-m-d', strtotime('first day of january this year'));
        $last_day_year = date('Y') . '-12-31';

        $count_admins = Admin::where('position_id', 1)->whereBetween('created_at', [$first_day_year, $last_day_year])->count();
        $count_users = Admin::where('position_id', 2)->whereBetween('created_at', [$first_day_year, $last_day_year])->count();
        $count_courses = Course::count();
        $count_pending_payments = Payment::where('status', 'pending')->count();
        $count_approved_users = Payment::where('status', 'approved')->count();
        $count_pending_subscriptions = CourseSubscription::where('status', 'pending')->count();
        $count_active_subscriptions = CourseSubscription::activeAccess()->count();

        return view('auth.admin.dashboard', [
            'title' => $title,
            'count_admins' => $count_admins,
            'count_users' => $count_users,
            'count_courses' => $count_courses,
            'count_pending_payments' => $count_pending_payments,
            'count_approved_users' => $count_approved_users,
            'count_pending_subscriptions' => $count_pending_subscriptions,
            'count_active_subscriptions' => $count_active_subscriptions,
            'objAdmin' => $objAdmin,
        ]);
    }
}
