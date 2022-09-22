<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        $event_centers = DB::table('event_centers')->get();
        return view('admin.settings', compact('event_centers'));
    }

    public function eventCenter($id)
    {
        if ($id !== 'new') {
            $event_center = DB::table('event_centers')->where('id', $id)->first();
            return view('admin.event_center', compact('event_center'));
        }
        $newStatus = 'Add New Reservation Space';
        return view('admin.event_center', compact('newStatus'));
    }

    public function addOrUpdateEventCenter(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'price' => 'required|numeric',
            'capacity' => 'required|numeric',
        ]);
        if (isset($request->event_center_id)) {
            DB::table('event_centers')->where('id', $request->event_center_id)->update([
                'title' => $request->title,
                'price' => $request->price,
                'capacity' => $request->capacity,
                'status' => $request->status,
                'updated_at' => now(),
            ]);
            return back()->with('suc_msg', 'Event Center details has been updated');
        }
        DB::table('event_centers')->insert([
            'title' => $request->title,
            'price' => $request->price,
            'capacity' => $request->capacity,
            'created_at' => now(),
        ]);
        return redirect()->route('admin.settings')->with('suc_msg', 'New Event Center has been added');
    }

    public function trashEventCenter($id)
    {
        DB::table('event_centers')->where('id', $id)->delete();
        return back()->with('suc_msg', 'Event Center has been deleted');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());
        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);
        return back()->withStatusPassword(__('Password successfully updated.'));
    }
    
}
