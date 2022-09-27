<?php

namespace App\Export;


class ExportFactory implements ExportFactoryInterface
{

    public static function createExport($type): ExportInterface
    {
        switch ($type) {
            case ExportInterface::CSV:
                return new CSVExport();
            case ExportInterface::XML:
                return new XMLExport();
            case ExportInterface::XLSX:
                return new XLSXExport();
        }

        throw new \Exception('Type not valid!');
    }

}