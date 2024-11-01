<?php

namespace app\command;

use app\model\post\PostModel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
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
     * @command php80 webman test:test
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        dd(empty(0));
//        $rows = Db::table('company')->get();
        $rows = PostModel::getPageList([], 1, 10);

        dd($rows->toArray());

        $name = $input->getArgument('name');
        $output->writeln('Hello test:test');
        return self::SUCCESS;
    }

}
