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

use Magebit\Faq\Api\Data\QuestionSearchResultsInterface;
use Magento\Cms\Api\Data\BlockSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

class QuestionSearchResults extends SearchResults implements QuestionSearchResultsInterface
{

}
