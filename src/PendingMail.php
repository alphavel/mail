<?php

declare(strict_types=1);

namespace Alphavel\Mail;

use Symfony\Component\Mime\Email;

/**
 * Pending Mail Builder
 * 
 * Fluent interface for building emails
 * Performance: O(1) - just builds message object
 */
class PendingMail
{
    private MailManager $manager;
    private array $to = [];
    private array $cc = [];
    private array $bcc = [];
    private ?string $subject = null;
    private array $attachments = [];
    
    public function __construct(MailManager $manager)
    {
        $this->manager = $manager;
    }
    
    /**
     * Set recipients
     * 
     * @param string|array $recipients
     * @return self
     */
    public function to(string|array $recipients): self
    {
        $this->to = is_array($recipients) ? $recipients : [$recipients];
        return $this;
    }
    
    /**
     * Set CC recipients
     * 
     * @param string|array $recipients
     * @return self
     */
    public function cc(string|array $recipients): self
    {
        $this->cc = is_array($recipients) ? $recipients : [$recipients];
        return $this;
    }
    
    /**
     * Set BCC recipients
     * 
     * @param string|array $recipients
     * @return self
     */
    public function bcc(string|array $recipients): self
    {
        $this->bcc = is_array($recipients) ? $recipients : [$recipients];
        return $this;
    }
    
    /**
     * Set subject
     * 
     * @param string $subject
     * @return self
     */
    public function subject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }
    
    /**
     * Attach file
     * 
     * @param string $path
     * @param string|null $name
     * @return self
     */
    public function attach(string $path, ?string $name = null): self
    {
        $this->attachments[] = [
            'path' => $path,
            'name' => $name
        ];
        return $this;
    }
    
    /**
     * Send email with view
     * 
     * Performance: 1-10ms (SMTP dependent)
     * 
     * @param string $view View template
     * @param array $data Template data
     * @return bool
     */
    public function send(string $view, array $data = []): bool
    {
        $mailable = new SimpleMailable(
            $this->to,
            $this->subject,
            $view,
            $data,
            $this->cc,
            $this->bcc,
            $this->attachments
        );
        
        return $this->manager->send($mailable);
    }
    
    /**
     * Queue email for sending
     * 
     * Performance: < 0.5ms dispatch
     * 
     * @param string $view
     * @param array $data
     * @param string $queue
     * @return void
     */
    public function queue(string $view, array $data = [], string $queue = 'default'): void
    {
        $mailable = new SimpleMailable(
            $this->to,
            $this->subject,
            $view,
            $data,
            $this->cc,
            $this->bcc,
            $this->attachments
        );
        
        $this->manager->queue($mailable, $queue);
    }
    
    /**
     * Send raw HTML email
     * 
     * @param string $html
     * @return bool
     */
    public function html(string $html): bool
    {
        $message = $this->manager->createMessage();
        
        // Add recipients
        foreach ($this->to as $recipient) {
            $message->to($recipient);
        }
        
        foreach ($this->cc as $recipient) {
            $message->cc($recipient);
        }
        
        foreach ($this->bcc as $recipient) {
            $message->bcc($recipient);
        }
        
        // Set subject
        if ($this->subject) {
            $message->subject($this->subject);
        }
        
        // Set HTML body
        $message->html($html);
        
        // Add attachments
        foreach ($this->attachments as $attachment) {
            $message->attachFromPath($attachment['path'], $attachment['name'] ?? null);
        }
        
        return $this->manager->sendMessage($message);
    }
    
    /**
     * Send plain text email
     * 
     * @param string $text
     * @return bool
     */
    public function text(string $text): bool
    {
        $message = $this->manager->createMessage();
        
        // Add recipients
        foreach ($this->to as $recipient) {
            $message->to($recipient);
        }
        
        // Set subject
        if ($this->subject) {
            $message->subject($this->subject);
        }
        
        // Set text body
        $message->text($text);
        
        return $this->manager->sendMessage($message);
    }
}
