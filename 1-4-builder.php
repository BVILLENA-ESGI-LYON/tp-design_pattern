<?php

declare(strict_types=1);

class Email
{
    private string $to;
    private string $subject;
    private string $message;
    private array $attachments;

    public function __construct(string $to, string $subject, string $message, array $attachments = [])
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->attachments = $attachments;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getAttachments(): array
    {
        return $this->attachments;
    }
}

interface EmailBuilderInterface
{
    public function addTo(string $to): self;

    public function setSubject(string $subject): self;

    public function setMessage(string $message): self;

    public function addAttachment(string $attachment): self;

    public function build(): Email;
}

class EmailBuilder implements EmailBuilderInterface
{
    private string $to;
    private string $subject;
    private string $message;
    private array $attachments;

    public function __construct()
    {
        $this->attachments = [];
    }

    public function addTo(string $to): self
    {
        $this->to = $to;
        return $this;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function addAttachment(string $attachment): self
    {
        $this->attachments[] = $attachment;
        return $this;
    }

    public function build(): Email
    {
        return new Email($this->to, $this->subject, $this->message, $this->attachments);
    }
}

$emailBuilder = new EmailBuilder();
$email = $emailBuilder
    ->addTo('recipient@exemple.com')
    ->setSubject('Example Subject')
    ->setMessage('message exemple')
    ->addAttachment('example_attachment.pdf')
    ->build();

echo "To: " . $email->getTo() . PHP_EOL;
echo "Subject: " . $email->getSubject() . PHP_EOL;
echo "Message: " . $email->getMessage() . PHP_EOL;
echo "Attachments: " . implode(', ', $email->getAttachments()) . PHP_EOL;
