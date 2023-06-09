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
    $user_ids = App\Models\Evaluation::where('target_user_id', $id)
      ->pluck('user_id')
      ->toArray();

    $results = [];

    if (empty($user_ids)) {
      return $results = [0, 0];
    } else {
      $user_by_gen_ids = App\Models\User::whereIn('id', $user_ids)
        ->select('id', 'gender')
        ->get()
        ->groupBy('gender')
        ->map(function ($group) {
          return $group->pluck('id')->toArray();
        });

      $evaluation_points = [];

      foreach ($user_by_gen_ids as $group) {
        $evaluation_points = App\Models\Evaluation::whereIn('user_id', $group)
          ->where('target_user_id', $id)
          ->pluck('evaluation_point')
          ->toArray();
      }

      $sum = array_sum($evaluation_points);
      $avg = $sum != 0 ? $sum / count($evaluation_points) : 0;
      $TEN_TIMES = 10;
      $avg_point = intval(round($avg) * $TEN_TIMES);

      $results[] = strval($avg_point);
    }

    return $results;
  }
}
