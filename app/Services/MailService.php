<?php

namespace App\Services;

class MailService
{
    public function send(string $to, string $subject, string $html): bool
    {
        $email = service('email');
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($html);

        if (! $email->send(false)) {
            log_message('error', 'Mail error: ' . $email->printDebugger(['headers']));
            return false;
        }

        return true;
    }
}