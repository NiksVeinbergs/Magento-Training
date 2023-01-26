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
namespace Magebit\Faq\Api\Data;

interface QuestionInterface
{
    /**#@+
     * Constants for keys of data array.
     */
    const QUESTION_ID = 'id';
    const QUESTION_TITLE = 'question';
    const QUESTION_ANSWER = 'answer';
    const QUESTION_STATUS = 'status';
    const QUESTION_POSITION = 'position';
    const UPDATED_AT = 'updated_at';
    /**#@-*/

    public function getId();
    public function getQuestion();
    public function setQuestion(string $question);
    public function getAnswer();
    public function setAnswer(string $answer);

    public function getStatus();
    public function setStatus(int $status);
    public function getPosition();
    public function setPosition(int $position);
    public function getUpdatedAt();
}
