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
namespace Magebit\Faq\Model\Question;

use Magebit\Faq\Model\Question;
use Magebit\Faq\Model\QuestionFactory;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;

/**
 * Class DataProvider
 */
class DataProvider extends ModifierPoolDataProvider
{

    /**
     * @var array
     */
    protected $loadedData;


    /**
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param CollectionFactory  $collectionFactory
     * @param QuestionResource   $resource
     * @param QuestionFactory    $questionFactory
     * @param RequestInterface   $request
     * @param array              $meta
     * @param array              $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        private QuestionResource $resource,
        private QuestionFactory $questionFactory,
        private RequestInterface $request,
        array $meta=[],
        array $data=[],
        PoolInterface $pool=null
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
        $this->collection = $collectionFactory->create();

    }//end __construct()


    /**
     * Description.
     * Get data of Current Question
     *
     *
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        foreach ($items as $question) {
            $this->loadedData[$question->getId()] = $question->getData();
        }

        return $this->loadedData;

    }//end getData()


    /**
     * Description.
     * Returns instance of current question
     *
     * @return Question
     */
    private function getCurrentQuestion() : Question
    {
        $questionId = $this->getQuestionId();
        $question   = $this->questionFactory->create();
        if (!$questionId) {
            return $question;
        }

        $this->resource->load($question, $questionId);
        return $question;

    }//end getCurrentQuestion()


    /**
     * Description.
     * Returns id of current question
     *
     * @return integer
     */
    private function getQuestionId() : int
    {
        return (int) $this->request->getParam($this->getRequestFieldName());

    }//end getQuestionId()


}//end class
