<?php
require_once("config/config.php");
require_once("config/function.php");
$baotri = $LINH->site('baotri');
if ($baotri === "ON") {
    if (!(isset($_SESSION['username']) && $getUser['level'] === "admin")) {
        header("Location: public/baotri.php");
        exit;
    }
}
if (!isset($_SESSION['username'])) {
    header("Location: login");
    exit;
}
?>
<?php require_once("templates/client/Header.php"); ?>
<div class="waveform before:content-[''] before:h-screen before:w-screen before:bg-gradient-to-b before:from-theme-1 before:to-theme-2 before:top-0 before:fixed">
    <div class="relative loading-page loading-page--before-hide [&.loading-page--before-hide]:before:block [&.loading-page--hide]:before:opacity-0 before:content-[''] before:transition-opacity before:duration-300 before:hidden before:h-screen before:w-screen before:fixed before:bg-gradient-to-b before:from-theme-1 before:to-theme-2 before:z-[60] [&.loading-page--before-hide]:after:block [&.loading-page--hide]:after:opacity-0 after:content-[''] after:transition-opacity after:duration-300 after:hidden after:h-16 after:w-16 after:animate-pulse after:fixed after:opacity-50 after:inset-0 after:m-auto after:bg-loading-puff after:bg-cover after:z-[61]">
        <?php require_once("templates/client/Nav.php"); ?>

        <div class="content relative transition-[margin,width] duration-100 pl-5 xl:pl-0 pr-5 pt-[66px] pb-5 content--compact xl:ml-[275px] [&.content--compact]:xl:ml-[91px]">
            <div class="relative z-10 mt-[35px] rounded-3xl bg-slate-100 px-5 pt-px pb-5 min-h-screen before:content-[''] before:rounded-3xl before:bg-slate-100/30 before:inset-x-0 before:h-20 before:top-0 before:absolute before:z-[-1] before:-mt-3.5 before:mx-5 after:content-[''] after:rounded-3xl after:bg-slate-100/20 after:inset-x-0 after:h-20 after:top-0 after:absolute after:z-[-2] after:-mt-7 after:mx-12">
                <!-- BEGIN: Filter -->
                <div class="box intro-y mt-5 p-5">
                    <?= $LINH->site('thongbao_index') ?>
                </div>
                <!-- END: Filter -->
                <input type="hidden" id="token" value="<?= isset($_SESSION['username']) ? $getUser['username'] : '' ?>">

                <div class="mt-5 grid grid-cols-12 gap-6 mb-5">
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="w-full text-left -mt-2 border-separate border-spacing-y-[10px]">
                            <thead class="">
                                <tr class="">
                                    <th class="font-medium px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0">
                                        API SERVICE
                                    </th>
                                    <th class="font-medium px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0">
                                        TÊN DỊCH VỤ
                                    </th>
                                    <th class="font-medium px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0 text-center">
                                        GIÁ
                                    </th>
                                    <th class="font-medium px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0 text-center">
                                        HÀNH ĐỘNG
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($LINH->get_list("SELECT * FROM `services`") as $service) : ?>
                                    <tr class="intro-x">
                                        <td class="px-5 py-3 w-40 border border-l-0 border-r-0 border-slate-200 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:border-darkmode-600 dark:bg-darkmode-600">
                                            #<?= $service['service_type'] ?>
                                        </td>
                                        <td class="px-5 py-3 border border-l-0 border-r-0 border-slate-200 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:border-darkmode-600 dark:bg-darkmode-600">
                                            <?= $service['service_name'] ?>
                                        </td>
                                        <td class="px-5 py-3 border border-l-0 border-r-0 border-slate-200 bg-white text-center shadow-[20px_3px_20px_#0000000b] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:border-darkmode-600 dark:bg-darkmode-600">
                                            <?= $service['price'] ?>
                                        </td>
                                        <td class="px-5 py-3 border border-l-0 border-r-0 border-slate-200 bg-white text-center shadow-[20px_3px_20px_#0000000b] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:border-darkmode-600 dark:bg-darkmode-600">
                                            <button class="transition border shadow-sm items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer bg-success border-success text-slate-900 mr-1 text-white" onclick="order('<?= $service['service_type'] ?>')">THUÊ NGAY</button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- END: Data List -->
                </div>

                <div class="col-span-12 2xl:col-span-9 mt-5">
                    <div class="box intro-y p-5">
                        <div class="truncate text-base font-medium">LỊCH SỬ THUÊ OTP</div>
                        <div class="overflow-auto">
                            <table id="myCode" class="w-full text-left table-striped table">
                                <thead class="">
                                    <tr class="">
                                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap !py-5">
                                            TÊN DỊCH VỤ
                                        </th>
                                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                            GMAIL
                                        </th>
                                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                            CODE
                                        </th>
                                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                            TIN NHẮN
                                        </th>
                                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                            THỜI GIAN
                                        </th>
                                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                            TRẠNG THÁI
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script>
            var pusher = new Pusher('3f445aa654bdfac71f01', {
                cluster: 'ap1'
            });

            var channel = pusher.subscribe('my-otpgmail');
            channel.bind('rent-gmail', function(data) {
                fetchDataAndPopulateTable()
            });
        </script>
        <script>
            function order(service) {
                const token = document.getElementById("token").value
                if (token !== "") {
                    new Notify({
                        status: "warning",
                        title: "Loading",
                        text: "Đang get mail",
                        effect: "slide",
                        speed: 50,
                        customClass: "",
                        customIcon: "",
                        showIcon: true,
                        showCloseButton: true,
                        autoclose: true,
                        autotimeout: 500,
                        notificationsGap: null,
                        notificationsPadding: null,
                        type: "outline",
                        position: "right top",
                        customWrapper: ""
                    })
                    $.ajax({
                        url: '<?= URL('ajaxs/client/rent-otp.php'); ?>',
                        method: 'POST',
                        data: {
                            action: 'rent_otp',
                            service: service,
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                new Notify({
                                    status: "success",
                                    title: "Thành công",
                                    text: response.msg,
                                    effect: "slide",
                                    speed: 100,
                                    customClass: "",
                                    customIcon: "",
                                    showIcon: true,
                                    showCloseButton: true,
                                    autoclose: true,
                                    autotimeout: 1000,
                                    notificationsGap: null,
                                    notificationsPadding: null,
                                    type: "outline",
                                    position: "right top",
                                    customWrapper: ""
                                })
                            } else if (response.status === 'curl' || response.status === 'error_sodu' || response.status === 'error_sodu_user' || response.status === 'account') {
                                new Notify({
                                    status: "error",
                                    title: "Thất bại",
                                    text: response.msg,
                                    effect: "slide",
                                    speed: 100,
                                    customClass: "",
                                    customIcon: "",
                                    showIcon: true,
                                    showCloseButton: true,
                                    autoclose: true,
                                    autotimeout: 1000,
                                    notificationsGap: null,
                                    notificationsPadding: null,
                                    type: "outline",
                                    position: "right top",
                                    customWrapper: ""
                                })

                            } else {
                                new Notify({
                                    status: "error",
                                    title: "Thất bại",
                                    text: response.msg,
                                    effect: "slide",
                                    speed: 100,
                                    customClass: "",
                                    customIcon: "",
                                    showIcon: true,
                                    showCloseButton: true,
                                    autoclose: true,
                                    autotimeout: 1000,
                                    notificationsGap: null,
                                    notificationsPadding: null,
                                    type: "outline",
                                    position: "right top",
                                    customWrapper: ""
                                })
                            }


                        },

                    });
                } else {
                    Swal.fire({
                        title: 'Lỗi',
                        text: "Vui lòng đăng nhập !",
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Đồng ý' // Sửa thành "Đồng ý"
                    });
                }

            };

            var lastUpdate = '<?= gettime() ?>'

            function fetchDataAndPopulateTable() {
                $.ajax({
                    url: '<?= URL('ajaxs/client/get_data.php?action=username'); ?>', // URL to fetch data from
                    method: 'GET',
                    data: {
                        last_update: lastUpdate
                    },
                    dataType: 'json',
                    success: function(response) {
                        var tbody = $('#myCode tbody');
                        tbody.empty(); // Clear existing table data

                        response.forEach(function(row) {
                            var tr = $('<tr></tr>');
                            tr.append('<td class="px-5 py-3 border-b dark:border-darkmode-300">' + row.services_name + '</td>');
                            tr.append('<td class="px-5 py-3 border-b dark:border-darkmode-300"><button class="btn-coppy" data-clipboard-target="#copy_' + row.id + '"> <span id="copy_' + row.id + '">' + row.account + '</span> <i class="fa-solid fa-copy"></i></button></td>');
                            tr.append('<td class="px-5 py-3 border-b dark:border-darkmode-300"><button class="btn-coppy" data-clipboard-target="#copy_' + row.code + '"> <span id="copy_' + row.code + '">' + row.code + '</span></button></td>');
                            tr.append('<td class="px-5 py-3 border-b dark:border-darkmode-300">' + row.full_text + '</td>');

                            tr.append('<td class="px-5 py-3 border-b dark:border-darkmode-300 text-center"><span class="whitespace-nowrap rounded-full border border-success/20 bg-dark px-2 py-1 text-xs text-white">' + row.created_at + '</span></td>');

                            var statusText;
                            if (row.status === 'pending') {
                                statusText = '<span class="whitespace-nowrap rounded-full border border-warning/20 bg-warning/20 px-2 py-1 text-xs text-warning">CHỜ OTP</span>';
                            } else if (row.status === 'success') {
                                statusText = '<span class="whitespace-nowrap rounded-full border border-success/20 bg-success/20 px-2 py-1 text-xs text-success">THÀNH CÔNG</span>';
                            } else if (row.status === 'cancel') {
                                statusText = '<span class="whitespace-nowrap rounded-full border border-danger bg-opacity-20 border-opacity-5 px-2 py-1 text-xs bg-danger text-danger">HỦY</span>';
                            } else {
                                statusText = '<span class="whitespace-nowrap rounded-full border border-danger bg-opacity-20 border-opacity-5 px-2 py-1 text-xs bg-danger text-danger">' + row.status + '</span>';
                            }
                            tr.append('<td class="px-5 py-3 border-b dark:border-darkmode-300 text-center">' + statusText + '</td>');


                            tbody.append(tr);
                        });

                    },
                });
            }


            fetchDataAndPopulateTable()
        </script>
        <script src="<?= URL('assets/js/clipboard.min.js') ?>"></script>

        <script>
            var clipboard = new ClipboardJS('.btn-coppy');

            clipboard.on('success', function(e) {
                new Notify({
                    status: "success",
                    title: "Thành công",
                    text: "Coppy thành công",
                    effect: "slide",
                    speed: 100,
                    customClass: "",
                    customIcon: "",
                    showIcon: true,
                    showCloseButton: true,
                    autoclose: true,
                    autotimeout: 1000,
                    notificationsGap: null,
                    notificationsPadding: null,
                    type: "outline",
                    position: "right top",
                    customWrapper: ""
                })
                e.clearSelection();
            });

            clipboard.on('error', function(e) {
                new Notify({
                    status: "error",
                    title: "Thất bại",
                    text: "Coppy thất bại",
                    effect: "slide",
                    speed: 100,
                    customClass: "",
                    customIcon: "",
                    showIcon: true,
                    showCloseButton: true,
                    autoclose: true,
                    autotimeout: 1000,
                    notificationsGap: null,
                    notificationsPadding: null,
                    type: "outline",
                    position: "right top",
                    customWrapper: ""
                })
            });
        </script>
        <?php require_once("templates/client/Footer.php"); ?>