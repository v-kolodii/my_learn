<?php

namespace App\Service;

use App\Entity\Statistic;
use App\Entity\TextEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\OptionsResolver\Exception\InvalidArgumentException;

class StatisticService
{

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function createNewTextStatistic($text)
    {
        if (!$text) {
            throw new InvalidArgumentException();
        }
        $hash = md5($text);
        $textEntity = $this->em->getRepository(TextEntity::class)->getOneByHash($hash);
        if (empty($textEntity)) {
            $time_start = microtime(true);
            $textEntity = (new TextEntity())
                ->setHash($hash);

            $statistic = new Statistic();
            $statistic->setAverageWordLength($this->averageWordLength($text));
            $frequency = $this->frequencyOfCharacters($text);
            $statistic->setFrequencyOfCharacters($frequency);
            $statistic->setDistributionOfCharactersAsAPercentageOfTotal(
                $this->distributionOfCharactersAsAPercentageOfTotal($text, $frequency)
            );
            $statistic->setNumberOfCharacter(strlen($text));
            $numberOfWords = $this->numberOfWords($text);
            $statistic->setNumberOfWords($numberOfWords);
            $numberOfSentences = $this->numberOfSentences($text);
            $statistic->setNumberOfSentences($numberOfSentences);

            $statistic->setTheAverageNumberOfWordsInSentence(
                $this->theAverageNumberOfWordsInASentence($numberOfSentences, $numberOfWords)
            );
            $statistic->setNumberOfPalindromeWords($this->numberOfPalindromeWords($text));
            $statistic->setIsTheWholeTextPalindrome($this->isTheWholeTextAPalindrome($text));
            $statistic->setTheReversedText($this->theReversedText($text));
            $statistic->setTheReversedTextButTheCharacterOrderInWordsKeptIntact(
                $this->theReversedTextButTheCharacterOrderInWordsKeptIntact($text)
            );
            $statistic->setTop10LongestPalindromeWords($this->top10LongestPalindromeWords($text));
            $statistic->setTop10LongestSentences($this->top10LongestSentences($text));
            $statistic->setTop10longestWords($this->top10LongestSentences($text));
            $statistic->setTop10MostUsedWords($this->top10MostUsedWords($text));
            $statistic->setTop10shortestSentences($this->top10shortestSentences($text));
            $statistic->setTop10ShortestWords($this->top10ShortestWords($text));
            $statistic->setRunTime((microtime(true) - $time_start));

            $this->em->persist($statistic);
            $this->em->persist($textEntity);
            $textEntity->setStatistic($statistic);
            $statistic->setTextEntity($textEntity);
            $this->em->flush();
        }

        return $textEntity;
    }

    protected function numberOfWords($string): int
    {
        $res = explode(' ', $string);

        return count($res);
    }

    protected function numberOfSentences($string): int
    {
        $res = preg_split('/[?]|[.]|[!]/', $string);
        $res = array_filter($res, function ($val) {
            return !empty($val);
        });

        return count($res);
    }

    protected function frequencyOfCharacters($string): array
    {
        $stringToArray = mb_str_split($string);
        $array = array_flip(array_unique($stringToArray));
        foreach ($array as &$val) {
            $val = 0;
        }
        foreach ($stringToArray as $str) {
            $array[$str]++;
        }

        return $array;
    }

    protected function distributionOfCharactersAsAPercentageOfTotal($string, $frequencyOfCharacters)
    {
        $koe = count(mb_str_split($string));
        foreach ($frequencyOfCharacters as $key => &$value) {
            $value = round(($value * 100) / $koe, 2);
        }

        return $frequencyOfCharacters;
    }

    protected function averageWordLength($string): float
    {
        $res = explode(' ', $string);
        $countSymbolOfWords = 0;
        foreach ($res as $value) {
            $countSymbolOfWords += count(mb_str_split($value));
        }

        return round($countSymbolOfWords / count($res), 2);
    }

    protected function theAverageNumberOfWordsInASentence($numberOfSentences, $numberOfWords)
    {
        return round($numberOfWords / $numberOfSentences, 2);
    }

    protected function top10MostUsedWords($string)
    {
        $res = explode(' ', $string);
        $res = array_count_values($res);
        arsort($res);

        return array_slice($res, 0, 10);
    }

    protected function top10LongestWords($string): array
    {
        $res = explode(' ', $string);
        $array = array_flip(array_unique($res));
        foreach ($array as $key => &$value) {
            $value = mb_strlen($key);
        }
        arsort($array);

        return array_slice($array, 0, 10);
    }

    protected function top10ShortestWords($string): array
    {
        $res = explode(' ', $string);
        $array = array_flip(array_unique($res));
        foreach ($array as $key => &$value) {
            $value = mb_strlen($key);
        }
        asort($array);

        return array_slice($array, 0, 10);
    }

    protected function top10LongestSentences($string): array
    {
        $res = preg_split('/[?]|[.]|[!]/', $string);
        $res = array_filter($res, function ($val) {
            return !empty($val);
        });
        $array = array_flip(array_unique($res));
        foreach ($array as $key => &$value) {
            $value = mb_strlen($key);
        }
        arsort($array);

        return array_slice($array, 0, 10);
    }

    protected function top10shortestSentences($string): array
    {
        $res = preg_split('/[?]|[.]|[!]/', $string);
        $res = array_filter($res, function ($val) {
            return !empty($val);
        });
        $array = array_flip(array_unique($res));
        foreach ($array as $key => &$value) {
            $value = mb_strlen($key);
        }
        asort($array);

        return array_slice($array, 0, 10);
    }

    protected function numberOfPalindromeWords($string): int
    {
        $string = str_replace([',', '!', '?', '.'], '', $string);
        $res = explode(' ', $string);
        $count_palindrome_word = 0;
        foreach ($res as $value) {
            $check_word = mb_str_split($value);
            if ($check_word === array_reverse($check_word)) {
                $count_palindrome_word++;
            }
        }

        return $count_palindrome_word;
    }

    protected function top10LongestPalindromeWords($string): array
    {
        $string = str_replace([',', '!', '?', '.'], '', $string);
        $res = explode(' ', $string);
        $palindrome_word = [];
        foreach ($res as $value) {
            $check_word = mb_str_split($value);
            if ($check_word === array_reverse($check_word)) {
                $palindrome_word[] = $value;
            }
        }

        $array = array_flip(array_unique($palindrome_word));
        foreach ($array as $key => &$value) {
            $value = mb_strlen($key);
        }
        arsort($array);

        return array_slice($array, 0, 10);
    }

    protected function isTheWholeTextAPalindrome($string): bool
    {
        $string = str_replace([',', '!', '?', '.', ' '], '', $string);
        $array = mb_str_split($string);

        return $array === array_reverse($array);
    }

    protected function theReversedText($string): string
    {
        $array = mb_str_split($string);
        $array = array_reverse($array);

        return $string . '=>' . implode('', $array);
    }

    protected function theReversedTextButTheCharacterOrderInWordsKeptIntact($string): string
    {
        $array = explode(' ', $string);
        $array = array_reverse($array);
        return implode(' ', $array);
    }

}