<?php

/**
 * @var PersonRepositoryInterface
 */
$dbPersonRepository = new DbPersonRepository();

$lowerCaseReadPersonRepositoryDecorator = new LowerCaseReadPersonRepositoryDecorator($dbPersonRepository);

$uppercaseWritePersonRepositoryDecorator = new UppercaseWritePersonRepositoryDecorator($lowerCaseReadPersonRepositoryDecorator);