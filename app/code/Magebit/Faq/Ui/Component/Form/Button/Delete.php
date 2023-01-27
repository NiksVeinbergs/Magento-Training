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
namespace Magebit\Faq\Ui\Component\Form\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class Delete
 */
class Delete implements ButtonProviderInterface
{
    /**
     * Description.
     *Delete button not needed (in example)
     *
     * @return array|void
     */
    public function getButtonData()
    {
        // TODO: Implement getButtonData() method. (No delete button in example so not sure about implementation)
    }
}
