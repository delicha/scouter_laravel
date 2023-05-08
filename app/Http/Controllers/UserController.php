<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Point;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::inRandomOrder()->paginate(10);

        return view('dashboard', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $auth = Auth::user();
        $point = Point::where('user_id', $auth->id)->first();

        $user = User::find($id);
        $ticket = Ticket::where('user_id', $auth->id)
            ->where('target_user_id', $user->id)
            ->whereDate('updated_at', '>=', now()->subDay())
            ->first();

        $total = eval_avg($id);
        $count = eval_count($id);
        $gen = eval_by_gen($id);

        return view('users.show', compact('user', 'auth', 'point', 'total', 'count', 'gen', 'ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function gain_ticket($id)
    {
        $auth = Auth::user();
        $point = Point::where('user_id', $auth->id)->first();
        $user = User::find($id);

        $ticket = Ticket::Create(
            [
                'user_id' => $auth->id,
                'target_user_id' =>  $user->id,
            ],

        );

        $point = Point::where('user_id', $auth->id)->first();

        $LOSE_POINT = 3;

        $result = ($point->point - $LOSE_POINT) < 0 ? 0 : $point->point - $LOSE_POINT;

        $point->update(

            ['point' => $result]
        );

        $total = eval_avg($id);
        $count = eval_count($id);
        $gen = eval_by_gen($id);

        return redirect()->route('users.show', compact('user', 'auth', 'point', 'total', 'count', 'gen', 'ticket'))
            ->with('message', '3ポイント消費しました。このユーザーの評価を24時間閲覧できます！');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
