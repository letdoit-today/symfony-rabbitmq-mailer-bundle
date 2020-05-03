<?php /** @noinspection PhpUnused */

namespace DIT\RabbitMQMailerBundle\Service;

use DIT\RabbitMQBundle\Service\AbstractDirectReceiverService;
use DIT\RabbitMQMailerBundle\Model\MailerRequest;
use Exception;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

/**
 * Class MailerReceiverService
 */
class MailerReceiverService extends AbstractDirectReceiverService
{
    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var MailerInterface
     */
    protected $mailer;

    /**
     * MailerReceiverService constructor.
     * @param ContainerBagInterface $params
     * @param SerializerInterface $serializer
     * @param MailerInterface $mailer
     */
    public function __construct(ContainerBagInterface $params, SerializerInterface $serializer, MailerInterface $mailer)
    {
        parent::__construct($params);
        $this->serializer = $serializer;
        $this->mailer = $mailer;
    }

    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;
    }

    public function getOutput()
    {
        return $this->output;
    }

    protected function getRoutingKeys(): array
    {
        return [
            'emails.send',
        ];
    }

    protected function getExchange(): string
    {
        return 'requests';
    }

    protected function handleDefault(string $routingKey, string $body)
    {
        $this->writeWarning("Unhandle routingkey '$routingKey'");
    }

    /** @noinspection PhpUnused */
    protected function handleEmailsSendMessage(string $message)
    {
        try {
            /** @var MailerRequest $emailRequest */
            $emailRequest = $this->serializer->deserialize($message, MailerRequest::class, 'json');

            $from = $emailRequest->getFrom();
            if (empty($from)) {
                $config = $this->params->get('letdoittoday.mailer');
                $emailRequest->setFrom($config['default_sender']);
            }

            $email = (new Email())
                ->from($emailRequest->getFromAddress())
                ->to(...$emailRequest->getToAddresses())
                ->cc(...$emailRequest->getCcAddresses())
                ->bcc(...$emailRequest->getBccAddresses())
                ->replyTo($emailRequest->getReplyToAddress())
                ->subject($emailRequest->getSubject())
                ->text($emailRequest->getText())
                ->html($emailRequest->getHtml());

            $this->mailer->send($email);

            $to = join(',', $emailRequest->getTo());
            $this->writeInfo("Sent email '{$emailRequest->getSubject()}' to {$to}");
        } catch (TransportExceptionInterface $exception) {
            $this->writeError($exception->getMessage());
        } catch (Exception $exception) {
            $this->writeError($exception->getMessage());
        }
    }

    protected function writeInfo(string $message)
    {
        $this->writeMessage("<info>$message</info>");
    }

    protected function writeWarning(string $message)
    {
        $this->writeMessage("<comment>$message</comment>");
    }

    protected function writeError(string $message)
    {
        $this->writeMessage("<error>$message</error>");
    }

    protected function writeMessage(string $message)
    {
        if (!empty($this->output)) {
            $this->output->writeln($message);
        } else {
            echo $message.PHP_EOL;
        }
    }
}
