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
namespace Magebit\Faq\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface QuestionSearchResultsInterface
 */
interface QuestionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get FAQ list.
     *
     * @return QuestionInterface
     */
    public function getItems();

    /**
     * Set FAQ list.
     *
     * @param QuestionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
