<?php
/**
 * Magebit_Faq
 *
 * @category  Magebit
 * @package   Magebit_Faq
 * @author    Niks Veinbergs
 * @copyright Copyright (c) 2023 Magebit, Ltd.(https://www.magebit.com/)
 */
declare(strict_types=1);
namespace Magebit\Faq\Block;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

/**
 * Class QuestionList
 */
class QuestionList extends Template implements BlockInterface
{

    /**
     * @var QuestionRepositoryInterface
     */
    protected $questionRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var SortOrder
     */
    private $sortOrder;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    /**
     * @param QuestionRepositoryInterface $questionRepository
     * @param SearchCriteriaBuilder       $searchCriteriaBuilder
     * @param SortOrder                   $sortOrder
     * @param SortOrderBuilder            $sortOrderBuilder
     * @param Template\Context            $context
     * @param array                       $data
     */
    public function __construct(
        QuestionRepositoryInterface $questionRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrder $sortOrder,
        SortOrderBuilder $sortOrderBuilder,
        Template\Context $context,
        array $data=[]
    ) {
        $this->questionRepository    = $questionRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrder             = $sortOrder;
        $this->sortOrderBuilder      = $sortOrderBuilder;
        parent::__construct($context, $data);
    }//end __construct()

    /**
     * Description.
     * Gets list of question based on DESC order of DATABASE_FIELD_POSITION and with filters in use
     *
     * @return array
     */
    public function getQuestionList(): array
    {
        $sortOrder = $this->sortOrderBuilder->setField(QuestionInterface::QUESTION_POSITION)->setDirection(SortOrder::SORT_DESC)->create();
        $this->searchCriteriaBuilder->addSortOrder($sortOrder);
        $this->searchCriteriaBuilder->addFilter(QuestionInterface::QUESTION_STATUS, QuestionInterface::STATUS_ENABLED_VALUE, 'eq');
        $searchCriteria = $this->searchCriteriaBuilder->create();

        return $this->questionRepository->getList($searchCriteria)->getItems();
    }//end getQuestionList()
}//end class
