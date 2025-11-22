<?php

declare(strict_types=1);

namespace Alphavel\Mail\Facades;

use Alphavel\Facade;

/**
 * Mail Facade
 * 
 * @method static \Alphavel\Mail\PendingMail to(string|array $recipients)
 * @method static bool send(\Alphavel\Mail\Mailable $mailable)
 * @method static void queue(\Alphavel\Mail\Mailable $mailable, string $queue = 'default')
 * @method static \Symfony\Component\Mime\Email createMessage()
 * @method static bool sendMessage(\Symfony\Component\Mime\Email $message)
 * 
 * @see \Alphavel\Mail\MailManager
 */
class Mail extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'mail';
    }
}
