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
namespace Magebit\Faq\Ui\Component\Form\Button;

use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class Delete
 */
class Delete implements ButtonProviderInterface
{

    /**
     * @var QuestionRepositoryInterface
     */
    protected $questionRepository;


    /**
     * @param Context                     $context
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        Context $context,
        QuestionRepositoryInterface $questionRepository,
    ) {
        $this->context            = $context;
        $this->questionRepository = $questionRepository;

    }//end __construct()


    /**
     * Description.
     *
     * @return array
     */
    public function getButtonData(): array
    {
        $data = [];
        if ($this->getQuestionId()) {
            $data = [
                'label'      => __('Delete Question'),
                'class'      => 'delete',
                'on_click'   => 'deleteConfirm(\''.__(
                    'Are you sure you want to do this?'
                ).'\', \''.$this->getDeleteUrl().'\', {"data": {}})',
                'sort_order' => 20,
            ];
        }

        return $data;

    }//end getButtonData()


    /**
     * URL to send delete requests to.
     *
     * @return string
     */
    public function getDeleteUrl(): string
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getQuestionId()]);

    }//end getDeleteUrl()


    /**
     * Description.
     *
     * @return array|mixed|null
     */
    public function getQuestionId(): mixed
    {
        if ($this->context->getRequest()->getParam('id')) {
            try {
                return $this->questionRepository->getById(
                    $this->context->getRequest()->getParam('id')
                )->getId();
            } catch (NoSuchEntityException $e) {
            }
        }

        return null;

    }//end getQuestionId()


    /**
     * Description.
     *
     * @param  $route
     * @param  $params
     * @return string
     */
    public function getUrl($route='', $params=[]): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);

    }//end getUrl()


}//end class
