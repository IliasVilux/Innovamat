<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ActivityApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function getCurrentActivity()
    {
        $user = Auth::User();
        $apiRequest = (new ActivityApiController)->show($user->currentActivity);
        if ($apiRequest === false)
        {
            return redirect()->route('activity.end');
        } else {
            return view('activity.activity', compact('apiRequest', 'user'));
        }
    }

    public function checkActivity(Request $request)
    {
        $user = Auth::User();
        $apiRequest = (new ActivityApiController)->nextActivity($request, $user);
        if ($apiRequest === false)
        {
            return redirect()->route('activity.end');
        } else {
            return redirect()->route('activity.activity');
        }
        
    }

    public function endItinerary()
    {
        return view('activity.end');
    }
}
