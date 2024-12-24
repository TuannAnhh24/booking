<div class="favorite-list-item">
    @if($user)
        <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
            style="background-image: url('{{  ($user->avatar ?? asset('image/avatar_default.png')) }}');">
        </div>
        <p>{{ strlen($user->user_name) > 5 ? substr($user->user_name,0,6).'..' : $user->user_name }}</p>
    @endif
</div>
