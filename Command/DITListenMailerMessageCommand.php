<?php /** @noinspection PhpUnused */

namespace DIT\RabbitMQMailerBundle\Command;

use DIT\RabbitMQMailerBundle\Service\MailerReceiverService;
use ErrorException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DITListenMailerMessageCommand
 */
class DITListenMailerMessageCommand extends Command
{
    protected static $defaultName = 'letdoittoday:listen:mailer-message';

    /**
     * @var MailerReceiverService
     */
    protected $receiverService;

    /**
     * ReceiveUserMessage constructor.
     * @param MailerReceiverService $receiverService
     * @param string|null $name
     */
    public function __construct(MailerReceiverService $receiverService, ?string $name = null)
    {
        parent::__construct($name);

        $this->receiverService = $receiverService;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws ErrorException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $now = date('l Y-m-d H:i:s');
        $output->writeln("$now: Waiting for message. To exit press CTRL+C ==============================");

        $this->receiverService->setOutput($output);
        $this->receiverService->receiveMessage();

        return 0;
    }
}
