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

use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\QuestionFactory;
use Magebit\Faq\Model\QuestionRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Save
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * @param Context $context
     * @param QuestionRepositoryInterface $resource
     * @param QuestionFactory $questionFactory
     * @param QuestionRepository $questionRepository
     */
    public function __construct(
        Context $context,
        private QuestionRepositoryInterface $resource,
        private QuestionFactory $questionFactory,
        private QuestionRepository $questionRepository
    ) {
        parent::__construct($context);
    }

    /**
     * Description.
     *Saves FAQ
     *
     * @return Redirect
     */
    public function execute() : Redirect
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            if (empty($data['id'])) {
                $data['id'] = null;
            }
            $model = $this->questionFactory->create();

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                try {
                    $model = $this->questionRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This FAQ no longer exists.'));
                    return $resultRedirect->setPath('/*/*');
                }
            }
            $model->setData($data);
            try {
                $this->questionRepository->save($model);
                $messageText = $id ? __('Question: %1 Successfully edited', $id) : __('Successfully created new FAQ');
                $this->messageManager->addSuccessMessage($messageText);
                return $this->processQuestionReturn($model, $data, $resultRedirect);
            } catch (LocalizedException $exception) {
                $this->messageManager->addExceptionMessage($exception);
            } catch (\Throwable $e) {
                $this->messageManager->addErrorMessage(__('Error occured saving FAQ'));
            }
        }
        return $resultRedirect->setPath('');
    }

    /**
     * Description.
     *If save and close redirect back to FAQ index page, if just save then redirects to new/edited product ID save page.
     *
     * @param $model
     * @param $data
     * @param $resultRedirect
     * @return mixed
     */
    private function processQuestionReturn($model, $data, $resultRedirect): mixed
    {
        $redirect = $data['back'] ?? 'close';

        if ($redirect ==='continue') {
            $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
        } elseif ($redirect === 'close') {
            $resultRedirect->setPath('*/*/');
        }
        return $resultRedirect;
    }
}
