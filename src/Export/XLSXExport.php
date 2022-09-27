<?php

namespace App\Export;

use App\Entity\TextEntity;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class XLSXExport implements ExportInterface
{

    public function export(TextEntity $textEntity): StreamedResponse
    {
        $response = new StreamedResponse();
        $response->setCallback(function () use ($textEntity) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle("Statistic");

            $result = $this->createData($textEntity);
            $count = 1;
            foreach ($result as $data) {
                $sheet->setCellValue('A' . $count, $data);
                $count++;
            }

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment; filename="statistic.xlsx"');

        return $response;
    }

    /**
     * @param TextEntity $textEntity
     * @return array
     */
    private function createData(TextEntity $textEntity): array
    {
        $stat = $textEntity->getStatistic();
        return [
            $textEntity->getId(),
            $textEntity->getText(),
            $stat->getNumberOfWords(),
            $stat->getAverageWordLength()
        ];
    }
}
