<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;
use App\Models\User;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Auth;

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
        $user = User::find($id);
        return view('evaluations.evaluate', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvaluationRequest $request)
    {
        //
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
