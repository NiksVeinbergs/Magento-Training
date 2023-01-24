<?php
/**
 * Magebit_Faq
 *
 * @category     Magebit
 * @package      Magebit_Faq
 * @author       Niks Veinbergs
 * @copyright    Copyright (c) 2023 Magebit, Ltd.(https://www.magebit.com/)
 */

namespace Magebit\Faq\Api\Data;

interface QuestionInterface
{
    const QUESTION_ID = 'id';
    const QUESTION_TITLE = 'question';
    const QUESTION_ANSWER = 'answer';
    const QUESTION_STATUS = 'status';
    const QUESTION_POSITION = 'position';
    const UPDATED_AT = 'updated_at';
    public function getId();
    public function getQuestion();
    public function setQuestion($question);
    public function getAnswer();
    public function setAnswer($answer);

    public function getStatus();
    public function setStatus($status);
    public function getPosition();
    public function setPosition($position);
    public function getUpdatedAt();
}
