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
namespace Magebit\Faq\Block;

use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class QuestionList extends Template implements BlockInterface
{
    const DATABASE_FIELD_POSITION = 'position';
    const DATABASE_FIELD_STATUS = 'status';
    const STATUS_ENABLED_VALUE = 1;
    const STATUS_CONDITION_TYPE_EQ = 'eq';
    protected $questionRepository;
    private $searchCriteriaBuilder;
    private $sortOrder;
    private $sortOrderBuilder;
    public function __construct(
        QuestionRepositoryInterface $questionRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrder $sortOrder,
        SortOrderBuilder $sortOrderBuilder,
        Template\Context $context,
        array $data = []
    ) {
        $this->questionRepository = $questionRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrder = $sortOrder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        parent::__construct($context, $data);
    }

    public function getQuestionList()
    {
        $sortOrder = $this->sortOrderBuilder
            ->setField(self::DATABASE_FIELD_POSITION)
            ->setDirection(SortOrder::SORT_DESC)
            ->create();
        $this->searchCriteriaBuilder->addSortOrder($sortOrder);
        $this->searchCriteriaBuilder->addFilter(self::DATABASE_FIELD_STATUS, self::STATUS_ENABLED_VALUE, self::STATUS_CONDITION_TYPE_EQ);
        $searchCriteria = $this->searchCriteriaBuilder->create();

        return $this->questionRepository->getList($searchCriteria);
    }
}
