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

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magento\Framework\Model\AbstractModel;

class Question extends AbstractModel implements QuestionInterface
{
    /**
     * Description.
     *Constructor for Question Model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(QuestionResource::class);
    }

    /**
     * Description.
     *Get ID
     *
     * @return array|mixed|null
     */
    public function getId(): mixed
    {
        return $this->getData(self::QUESTION_ID);
    }

    /**
     * Description.
     * Get FAQ title/question name
     *
     * @return array|mixed|null
     */
    public function getQuestion(): mixed
    {
        return $this->getData(self::QUESTION_TITLE);
    }

    /**
     * Description.
     *Set FAQ title/question name
     *
     * @param string $question
     * @return Question
     */
    public function setQuestion(string $question): Question
    {
        return $this->setData(self::QUESTION_TITLE, $question);
    }

    /**
     * Description.
     *Get answer
     *
     * @return array|mixed|null
     */
    public function getAnswer(): mixed
    {
        return $this->getData(self::QUESTION_ANSWER);
    }

    /**
     * Description.
     *Set answer
     *
     * @param string $answer
     * @return Question
     */
    public function setAnswer(string $answer): Question
    {
        return $this->setData(self::QUESTION_ANSWER, $answer);
    }

    /**
     * Description.
     *Get status
     *
     * @return array|mixed|null
     */
    public function getStatus(): mixed
    {
        return $this->getData(self::QUESTION_STATUS);
    }

    /**
     * Description.
     *Set status
     *
     * @param int $status
     * @return Question
     */
    public function setStatus(int $status): Question
    {
        return $this->setData(self::QUESTION_STATUS, $status);
    }

    /**
     * Description.
     *Get position
     *
     * @return array|mixed|null
     */
    public function getPosition(): mixed
    {
        return $this->getData(self::QUESTION_POSITION);
    }

    /**
     * Description.
     *Set position (higher position - FAQ will append higher)
     *
     * @param int $position
     * @return Question
     */
    public function setPosition(int $position): Question
    {
        return $this->setData(self::QUESTION_POSITION, $position);
    }

    /**
     * Description.
     *Get last time question was updated
     *
     * @return array|mixed|null
     */
    public function getUpdatedAt(): mixed
    {
        return $this->getData(self::UPDATED_AT);
    }
}
