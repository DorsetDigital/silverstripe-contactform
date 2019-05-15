<?php

namespace ThomasPaulson\SilverStripe\ContactForm;

use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\Security\Security;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\View\Requirements;

class ContactController extends Controller
{

    private static $url_segment = 'contactform';

    private static $allowed_actions = [
        'ContactForm'
    ];

    public function ContactForm()
    {
        $form = new ContactForm($this, 'ContactForm');
        $form->enableSpamProtection();
        if ($form->hasExtension('SilverStripe\SpamProtection\Extension\FormSpamProtectionExtension')) {
            $form->enableSpamProtection();
        }
        return $form;
    }

    public function SuccessMessage()
    {
        $request = Injector::inst()->get(HTTPRequest::class);
        $session = $request->getSession();
        if ($session->get('MailSent')) {
            $config = SiteConfig::current_site_config();
            $message = $config->SubmitText;
            $session->set('MailSent', false);
            return DBField::create_field('HTMLFragment', $message);
        }
        return null;
    }

}
