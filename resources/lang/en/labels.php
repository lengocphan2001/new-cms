<?php

return [
    'text' => [
        'first_name' => 'Họ',
        'last_name' => 'Tên',
        'name' => 'Tên',
        'username' => 'Tên người dùng',
        'email' => 'Email',
        'mobile' => 'Số điện thoại',
        'password' => 'Mật khẩu (Tối thiểu 6 ký tự)',
        'password_confirmation' => 'Xác nhận mật khẩu',
        'gender' => 'Giới tính',
        'register' => 'Đăng ký ngay',
        'login' => 'Đăng nhập',
        'login_to_account' => 'Đăng nhập vào tài khoản',
        'need_help' => 'Cần trợ giúp?',
        'select_an_option' => 'Vui lòng chọn',
        'profile' => 'Hồ sơ cá nhân',
        'logout' => 'Đăng xuất',
        'male' => 'Nam',
        'female' => 'Nữ',
        'hijra' => 'Người chuyển giới',
        'other' => 'Khác',
        'Male' => 'Nam',
        'Female' => 'Nữ',
        'Hijra' => 'Người chuyển giới',
        'Other' => 'Khác',
        'edit_profile' => 'Chỉnh sửa hồ sơ',
        'category_name' => 'Danh mục',
    ],

    'backend' => [
        'users' => [
            'index' => [
                'action' => 'Danh sách',
                'title' => 'Người dùng',
                'sub-title' => 'Quản lý người dùng',
            ],
            'profile' => [
                'action' => 'Hiển thị',
                'title' => 'Hồ sơ người dùng',
                'sub-title' => 'Quản lý người dùng',
                'profile' => 'Hồ sơ',
            ],
            'show' => [
                'action' => 'Hiển thị',
                'title' => 'Người dùng',
                'sub-title' => 'Quản lý người dùng',
                'profile' => 'Hồ sơ',
            ],
            'edit' => [
                'action' => 'Chỉnh sửa',
                'title' => 'Người dùng',
                'sub-title' => 'Quản lý người dùng',
            ],
            'create' => [
                'action' => 'Tạo mới',
                'title' => 'Người dùng',
                'sub-title' => 'Quản lý người dùng',
            ],
            'fields' => [
                'name' => 'Tên',
                'first_name' => 'Họ',
                'last_name' => 'Tên',
                'email' => 'Email',
                'username' => 'Tên người dùng',
                'mobile' => 'Số điện thoại',
                'gender' => 'Giới tính',
                'date_of_birth' => 'Ngày sinh',
                'url_website' => 'Trang web',
                'url_facebook' => 'Facebook',
                'url_twitter' => 'Twitter',
                'url_googleplus' => 'Google Plus',
                'url_linkedin' => 'LinkedIn',
                'profile_privecy' => 'Quyền riêng tư hồ sơ',
                'address' => 'Địa chỉ',
                'bio' => 'Giới thiệu',
                'login_count' => 'Số lần đăng nhập',
                'last_ip' => 'IP lần cuối',
                'last_login' => 'Lần đăng nhập cuối',
                'password' => 'Mật khẩu',
                'password_confirmation' => 'Xác nhận mật khẩu',
                'confirmed' => 'Đã xác nhận',
                'active' => 'Hoạt động',
                'email_credentials' => 'Thông tin tài khoản',
                'roles' => 'Vai trò',
                'permissions' => 'Quyền hạn',
                'social' => 'Mạng xã hội',
                'picture' => 'Hình ảnh',
                'avatar' => 'Ảnh đại diện',
                'status' => 'Trạng thái',
                'created_at' => 'Tạo vào lúc',
                'updated_at' => 'Cập nhật vào lúc',
            ],
        ],
        'roles' => [
            'index' => [
                'action' => 'Danh sách',
                'title' => 'Vai trò',
                'sub-title' => 'Quản lý vai trò',
            ],
            'show' => [
                'action' => 'Hiển thị',
                'title' => 'Vai trò',
                'sub-title' => 'Quản lý vai trò',
                'profile' => 'Hồ sơ',
            ],
            'edit' => [
                'action' => 'Chỉnh sửa',
                'title' => 'Vai trò',
                'sub-title' => 'Quản lý vai trò',
            ],
            'create' => [
                'action' => 'Tạo mới',
                'title' => 'Vai trò',
                'sub-title' => 'Quản lý vai trò',
            ],
            'fields' => [
                'name' => 'Tên',
                'status' => 'Trạng thái',
                'permissions' => 'Quyền hạn',
                'created_at' => 'Tạo vào lúc',
                'updated_at' => 'Cập nhật vào lúc',
            ],
        ],
        'products' => [
            'index' => [
                'action' => 'Danh sách',
                'title' => 'San pham',
                'sub-title' => 'Quản lý san pham',
            ],
            'show' => [
                'action' => 'Hiển thị',
                'title' => 'san pham',
                'sub-title' => 'Quản lý san pham',
            ],
            'edit' => [
                'action' => 'Chỉnh sửa',
                'title' => 'san pham',
                'sub-title' => 'Quản lý san pham',
            ],
            'create' => [
                'action' => 'Tạo mới',
                'title' => 'san pham',
                'sub-title' => 'Quản lý san pham',
            ],
            'fields' => [
                'stt' => 'So thu tu',
                'name' => 'Tên san pham',
                'project_id' => 'Don hang',
                'price' => 'Don gia',
                'quantity' => 'So luong',
                'group_management' => 'Nhom san xuat',
                'number_of_employees' => 'So luong lao dong',
                'time_to_complete' => 'Thoi gian hoan thanh 1 SP',
                'time_each_employee' => 'Thoi gian hoan thanh cua nhan vien',
                'average_productivity' => 'Nang suat binh quan',
                'average_productivity_each_employee' => 'Nang suat cua nhan vien',
                'total_time' => 'Tong thoi gian',
                'created_at' => 'Tạo vào lúc',
                'updated_at' => 'Cập nhật vào lúc',
            ],
        ],
        'groups' => [
            'index' => [
                'action' => 'Danh sách',
                'title' => 'To san xuat',
                'sub-title' => 'Quản lý to san xuat',
            ],
            'show' => [
                'action' => 'Hiển thị',
                'title' => 'To san xuat',
                'sub-title' => 'Quản lý to san xuat',
                'profile' => 'Hồ sơ',
            ],
            'edit' => [
                'action' => 'Chỉnh sửa',
                'title' => 'To san xuat',
                'sub-title' => 'Quản lý to san xuat',
            ],
            'create' => [
                'action' => 'Tạo mới',
                'title' => 'To san xuat',
                'sub-title' => 'Quản lý to san xuat',
            ],
            'fields' => [
                'stt' => 'So thu tu',
                'name' => 'Tên to san xuat',
                'created_at' => 'Tạo vào lúc',
                'updated_at' => 'Cập nhật vào lúc',
            ],
        ],
        'stages' => [
            'index' => [
                'action' => 'Danh sách',
                'title' => 'Cong doan',
                'sub-title' => 'Quản lý cong doan',
            ],
            'show' => [
                'action' => 'Hiển thị',
                'title' => 'Cong doan',
                'sub-title' => 'Quản lý cong doan',
            ],
            'edit' => [
                'action' => 'Chỉnh sửa',
                'title' => 'Cong doan',
                'sub-title' => 'Quản lý cong doan',
            ],
            'create' => [
                'action' => 'Tạo mới',
                'title' => 'Cong doan',
                'sub-title' => 'Quản lý cong doan',
            ],
            'fields' => [
                'stt' => 'So thu tu',
                'name' => 'Tên cong doan',
                'group_stage' => 'Nhom cong doan',
                'machine_type' => 'Loai may',
                'price' => 'Don gia',
                'time_to_complete' => 'Thoi gian chuan',
                'number_of_employee' => 'So luong nhan vien',
                'created_at' => 'Tạo vào lúc',
                'updated_at' => 'Cập nhật vào lúc',
            ],
        ],
        'stage_groups' => [
            'index' => [
                'action' => 'Danh sách',
                'title' => 'Nhom cong doan',
                'sub-title' => 'Quản lý nhom cong doan',
            ],
            'show' => [
                'action' => 'Hiển thị',
                'title' => 'Nhom cong doan',
                'sub-title' => 'Quản lý nhom cong doan',
                'profile' => 'Hồ sơ',
            ],
            'edit' => [
                'action' => 'Chỉnh sửa',
                'title' => 'Nhom cong doan',
                'sub-title' => 'Quản lý nhom cong doan',
            ],
            'create' => [
                'action' => 'Tạo mới',
                'title' => 'Nhom cong doan',
                'sub-title' => 'Quản lý nhom cong doan',
            ],
            'fields' => [
                'stt' => 'So thu tu',
                'name' => 'Tên nhom cong doan',
                'created_at' => 'Tạo vào lúc',
                'updated_at' => 'Cập nhật vào lúc',
            ],
        ],
        'action' => 'Hành động',
        'create' => 'Tạo mới',
        'edit' => 'Chỉnh sửa',
        'changePassword' => 'Đổi mật khẩu',
        'delete' => 'Xóa',
        'restore' => 'Khôi phục',
        'save' => 'Lưu',
        'show' => 'Hiển thị',
        'update' => 'Cập nhật',
        'total' => 'Tổng',
        'block' => 'Chặn',
        'unblock' => 'Bỏ chặn',
        'cancel' => 'Hủy',
    ],

    'buttons' => [
        'general' => [
            'create' => 'Tạo mới',
            'save' => 'Lưu',
            'cancel' => 'Hủy',
            'update' => 'Cập nhật',
        ],
    ],

];
