<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Symfony\Component\Console\Input\Input;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $event_centers = DB::table('event_centers')->get();
        return view('welcome', compact('event_centers'));
    }

    public function checkBooking(Request $request)
    {
        $validTime = ['09:00 AM', '12:00 PM', '15:00 PM', '18:00 PM'];
        $this->validate($request, [
            'event_center' => ['required', 'integer'],
            'event_date' => ['required', 'date', 'after:today'],
            'scheduled_time' => ['required', 'string', Rule::in($validTime)],
        ]);
        $getBookings = Booking::where([
            ['event_center_id', $request->event_center],
            ['event_date', $request->event_date],
            ['scheduled_time', $request->scheduled_time],
            ['status', true],
        ])->get();
        //dd($getBookings);
        if ($getBookings->count() < 1) {
            //dd($request->all());
            $availablity = $request->all();
            $space = DB::table('event_centers')->where('id', $request->event_center)->first();
            $expiry = time()+60*30;
            setcookie('availablity', json_encode($availablity), $expiry);
            setcookie('space', json_encode($space), $expiry);
            //return view('reservation', compact('availablity', 'space'));
            return redirect()->route('booking');
        }
        return back()->withErrors(['event_date_ops' => 'Reservation space not available for that day and time']);
    }

    public function booking(Request $request)
    {
        if ((! isset($_COOKIE['availablity'])) && (! isset($_COOKIE['space']))) {
            return redirect('/');
        }
        $availablity = json_decode($_COOKIE['availablity'], true);
        $space = json_decode($_COOKIE['space'], true);
        //dd($space);
        return view('reservation', compact('availablity', 'space'));
    }

    public function adminHome()
    {
        $bookings_total = Booking::count();
        $bookings_today = Booking::whereRaw('DATE(created_at) = CURDATE()')->count();
        $bookings_yesterday = Booking::whereRaw('DATE(created_at) = SUBDATE(CURDATE(),1)')->count();
        $payments_count = DB::table('transactions')->count();
        $payments_total = DB::table('transactions')->sum('amount');
        $payments_today = DB::table('transactions')->whereRaw('DATE(created_at) = CURDATE()')->sum('amount');
        return view('admin.home', [
            'bookings_total' => $bookings_total, 
            'bookings_today' => $bookings_today,
            'bookings_yesterday' => $bookings_yesterday,
            'payments_count' => $payments_count,
            'payments_total' => $payments_total,
            'payments_today' => $payments_today,
        ]);
    }

    public function admin()
    {
        return redirect()->route('admin.dashboard');
    }
}
