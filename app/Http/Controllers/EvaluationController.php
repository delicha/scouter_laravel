<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;
use App\Models\User;
use App\Models\Evaluation;
use App\Models\Point;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth = Auth::user();

        $evaluations = Evaluation::where('target_user_id', $auth->id)->get();

        $eval_ids = Evaluation::where('target_user_id', $auth->id)
            ->pluck("user_id")
            ->toArray();

        $users = User::whereIn("id", $eval_ids)
            ->get();


        return view('evaluations.index', compact('evaluations', 'auth', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function evaluate($id)
    {
        $auth = Auth::user();
        $user = User::find($id);
        return view('evaluations.evaluate', compact('user', 'auth'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvaluationRequest $request)
    {
        $evaluation = Evaluation::create([
            'user_id' => $request->user_id,
            'target_user_id' => $request->target_user_id,
            'evaluation_point' => intval($request->options),
        ]);

        $GAIN_POINT = 1;

        // 評価してポイント取得
        $user_point = Point::where('user_id', $request->user_id)->first();

        if (!is_null($user_point)) {
            $user_point->update([
                'user_id' => $request->user_id,
                'point' => $user_point->point + $GAIN_POINT
            ]);
        } else {
            $user_point = Point::create([
                'user_id' => $request->user_id,
                'point' => 0 + $GAIN_POINT
            ]);
        }

        // 相手にもポイント贈与
        $user_point_given = Point::where('user_id', $request->target_user_id)->first();

        if (!is_null($user_point_given)) {
            $user_point_given->update([
                'user_id' => $request->target_user_id,
                'point' => $user_point_given->point + $GAIN_POINT
            ]);
        } else {
            $user_point_given = Point::create([
                'user_id' => $request->target_user_id,
                'point' => 0 + $GAIN_POINT
            ]);
        }

        return redirect()->route('users.show', $request->target_user_id)->with('message', '評価をして1ポイント獲得、評価相手も1ポイント獲得しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEvaluationRequest $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }
}
