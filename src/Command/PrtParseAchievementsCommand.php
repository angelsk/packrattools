<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class PrtParseAchievementsCommand extends Command
{
    protected static $defaultName = 'prt:parse-achievements';

    protected function configure()
    {
        $this
            ->setDescription('Parse achievements JSON to get SQL insert')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $file_contents = file_get_contents('/Users/jo/Desktop/packrat-api/achievements.json');
        $achievements = json_decode($file_contents, true);

        $io->text('insert into feat (packrat_id, feat_identifier, feat_name, feat_image, feat_points, date_achieved, datetime_achieved, confirmed_num1) values');

        foreach ($achievements as $achievement) {
            $io->text(
                sprintf(
                    '(%d, "%s", "%s", "%s", 0, "%s", "%s", 1),',
                    $achievement['id'],
                    strtolower(str_replace(' ', '-', $achievement['name'])),
                    $achievement['name'],
                    $achievement['image'],
                    isset($achievement['achievement_date']) ? substr($achievement['achievement_date'], 0, 10) : '0000-00-00',
                    $achievement['achievement_date'] ?? null
                )
            );
        }
    }
}
