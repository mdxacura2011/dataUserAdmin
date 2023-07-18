<?php
declare(strict_types = 1);

namespace Serhii\UserAdmin\Block\Adminhtml\System\Account\Edit;

/**
 * Preference form admin user data
 */
class Form extends \Magento\Backend\Block\System\Account\Edit\Form
{
    /**
     * @return $this|\Magento\Backend\Block\System\Account\Edit\Form|Form
     */
    protected function _prepareForm()
    {
        parent::_prepareForm();
        $form = $this->getForm();
        $userId = $this->_authSession->getUser()->getId();
        $user = $this->_userFactory->create()->load($userId);
        $baseFieldset = $form->getElement('base_fieldset');

        $baseFieldset->addField(
            'job_description',
            'text',
            [
                'name' => 'job_description',
                'id' => 'job_description',
                'label' => __('Job description'),
                'title' => __('Job description'),
                'required' => false
            ]
        );

        $baseFieldset->addField(
            'profile_photo',
            'image',
            [
                'name' => 'profile_photo',
                'label' => __('Profile photo'),
                'id' => 'profile_photo',
                'title' => __('Profile photo'),
                'required' => false,
                'note' => 'Allow image type: jpg, jpeg, png'
            ]
        );

        $baseFieldset->addField(
            'phone_number',
            'text',
            [
                'name' => 'phone_number',
                'id' => 'phone_number',
                'label' => __('Phone number'),
                'title' => __('Phone number'),
                'required' => false
            ]
        );

        $data = $user->getData();
        unset($data['password']);
        $form->setValues($data);
        $this->setForm($form);

        return $this;
    }
}
