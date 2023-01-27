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
namespace Magebit\Faq\Ui\Component\Listing\Column;

use Magento\Framework\Escaper;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class QuestionActions
 */
class QuestionActions extends Column
{

    /**#@+
     * Constants for URL Paths.
     */
    private const URL_PATH_EDIT = 'magebit_faq/question/edit';
    private const URL_PATH_DELETE = 'magebit_faq/question/delete';
    /**#@-*/

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param Escaper $escaper
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        private UrlInterface $urlBuilder,
        private Escaper $escaper,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Description.
     *Preparing data source for Edit/Delete
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['id'])) {
                    $name = $this->getData('name');
                    $item[$name]['edit'] = [
                        'href' => $this->getCustomUrl($item, self::URL_PATH_EDIT),
                        'label' => __('Edit')
                    ];
                    $question = $this->escaper->escapeHtml($item['question']);
                    $item[$name]['delete'] = [
                      'href' => $this->getCustomUrl($item, self::URL_PATH_DELETE),
                      'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete %1', $question),
                            'message' => __('Are you sure you want to delete a %1', $question)
                        ],
                        'post' => true
                    ];
                }
            }
        }
        return $dataSource;
    }

    /**
     * Description.
     *Gets faq url with id
     *
     * @param array $item
     * @param string $url
     * @return string
     */
    private function getCustomUrl(array $item, string $url) : string
    {
        return $this->urlBuilder->getUrl($url, ['id' => $item['id']]);
    }
}
