<?php
/**
 * @author       Niks Veinbergs
 * @copyright    Copyright (c) 2023
 */
use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    type: ComponentRegistrar::THEME,
    componentName: 'frontend/Magebit/learning',
    path: __DIR__
);
