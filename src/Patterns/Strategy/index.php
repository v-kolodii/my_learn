<?php

$employees = new EmployeeCollection;

$DepartmentNameAscendingAndDescending = new DepartmentNameAscendingAndDescending;
$employees->setStrategy( $DepartmentNameAscendingAndDescending );
$sortedEmployees = $employees->showEmployees();

$NameAscendingAndDescending = new NameAscendingAndDescending;
$employees->setStrategy( $NameAscendingAndDescending );
$sortedEmployees = $employees->showEmployees();

$SalaryAscendingAndDescending = new SalaryAscendingAndDescending;
$employees->setStrategy( $SalaryAscendingAndDescending );
$sortedEmployees = $employees->showEmployees();
