
## Introduction

This module provides a simple way to add a contact form to a page outside the normal content area.

For more documentation about the module see the provided documentation located
inside the docs folder.

## Requirements

 * SilverStripe 4.x

## Installation

The module can be installed with composer using:  `composer require dorsetdigital/silverstripe-contactform`

Once installed, run a `dev/build?flush` and make sure you configure the module in the CMS settings screen.


##Usage
Insert `$ContactForm` placeholder in templates where you want the form to appear.

If you have the SilverStripe spamprotection module installed and enabled, it will automatically be applied to the contact form.


##Credits

Based on the work of Thomas Paulson [https://github.com/thomaspaulson/silverstripe-contactform]
