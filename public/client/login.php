<?php
require("../../config/config.php");
require("../../config/function.php");
// require("../../templates/client/header.php");
// require("../../templates/client/Nav.php");
?>

<!DOCTYPE html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?= $LINH->site('mota') ?>">
    <meta name="keywords" content="<?= $LINH->site('tukhoa') ?>">
    <meta name="author" content="WEBHOME.VN">
    <title><?= $LINH->site('tenweb') ?></title>
    <link rel="stylesheet" href="<?= URL('assets/dist/css/app.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.css" />
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>
</head>

<body>
    <div class="before:fixed before:top-0 before:z-[-1] before:h-screen before:w-screen before:bg-gradient-to-b before:from-theme-1 before:to-theme-2 before:transition-[opacity,height] before:duration-300 before:ease-in-out before:content-['']">
        <div class="container relative">
            <div class="flex min-h-screen w-full items-center justify-center p-5 md:p-20">
                <div class="intro-y w-96">
                    <img class="mx-auto" src="<?= URL('assets/img/theme/') ?><?= $LINH->site('logo'); ?>" alt="Rocketman - Admin Dashboard Template">
                    <!-- <div class="mt-8 text-center text-2xl font-medium text-white dark:text-slate-300">Login to Your -->
                    <!-- Account! -->
                    <!-- </div> -->
                    <div class="box box--stacked relative mt-14 max-w-[450px] px-5 py-8">
                        <input type="text" id="page-login-username" placeholder="Username" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&[type='file']]:border file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 block px-4 py-3">
                        <input type="password" id="page-login-password" placeholder="Password" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&[type='file']]:border file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 mt-4 block px-4 py-3">
                        <div class="mt-4 flex text-xs text-slate-500 sm:text-sm">
                            <div class="mr-auto flex items-center">
                                <input type="checkbox" class="transition-all duration-100 ease-in-out shadow-sm border-slate-200 cursor-pointer rounded focus:ring-4 focus:ring-offset-0 focus:ring-primary focus:ring-opacity-20 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&[type='radio']]:checked:bg-primary [&[type='radio']]:checked:border-primary [&[type='radio']]:checked:border-opacity-10 [&[type='checkbox']]:checked:bg-primary [&[type='checkbox']]:checked:border-primary [&[type='checkbox']]:checked:border-opacity-10 [&:disabled:not(:checked)]:bg-slate-100 [&:disabled:not(:checked)]:cursor-not-allowed [&:disabled:not(:checked)]:dark:bg-darkmode-800/50 [&:disabled:checked]:opacity-70 [&:disabled:checked]:cursor-not-allowed [&:disabled:checked]:dark:bg-darkmode-800/50 mr-2 border" id="remember-me">
                                <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                            </div>
                            <a href="#">Quên mật khẩu?</a>
                        </div>
                        <div class="mt-5 text-center xl:mt-8 xl:text-left">
                            <button class="transition duration-200 border shadow-sm inline-flex items-center justify-center px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary w-full py-3 xl:mr-3" onclick="login()" id="btnLoginPage">Đăng Nhập</button>
                            <a href="register" class="transition duration-200 border shadow-sm inline-flex items-center justify-center px-3 rounded-md font-medium cursor-pointer mt-3 w-full py-3">Đăng kí</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function login() {
            $('#btnLoginPage').html('Đang xử lý...').prop('disabled', true);
            let username = $("#page-login-username").val();
            let password = $("#page-login-password").val();
            if (username == "" || password == "") {
                new Notify({
                    status: "error",
                    title: "Thất bại",
                    text: "Nhập đầy đủ thông tin",
                    effect: "slide",
                    speed: 300,
                    customClass: "",
                    customIcon: "",
                    showIcon: true,
                    showCloseButton: true,
                    autoclose: true,
                    autotimeout: 2000,
                    notificationsGap: null,
                    notificationsPadding: null,
                    type: "outline",
                    position: "right top",
                    customWrapper: ""
                })
                $('#btnLoginPage').html(
                    'Đăng Nhập')
                setTimeout(function() {
                    $('#btnLoginPage').prop('disabled', false);
                }, 2000);
            } else {
                $.ajax({
                    url: "<?= URL("ajaxs/client/login.php"); ?>",
                    method: "POST",
                    data: {
                        type: 'login',
                        username: username,
                        password: password
                    },
                    success: function(response) {
                        $("#thongbao").html(response);
                        $('#btnLoginPage').html('Đăng Nhập')
                        setTimeout(function() {
                            $('#btnLoginPage').prop('disabled', false);
                        }, 3000);
                    }
                });
            }

        }
    </script>
    <div id="thongbao"></div>
    <script src="<?= URL('assets/dist/js/vendors/tailwind-merge.js'); ?>"></script>
    <script src="<?= URL('assets/dist/js/vendors/lucide.js'); ?>"></script>
    <!-- <script src="<?= URL('assets/dist/js/vendors/modal.js'); ?>"></script> -->
    <script src="<?= URL('assets/dist/js/components/base/theme-color.js'); ?>"></script>
    <script src="<?= URL('assets/dist/js/components/base/lucide.js'); ?>"></script>
</body>

</html>