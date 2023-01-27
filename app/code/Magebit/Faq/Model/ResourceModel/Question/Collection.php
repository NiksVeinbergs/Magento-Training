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
namespace Magebit\Faq\Model\ResourceModel\Question;

use Magebit\Faq\Model\Question;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * Description.
     *Collection constructor
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(Question::class, QuestionResource::class);
    }
}
