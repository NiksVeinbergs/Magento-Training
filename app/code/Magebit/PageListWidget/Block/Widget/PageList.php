<?php
/**
 * Magebit_PageListWidget
 *
 * @category     Magebit
 * @package      Magebit_PageListWidget
 * @author       Niks Veinbergs
 * @copyright    Copyright (c) 2023 Magebit, Ltd.(https://www.magebit.com/)
 */

namespace Magebit\PageListWidget\Block\Widget;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class PageList extends Template implements BlockInterface
{
    protected $_template = "page-list.phtml";
    protected \Magento\Cms\Api\PageRepositoryInterface $_pageRepository;
    protected \Magento\Cms\Helper\Page $_pageHelper;
    protected \Magento\Framework\Api\SearchCriteriaBuilder $_searchCriteriaBuilder;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Cms\Helper\Page $pageHelper,
        \Magento\Cms\Api\PageRepositoryInterface $pageRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_pageRepository = $pageRepository;
        $this->_pageHelper = $pageHelper;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function getTitle()
    {
        return $this->getData('title');
    }

    /**
     * @throws LocalizedException
     */
    public function getPages(): array
    {
        if (empty($this->getData('pages'))) {
            return $this->getAllPages();
        }
        $selectedPageIds = explode(',', $this->getData('pages'));
        $pages = [];
        foreach ($selectedPageIds as $pageId) {
            try {
                $page = $this->_pageRepository->getById($pageId);
                $pages[] = [
                    'url' => $this->_pageHelper->getPageUrl($pageId),
                    'name' => $page->getTitle()
                ];
            } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
                // page not found
            }
        }
        return $pages;
    }

    /**
     * @throws LocalizedException
     */
    public function getAllPages(): array
    {
        $searchCriteria = $this->_searchCriteriaBuilder->create();
        $searchResults = $this->_pageRepository->getList($searchCriteria);
        $pages = [];
        foreach ($searchResults->getItems() as $page) {
            $pages[] = [
                'url' => $this->_pageHelper->getPageUrl($page->getId()),
                'name' => $page->getTitle()
            ];
        }
        return $pages;
    }
}
