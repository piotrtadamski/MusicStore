<?php

namespace MusicStore\Infrastructure\Ports\Console\Command;

use MusicStore\Domain\Album\AlbumRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

class GetAllAlbumsCommand extends Command
{
    private AlbumRepositoryInterface $albumRepository;
    private SerializerInterface $serializer;

    public function __construct(
        AlbumRepositoryInterface $albumRepository,
        SerializerInterface      $serializer
    )
    {
        $this->albumRepository = $albumRepository;
        $this->serializer = $serializer;
        parent::__construct('musicshop:album:list');
    }

    protected function configure(): void
    {
        $this->setDescription('Retrieves all albums');

        $this->addOption('format',
            'fm',
            InputOption::VALUE_OPTIONAL,
            'Output format: can be json or xml',
            'json'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $format = $input->getOption('format');
        $albums = $this->albumRepository->findAll();

        $serializedOutput = $this->serializer->serialize($albums, $format);

        $output->writeln($serializedOutput);
    }
}
