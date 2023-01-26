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

use Magebit\Faq\Api\QuestionManagementInterface;
use Magento\Framework\Exception\CouldNotSaveException;

class QuestionManagement implements QuestionManagementInterface
{
    private $questionRepository;
    public function __construct(
        QuestionRepository $questionRepository
    ) {
        $this->questionRepository = $questionRepository;
    }

    /**
     * @throws CouldNotSaveException
     */
    public function enableQuestion(Question $question)
    {
        $question->setStatus(self::STATUS_ENABLED);
        $this->questionRepository->save($question);

    }

    public function disableQuestion(Question $question)
    {
        $question->setStatus(self::STATUS_DISABLED);
        $this->questionRepository->save($question);
    }
}
