<?php

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

if (!function_exists('get_eval_points')) {
  function get_eval_points($id)
  {
    return App\Models\Evaluation::where('target_user_id', $id)
      ->pluck('evaluation_point')
      ->toArray();
  }
}

if (!function_exists('eval_count')) {
  function eval_count($id)
  {
    $eval_points = get_eval_points($id);
    return count($eval_points);
  }
}

if (!function_exists('eval_avg')) {
  function eval_avg($id)
  {
    $eval_points = get_eval_points($id);
    $sum = array_sum($eval_points);
    $avg = $sum != 0 ? $sum / count($eval_points) : 0;
    $TEN_TIMES = 10;
    return intval(round($avg) * $TEN_TIMES);
  }
}

if (!function_exists('eval_by_gen')) {
  function eval_by_gen($id)
  {
    $user = App\Models\User::find($id);

    $results = [];

    if (!$user) {
      // 指定されたIDのユーザーが存在しない場合の処理
      return $results;
    }

    $gender = $user->gender;

    $evaluations = App\Models\Evaluation::join('users', function ($join) use ($gender) {
      $join->on('evaluations.target_user_id', '=', 'users.id')
        ->where(function ($query) use ($gender) {
          $query->where('users.gender', $gender)
            ->orWhere('users.gender', 0)
            ->orWhere('users.gender', 1);
        });
    })
      ->pluck('evaluations.evaluation_point')
      ->toArray();

    // dd($evaluations);

    if (empty($evaluations)) {
      // 評価ポイントが存在しない場合の処理
      return $results;
    }

    $sum = array_sum($evaluations);

    // dd($sum);

    $avg = $sum / count($evaluations);

    $TEN_TIMES = 10;
    $avg_point = intval(round($avg * $TEN_TIMES));
    $results[] = strval($avg_point);

    return $results;
  }
}
