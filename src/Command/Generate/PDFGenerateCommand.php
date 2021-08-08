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
            ->addArgument('pageCount', InputArgument::OPTIONAL, 'Enter text in pdf file', 1)
            ->setDescription('Generate pdf file of text');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $text = $input->getArgument('text');
        $pageCount = $input->getArgument('pageCount');
        $path = "/tmp/certificate/$text.pdf";
        $stylesheet = "
            body {
                background-color: #d9eef0;
                background-image: url('/tmp/certificate/certificate.png');
                background-repeat: no-repeat;
                background-position: center;
            }
            .name {
                position: absolute;
                margin-top: 400px;
                font-size: 30px;
                width: 620px;
                text-align: center;
                color: #be9265;
            }
        ";

        $title = "<div class='name'>$text</div>";

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'orientation' => 'L', 'format' => [210, 294]]);
        $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
        for ($i = 1; $i <= $pageCount; $i++) {
            $mpdf->addPage();
            $mpdf->WriteHTML($title, \Mpdf\HTMLParserMode::HTML_BODY);
        }
        $mpdf->Output($path, \Mpdf\Output\Destination::FILE);

        $output->writeln("<info>$path</info>");
        return Command::SUCCESS;
    }
}