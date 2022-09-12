<?php

class EmployeeCollection {
    /**
     * @var
     */
    private $employees;
    /**
     * @var
     */
    private $strategy;

    /**
     * @param Sort $strategy
     */
    public function setStrategy( Sort $strategy ) {
        $this->strategy = $strategy;
    }

    /**
     * @param $employees
     *
     * @return mixed
     */
    private function executeStrategy( $employees ) {
        return $this->strategy->sort( $employees );
    }

    /**
     * @return mixed
     */
    public function getEmployee() {
        return $this->employees;
    }

    /**
     * @param $employees
     */
    public function setEmployee( $employees ) {
        $this->employees = $employees;
    }

    /**
     * @return mixed
     */
    public function showEmployees() {
        return $this->executeStrategy( $this->employees );
    }

}
