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
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magebit\Faq\Api\Data\QuestionSearchResultsInterfaceFactory;

class QuestionRepository implements QuestionRepositoryInterface
{
    protected $resource;
    protected $questionFactory;
    protected $questionCollectionFactory;
    protected $searchResultsFactory;
    private $collectionProcessor;

    public function __construct(
        ResourceQuestion $resource,
        QuestionFactory $questionFactory,
        \Magebit\Faq\Api\Data\QuestionInterfaceFactory $dataQuestionFactory,
        QuestionCollectionFactory $questionCollectionFactory,
        QuestionSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor

    ) {
        $this->resource = $resource;
        $this->questionFactory = $questionFactory;
        $this->dataQuestionFactory = $dataQuestionFactory;
        $this->questionCollectionFactory = $questionCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getById($questionId): Question
    {
        $question = $this->questionFactory->create();
        $this->resource->load($question, $questionId);
        if (!$question->getId()) {
            throw new NoSuchEntityException(__('The Question with the "%1" ID doesn\'t exist.', $questionId));
        }
        return $question;
    }

    /**
     * @throws CouldNotSaveException
     */
    public function save(Data\QuestionInterface $question): Data\QuestionInterface
    {
        try {
            $this->resource->save($question);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $question;
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->questionCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults->getItems();
    }

    public function delete(Data\QuestionInterface $question): bool
    {
        try {
            $this->resource->delete($question);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($questionId): bool
    {
        $question = $this->questionFactory->create();
        $this->resource->load($question, $questionId);
        if (!$question->getId()) {
            throw new NoSuchEntityException(__('FAQ with the "%1" ID doesn\'t exist.', $questionId));
        }
        try {
            $this->resource->delete($question);
            return true;
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
    }
}
