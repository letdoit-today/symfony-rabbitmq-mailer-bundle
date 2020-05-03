<?php /** @noinspection PhpUnused */

namespace DIT\RabbitMQMailerBundle\Service;

use DIT\RabbitMQBundle\Service\AbstractDirectEmitterService;
use DIT\RabbitMQMailerBundle\Model\MailerRequestInterface;
use Exception;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

/**
 * Class MailerEmitterService
 */
class MailerEmitterService extends AbstractDirectEmitterService
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * MailerEmitterService constructor.
     * @param ContainerBagInterface $params
     * @param SerializerInterface $serializer
     */
    public function __construct(ContainerBagInterface $params, SerializerInterface $serializer)
    {
        parent::__construct($params);
        $this->serializer = $serializer;
    }

    protected function getExchange(): string
    {
        return 'requests';
    }

    /**
     * @param MailerRequestInterface $entity
     * @throws Exception
     */
    public function emitSendMessage(MailerRequestInterface $entity)
    {
        $message = $this->serializer->serialize($entity, 'json');

        $this->emitMessage($message, 'emails.send');
    }
}
