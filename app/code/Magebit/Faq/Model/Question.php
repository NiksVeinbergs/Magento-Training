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
namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magento\Framework\Model\AbstractModel;

class Question extends AbstractModel implements QuestionInterface
{


    /**
     * Description.
     * Constructor for Question Model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(QuestionResource::class);
    }//end _construct()


    /**
     * Description.
     * Get ID
     *
     * @return array|mixed|null
     */
    public function getId(): mixed
    {
        return $this->getData(self::QUESTION_ID);
    }//end getId()


    /**
     * Description.
     * Get FAQ title/question name
     *
     * @return array|mixed|null
     */
    public function getQuestion(): mixed
    {
        return $this->getData(self::QUESTION_TITLE);
    }//end getQuestion()


    /**
     * Description.
     * Set FAQ title/question name
     *
     * @param  string $question
     * @return Question
     */
    public function setQuestion(string $question): Question
    {
        return $this->setData(self::QUESTION_TITLE, $question);
    }//end setQuestion()


    /**
     * Description.
     * Get answer
     *
     * @return array|mixed|null
     */
    public function getAnswer(): mixed
    {
        return $this->getData(self::QUESTION_ANSWER);
    }//end getAnswer()


    /**
     * Description.
     * Set answer
     *
     * @param  string $answer
     * @return Question
     */
    public function setAnswer(string $answer): Question
    {
        return $this->setData(self::QUESTION_ANSWER, $answer);
    }//end setAnswer()


    /**
     * Description.
     * Get status
     *
     * @return array|mixed|null
     */
    public function getStatus(): mixed
    {
        return $this->getData(self::QUESTION_STATUS);
    }//end getStatus()


    /**
     * Description.
     * Set status
     *
     * @param  integer $status
     * @return Question
     */
    public function setStatus(int $status): Question
    {
        return $this->setData(self::QUESTION_STATUS, $status);
    }//end setStatus()


    /**
     * Description.
     * Get position
     *
     * @return array|mixed|null
     */
    public function getPosition(): mixed
    {
        return $this->getData(self::QUESTION_POSITION);
    }//end getPosition()


    /**
     * Description.
     * Set position (higher position - FAQ will append higher)
     *
     * @param  integer $position
     * @return Question
     */
    public function setPosition(int $position): Question
    {
        return $this->setData(self::QUESTION_POSITION, $position);
    }//end setPosition()


    /**
     * Description.
     * Get last time question was updated
     *
     * @return array|mixed|null
     */
    public function getUpdatedAt(): mixed
    {
        return $this->getData(self::UPDATED_AT);
    }//end getUpdatedAt()


    public function getAvailableStatuses()
    {
        return [
            self::STATUS_ENABLED_VALUE  => __('Enabled'),
            self::STATUS_DISABLED_VALUE => __('Disabled'),
        ];
    }//end getAvailableStatuses()
}//end class
