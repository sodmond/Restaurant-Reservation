<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Unicodeveloper\Paystack\Facades\Paystack;

class BookingsController extends Controller
{
    public function index($search = "")
    {
        if ($search != "") {
            $bookings = Booking::where('email', 'LIKE', "%$search%")
                ->orWhere('phone', 'LIKE', "%$search%")->orderByDesc('created_at')->paginate(15);
            return view('admin.bookings', compact('bookings', 'search'));
        }
        $bookings = Booking::orderByDesc('created_at')->paginate(15);
        return view('admin.bookings', compact('bookings'));
    }

    public function view($id)
    {
        $booking = Booking::find($id);
        $payment = DB::table('transactions')->where('booking_id', $booking->id)->first();
        return view('admin.bookings_view', compact('booking', 'payment'));
    }

    public function booking(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => 'required|numeric',
            'event_center_id' => 'required|integer',
            'price' => 'required|numeric',
            'event_date' => 'required|date',
            'scheduled_time' => 'required|string',
        ]);
        $meta = $request->all();
        $data = [
            'amount'    => ($request->price * 100),
            'email'     => $request->email,
            'currency'  => 'NGN',
            'reference' => Paystack::genTranxRef(),
            'metadata'      => $meta,
        ];
        $pay = new PaymentController;
        return $pay->redirectToGateway($data);
    }

    public function search()
    {
        if (isset($_GET['search'])) {
            return redirect()->route('admin.bookings.search.result', ['search' => $_GET['search']]);
        }
        return redirect('/');
    }

    public function cancel($id)
    {
        if (isset($id)) {
            try {
                $booking = Booking::find($id);
                $booking->status = false;
                DB::table('transactions')->where('booking_id', $booking->id)->update(['status' => 'refunded']);
                $booking->save();
                return back()->with('success', 'Booking has been cancelled');
            } catch (\Exception $e) {
                Log::info($e->getMessage());
                return back()->withErrors(['booking_cancel_failed' => 'Problem encountered with booking cancellation, pls try again.']);
            }
        }
        return redirect()->route('admin.bookings');
    }
}
