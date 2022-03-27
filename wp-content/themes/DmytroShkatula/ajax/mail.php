<?php check_ajax_referer( 'mail', 'security' );

if(!$_POST['fields']){
    return 'error';
}

$json = [];

parse_str($_POST['fields'], $fields);

if(!$fields['name']){
    $json['name'] = false;
}

if(!filter_var($fields['email'], FILTER_VALIDATE_EMAIL)){
    $json['email'] = false;
}

if(!$fields['message'] || strlen($fields['message']) < 20){
    $json['message'] = false;
}

if (empty($json)){
    $to = get_option('admin_email');
    $subject = 'New message from ' . get_option('blogname');
    $from = 'mailer@' . str_replace(['http://','https://'], '', get_site_url()) ;
    $message = 'Name:' . $fields['name'] . "\n\r" . 'Email:' . $fields['email'] . "\n\r" . $fields['message'];

    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        "From: {$fields['name']} <{$from}>"
    );

    header("Content-Type: application/json");

    if(wp_mail($to, $subject, $message, $headers)){
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

} else {
    header("Content-Type: application/json");
    echo json_encode($json);
}