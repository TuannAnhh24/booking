<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {}

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('is_valid_image', function ($attribute, $value, $params, $validator) {
            $base64Image = trim($value);
            $search = substr($base64Image, 0, strpos($base64Image, ",") + 1);

            // get image extension
            $imageExtension = substr(
                $search,
                strpos($search, "/") + 1,
                strpos($search, ";") - (strpos($search, "/") + 1)
            );

            return in_array($imageExtension, ['jpeg', 'jpg', 'png']);
        });

        Validator::extend('is_valid_size_image', function ($attribute, $value) {
            $sizeInBytes = (int) (strlen(rtrim($value, '=')) * 3 / 4);
            $sizeInKb = $sizeInBytes / 1000;
            $sizeInMb = $sizeInKb / 1000;

            return $sizeInMb <= 2;
        });
        View::composer('admin.layouts.navbar', function ($view) {
            $notifications = Notification::with('users') // Tải thông tin user liên kết
                ->latest()
                ->get();
            $unreadCount = Notification::where('read', false)->count(); // Đếm số thông báo chưa đọc

            $view->with('notifications', $notifications)->with('unreadCount', $unreadCount);
        });
    }
}
