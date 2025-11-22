<?php

declare(strict_types=1);

namespace Alphavel\Mail;

use Alphavel\Queue\Job;

/**
 * Send Queued Mail Job
 * 
 * Performance: Async email sending with queue
 * < 0.5ms dispatch, actual sending in background
 */
class SendQueuedMailJob extends Job
{
    private Mailable $mailable;
    
    public function __construct(Mailable $mailable)
    {
        $this->mailable = $mailable;
    }
    
    /**
     * Handle job execution
     * 
     * Performance: 1-10ms depending on SMTP
     * 
     * @return void
     */
    public function handle(): void
    {
        // Get mail manager from container
        $mail = app('mail');
        
        // Send mailable
        $mail->send($this->mailable);
    }
    
    /**
     * Get mailable for serialization
     * 
     * @return Mailable
     */
    public function getMailable(): Mailable
    {
        return $this->mailable;
    }
}
