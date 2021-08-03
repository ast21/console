<?php

namespace App\Command\Generate;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PDFGenerateCommand extends Command
{
    protected static $defaultName = 'generate:pdf';

    protected function configure(): void
    {
        $this
            ->addArgument('text', InputArgument::REQUIRED, 'Enter text in pdf file')
            ->setDescription('Generate pdf file of text');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $text = $input->getArgument('text');
        $path = "/tmp/$text.pdf";
        $stylesheet = "body { background-color: #d9eef0; }";
        $html = "<h1>$text</h1>";

        $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
        $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
        $mpdf->Output($path, \Mpdf\Output\Destination::FILE);

        $output->writeln("<info>$path</info>");
        return Command::SUCCESS;
    }
}