<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('presence-video-chat', function ($user) {
    //로그인한 사용자가 이채널을 구독할수 있는지 여부 판단
    //아규 먼트 유저로 현재로그인 한 사용자 넘어옴
    if (Auth::check()) {
        return ['id' => $user->id, 'name' => $user->name];
    }
});
