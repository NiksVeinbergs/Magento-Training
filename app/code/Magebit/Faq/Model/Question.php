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
    protected function _construct()
    {
        $this->_init(QuestionResource::class);
    }

    public function getId()
    {
        return $this->getData(self::QUESTION_ID);
    }

    public function getQuestion()
    {
        return $this->getData(self::QUESTION_TITLE);
    }

    public function setQuestion($question): Question
    {
        return $this->setData(self::QUESTION_TITLE, $question);
    }

    public function getAnswer()
    {
        return $this->getData(self::QUESTION_ANSWER);
    }

    public function setAnswer($answer): Question
    {
        return $this->setData(self::QUESTION_ANSWER, $answer);
    }

    public function getStatus()
    {
        return $this->getData(self::QUESTION_STATUS);
    }

    public function setStatus($status): Question
    {
        return $this->setData(self::QUESTION_STATUS, $status);
    }

    public function getPosition()
    {
        return $this->getData(self::QUESTION_POSITION);
    }

    public function setPosition($position): Question
    {
        return $this->setData(self::QUESTION_POSITION, $position);
    }

    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }
}
