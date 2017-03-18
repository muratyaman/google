<?php

namespace App\Services\GoogleService;


class GoogleScope
{

    //==================================================================================================================
    // GMAIL API V1

    // View and manage your mail
    const GMAIL_VIEW_AND_MANAGE           = 'https://mail.google.com/';

    // Manage drafts and send emails
    const GMAIL_DRAFT_AND_SEND            = 'https://www.googleapis.com/auth/gmail.compose';

    // Insert mail into your mailbox
    const GMAIL_INSERT_MAIL               = 'https://www.googleapis.com/auth/gmail.insert';

    // Manage mailbox labels
    const GMAIL_MANAGE_LABELS             = 'https://www.googleapis.com/auth/gmail.labels';

    // View your email message metadata such as labels and headers, but not the email body
    const GMAIL_VIEW_METADATA             = 'https://www.googleapis.com/auth/gmail.metadata';

    // View and modify but not delete your email
    const GMAIL_VIEW_AND_MODIFY_EMAILS    = 'https://www.googleapis.com/auth/gmail.modify';

    // View your emails messages and settings
    const GMAIL_VIEW_EMAILS_AND_SETTINGS  = 'https://www.googleapis.com/auth/gmail.readonly';

    // Send email on your behalf
    const GMAIL_SEND_EMAILS               = 'https://www.googleapis.com/auth/gmail.send';

    // Manage your basic mail settings
    const GMAIL_MANAGE_BASIC_SETTINGS     = 'https://www.googleapis.com/auth/gmail.settings.basic';

    // Manage your sensitive mail settings, including who can manage your mail
    const GMAIL_MANAGE_MORE_SETTINGS      = 'https://www.googleapis.com/auth/gmail.settings.sharing';
    //==================================================================================================================
    // CALENDAR API V3

    // Manage your calendars
    const CALENDAR_MANAGE = 'https://www.googleapis.com/auth/calendar';

    // View your calendars
    const CALENDAR_VIEW   = 'https://www.googleapis.com/auth/calendar.readonly';
    //==================================================================================================================

}