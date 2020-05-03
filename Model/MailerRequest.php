<?php

namespace DIT\RabbitMQMailerBundle\Model;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class MailerRequest
 */
class MailerRequest implements MailerRequestInterface
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $from;

    /**
     * @var string[]
     * @Serializer\Type("array<string>")
     */
    protected $to;

    /**
     * @var string[]
     * @Serializer\Type("array<string>")
     */
    protected $cc;

    /**
     * @var string[]
     * @Serializer\Type("array<string>")
     */
    protected $bcc;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $replyTo;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $subject;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $html;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $text;

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from ?? '';
    }

    /**
     * @param string $from
     */
    public function setFrom(string $from): void
    {
        $this->from = $from;
    }

    /**
     * @return string[]
     */
    public function getTo(): array
    {
        return $this->to ?? [];
    }

    /**
     * @param string[] $to
     */
    public function setTo(array $to): void
    {
        $this->to = $to;
    }

    /**
     * @return string[]
     */
    public function getCc(): array
    {
        return $this->cc ?? [];
    }

    /**
     * @param string[] $cc
     */
    public function setCc(array $cc): void
    {
        $this->cc = $cc;
    }

    /**
     * @return string[]
     */
    public function getBcc(): array
    {
        return $this->bcc ?? [];
    }

    /**
     * @param string[] $bcc
     */
    public function setBcc(array $bcc): void
    {
        $this->bcc = $bcc;
    }

    /**
     * @return string
     */
    public function getReplyTo(): string
    {
        return $this->replyTo ?? '';
    }

    /**
     * @param string $replyTo
     */
    public function setReplyTo(string $replyTo): void
    {
        $this->replyTo = $replyTo;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject ?? '';
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getHtml(): string
    {
        return $this->html ?? '';
    }

    /**
     * @param string $html
     */
    public function setHtml(string $html): void
    {
        $this->html = $html;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text ?? '';
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }
}
