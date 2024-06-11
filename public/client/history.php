<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
require_once("../../templates/client/Header.php");
CheckLogin();
?>
<style>
    table.dataTable>tbody>tr>td {
        padding: 12px 10px;
    }
</style>
<style>
    div.dt-container select.dt-input {
        margin-left: 1rem;
        padding-right: 2.5rem;
    }
</style>
<div class="waveform before:content-[''] before:h-screen before:w-screen before:bg-gradient-to-b before:from-theme-1 before:to-theme-2 before:top-0 before:fixed">
    <div class="relative loading-page loading-page--before-hide [&.loading-page--before-hide]:before:block [&.loading-page--hide]:before:opacity-0 before:content-[''] before:transition-opacity before:duration-300 before:hidden before:h-screen before:w-screen before:fixed before:bg-gradient-to-b before:from-theme-1 before:to-theme-2 before:z-[60] [&.loading-page--before-hide]:after:block [&.loading-page--hide]:after:opacity-0 after:content-[''] after:transition-opacity after:duration-300 after:hidden after:h-16 after:w-16 after:animate-pulse after:fixed after:opacity-50 after:inset-0 after:m-auto after:bg-loading-puff after:bg-cover after:z-[61]">
        <?php require_once("../../templates/client/Nav.php"); ?>
        <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>

        <div class="content relative transition-[margin,width] duration-100 pl-5 xl:pl-0 pr-5 pt-[66px] pb-5 content--compact xl:ml-[275px] [&.content--compact]:xl:ml-[91px]">
            <div class="relative z-10 mt-[35px] rounded-3xl bg-slate-100 px-5 pt-px pb-5 min-h-screen before:content-[''] before:rounded-3xl before:bg-slate-100/30 before:inset-x-0 before:h-20 before:top-0 before:absolute before:z-[-1] before:-mt-3.5 before:mx-5 after:content-[''] after:rounded-3xl after:bg-slate-100/20 after:inset-x-0 after:h-20 after:top-0 after:absolute after:z-[-2] after:-mt-7 after:mx-12">
                <div class="col-span-12 2xl:col-span-9 mt-5">
                    <div class="box intro-y p-5">
                        <div class="truncate text-base font-medium">LỊCH SỬ THUÊ OTP</div>
                        <div class="overflow-auto">
                            <table id="myHistory" class="w-full text-left table-striped table">
                                <thead class="">
                                    <tr class="">
                                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap !py-5">
                                            STT
                                        </th>
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
                                            TRẠNG THÁI
                                        </th>
                                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                                            THỜI GIAN
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
                fetchDataAndInitializeTable()
            });
        </script>
        <script>
            var table;

            function fetchDataAndInitializeTable() {
                $.ajax({
                    url: '<?= URL('ajaxs/client/get_data.php?action=histori'); ?>',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log("Dữ liệu tải về thành công:", response);
                        var tbody = $('#myHistory tbody');
                        tbody.empty();
                        var tableData = response.map(function(row) {
                            return {
                                id: row.id,
                                services_name: row.services_name,
                                account: '<td class="px-5 py-3 border-b dark:border-darkmode-300"><button class="btn-coppy" data-clipboard-target="#copy_' + row.id + '"> <span id="copy_' + row.id + '">' + row.account + '</span> <i class="fa-solid fa-copy"></i></button></td>',
                                code: '<td class="px-5 py-3 border-b dark:border-darkmode-300"><button class="btn-coppy" data-clipboard-target="#copy_' + row.code + '"> <span id="copy_' + row.code + '">' + row.code + '</span></button></td>',
                                status: row.status,
                                full_text: row.full_text,
                                created_at: '<td class="px-5 py-3 border-b dark:border-darkmode-300 text-center"><span class="whitespace-nowrap rounded-full border border-success/20 bg-dark px-2 py-1 text-xs text-white">' + row.created_at + '</span></td>',
                                actions: row.status === 'pending' ? '<button class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer bg-danger border-danger text-white delete-btn" data-id="' + row.id + '">Hủy</button>' : '<button class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-secondary/70 border-secondary/70 text-slate-500 dark:border-darkmode-400 dark:bg-darkmode-400 dark:text-slate-300 [&:hover:not(:disabled)]:bg-slate-100 [&:hover:not(:disabled)]:border-slate-100 [&:hover:not(:disabled)]:dark:border-darkmode-300/80 [&:hover:not(:disabled)]:dark:bg-darkmode-300/80 mb-2 mr-1 w-24 mb-2 mr-1 w-24" disabled>THUÊ LẠI</button>'
                            };
                        });

                        if ($.fn.DataTable.isDataTable('#myHistory')) {
                            $('#myHistory').DataTable().clear().destroy();
                        }

                        table = new DataTable('#myHistory', {
                            data: tableData,
                            columns: [{
                                    data: 'id',
                                },
                                {
                                    data: 'services_name'
                                },
                                {
                                    data: 'account',
                                },
                                {
                                    data: 'code'
                                },
                                {
                                    data: 'full_text'
                                },
                                {
                                    data: 'status',
                                    render: function(data, type, row) {
                                        var statusText = '';
                                        if (data === 'pending') {
                                            statusText = '<span class="whitespace-nowrap rounded-full border border-warning/20 bg-warning/20 px-2 py-1 text-xs text-warning">CHỜ OTP</span>';
                                        } else if (data === 'success') {
                                            statusText = '<span class="whitespace-nowrap rounded-full border border-success/20 bg-success/20 px-2 py-1 text-xs text-success">THÀNH CÔNG</span>';
                                        } else if (data === 'cancel') {
                                            statusText = '<span class="whitespace-nowrap rounded-full border border-danger bg-opacity-20 border-opacity-5 px-2 py-1 text-xs bg-danger text-danger">HỦY</span>';
                                        } else {
                                            statusText = '<span class="whitespace-nowrap rounded-full border border-danger bg-opacity-20 border-opacity-5 px-2 py-1 text-xs bg-danger text-danger">' + row.status + '</span>';
                                        }
                                        return statusText;
                                    }
                                },
                                {
                                    data: 'created_at'
                                }
                            ],
                            order: [
                                [0, 'desc']
                            ],
                            language: {
                                searchPlaceholder: 'Tìm dịch vụ',
                                paginate: {
                                    next: "<i class='ti-arrow-right'></i>",
                                    previous: "<i class='ti-arrow-left'></i>"
                                }
                            },
                            responsive: true
                        });

                    },
                });
            }

            fetchDataAndInitializeTable();
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
        <?php
        require_once("../../templates/client/Footer.php");
        ?>