<?php

namespace App\Service;

use App\Entity\TextEntity;
use App\Repository\TextEntityRepository;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\OptionsResolver\Exception\InvalidArgumentException;

class StatisticServiceTest extends TestCase
{

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|EntityManager
     */
    private $entityManager;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|TextEntityRepository
     */
    private $repository;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManager::class);
        $this->repository = $this
            ->getMockBuilder(TextEntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown(): void
    {
        $this->entityManager = null;
        $this->repository = null;
    }

    /**
     * @covers StatisticService::__construct
     */
    public function testConstruct(): void
    {
        $StatisticService = new StatisticService($this->entityManager);

        self::assertInstanceOf(StatisticService::class, $StatisticService);
    }


    public function testCreateNewTextStatisticWithHash()
    {
       $hash = md5('text for transform');

        $textEntity = new class extends TextEntity {
            public function getHash(): ?string
            {
                return md5('text for transform');
            }
        };

        $this->repository
            ->method('getOneByHash')
            ->with($hash)
            ->willReturn($textEntity);

        $this->entityManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($this->repository);

        $statService = new StatisticService($this->entityManager);

        self::assertInstanceOf(TextEntity::class, $statService->createNewTextStatistic('text for transform'));
    }

    public function testGetException()
    {
        $this->expectException(InvalidArgumentException::class);

        $statService = new StatisticService($this->entityManager);
        $statService->createNewTextStatistic('');
    }

    public function testNumberOfWords()
    {
        $text = 'text for transform';
        $statService = new StatisticService($this->entityManager);

        $numberOfWordsMethod = new \ReflectionMethod(StatisticService::class, 'numberOfWords');
        $numberOfWordsMethod->setAccessible(true);
        static::assertEquals(3, $numberOfWordsMethod->invokeArgs($statService, [$text]));
    }
}
