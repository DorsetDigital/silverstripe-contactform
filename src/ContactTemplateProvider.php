<?php

namespace ThomasPaulson\SilverStripe\ContactForm;

use SilverStripe\View\ArrayData;
use SilverStripe\View\SSViewer;
use SilverStripe\View\TemplateGlobalProvider;

class ContactTemplateProvider implements TemplateGlobalProvider
{

    /**
     * @return array|void
     */
    public static function get_template_global_variables()
    {
        return [
            'ContactForm' => 'ContactFormFunction'
        ];
    }

    public static function ContactFormFunction()
    {
        $template = SSViewer::create('ThomasPaulson/SilverStripe/ContactForm/ContactTemplateProvider');
        $controller = new ContactController();
        $form = $controller->ContactForm();

        return $template->process(ArrayData::create([
            'AddContactForm' => $form,
            'SuccessMessage' => $controller->SuccessMessage()
        ]));
    }
}
