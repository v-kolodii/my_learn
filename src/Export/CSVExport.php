<?php

namespace App\Export;

use App\Entity\TextEntity;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CSVExport implements ExportInterface
{

    public function export(TextEntity $textEntity): StreamedResponse
    {
        $filename = 'statistic';

        $response = new StreamedResponse();
        $response->setCallback(
            function () use ($textEntity) {
                $handle = fopen('php://output', 'r+');
                $stat = $textEntity->getStatistic();
                $data = [
                    $textEntity->getId(),
                    $textEntity->getText(),
                    $stat->getAverageWordLength(),
                    $stat->getNumberOfWords()

                ];
                fputcsv($handle, $data);
                fclose($handle);
            }
        );
        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
        return $response;
    }
}