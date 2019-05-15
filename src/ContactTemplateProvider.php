<?php

namespace DorsetDigital\SilverStripe\ContactForm;

use SilverStripe\View\ArrayData;
use SilverStripe\View\SSViewer;
use SilverStripe\View\TemplateGlobalProvider;

class ContactTemplateProvider implements TemplateGlobalProvider
{
    public static function get_template_global_variables()
    {
        return [
            'ContactForm' => 'ContactFormFunction'
        ];
    }

    public static function ContactFormFunction()
    {
        $template = SSViewer::create('DorsetDigital/SilverStripe/ContactForm/ContactTemplateProvider');
        $controller = new ControllerExtension();
        $form = $controller->ContactForm();

        return $template->process(ArrayData::create([
            'AddContactForm' => $form,
            'SuccessMessage' => $controller->SuccessMessage()
        ]));
    }
}
