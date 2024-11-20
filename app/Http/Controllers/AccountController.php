<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Models\User;
use App\Models\Donor;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Flasher\Toastr\Prime\ToastrInterface;


class AccountController extends Controller
{
    public function register(){
        return view('account.register');
    }
    
    public function processRegister(HttpRequest $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required | min:3',
            'email' => 'required | email',
            'age' => 'required',
            'bloodgroup' => 'required',
            'phone' => 'required',
            'password' => 'required | confirmed | min:8',
            'password_confirmation' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->route('account.register')->withInput()->withErrors($validator);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->age = $request->age;
        $user->bloodgroup = $request->bloodgroup;
        $user->phone = $request->phone;

        $user->password = Hash::make($request->password);
        $user->save();
        toastr()->timeout(10000)->closeButton()->addSuccess('You have registered successfully.');
        return redirect()->route('account.login');
    }
    
    public function login(){
        return view('account.login');
    }

    public function authenticate(HttpRequest $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required | email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            toastr()->timeout(10000)->closeButton()->addSuccess('You have login successfully.');
            return redirect()->route('account.index');
            
        } else {
            toastr()->timeout(10000)->closeButton()->addError('Either mail/password is incorrect');
            return redirect()->route('account.login');
        }
    }

    public function index(){
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $your_donation_count = Donor::where('user_id', $userid)->get()->count();
            $your_received_request = Request::where('receiver_id', $user->id)->get()->count();
            $your_sent_request = Request::where('sender_id', $user->id)->get()->count();
        }
        return view('account.index', compact('your_donation_count','your_received_request','your_sent_request'));
    }

    public function donate(){
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $your_donation_count = Donor::where('user_id', $userid)->get()->count();
            $your_received_request = Request::where('receiver_id', $user->id)->get()->count();
            $your_sent_request = Request::where('sender_id', $user->id)->get()->count();
        }
        
        return view('account.donate', compact('your_donation_count','your_received_request','your_sent_request'));
    }

    public function registerDonor(HttpRequest $request){
        $user = Auth::user();
        $user_id = $user->id;

        $donor = new Donor();
        $donor->name = $request->name;
        $donor->email = $request->email;
        $donor->age = $request->age;
        $donor->bloodgroup = $request->bloodgroup;
        $donor->city = $request->city;
        $donor->phone = $request->phone;
        $donor->user_id = $user_id;
        $donor->save();

        toastr()->timeout(10000)->closeButton()->addSuccess('Your Donation added Successfully.');

        return redirect()->route('account.yourDonations');
    }

    public function yourDonations(){
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $donation = Donor::where('user_id', $userid)->get();
            $your_donation_count = Donor::where('user_id', $userid)->get()->count();
            $your_received_request = Request::where('receiver_id', $user->id)->get()->count();
            $your_sent_request = Request::where('sender_id', $user->id)->get()->count();

        }
        
        return view('account.yourDonations', compact('donation','user', 'your_donation_count' ,'your_received_request','your_sent_request'));
    }

    public function delete_donation($id){
        $donation1=Donor::find($id);
        $donation1->delete();
        toastr()->closeButton()->addSuccess('Donation deleted successfully.');

        return redirect()->back();
    }
    
    public function require(){
        if (Auth::check()) {
            $user = Auth::user();
            $donation = Donor::where('user_id', '!=', $user->id)->get();
            $your_donation_count = Donor::where('user_id', $user->id)->get()->count();
            $your_received_request = Request::where('receiver_id', $user->id)->get()->count();
            $your_sent_request = Request::where('sender_id', $user->id)->get()->count();
        }
        
        return view('account.require', compact('donation', 'user', 'your_donation_count','your_received_request','your_sent_request'));
        
    }

}

