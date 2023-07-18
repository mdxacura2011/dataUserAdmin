<?php
declare(strict_types = 1);

namespace Serhii\UserAdmin\Block\Adminhtml\User\Edit\Tab;

use Magento\Backend\Block\Widget\Form;

/**
 * Preference form admin user data
 */
class Main extends \Magento\User\Block\User\Edit\Tab\Main
{
    /**
     * @return $this|Form
     */
    protected function _prepareForm()
    {
        parent::_prepareForm();
        $form = $this->getForm();
        $model = $this->_coreRegistry->registry('permissions_user');
        $baseFieldset = $form->getElement('base_fieldset');

        $baseFieldset->addField(
            'job_description',
            'text',
            [
                'name' => 'job_description',
                'id' => 'job_description',
                'label' => __('Job description'),
                'title' => __('Job description'),
                'value' => $model->getJobDescription(),
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
                'value' => $model->getProfilePhoto(),
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
                'value' => $model->getPhoneNumber(),
                'required' => false
            ]
        );

        return $this;
    }
}
