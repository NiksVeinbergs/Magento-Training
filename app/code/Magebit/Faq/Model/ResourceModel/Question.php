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
namespace Magebit\Faq\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magebit\Faq\Api\Data\QuestionInterface;

/**
 * Class Question
 */
class Question extends AbstractDb
{
    /**
     * #@+
     * Constants for constructor.
     */
    private const TABLE_NAME  = 'faq';
    /**
     * #@-
     */


    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, QuestionInterface::QUESTION_ID);
    }//end _construct()
}//end class
