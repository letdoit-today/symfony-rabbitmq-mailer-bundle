<?php /** @noinspection PhpUnused */

namespace DIT\RabbitMQMailerBundle\Model;

/**
 * Interface MailerRequestInterface
 */
interface MailerRequestInterface
{
    /**
     * @return string
     */
    public function getFrom(): string;

    /**
     * @return string[]
     */
    public function getTo(): array;

    /**
     * @return string[]
     */
    public function getCc(): array;

    /**
     * @return string[]
     */
    public function getBcc(): array;

    /**
     * @return string
     */
    public function getReplyTo(): string;

    /**
     * @return string
     */
    public function getSubject(): string;

    /**
     * @return string
     */
    public function getHtml(): string;

    /**
     * @return string
     */
    public function getText(): string;
}
