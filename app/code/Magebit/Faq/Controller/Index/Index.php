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
namespace Magebit\Faq\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 */
class Index implements HttpGetActionInterface
{
    /**
     * @param PageFactory $pageFactory
     */
    public function __construct(
        private PageFactory $pageFactory
    ) {
    }

    /**
     * Description.
     *Returns front-end page of FAQ and sets page title and layout to 2 columns
     *
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute() //TODO Return type?
    {
        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->set(__('Frequently Asked Questions'));
        $page->getConfig()->setPageLayout('2columns');

        return $page;
    }
}
