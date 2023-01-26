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

use Magebit\Faq\Model\Question;

interface QuestionManagementInterface
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    public function enableQuestion(Question $question);
    public function disableQuestion(Question $question);
}
