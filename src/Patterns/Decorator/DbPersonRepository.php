<?php

/**
 * Class DbPersonRepository
 */
class DbPersonRepository implements PersonRepositoryInterface {
    /**
     * @param Person $person
     */
    public function savePerson( Person $person ): void {
        //save person to db
    }

    /**
     * @return array
     */
    public function readPeople(): array {
        //select people from db
    }

    /**
     * @param string $name
     *
     * @return Person|null
     */
    public function readPerson( string $name ): ?Person {
        //select person from db
    }
}
