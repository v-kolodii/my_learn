<?php

/**
 * Interface Sort
 */
interface Sort {
    /**
     * sort constructor.
     *
     * @param $employees
     */
    public function sort( $employees );

    /**
     * @param $employees
     *
     * @return mixed
     */
    public function execute( $employees );
}
