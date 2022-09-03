<?php
    $parent_data = array(
        'id'=>'1',
        'firstname'=>'Parent',
        'lastname'=>'Dev',
        'email'=>'parent.dev@mailinator.com',
        'password'=>'123456',
        'profile_photo'=>'',
    );
    $teacher_data = array(
        'id'=>'2',
        'firstname'=>'Teacher',
        'lastname'=>'Dev',
        'email'=>'teacher.dev@mailinator.com',
        'password'=>'123456',
        'profile_photo'=>'',
    );
    $student_data = array(
        'id'=>'3',
        'firstname'=>'Student',
        'lastname'=>'Dev',
        'email'=>'student.dev@mailinator.com',
        'password'=>'123456',
        'profile_photo'=>'',
    );
    if(!defined('parent_data')) define('parent_data',$parent_data);
    if(!defined('teacher_data')) define('teacher_data',$teacher_data);
    if(!defined('student_data')) define('student_data',$student_data);

    if(!defined('base_url')) define('base_url','http://msgapp.local/');
    if(!defined('base_app')) define('base_app', str_replace('\\','/',__DIR__).'/' );

    if(!defined('DB_SERVER')) define('DB_SERVER',"localhost");
    if(!defined('DB_USERNAME')) define('DB_USERNAME',"root");
    if(!defined('DB_PASSWORD')) define('DB_PASSWORD',"root");
    if(!defined('DB_NAME')) define('DB_NAME',"msg_app");
?>