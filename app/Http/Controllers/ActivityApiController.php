<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Exercice;
use App\Models\Interaction;

class ActivityApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($activityId)
    {
        if ($activityId == 'finished')
        {
            return false;
        }
        $activity = Activity::find($activityId);
        $exercices = Exercice::where('activity_id', $activityId)->get();
        return compact('activity', 'exercices');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function nextActivity($answers, $user)
    {
        $activity = Activity::find($user->currentActivity);
        $exercices = Exercice::where('activity_id', $user->currentActivity)->get();
        $activityResult = explode('_', $activity->solution);

        $userSolution = array();
        $contExercices = 0;
        $contCorrect = 0;
        $score = 0;

        foreach ($exercices as $exercice)
        {
            array_push($userSolution, $answers['ex'.$contExercices]);
            if($answers['ex'.$contExercices] == $activityResult[$contExercices] || str_contains($activityResult[$contExercices], $answers['ex'.$contExercices]))
            {
                $contCorrect ++;
            }
            $contExercices ++;
        }
        $userSolution = implode('_', $userSolution);

        $checkInteraction = Interaction::where('user_id', $user->id)->first();
        if($checkInteraction)
        {
            Interaction::where('user_id', $user->id)
            ->update(['activity_id' => $user->currentActivity, 'activitySolution' => $userSolution]);
        } else {
            Interaction::create([
                'user_id' => $user->id,
                'activity_id' => $user->currentActivity,
                'activitySolution' => $userSolution,
            ]);
        }

        if ($contCorrect != 0)
        {
            $score = $contCorrect/$contExercices;
            if($score >= 0.75)
            {
                $activityNumber = intval(ltrim($user->currentActivity, 'A'));
                if($activityNumber < 15)
                {
                    $user->currentActivity = 'A'. strval($activityNumber+1);
                    $user->save();
                } else {
                    $user->currentActivity = 'finished';
                    $user->save();
                    return response()->json('There are no more available activities, since the itinerary has already been completed.');
                }
            }
        }
        $activity = Activity::find($user->currentActivity);
        return compact('activity', 'exercices');
    }
}
