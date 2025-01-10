<?php
session_start();



// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/NguoiDungController.php';
require_once './controllers/TinTucController.php';
require_once './controllers/MaKhuyenMaiController.php';

// Require toàn bộ file Models
require_once './models/Base.php';
require_once './models/NguoiDung.php';
require_once './models/Home.php';
require_once './models/TinTuc.php';
require_once './models/MaKhuyenMai.php';


require_once "./mailer/src/Exception.php";
require_once "./mailer/src/PHPMailer.php";
require_once "./mailer/src/SMTP.php";



// Route
$act = $_GET['act'] ?? '/';

// $mail = new PHPMailer()


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/'                 => (new HomeController())->index(),
    'lien-he'           => (new HomeController())->contactPage(),
    'list-san-pham'     => (new HomeController())->listProduct(),
    'chi-tiet-san-pham' => (new HomeController())->detailProduct(),

    // 'form-dang-nhap' => (new NguoiDungController())->formLogin(),
    // 'dang-nhap'      => (new NguoiDungController())->login(),
    // 'dang-xuat'      => (new NguoiDungController())->logout(),
    // 'form-dang-ky'   => (new NguoiDungController())->formSignUp(),
    // 'dang-ky'        => (new NguoiDungController())->signUp(),
    // 'list-yeu-thich' => (new NguoiDungController())->listLike(),
    // 'gui-lien-he'    => (new NguoiDungController())->sendContact(),

    //Người dùng
    'form-dang-nhap'          => (new NguoiDungController())->formLogin(),
    'dang-nhap'               => (new NguoiDungController())->login(),
    'dang-xuat'               => (new NguoiDungController())->logout(),
    'form-dang-ky'            => (new NguoiDungController())->formSignUp(),
    'dang-ky'                 => (new NguoiDungController())->signUp(),
    'list-yeu-thich'          => (new NguoiDungController())->listLike(),
    'gui-binh-luan'           => (new NguoiDungController())->sendComment(),
    'gui-lien-he'             => (new NguoiDungController())->sendContact(),
    'tai-khoan'               => (new NguoiDungController())->viewAccount(),
    'cap-nhat-tai-khoan'      => (new NguoiDungController())->editAccount(),
    'submit-update-tai-khoan' => (new NguoiDungController())->updateAccount(),
    'doi-mat-khau'            => (new NguoiDungController())->getFormChangePassword(),
    'submit-update-mat-khau'  => (new NguoiDungController())->updatePassword(),
    'yeu-thich-san-pham'      => (new NguoiDungController())->likeProduct(),
    'xoa-yeu-thich'           => (new NguoiDungController())->deleteLike(),
    'xoa-list-yeu-thich'      => (new NguoiDungController())->deleteAllLike(),
    'danh-gia-san-pham'       => (new NguoiDungController())->reviewProduct(),

    // Quên mật khẩu
    'form-email-quen-mat-khau' => (new NguoiDungController())->formEmail(),
    'kiem-tra-email'           => (new NguoiDungController())->checkEmail(),
    'form-verify-code'         => (new NguoiDungController())->formVerifyCode(),
    'kiem-tra-code'            => (new NguoiDungController())->verifyCode(),
    'form-doi-mat-khau'        => (new NguoiDungController())->formChangePassword(),
    'reset-mat-khau'           => (new NguoiDungController())->resetPassword(),


    // Giỏ hàng, Thanh Toán
    'them-gio-hang'           => (new NguoiDungController())->addToCart(),
    'gio-hangs'               => (new NguoiDungController())->listCart(),
    'xoa-gio-hang'            => (new NguoiDungController())->deleteCart(),
    'check-quantity-cart'     => (new NguoiDungController())->checkQuantity(),
    'form-thanh-toan'         => (new NguoiDungController())->formCheckOut(),
    'check-coupon'            => (new NguoiDungController())->checkCoupon(),
    'thanh-toan'              => (new NguoiDungController())->checkOut(),
    'dat-hang-thanh-cong'     => (new NguoiDungController())->orderSuccess(),


    //Tin Tức
    'tin-tuc'           => (new TinTucController())->index(),
    'chi-tiet-tin-tuc'  => (new TinTucController())->viewDetail(),

    //Mã Khuyến Mãi
    'ma-khuyen-mai'     => (new MaKhuyenMaiController())->index(),

    //Đơn hàng
    'don-hang'              => (new NguoiDungController())->viewMyOrder(),
    'chi-tiet-don-hang'     => (new NguoiDungController())->viewManageOrder(),
    'huy-don-hang'          => (new NguoiDungController())->cancelOrder(),
    'xac-nhan-thanh-cong'   => (new NguoiDungController())->confirmSuccessOrder(),
};
