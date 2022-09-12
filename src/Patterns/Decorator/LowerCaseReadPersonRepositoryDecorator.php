<?php


/**
 * Class LowerCaseReadPersonDecorator
 */
class LowerCaseReadPersonRepositoryDecorator implements PersonRepositoryDecoratorInterface
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
        $this->personRepository->savePerson($person);
    }

    /**
     * @return array
     */
    public function readPeople(): array
    {
        $people = $this->personRepository->readPeople();

        return array_map(
            function ($person) {
                $person->setName(strtolower($person->getName()));

                return $person;
            }, $people
        );
    }

    /**
     * @param string $name
     *
     * @return Person|null
     */
    public function readPerson(string $name): ?Person
    {
        $person = $this->personRepository->readPerson($name);
        $person->setName(strtolower($person->getName()));
    }

    /**
     * LowerCaseReadPersonRepositoryDecorator constructor.
     *
     * @param PersonRepositoryInterface $personRepository
     */
    public function __construct(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }
}
