<?php

/**
 * Class UppercaseWritePersonDecorator
 */
class UppercaseWritePersonRepositoryDecorator implements PersonRepositoryDecoratorInterface
{
    /**
     * @var PersonRepositoryInterface
     */
    private $personRepository;

    /**
     * @param Person $person
     */
    public function savePerson(Person $person): void
    {
        $person->setName(strtoupper($person->getName()));
        $this->personRepository->savePerson($person);
    }

    /**
     * @return array
     */
    public function readPeople(): array
    {
        return $this->personRepository->readPeople();
    }

    /**
     * @param string $name
     *
     * @return Person|null
     */
    public function readPerson(string $name): ?Person
    {
        return $this->personRepository->readPerson($name);
    }

    /**
     * UppercaseWritePersonRepositoryDecorator constructor.
     *
     * @param PersonRepositoryInterface $personRepository
     */
    public function __construct(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }
}
