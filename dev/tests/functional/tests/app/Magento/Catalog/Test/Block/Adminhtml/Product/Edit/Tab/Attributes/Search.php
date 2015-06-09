<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Catalog\Test\Block\Adminhtml\Product\Edit\Tab\Attributes;

use Magento\Mtf\Client\Element\SuggestElement;
use Magento\Catalog\Test\Fixture\CatalogProductAttribute;
use Magento\Mtf\Client\Locator;

/**
 * Form Attribute Search on Product page.
 */
class Search extends SuggestElement
{
    /**
     * Selector for top page.
     *
     * @var string
     */
    protected $topPage = './ancestor::body//header[contains(@class, "page-header")]/div[1]';

    /**
     * Attributes locator.
     *
     * @var string
     */
    protected $value = '.action-toggle > span';

    /**
     * Attributes button.
     *
     * @var string
     */
    protected $actionToggle = '.action-toggle';

    /**
     * Saerch result dropdown.
     *
     * @var string
     */
    protected $searchResult = '.mage-suggest-dropdown';

    /**
     * Searched attribute result locator.
     *
     * @var string
     */
    protected $searchArrtibute = './/a[text()="%s"]';

    /**
     * Set value.
     *
     * @param string $value
     * @return void
     */
    public function setValue($value)
    {
        $this->find($this->actionToggle)->click();
        parent::setValue($value);
    }

    /**
     * Get value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->find($this->value)->getText();
    }

    /**
     * Checking not exist attribute in search result.
     *
     * @param CatalogProductAttribute $productAttribute
     * @return bool
     */
    public function isExistAttributeInSearchResult($productAttribute)
    {
        $this->find($this->topPage, Locator::SELECTOR_XPATH)->click();
        $this->find($this->actionToggle)->click();

        return $this->isExistValueInSearchResult($productAttribute->getFrontendLabel());
    }

    /**
     * Wait for search result is visible.
     *
     * @return void
     */
    public function waitResult()
    {
        $browser = $this;
        $selector = $this->searchResult;
        $browser->waitUntil(
            function () use ($browser, $selector) {
                $element = $browser->find($selector);
                return $element->isVisible() ? true : null;
            }
        );
    }
}
