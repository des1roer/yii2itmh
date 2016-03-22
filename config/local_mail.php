<?php
return [ 'mail' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.gmail.com', // e.g. smtp.mandrillapp.com or smtp.gmail.com
        'username' => '',
        'password' => '',
        'port' => 25, // Port 25 is a very common port too
    //   'encryption' => 'tls', // It is often used, check your provider or mail server specs
    ]
];
