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
            'min' => 'Vui lòng nhập tên ít nhất :max ký tự.',
        ],
        'email' => [
            'required' => 'Vui lòng nhập email của bạn',
            'unique' => 'Email bạn nhập đã được đăng ký',
        ],
        'province_id' => [
            'required' => 'Vui lòng chọn thành phố'
        ],
        'images' => [
            'required' => 'Vui lòng chọn hình ảnh'
        ],
        'description' => [
            'required' => 'Vui lòng nhập mô tả',
            'max' => 'Vui lòng nhập :attribute ít nhất :max ký tự.',
        ],
        'price' => [
            'required' => 'Không được để trống giá tiền',
            'numeric' => 'Giá tiền phải là một số'
        ],
        'qty' => [
            'required' => 'Không được để trống số lượng',
            'numeric' => 'số lượng phải là một số'
        ],
        'remaining' => [
            'required' => 'Không được để trống số phòng',
            'numeric' => 'Số phòng phải là một số',
            'lte' => 'Số phòng trống khải nhỏ hơn :value phòng'
        ]
    ],
    'attributes' => [
        'password' => 'mật khẩu',
        'name' => 'tên',
        'images' => 'hình ảnh',
        'province_id' => 'thành phố'
    ],
];
