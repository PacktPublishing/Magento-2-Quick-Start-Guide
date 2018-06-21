<?php

namespace Magelicious\Core\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunStockImportCommand extends Command
{
    const ORDER_ID_ARGUMENT = 'order_id';
    const DAYS_BACK_OPTION = 'days_back';

    protected function configure()
    {
        $this->setName('magelicious:stock:import')
            ->setDescription('The Magelicious Stock Import.')
            ->setDefinition([
                new InputArgument(
                    self::ORDER_ID_ARGUMENT, /* name */
                    InputArgument::REQUIRED, /* mode REQUIRED or OPTIONAL */
                    'The argument to set.', /* description */
                    null /* default */
                ),
                new InputOption(
                    self::DAYS_BACK_OPTION, /* name */
                    null, /* shortcut */
                    InputOption::VALUE_OPTIONAL, /* VALUE_NONE or VALUE_REQUIRED or VALUE_OPTIONAL or VALUE_IS_ARRAY */
                    'The option to set.' /* description */
                )
            ]);
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $output->setDecorated(true);
            // $input->getArgument(self::ORDER_ID_ARGUMENT);
            // $input->getOption(self::DAYS_BACK_OPTION);
            // green text
            $output->writeln('<info>The info message.</info>');
            // yellow text
            $output->writeln('<comment>The comment message.</comment>');
            // black text on a cyan background
            $output->writeln('<question>The question message.</question>');
            return \Magento\Framework\Console\Cli::RETURN_SUCCESS;
        } catch (\Exception $e) {
            // white text on a red background
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            if ($output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE) {
                $output->writeln($e->getTraceAsString());
            }
            return \Magento\Framework\Console\Cli::RETURN_FAILURE;
        }
    }
}