<?php

namespace App\Jobs;

use App\Mail\KullaniciKayitMail;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendUserVerificationMail
{
    use Dispatchable;
    use InteractsWithQueue;
    use SerializesModels;

    private $user;
    private $email;

    /**
     * Create a new job instance.
     *
     * @param mixed $email
     * @param mixed $user
     */
    public function __construct($email, $user)
    {
        $this->user = $user;
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to($this->email)->send(new KullaniciKayitMail($this->user));
    }
}
