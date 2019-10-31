<?php

namespace App\Command;

use App\Entity\Place\Countries;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GeojsonCommand extends Command
{
    protected static $defaultName = 'app:geojson';

    private $entityManager;

    public function __construct(string $name = null, EntityManagerInterface $entityManager)
    {
        parent::__construct($name);

        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $countries = require __DIR__ . '/data/en/country.php';
        $countries_bg = require __DIR__ . '/data/bg/country.php';
        ksort($countries);

        $progressBar = new ProgressBar($output, count($countries));
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% -- %message%');

        foreach ($countries as $iso => $name) {
            $progressBar->setMessage("Processing \"" . $name . "\"");

            $data = json_decode(shell_exec('wget -O - "https://nominatim.openstreetmap.org/search?country='.strtolower($name).'&format=geojson&polygon_geojson=1" 2>/dev/null'), true);


            if ($data === null or count($data['features']) == 0) {
                $io->writeln("\nMissing country: " . $name);
                continue;
            }

            if (count($data['features']) != 1) {
                $io->writeln("\nNumber of features should be exactly one: " . $name);
                continue;
            }

            $country = new Countries();
            $country->setId($iso);
            $country->setNameEn($name);
            $country->setNameBg($countries_bg[$iso]);
            $country->setGeojson($data);
            $this->entityManager->persist($country);
            $this->entityManager->flush();

            $progressBar->advance();
        }

        $progressBar->finish();
        $io->success("All countries imported");
    }
}
