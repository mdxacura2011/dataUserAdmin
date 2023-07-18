<?php
declare(strict_types = 1);

namespace Serhii\UserAdmin\Plugin\Controller\Adminhtml\User;

use Magento\Backend\Model\Auth\Session;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Message\ManagerInterface;
use Magento\User\Model\ResourceModel\User;
use Magento\User\Model\UserFactory;

/**
 * Save data admin user form
 */
class Save
{
    /** @var Session */
    private $session;

    /** @var UserFactory */
    private $userFactory;

    /** @var User */
    private $userResourceModel;

    /** @var Http */
    private $request;

    /** @var ManagerInterface */
    private $messageManager;

    /**
     * @param Session $session
     * @param UserFactory $userFactory
     * @param User $userResourceModel
     * @param Http $request
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        Session $session,
        UserFactory $userFactory,
        User $userResourceModel,
        Http $request,
        ManagerInterface $messageManager
    ){
        $this->session = $session;
        $this->userFactory = $userFactory;
        $this->userResourceModel = $userResourceModel;
        $this->request = $request;
        $this->messageManager = $messageManager;
    }

    /**
     * @param \Magento\Backend\Controller\Adminhtml\System\Account\Save $subject
     * @param $result
     * @return mixed
     * @throws AlreadyExistsException
     */
    public function afterExecute(
        \Magento\Backend\Controller\Adminhtml\System\Account\Save $subject,
        $result
    ) {
        $userId = $this->session->getUser()->getId();
        $user = $this->userFactory->create();
        $this->userResourceModel->load($user, $userId);
        $profilePhoto = $this->request->getParam('profile_photo', false);
        if (is_array($profilePhoto)) {
            $profilePhoto = !empty($profilePhoto['delete']) ? "" : $profilePhoto['value'];
        }
        $user
            ->setJobDescription($this->request->getParam('job_description', false))
            ->setProfilePhoto($profilePhoto)
            ->setPhoneNumber($this->request->getParam('phone_number', false));
        $errors = $user->validate();
        if ($errors !== true && !empty($errors)) {
            foreach ($errors as $error) {
                $this->messageManager->addErrorMessage($error);
            }
        } else {
            $this->userResourceModel->save($user);
        }

        return $result;
    }
}
