<?php

namespace App\Http\Controllers;
use App\Models\Request;
use App\Models\User;
use App\Models\Donor;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(HttpRequest $request)
    {
        $request->validate([
            'Type' => 'required',
            'City' => 'required',
        ]);

        $bloodgroup = $request->input('Type');
        $city = $request->input('City');

        
        if (Auth::check()) {
            $user = Auth::user();
            $donation = Donor::where('user_id', '!=', $user->id)
                        ->where('bloodgroup', $bloodgroup)
                        ->where('city', $city)
                        ->get();
            // return view('account.require', compact('donation', 'user'));
        }
        $user = auth()->user();
        $requests = Request::where('receiver_id', $user->id)->get();
        $your_received_request = Request::where('receiver_id', $user->id)->get()->count();
        $your_sent_request = Request::where('sender_id', $user->id)->get()->count();

        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $your_donation_count = Donor::where('user_id', $userid)->get()->count();
        }
        return view('account.require', compact('donation', 'user','your_donation_count','your_sent_request','your_received_request'));
        
    }
}
