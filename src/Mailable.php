<?php

declare(strict_types=1);

namespace Alphavel\Mail;

/**
 * Mailable Base Class
 * 
 * Laravel-compatible mailable pattern
 * Performance: Lazy building, only when sent
 */
abstract class Mailable
{
    public array $to = [];
    public array $cc = [];
    public array $bcc = [];
    public string $subject = '';
    public string $view = '';
    public array $data = [];
    public array $attachments = [];
    
    /**
     * Build the message
     * 
     * Override this method to configure the email
     * 
     * @return self
     */
    abstract public function build(): self;
    
    /**
     * Set recipients
     * 
     * @param string|array $recipients
     * @return self
     */
    protected function to(string|array $recipients): self
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
    protected function cc(string|array $recipients): self
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
    protected function bcc(string|array $recipients): self
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
    protected function subject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }
    
    /**
     * Set view template
     * 
     * @param string $view
     * @param array $data
     * @return self
     */
    protected function view(string $view, array $data = []): self
    {
        $this->view = $view;
        $this->data = array_merge($this->data, $data);
        return $this;
    }
    
    /**
     * Attach file
     * 
     * @param string $path
     * @param string|null $name
     * @return self
     */
    protected function attach(string $path, ?string $name = null): self
    {
        $this->attachments[] = [
            'path' => $path,
            'name' => $name
        ];
        return $this;
    }
    
    /**
     * Pass data to view
     * 
     * @param string $key
     * @param mixed $value
     * @return self
     */
    protected function with(string $key, mixed $value): self
    {
        $this->data[$key] = $value;
        return $this;
    }
}
