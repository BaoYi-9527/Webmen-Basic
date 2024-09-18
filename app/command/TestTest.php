<?php

namespace app\command;

use app\model\TagModel;
use support\Db;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;


class TestTest extends Command
{
    protected static $defaultName = 'test:test';
    protected static $defaultDescription = 'test test';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('name', InputArgument::OPTIONAL, 'Name description');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

//        $rows = Db::table('company')->get();
        $rows = TagModel::query()->get();

        dd($rows->toArray());

        $name = $input->getArgument('name');
        $output->writeln('Hello test:test');
        return self::SUCCESS;
    }

}