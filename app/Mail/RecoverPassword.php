<?php

namespace App\Mail;

use App\Models\UserAdministration\User;
use App\Models\UserAdministration\Recover;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecoverPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User;
     */
    protected $user;

    /**
     * @var User;
     */
    protected $recover;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Recover $recover)
    {
        $this->user = $user;
        $this->recover = $recover;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view(
            'emails.users.recover',
            [
                'user' => $this->user,
                'recover' => $this->recover,
            ]
        );
    }
}
