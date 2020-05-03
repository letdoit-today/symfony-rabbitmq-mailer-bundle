<?php /** @noinspection PhpUnused */

namespace DIT\RabbitMQMailerBundle\Model;

use Symfony\Component\Mime\Address;

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

    /**
     * @return Address
     */
    public function getFromAddress(): ?Address;

    /**
     * @return Address[]
     */
    public function getToAddresses(): array;

    /**
     * @return Address[]
     */
    public function getCcAddresses(): array;

    /**
     * @return Address[]
     */
    public function getBccAddresses(): array;

    /**
     * @return Address
     */
    public function getReplyToAddress(): ?Address;
}
