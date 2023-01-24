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
namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Magebit\Faq\Model\QuestionFactory;

class Save extends Action implements HttpPostActionInterface
{
    public function __construct(
        Context $context,
        private QuestionResource $resource,
        private QuestionFactory $questionFactory
    ) {
        parent::__construct($context);
    }

    /**
     * @throws AlreadyExistsException
     */
    public function execute() : \Magento\Framework\Controller\Result\Redirect
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $model = $this->questionFactory->create();
            if (empty($data['id'])) {
                $data['id'] = null;
            }

            $model->setData($data);
            try {
                $this->resource->save($model);
                $this->messageManager->addSuccessMessage(__('Successfully created new FAQ'));
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $exception) {
                $this->messageManager->addExceptionMessage($exception);
            } catch (\Throwable $e) {
                $this->messageManager->addErrorMessage(__('Error occured saving FAQ'));
            }
        }
        return $resultRedirect->setPath('*/*/');
    }
}
