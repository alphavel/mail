# Alphavel Mail Package

Email system with templates, attachments, and queue support.

## Installation

```bash
composer require alphavel/mail
```

## Usage

```php
// Send email
Mail::to('user@example.com')
    ->subject('Welcome!')
    ->send('emails.welcome', ['name' => 'John']);

// With queue
Mail::to('user@example.com')
    ->queue('emails.welcome', ['name' => 'John']);

// Mailable class (Laravel-like)
class WelcomeEmail extends Mailable
{
    public function build()
    {
        return $this->view('emails.welcome')
                    ->subject('Welcome to Alphavel!');
    }
}

Mail::send(new WelcomeEmail($user));
```

## Features
- SMTP, Sendmail, Mailgun, SES
- HTML/Plain text
- Attachments
- Queue integration
- Connection pooling

## License
MIT
