<?php
/**
 * Magebit_Faq
 *
 * @category     Magebit
 * @package      Magebit_Faq
 * @author       Niks Veinbergs
 * @copyright    Copyright (c) 2023 Magebit, Ltd.(https://www.magebit.com/)
 */
declare(strict_types=1);
namespace Magebit\Faq\Api;

use Magebit\Faq\Model\Question;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface QuestionRepositoryInterface
 */
interface QuestionRepositoryInterface
{

    /**
     * Description.
     * Returns Question, based on given Question ID
     *
     * @param string $questionId
     * @return Question
     */
    public function getById(string $questionId): Question;

    /**
     * Description.
     *Saves question
     *
     * @param Data\QuestionInterface $question
     * @return Data\QuestionInterface
     */
    public function save(Data\QuestionInterface $question): Data\QuestionInterface;

    /**
     * Description.
     *Get List of Questions based on given search criteria
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return array
     */
    public function getList(SearchCriteriaInterface $searchCriteria): array;


    /**
     * Description.
     *Delete question
     *
     * @param Data\QuestionInterface $question
     * @return bool
     */
    public function delete(Data\QuestionInterface $question): bool;

    /**
     * Description.
     * Delete Question by given id
     *
     * @param int $questionId
     * @return bool
     */
    public function deleteById(int $questionId): bool;
}
