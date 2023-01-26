<?php
/**
 * Magebit_Faq
 *
 * @category     Magebit
 * @package      Magebit_Faq
 * @author       Niks Veinbergs
 * @copyright    Copyright (c) 2023 Magebit, Ltd.(https://www.magebit.com/)
 */

namespace Magebit\Faq\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface QuestionRepositoryInterface
{
    public function getById($questionId);
    public function save(Data\QuestionInterface $question);
    public function getList(SearchCriteriaInterface $searchCriteria);
    public function delete(Data\QuestionInterface $question);
    public function deleteById($questionId);
}
