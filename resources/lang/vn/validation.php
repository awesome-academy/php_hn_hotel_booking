<?php
return [
    'custom' => [
        'password' => [
            'required' => 'Không được để trống mật khẩu',
            'confirmed' => 'Mật khẩu bạn nhập không khớp',
            'min' => 'Vui lòng nhập :attribute ít nhất :min ký tự.',
        ],
        'name' => [
            'required' => 'Vui lòng nhập tên của bạn',
        ],
        'email' => [
            'required' => 'Vui lòng nhập email của bạn',
            'unique' => 'Email bạn nhập đã được đăng ký',
        ]
    ],
    'attributes' => [
        'password' => 'Mật khẩu',
        'name' => 'Tên'
    ],
];
