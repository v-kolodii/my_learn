<?php

namespace App\Export;


interface ExportFactoryInterface
{
    public static function createExport(string $exportType): ExportInterface;
}
