<?php

/**
 * Interface PersonRepositoryDecoratorInterface
 */
interface PersonRepositoryDecoratorInterface extends PersonRepositoryInterface {
    /**
     * PersonRepositoryDecoratorInterface constructor.
     *
     * @param PersonRepositoryInterface $personRepository
     */
    public function __construct(PersonRepositoryInterface $personRepository);
}