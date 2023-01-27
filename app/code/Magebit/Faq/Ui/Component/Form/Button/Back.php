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
 * Class Back
 */
class Back implements ButtonProviderInterface
{
    /**
     * Description.
     *Back button currently not used, maybe will need to implement. Using button from CMS block instead
     *
     * @return array
     */
    public function getButtonData() : array
    {
        // TODO: Implement getButtonData() method. (But its working w/o this class (using CMS block redirect /*/* which is the same)
    }
}
