{{-- user info and avatar --}}
<div class="avatar av-l chatify-d-flex" style="background-image: url('{{  ($user->avatar ?? asset('image/avatar_default.png')) }}');"></div>
<p class="info-name">{{ ($user->first_name ?? "") . ' ' . ($user->last_name ?? config('chatify.name')) }}</p>
<div class="messenger-infoView-btns">
    <a href="#" class="danger delete-conversation">{{ __('content.chatuser.delete_conversation') }}</a>
</div>
{{-- shared photos --}}
<div class="messenger-infoView-shared">
    <p class="messenger-title"><span>{{ __('content.chatuser.shared_photos') }}</span></p>
    <div class="shared-photos-list"></div>
</div>
