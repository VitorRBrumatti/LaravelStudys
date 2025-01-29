<?php

use App\Mail\WelcomeMail;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('send-welcome-mail', function () {
    Mail::to('vitorrufino084@gmail.com')->send(new WelcomeMail("Vitor"));
})->purpose('Send welcome mail');
