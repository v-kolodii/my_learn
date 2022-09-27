<?php

namespace App\Export;

use App\Entity\TextEntity;
use Symfony\Component\HttpFoundation\Response;

interface ExportInterface
{
    const CSV = 'csv';
    const XML = 'xml';
    const XLSX = 'xlsx';

    public function export(TextEntity $textEntity): Response;
}
