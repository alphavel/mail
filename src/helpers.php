<?php

declare(strict_types=1);

use Alphavel\Mail\Facades\Mail;

if (!function_exists('mail')) {
    /**
     * Get mail manager instance or send email
     * 
     * Performance: O(1) - singleton access
     * 
     * @param string|array|null $to
     * @return \Alphavel\Mail\MailManager|\Alphavel\Mail\PendingMail
     */
    function mail(string|array|null $to = null)
    {
        $manager = app('mail');
        
        if ($to === null) {
            return $manager;
        }
        
        return $manager->to($to);
    }
}
