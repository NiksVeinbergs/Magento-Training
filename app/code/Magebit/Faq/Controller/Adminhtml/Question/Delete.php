<?php
/**
 * Magebit_Faq
 *
 * @category     Magebit
 * @package      Magebit_Faq
 * @author       Niks Veinbergs
 * @copyright    Copyright (c) 2023 Magebit, Ltd.(https://www.magebit.com/)
 */

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Model\QuestionFactory;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;

class Delete extends Action implements HttpPostActionInterface
{
    public function __construct(
        Context $context,
        private QuestionFactory $questionFactory,
        private QuestionResource $resource
    ) {
        parent::__construct($context);
    }

    public function execute() : ResultInterface
    {
        $questionId = (int) $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if (!$questionId) {
            $this->messageManager->addErrorMessage('No question to delete');
            return $resultRedirect->setPath('*/*/');
        }

        $model = $this->questionFactory->create();
        try {
            $this->resource->load($model, $questionId);
            $this->resource->delete($model);
            $this->messageManager->addSuccessMessage('Question has been deleted');
        } catch (\Throwable $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        return $resultRedirect->setPath('*/*/');
    }
}
