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
namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Model\QuestionRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Delete
 */
class Delete extends Action implements HttpPostActionInterface
{


    /**
     * @param Context            $context
     * @param QuestionRepository $questionRepository
     */
    public function __construct(
        Context $context,
        private QuestionRepository $questionRepository
    ) {
        parent::__construct($context);
    }//end __construct()


    /**
     * Description.
     * Deletes entry of question
     *
     * @return ResultInterface
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute() : ResultInterface
    {
        $questionId     = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
        $question       = $this->questionRepository->getById($questionId);

        $message = $this->questionRepository->delete($question);
        if ($message) {
            $this->messageManager->addSuccessMessage('Question has been deleted');
        } else {
            $this->messageManager->addErrorMessage('No question to delete');
        }

        return $resultRedirect->setPath('*/*/');
    }//end execute()
}//end class
