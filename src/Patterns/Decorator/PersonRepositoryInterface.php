<?php

/**
 * Interface PersonRepositoryInterface
 */
interface PersonRepositoryInterface {
    /**
     * @param Person $person
     */
    public function savePerson( Person $person ): void;

    /**
     * @return array
     */
    public function readPeople(): array;

    /**
     * @param string $name
     *
     * @return Person|null
     */
    public function readPerson( string $name ): ?Person;
}
