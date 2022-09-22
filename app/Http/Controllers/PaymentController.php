<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmation;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    public function index()
    {
        $transactions = DB::table('transactions')->orderByDesc('created_at')->paginate(15);
        return view('admin.payments', compact('transactions'));
    }

    public function view($id)
    {
        return view('admin.payments_view');
    }

    public function redirectToGateway($data)
    {
        try {
            return Paystack::getAuthorizationUrl($data)->redirectNow();
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return back()->with(['err_msg'=>'The paystack token has expired. Please refresh the page and try again.']);
        }
    }

    public function handleGatewayCallback()
    {
        $payment = Paystack::getPaymentData();
        //dd($payment);
        if ($payment['status'] == true) {
            $paymentData = $payment['data'];
            $paymentMeta = $payment['data']['metadata'];
            //dd($paymentData);
            DB::beginTransaction();
            $booking = new Booking;
            $booking->event_center_id = $paymentMeta['event_center_id'];
            $booking->name = $paymentMeta['name'];
            $booking->phone = $paymentMeta['phone'];
            $booking->email = $paymentMeta['email'];
            $booking->scheduled_time = $paymentMeta['scheduled_time'];
            $booking->guests = 0;
            $booking->event_date = $paymentMeta['event_date'];
            if ($booking->save()) {
                DB::table('transactions')->insert([
                    'booking_id' => $booking->id,
                    'amount' => $paymentData['amount'] / 100,
                    'reference' => $paymentData['reference'],
                    'status' => 'completed',
                    'created_at' => now(),
                ]);
                DB::commit();
            }
            Mail::to($booking->email)->bcc('reservation@lobstercribrestaurant.com')->send(new BookingConfirmation($booking, $paymentMeta['event_center'], $paymentData['reference']));
            $convDate = date('l jS \of F Y', strtotime($paymentMeta['event_date']));
            unset($_COOKIE['availablity']); unset($_COOKIE['space']);
            return redirect('/')->with('success', 'You have booked the ' . $paymentMeta['event_center'] . ' for ' . $convDate . ' at ' . $paymentMeta['scheduled_time']);
        }
        return back()->with('err_msg', "Payment couldn't be completed, pls try again.");
    }
}
