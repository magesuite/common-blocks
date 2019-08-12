<?php

namespace MageSuite\CommonBlocks\Setup;

class InstallData implements \Magento\Framework\Setup\InstallDataInterface
{

    /**
     * @var \Magento\Cms\Model\BlockFactory
     */
    private $blockFactory;

    /**
     * @var \Magento\Cms\Model\ResourceModel\Block
     */
    private $blockResource;

    /**
     * @var array
     */
    private $blocks;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    public function __construct(
        \Magento\Cms\Model\BlockFactory $blockFactory,
        \Magento\Cms\Model\ResourceModel\Block $blockResource,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->blockFactory = $blockFactory;
        $this->blockResource = $blockResource;
        $this->blocks = [];
        $this->logger = $logger;
    }

    public function install(\Magento\Framework\Setup\ModuleDataSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        try {
            $this->installBlocks();
        } catch (\Exception $e) {
            $this->logger->log(\Psr\Log\LogLevel::NOTICE, $e->getMessage());
        }
    }

    private function installBlocks()
    {
        $this->createHeaderTopbarHotlineBlock();
        $this->createHeaderTopbarUspsBlock();
        $this->createFooterLinks1Block();
        $this->createFooterLinks2Block();
        $this->createFooterLinks3Block();

        foreach ($this->blocks as $block) {
            $this->saveBlock($block);
        }
    }

    private function createHeaderTopbarHotlineBlock()
    {
        $content = <<<'EOT'
        <div class="cs-topbar__hotline">
            <a class="cs-topbar__phone-number" href="tel:{{config path="general/store_information/phone"}}">{{config path="general/store_information/phone"}}</a>
            <span class="cs-topbar__opening-hours-label">Our lines are open: </span>
            <span class="cs-topbar__opening-hours">{{config path="general/store_information/hours"}}</span>
        </div>
EOT;

        $block = $this->blockFactory->create();
        $block->setData([
            'title' => 'Header (Top Bar) - Hotline',
            'identifier' => 'header_topbar_hotline',
            'content' => $content,
            'stores' => [0],
            'is_active' => 1,
        ]);
        $this->blocks[] = $block;
    }

    private function createHeaderTopbarUspsBlock()
    {
        $content = <<<'EOT'
        <ul class="cs-topbar__list cs-topbar__list--featured">
            <li class="cs-topbar__list-item"><span class="cs-topbar__text">Discreet and rapid delivery</span></li>
            <li class="cs-topbar__list-item"><span class="cs-topbar__text">All offers include VAT</span></li>
            <li class="cs-topbar__list-item"><span class="cs-topbar__text">24h delivery</span></li>
        </ul>
EOT;

        $block = $this->blockFactory->create();
        $block->setData([
            'title' => 'Header (Top Bar) - USPs',
            'identifier' => 'header_topbar_usps',
            'content' => $content,
            'stores' => [0],
            'is_active' => 1,
        ]);
        $this->blocks[] = $block;
    }

    private function createFooterLinks1Block()
    {
        $content = <<<'EOT'
        <ul class="cs-footer-links">
            <li class="cs-footer-links__item">{{widget type="Magento\Cms\Block\Widget\Page\Link" template="widget/link/link_inline.phtml" page_id="3"}}</li>
            <li class="cs-footer-links__item">{{widget type="Magento\Cms\Block\Widget\Page\Link" template="widget/link/link_inline.phtml" page_id="3"}}</li>
            <li class="cs-footer-links__item">{{widget type="Magento\Cms\Block\Widget\Page\Link" template="widget/link/link_inline.phtml" page_id="3"}}</li>
            <li class="cs-footer-links__item">{{widget type="Magento\Cms\Block\Widget\Page\Link" anchor_text="Custom Link 4" template="widget/link/link_inline.phtml" page_id="3"}}</li>
            <li class="cs-footer-links__item">{{widget type="Magento\Cms\Block\Widget\Page\Link" anchor_text="Custom Link 5" template="widget/link/link_inline.phtml" page_id="3"}}</li>
        </ul>
EOT;

        $block = $this->blockFactory->create();
        $block->setData([
            'title' => 'Footer Links - 1',
            'identifier' => 'footer_links_1',
            'content' => $content,
            'stores' => [0],
            'is_active' => 1,
        ]);
        $this->blocks[] = $block;
    }

    private function createFooterLinks2Block()
    {
        $content = <<<'EOT'
        <ul class="cs-footer-links">
            <li class="cs-footer-links__item">{{widget type="Magento\Cms\Block\Widget\Page\Link" template="widget/link/link_inline.phtml" page_id="3"}}</li>
            <li class="cs-footer-links__item">{{widget type="Magento\Cms\Block\Widget\Page\Link" template="widget/link/link_inline.phtml" page_id="3"}}</li>
            <li class="cs-footer-links__item">{{widget type="Magento\Cms\Block\Widget\Page\Link" template="widget/link/link_inline.phtml" page_id="3"}}</li>
            <li class="cs-footer-links__item">{{widget type="Magento\Cms\Block\Widget\Page\Link" anchor_text="Custom Link 4" template="widget/link/link_inline.phtml" page_id="3"}}</li>
            <li class="cs-footer-links__item">{{widget type="Magento\Cms\Block\Widget\Page\Link" anchor_text="Custom Link 5" template="widget/link/link_inline.phtml" page_id="3"}}</li>
            <li class="cs-footer-links__item">{{widget type="Magento\Cms\Block\Widget\Page\Link" anchor_text="Custom Link 6" template="widget/link/link_inline.phtml" page_id="3"}}</li>
        </ul>
EOT;

        $block = $this->blockFactory->create();
        $block->setData([
            'title' => 'Footer Links - 2',
            'identifier' => 'footer_links_2',
            'content' => $content,
            'stores' => [0],
            'is_active' => 1,
        ]);
        $this->blocks[] = $block;
    }

    private function createFooterLinks3Block()
    {
        $content = <<<'EOT'
        <ul class="cs-footer-links">
            <li class="cs-footer-links__item">{{widget type="Magento\Cms\Block\Widget\Page\Link" template="widget/link/link_inline.phtml" page_id="3"}}</li>
            <li class="cs-footer-links__item">{{widget type="Magento\Cms\Block\Widget\Page\Link" template="widget/link/link_inline.phtml" page_id="3"}}</li>
            <li class="cs-footer-links__item">{{widget type="Magento\Cms\Block\Widget\Page\Link" anchor_text="Custom Link 3" template="widget/link/link_inline.phtml" page_id="3"}}</li>
            <li class="cs-footer-links__item"><a href="{{store direct_url="contact"}}">Contact us</a></li>
        </ul>
EOT;

        $block = $this->blockFactory->create();
        $block->setData([
            'title' => 'Footer Links - 3',
            'identifier' => 'footer_links_3',
            'content' => $content,
            'stores' => [0],
            'is_active' => 1,
        ]);
        $this->blocks[] = $block;
    }

    private function saveBlock(\Magento\Cms\Model\Block $block)
    {
        $identifier = $block->getIdentifier();

        if ($this->blockExists($identifier)) {
            return;
        }

        $this->blockResource->save($block);
    }

    private function blockExists($identifier)
    {
        $block = $this->blockFactory->create();
        $this->blockResource->load($block, $identifier, 'identifier');

        if($block->getId()) {
            return true;
        }

        return false;
    }
}
