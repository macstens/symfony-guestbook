<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Doctrine\ORM\EntityManagerInterface;

class GuestbookPurgeOldEntriesCommand extends Command
{
    // php bin/console $defaultName
    protected static $defaultName = 'app:purge-old-entries';
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure(): void
    {
        // ...
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        $entityManager = $this->entityManager;
    
        // A. Access repositories
        $repo = $entityManager->getRepository(Guestbook::class);
        
        $allEntities = $repo->findAll();
        foreach($allEntities as $entity) {
            $createdAt = $entity->getCreatedAt();
            $now = new \DateTime();

            if($createdAt->diff($now)->days > 10) {
                $output->writeLn('Deleting guestbook entry with: ' . $entity->getFirstname() . ' ' . $entity->getLastname() . ', ID: ' . $entity->getId());

                $entityManager->remove($entity);
            }
            $entityManager->flush();
        }
        
        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }
}