<?php
/**
 * Magebit_PageListWidget
 *
 * @category     Magebit
 * @package      Magebit_PageListWidget
 * @author       Niks Veinbergs
 * @copyright    Copyright (c) 2023 Magebit, Ltd.(https://www.magebit.com/)
 */
declare(strict_types=1);

namespace Magebit\PageListWidget\Block\Widget;

use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Cms\Helper\Page;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Widget\Block\BlockInterface;

class PageList extends Template implements BlockInterface
{
    const DISPLAY_MODE_SELECTED_PAGES = 2;
    const SELECTED_PAGES = 'pages';
    protected $_template = "page-list.phtml";
    protected \Magento\Cms\Api\PageRepositoryInterface $_pageRepository;
    protected \Magento\Cms\Helper\Page $_pageHelper;
    protected \Magento\Framework\Api\SearchCriteriaBuilder $_searchCriteriaBuilder;
    protected \Magento\Framework\Api\FilterBuilder $_filterBuilder;

    /**
     * @param Context $context
     * @param Page $pageHelper
     * @param PageRepositoryInterface $pageRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterBuilder $filterBuilder
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Cms\Helper\Page $pageHelper,
        \Magento\Cms\Api\PageRepositoryInterface $pageRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_pageRepository = $pageRepository;
        $this->_pageHelper = $pageHelper;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_filterBuilder = $filterBuilder;
    }

    /**
     * Returns input title as a String
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getData('title');
    }

    /**
     * Returns display mode as a string
     *
     * @return string
     */
    public function getDisplayMode(): string
    {
        return $this->getData('display_mode');
    }

    /**
     * Based on display mode, returns specific pages (adds additional filter) or returns all pages w/o filter
     *
     * @return array
     * @throws LocalizedException
     */
    public function getPages(): array
    {
        $pages = [];
        $filters =[];
        if ($this->getDisplayMode() == self::DISPLAY_MODE_SELECTED_PAGES) {
            $selectedPageIds = explode(',', $this->getData(self::SELECTED_PAGES));
            $filters[] = $this->_filterBuilder->setField('identifier')->setValue($selectedPageIds)->setConditionType('in')->create();
        }

        $searchCriteria = $this->_searchCriteriaBuilder->addFilters($filters)->create();
        $searchResults = $this->_pageRepository->getList($searchCriteria);
        foreach ($searchResults->getItems() as $page) {
            $pages[] = [
                'url' => $this->_pageHelper->getPageUrl($page->getId()),
                'name' => $page->getTitle()
            ];
        }
        return $pages;
    }
}
