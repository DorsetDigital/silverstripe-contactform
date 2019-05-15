<?php

namespace DorsetDigital\SilverStripe\ContactForm;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;

class SiteConfigExtension extends DataExtension
{

    private static $db = [
        'MailFrom' => 'Varchar(100)',
        'MailTo' => 'Varchar(100)',
        'SubmitText' => 'HTMLText',
        'EmailSubject' => 'Varchar(200)',
        'FormTitle' => 'Varchar(60)',
        'FormIntro' => 'HTMLText'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab("Root.ContactForm", [
            TextField::create('FormTitle', _t(__CLASS__.'.FORM_TITLE', 'Title shown above the form')),
            HTMLEditorField::create('FormIntro', _t(__CLASS__.'.FORM_INTRO', "Text shown before the form")),
            TextField::create("MailFrom", _t(__CLASS__ . '.MAIL_FROM', 'Send emails from')),
            TextField::create("MailTo", _t(__CLASS__ . '.MAIL_TO', "Recipient email")),
            TextField::create("EmailSubject", _t(__CLASS__ . '.EMAIL_SUBJECT', "Email Subject")),
            HTMLEditorField::create('SubmitText',
                _t(__CLASS__ . '.SUBMIT_TEXT', 'Message to be displayed after a user submits the form'))
        ]);
    }
}
