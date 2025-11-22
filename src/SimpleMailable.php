<?php

declare(strict_types=1);

namespace Alphavel\Mail;

/**
 * Simple Mailable Implementation
 * 
 * Used by PendingMail for inline emails
 * Performance: Minimal overhead, no class generation
 */
class SimpleMailable extends Mailable
{
    public function __construct(
        array $to,
        ?string $subject,
        string $view,
        array $data = [],
        array $cc = [],
        array $bcc = [],
        array $attachments = []
    ) {
        $this->to = $to;
        $this->subject = $subject ?? '';
        $this->view = $view;
        $this->data = $data;
        $this->cc = $cc;
        $this->bcc = $bcc;
        $this->attachments = $attachments;
    }
    
    public function build(): self
    {
        // Already built in constructor
        return $this;
    }
}
