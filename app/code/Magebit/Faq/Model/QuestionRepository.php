<?php
/**
 * Magebit_Faq
 *
 * @category     Magebit
 * @package      Magebit_Faq
 * @author       Niks Veinbergs
 * @copyright    Copyright (c) 2023 Magebit, Ltd.(https://www.magebit.com/)
 */

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\ResourceModel\Question as ResourceQuestion;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;

class QuestionRepository implements QuestionRepositoryInterface
{
    protected $resource;
    protected $questionFactory;
    protected $questionCollectionFactory;
    protected $searchResultsFactory;

    public function __construct(
        ResourceQuestion $resource,
        QuestionFactory $questionFactory,
        \Magebit\Faq\Api\Data\QuestionInterfaceFactory $dataQuestionFactory,
        QuestionCollectionFactory $questionCollectionFactory,
        Data\QuestionSearchResultsInterfaceFactory $searchResultsFactory,
    ) {
        $this->resource = $resource;
        $this->questionFactory = $questionFactory;
        $this->dataQuestionFactory = $dataQuestionFactory;
        $this->questionCollectionFactory = $questionCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }
    public function get(Data\QuestionInterface $question)
    {
        // TODO: Implement get() method.
    }

    public function save(Data\QuestionInterface $question)
    {
        // TODO: Implement save() method.
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        // TODO: Implement getList() method.
    }

    public function delete(Data\QuestionInterface $question)
    {
        // TODO: Implement delete() method.
    }

    public function deleteById($questionId)
    {
        // TODO: Implement deleteById() method.
    }
}
