<?php
declare(strict_types = 1);

namespace Serhii\UserAdmin\Block\Adminhtml\Page;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;

/**
 * Preference header page admin
 */
class Header extends \Magento\Backend\Block\Page\Header
{
    protected $_template = 'Serhii_UserAdmin::page/header.phtml';

    /**
     * @return string|null
     * @throws NoSuchEntityException
     */
    public function getAvatarAdmin()
    {
        if (!empty($ava = $this->getUser()->getProfilePhoto())) {
            return $this ->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . $ava;
        }

        return null;
    }
}
