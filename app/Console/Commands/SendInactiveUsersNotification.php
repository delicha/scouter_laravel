<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use App\Notifications\InactiveUserNotification;

class SendInactiveUsersNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inactive-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send push notifications to inactive users.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 最終ログイン日時が3日以上前のユーザーを取得する
        $inactiveUsers = User::where('last_login_at', '<', Carbon::now()->subDays(3))->get();

        // 取得したユーザーにプッシュ通知を送信する
        foreach ($inactiveUsers as $user) {
            $user->notify(new InactiveUserNotification);
        }
    }
}
