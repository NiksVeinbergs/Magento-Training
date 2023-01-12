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

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class PageList extends Template implements BlockInterface
{
    protected $_template = "page-list.phtml";
    protected $_page;
//Injectot page repository nevis source modeli
    public function __construct(Template\Context $context, array $data = [], \Magento\Cms\Model\Config\Source\Page $page)
    {
        parent::__construct($context, $data);
        $this->_page = $page;
    }

    public function pageOptionArray(): array
    {
        return $this->_page->toOptionArray();
    }
}
