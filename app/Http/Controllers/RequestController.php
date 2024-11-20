<?php

namespace App\Http\Controllers;
use App\Models\Request;
use App\Models\User;
use App\Models\Donor;

use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Flasher\Toastr\Prime\ToastrInterface;

class RequestController extends Controller
{
    public function sendRequestForm($donationId)
    {
        
        $donation = Donor::find($donationId);
        $users = User::where('id', '!=', Auth::id())->get();
        $user = auth()->user();
        $requests = Request::where('receiver_id', $user->id)->get();
        $your_received_request = Request::where('receiver_id', $user->id)->get()->count();
        $your_sent_request = Request::where('sender_id', $user->id)->get()->count();

        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $your_donation_count = Donor::where('user_id', $userid)->get()->count();
        }
        return view('requests.send', compact('donation', 'users','your_donation_count','your_sent_request','your_received_request'));

    }


    public function sendRequest(HttpRequest $request)
    {
        $request->validate([
            'donor_id' => 'required|exists:users,id',
            'message' => 'required|string|max:255',
        ]);

        Request::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->donor_id,
            'message' => $request->message,
        ]);

        // Redirect to a page (e.g., the received requests page) with a success message
        // return redirect()->route('requests.received')->with('success', 'Request sent successfully.');
        // return redirect()->back()->with('success','Request sent successfully.');
        toastr()->closeButton()->addSuccess('Your request sent successfully.');
        return redirect()->route('requests.yourSentRequests');
    }

    public function receivedRequests()
    {
        
        $user = auth()->user();
        $requests = Request::where('receiver_id', $user->id)->get();
        $your_received_request = Request::where('receiver_id', $user->id)->get()->count();
        $your_sent_request = Request::where('sender_id', $user->id)->get()->count();

        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $your_donation_count = Donor::where('user_id', $userid)->get()->count();
        }
        return view('requests.received', compact('requests','your_donation_count','your_received_request','your_sent_request'));

    }
    
    public function accept_request($id)
    {
        $request = Request::find($id);
        if ($request && $request->receiver_id == auth()->id()) {
            $request->request_status = 'Accepted';
            $request->save();
            toastr()->timeout(10000)->closeButton()->addSuccess('Request Accept Successfully.');
            return redirect()->back();
        }
        return redirect()->back()->with('error', 'Request not found or unauthorized action.');
    }

    public function reject_request($id)
    {
        $request = Request::find($id);
        if ($request && $request->receiver_id == auth()->id()) {
            $request->request_status = 'Rejected';
            $request->save();
            toastr()->timeout(10000)->closeButton()->addSuccess('Request Reject Successfully.');
            return redirect()->back();
        }
        return redirect()->back()->with('error', 'Request not found or unauthorized action.');
    }

    public function yourSentRequests(){
        $user = auth()->user();
        $requests = Request::where('sender_id', $user->id)->get();
        $your_sent_request = Request::where('sender_id', $user->id)->get()->count();
        $your_received_request = Request::where('receiver_id', $user->id)->get()->count();
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $your_donation_count = Donor::where('user_id', $userid)->get()->count();
        }

        return view('requests.yourSentRequests', compact('requests','your_donation_count','your_received_request','your_sent_request'));
    }

    public function delete_request($id){
        $request=Request::find($id);
        $request->delete();
        toastr()->closeButton()->addSuccess('Your request deleted successfully.');

        return redirect()->back();
    }
    
}

