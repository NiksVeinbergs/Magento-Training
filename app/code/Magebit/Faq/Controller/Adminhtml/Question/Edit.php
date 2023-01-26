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

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;

class Edit extends Action implements HttpGetActionInterface
{
    public function execute(): Page
    {
        $id = $this->getRequest()->getParam('id');
        $text = $id ? sprintf('Question: %u', $id) : __('New Question');
        $pageResult = $this->createPageResult();
        $title = $pageResult->getConfig()->getTitle();
        $title->prepend(__('Questions'));
        $title->prepend($text);

        return $pageResult;
    }

    private function createPageResult(): Page|ResultInterface
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
