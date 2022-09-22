<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\StatisticRepository;

/**
 * @ORM\Table(name="statistic")
 * @ORM\Entity(repositoryClass=StatisticRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Statistic
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="number_of_character", type="smallint", nullable=true)
     */
    private $numberOfCharacter;

 /**
     * @var int
     *
     * @ORM\Column(name="number_of_words", type="smallint", nullable=true)
     */
    private $numberOfWords;

/**
     * @var int
     *
     * @ORM\Column(name="number_of_sentences", type="smallint", nullable=true)
     */
    private $numberOfSentences;


/**
     * @var array
     *
     * @ORM\Column(name="frequency_of_characters", type="simple_array", nullable=true)
     */
    private $frequencyOfCharacters;


/**
     * @var array
     *
     * @ORM\Column(name="distribution_of_characters_as_apercentage_of_total", type="simple_array", nullable=true)
     */
    private $distributionOfCharactersAsAPercentageOfTotal;


/**
     * @var float
     *
     * @ORM\Column(name="average_word_length", type="float", nullable=true)
     */
    private $averageWordLength;


/**
     * @var float
     *
     * @ORM\Column(name="the_average_number_of_words_in_sentence", type="float", nullable=true)
     */
    private $theAverageNumberOfWordsInSentence;


/**
     * @var array
     *
     * @ORM\Column(name="top10most_used_words", type="simple_array", nullable=true)
     */
    private $top10MostUsedWords;


/**
     * @var array
     *
     * @ORM\Column(name="top10longest_words", type="simple_array", nullable=true)
     */
    private $top10longestWords;


/**
     * @var array
     *
     * @ORM\Column(name="top10shortest_words", type="simple_array", nullable=true)
     */
    private $top10ShortestWords;

/**
     * @var array
     *
     * @ORM\Column(name="top10longest_sentences", type="simple_array", nullable=true)
     */
    private $top10LongestSentences;

/**
     * @var array
     *
     * @ORM\Column(name="top10shortest_sentences", type="simple_array", nullable=true)
     */
    private $top10shortestSentences;

/**
     * @var int
     *
     * @ORM\Column(name="number_of_palindrome_words", type="smallint", nullable=true)
     */
    private $numberOfPalindromeWords;

/**
     * @var array
     *
     * @ORM\Column(name="top10longest_palindrome_words", type="simple_array", nullable=true)
     */
    private $top10LongestPalindromeWords;

/**
     * @var bool
     *
     * @ORM\Column(name="is_the_whole_text_palindrome", type="boolean", nullable=false)
     */
    private $isTheWholeTextPalindrome = 0;
/**
     * @var string
     *
     * @ORM\Column(name="the_reversed_text ", type="text", nullable=true)
     */
    private $theReversedText;
/**
     * @var string
     *
     * @ORM\Column(name="the_reversed_text_but_the_character_order_in_words_kept_intact", type="text", nullable=true)
     */
    private $theReversedTextButTheCharacterOrderInWordsKeptIntact;
/**
     *
     * @ORM\Column(name="run_time ", type="float", nullable=true)
     */
    private $runTime;

    /**
     * @var TextEntity
     * @ORM\OneToOne(targetEntity="TextEntity", inversedBy="statistic")
     * @ORM\JoinColumn(name="text_entity_id", referencedColumnName="id")
     */
    private $textEntity;

    /**
     * @return TextEntity
     */
    public function getTextEntity(): TextEntity
    {
        return $this->textEntity;
    }

    /**
     * @param TextEntity $textEntity
     */
    public function setTextEntity(TextEntity $textEntity): void
    {
        $this->textEntity = $textEntity;
    }

    /**
     * @return mixed
     */
    public function getRunTime()
    {
        return $this->runTime;
    }

    /**
     * @param mixed $runTime
     */
    public function setRunTime($runTime): void
    {
        $this->runTime = $runTime;
    }

    /**
     * @return string
     */
    public function getTheReversedTextButTheCharacterOrderInWordsKeptIntact(): string
    {
        return $this->theReversedTextButTheCharacterOrderInWordsKeptIntact;
    }

    /**
     * @param string $theReversedTextButTheCharacterOrderInWordsKeptIntact
     */
    public function setTheReversedTextButTheCharacterOrderInWordsKeptIntact(
        string $theReversedTextButTheCharacterOrderInWordsKeptIntact
    ): void {
        $this->theReversedTextButTheCharacterOrderInWordsKeptIntact = $theReversedTextButTheCharacterOrderInWordsKeptIntact;
    }

    /**
     * @return string
     */
    public function getTheReversedText(): string
    {
        return $this->theReversedText;
    }

    /**
     * @param string $theReversedText
     */
    public function setTheReversedText(string $theReversedText): void
    {
        $this->theReversedText = $theReversedText;
    }

    /**
     * @return bool
     */
    public function isTheWholeTextPalindrome()
    {
        return $this->isTheWholeTextPalindrome;
    }

    /**
     * @param bool $isTheWholeTextPalindrome
     */
    public function setIsTheWholeTextPalindrome($isTheWholeTextPalindrome): void
    {
        $this->isTheWholeTextPalindrome = $isTheWholeTextPalindrome;
    }

    /**
     * @return array
     */
    public function getTop10LongestPalindromeWords(): array
    {
        return $this->top10LongestPalindromeWords;
    }

    /**
     * @param array $top10LongestPalindromeWords
     */
    public function setTop10LongestPalindromeWords(array $top10LongestPalindromeWords): void
    {
        $this->top10LongestPalindromeWords = $top10LongestPalindromeWords;
    }

    /**
     * @return int
     */
    public function getNumberOfPalindromeWords(): int
    {
        return $this->numberOfPalindromeWords;
    }

    /**
     * @param int $numberOfPalindromeWords
     */
    public function setNumberOfPalindromeWords(int $numberOfPalindromeWords): void
    {
        $this->numberOfPalindromeWords = $numberOfPalindromeWords;
    }

    /**
     * @return array
     */
    public function getTop10shortestSentences(): array
    {
        return $this->top10shortestSentences;
    }

    /**
     * @param array $top10shortestSentences
     */
    public function setTop10shortestSentences(array $top10shortestSentences): void
    {
        $this->top10shortestSentences = $top10shortestSentences;
    }

    /**
     * @return array
     */
    public function getTop10LongestSentences(): array
    {
        return $this->top10LongestSentences;
    }

    /**
     * @param array $top10LongestSentences
     */
    public function setTop10LongestSentences(array $top10LongestSentences): void
    {
        $this->top10LongestSentences = $top10LongestSentences;
    }

    /**
     * @return array
     */
    public function getTop10ShortestWords(): array
    {
        return $this->top10ShortestWords;
    }

    /**
     * @param array $top10ShortestWords
     */
    public function setTop10ShortestWords(array $top10ShortestWords): void
    {
        $this->top10ShortestWords = $top10ShortestWords;
    }

    /**
     * @return array
     */
    public function getTop10longestWords(): array
    {
        return $this->top10longestWords;
    }

    /**
     * @param array $top10longestWords
     */
    public function setTop10longestWords(array $top10longestWords): void
    {
        $this->top10longestWords = $top10longestWords;
    }

    /**
     * @return array
     */
    public function getTop10MostUsedWords(): array
    {
        return $this->top10MostUsedWords;
    }

    /**
     * @param array $top10MostUsedWords
     */
    public function setTop10MostUsedWords(array $top10MostUsedWords): void
    {
        $this->top10MostUsedWords = $top10MostUsedWords;
    }

    /**
     * @return float
     */
    public function getTheAverageNumberOfWordsInSentence(): float
    {
        return $this->theAverageNumberOfWordsInSentence;
    }

    /**
     * @param float $theAverageNumberOfWordsInSentence
     */
    public function setTheAverageNumberOfWordsInSentence(float $theAverageNumberOfWordsInSentence): void
    {
        $this->theAverageNumberOfWordsInSentence = $theAverageNumberOfWordsInSentence;
    }

    /**
     * @return float
     */
    public function getAverageWordLength(): float
    {
        return $this->averageWordLength;
    }

    /**
     * @param float $averageWordLength
     */
    public function setAverageWordLength(float $averageWordLength): void
    {
        $this->averageWordLength = $averageWordLength;
    }

    /**
     * @return array
     */
    public function getDistributionOfCharactersAsAPercentageOfTotal(): array
    {
        return $this->distributionOfCharactersAsAPercentageOfTotal;
    }

    /**
     * @param array $distributionOfCharactersAsAPercentageOfTotal
     */
    public function setDistributionOfCharactersAsAPercentageOfTotal(array $distributionOfCharactersAsAPercentageOfTotal
    ): void {
        $this->distributionOfCharactersAsAPercentageOfTotal = $distributionOfCharactersAsAPercentageOfTotal;
    }

    /**
     * @return array
     */
    public function getFrequencyOfCharacters(): array
    {
        return $this->frequencyOfCharacters;
    }

    /**
     * @param array $frequencyOfCharacters
     */
    public function setFrequencyOfCharacters(array $frequencyOfCharacters): void
    {
        $this->frequencyOfCharacters = $frequencyOfCharacters;
    }

    /**
     * @return int
     */
    public function getNumberOfSentences(): int
    {
        return $this->numberOfSentences;
    }

    /**
     * @param int $numberOfSentences
     */
    public function setNumberOfSentences(int $numberOfSentences): void
    {
        $this->numberOfSentences = $numberOfSentences;
    }

    /**
     * @return int
     */
    public function getNumberOfWords(): int
    {
        return $this->numberOfWords;
    }

    /**
     * @param int $numberOfWords
     */
    public function setNumberOfWords(int $numberOfWords): void
    {
        $this->numberOfWords = $numberOfWords;
    }

    /**
     * @return int
     */
    public function getNumberOfCharacter(): int
    {
        return $this->numberOfCharacter;
    }

    /**
     * @param int $numberOfCharacter
     */
    public function setNumberOfCharacter(int $numberOfCharacter): void
    {
        $this->numberOfCharacter = $numberOfCharacter;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
