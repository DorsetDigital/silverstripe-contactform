<?php

namespace DorsetDigital\SilverStripe\ContactForm;

use SilverStripe\Control\Controller;
use SilverStripe\Control\Email\Email;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\SiteConfig\SiteConfig;


class ContactForm extends Form
{

    public function __construct($controller, $name)
    {
        $fields = FieldList::create(
            CompositeField::create(
                TextField::create("Name")->setAttribute('placeholder', _t(__CLASS__ . '.YOURNAME', 'Your name'))
                    ->setCustomValidationMessage(_t(__CLASS__ . '.YOURNAME_MESSAGE_REQUIRED', 'Please enter your name'))
                    ->setAttribute('data-message-required',
                        _t(__CLASS__ . '.YOURNAME_MESSAGE_REQUIRED', 'Please enter your name')),


                EmailField::create("Email")
                    ->setAttribute('placeholder', _t(__CLASS__ . '.EMAILADDRESS', "Your email address"))
                    ->setCustomValidationMessage(_t(__CLASS__ . '.EMAILADDRESS_MESSAGE_REQUIRED',
                        'Please enter your email address'))
                    ->setAttribute('data-message-required',
                        _t(__CLASS__ . '.EMAILADDRESS_MESSAGE_REQUIRED', 'Please enter your email address'))
                    ->setAttribute('data-message-email',
                        _t(__CLASS__ . '.EMAILADDRESS_MESSAGE_EMAIL', 'Please enter a valid email address')),


                TextareaField::create("Comment")
                    ->setAttribute('placeholder', _t(__CLASS__ . '.COMMENTS', "Your message"))
                    ->setCustomValidationMessage(_t(__CLASS__ . '.COMMENT_MESSAGE_REQUIRED',
                        'Please enter your comment'))
                    ->setAttribute('data-message-required',
                        _t(__CLASS__ . '.COMMENT_MESSAGE_REQUIRED', 'Please enter your comment'))
            )->addExtraClass('data-fields')
        );


        $actions = FieldList::create(
            FormAction::create("doPostContact", _t(__CLASS__ . '.POST', 'Send'))
        );

        $required = RequiredFields::create([
            'Name',
            'Email',
            'Comment'
        ]);

        parent::__construct($controller, $name, $fields, $actions, $required);
    }


    public function doPostContact($data, $form)
    {

        $config = SiteConfig::current_site_config();

        $subject = $config->EmailSubject;
        $email = new Email();
        $email->setFrom($config->MailFrom);
        $email->setTo($config->MailTo);
        $email->setReplyTo($data['Email']);
        $email->setHTMLTemplate('DorsetDigital/SilverStripe/ContactForm/ContactEmail');
        $email->setData($data);
        $email->send();

        $controller = Controller::curr();
        $controller->getRequest()->getSession()->set('MailSent', true);
        $url = (isset($data['ReturnURL'])) ? $data['ReturnURL'] : false;

        return $controller->redirectBack('#ContactForm_ContactForm');
    }


}
