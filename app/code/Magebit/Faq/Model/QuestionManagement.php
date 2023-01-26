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
namespace Magebit\Faq\Model;

use Magebit\Faq\Api\QuestionManagementInterface;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Class QuestionManagement
 */
class QuestionManagement implements QuestionManagementInterface
{
    /**
     * @var QuestionRepository
     */
    private $questionRepository;

    /**
     * @param QuestionRepository $questionRepository
     */
    public function __construct(
        QuestionRepository $questionRepository
    ) {
        $this->questionRepository = $questionRepository;
    }


    /**
     * Description.
     * Disable question, sets status value to STATUS_ENABLED and makes it visible in front-end
     *
     * @param Question $question
     * @return void
     * @throws CouldNotSaveException
     */
    public function enableQuestion(Question $question) : void
    {
        $question->setStatus(self::STATUS_ENABLED);
        $this->questionRepository->save($question);
    }

    /**
     * Description.
     * Disables question, sets status value to STATUS_DISABLED and makes it invisible in front-end
     *
     * @param Question $question
     * @return void
     * @throws CouldNotSaveException
     */
    public function disableQuestion(Question $question): void
    {
        $question->setStatus(self::STATUS_DISABLED);
        $this->questionRepository->save($question);
    }
}
