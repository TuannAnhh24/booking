<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserStatusUpdated extends Mailable
{
    use SerializesModels;

    public $user;
    public $status;
    public $statusMessage;

    public function __construct($user, $status)
    {
        $this->user = $user;
        $this->status = $status;

        if ($status == 'locked') {
            $this->statusMessage = __('content.update_status.account_locked');
        } else {
            $this->statusMessage = __('content.update_status.account_activated');
        }
    }

    public function build()
    {
        return $this->subject(__('content.update_status.account_status_update_subject'))
            ->view('emails.user_status_updated', [
                'user' => $this->user,
                'statusMessage' => $this->statusMessage,
            ]);
    }
}
