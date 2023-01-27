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

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;

/**
 * Class Edit
 */
class Edit extends Action implements HttpGetActionInterface
{
    /**
     * Description.
     *Returns Page and formats it to Edit page if ID exists or New Page if it doesn't
     *
     * @return Page
     */
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

    /**
     * Description.
     *Creates pages Result
     *
     * @return Page|ResultInterface
     */
    private function createPageResult(): Page|ResultInterface
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
