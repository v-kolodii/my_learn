<?php

/**
 * Class DepartmentNameAscendingAndDescending
 */
class DepartmentNameAscendingAndDescending implements Sort {
    /**
     * @param $employees
     *
     * @return mixed|Sort
     */
    public function sort( $employees ) {
        return $this->execute( $employees );
    }

    /**
     * @param $employees
     *
     * @return mixed
     */
    public function execute( $employees ) {
        return $employees;
    }
}
