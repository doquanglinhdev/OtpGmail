<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
require_once("../../templates/client/Header.php");
CheckLogin();
?>

<div class="waveform before:content-[''] before:h-screen before:w-screen before:bg-gradient-to-b before:from-theme-1 before:to-theme-2 before:top-0 before:fixed">
  <div class="relative loading-page loading-page--before-hide [&.loading-page--before-hide]:before:block [&.loading-page--hide]:before:opacity-0 before:content-[''] before:transition-opacity before:duration-300 before:hidden before:h-screen before:w-screen before:fixed before:bg-gradient-to-b before:from-theme-1 before:to-theme-2 before:z-[60] [&.loading-page--before-hide]:after:block [&.loading-page--hide]:after:opacity-0 after:content-[''] after:transition-opacity after:duration-300 after:hidden after:h-16 after:w-16 after:animate-pulse after:fixed after:opacity-50 after:inset-0 after:m-auto after:bg-loading-puff after:bg-cover after:z-[61]">
    <?php require_once("../../templates/client/Nav.php"); ?>

    <div class="content relative transition-[margin,width] duration-100 pl-5 xl:pl-0 pr-5 pt-[66px] pb-5 content--compact xl:ml-[275px] [&.content--compact]:xl:ml-[91px]">
      <div class="relative z-10 mt-[35px] rounded-3xl bg-slate-100 px-5 pt-px pb-5 min-h-screen before:content-[''] before:rounded-3xl before:bg-slate-100/30 before:inset-x-0 before:h-20 before:top-0 before:absolute before:z-[-1] before:-mt-3.5 before:mx-5 after:content-[''] after:rounded-3xl after:bg-slate-100/20 after:inset-x-0 after:h-20 after:top-0 after:absolute after:z-[-2] after:-mt-7 after:mx-12">
        <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
          <h2 class="mr-auto text-lg font-medium">NẠP TIỀN</h2>
          <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
          </div>
        </div>
        <div class="intro-y mt-5 grid grid-cols-12 gap-6">
          <!-- BEGIN: Calendar Side Menu -->
          <div class="col-span-12 lg:col-span-6">
            <div class="box intro-y p-2">
              <ul role="tablist" class="w-full flex">
                <li id="event-list-tab" role="presentation" class="focus-visible:outline-none flex-1 bg-slate-50 first:rounded-l-[0.6rem] last:rounded-r-[0.6rem] [&amp;[aria-selected='true']_button]:text-current">
                  <button data-tw-target="#event-list" role="tab" class="cursor-pointer block appearance-none px-3 py-2 border-transparent transition-colors dark:text-slate-400 [&amp;.active]:dark:text-white border-0 [&amp;.active]:bg-primary [&amp;.active]:text-white [&amp;.active]:font-medium active w-full whitespace-nowrap rounded-[0.6rem] text-slate-500">NẠP ATM</button>
                </li>
                <li id="add-new-event-tab" role="presentation" class="focus-visible:outline-none flex-1 bg-slate-50 first:rounded-l-[0.6rem] last:rounded-r-[0.6rem] [&amp;[aria-selected='true']_button]:text-current">
                  <button data-tw-target="#add-new-event" role="tab" class="cursor-pointer block appearance-none px-3 py-2 border-transparent transition-colors dark:text-slate-400 [&amp;.active]:dark:text-white border-0 [&amp;.active]:bg-primary [&amp;.active]:text-white [&amp;.active]:font-medium w-full whitespace-nowrap rounded-[0.6rem] text-slate-500">NẠP MOMO</button>
                </li>
              </ul>
            </div>
            <div class="tab-content mt-5">
              <div data-transition="" data-selector=".active" data-enter="transition-[visibility,opacity] ease-linear duration-150" data-enter-from="!p-0 !h-0 overflow-hidden invisible opacity-0" data-enter-to="visible opacity-100" data-leave="transition-[visibility,opacity] ease-linear duration-150" data-leave-from="visible opacity-100" data-leave-to="!p-0 !h-0 overflow-hidden invisible opacity-0" id="event-list" role="tabpanel" aria-labelledby="event-list-tab" class="tab-pane active visible opacity-100" data-state="enter">
                <div class="scrollbar-hidden overflow-y-auto" id="calendar-events">
                  <div class="event box mt-5 cursor-pointer p-5 first:mt-0">
                    <div class="row">
                      <center class="py-3">
                        <img src="https://api.vietqr.io/image/<?= strtolower(explode('|', $LINH->site('bank'))[0]); ?>-<?= $LINH->site('stk'); ?>-wgEtlNH.jpg?accountName=<?= $LINH->site('name_bank'); ?>&amount=0&addInfo=<?= $LINH->site('noidung_naptien'); ?><?= $getUser['id']; ?>" width="300px">
                      </center>

                      <div class="overflow-x-auto">
                        <table class="w-full text-left table">
                          <tbody>
                            <tr class="">
                              <td class=" px-3 py-2 border-b dark:border-darkmode-400">
                                <div class="whitespace-nowrap font-medium">Số tài khoản:</div>
                              </td>
                              <td class=" px-3 py-2 border-b  font-medium dark:border-darkmode-400">
                                <b id="copySTK" style="color: green;"><?= $LINH->site('stk'); ?></b> <button class="btn-coppy" data-clipboard-target="#copySTK"><i class="fa-regular fa-copy"></i></button>
                              </td>
                              <td class="px-3 py-2 border-b  dark:border-darkmode-400"></td>
                            </tr>
                            <tr class="">
                              <td class=" px-3 py-2 border-b dark:border-darkmode-400">
                                <div class="whitespace-nowrap font-medium">Chủ tài khoản:</div>
                              </td>
                              <td class=" px-3 py-2 border-b  font-medium dark:border-darkmode-400">
                                <b><?= $LINH->site('name_bank'); ?></b>
                              </td>
                              <td class=" px-3 py-2 border-b  dark:border-darkmode-400">
                              </td>
                            </tr>
                            <tr class="">
                              <td class=" px-3 py-2 border-b dark:border-darkmode-400">
                                <div class="whitespace-nowrap font-medium"> Ngân hàng:</div>
                              </td>
                              <td class=" px-3 py-2 border-b  font-medium dark:border-darkmode-400">
                                <b><?= explode('|', $LINH->site('bank'))[1]; ?></b>
                              </td>
                              <td class=" px-3 py-2 border-b  dark:border-darkmode-400">
                              </td>
                            </tr>
                            <tr class="">
                              <td class=" px-3 py-2 border-b dark:border-darkmode-400">
                                <div class="whitespace-nowrap font-medium">Nội dung chuyển khoản:</div>
                              </td>
                              <td class=" px-3 py-2 border-b  font-medium dark:border-darkmode-400">
                                <b id="copyNoiDung" style="color: red;"><?= $LINH->site('noidung_naptien'); ?><?=
                                                                                                              $getUser['id']; ?></b>
                                <button class="btn-coppy" data-clipboard-target="#copyNoiDung">
                                  <i class="fas fa-copy"></i>
                                </button>
                              </td>
                              <td class=" px-3 py-2 border-b  dark:border-darkmode-400">
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>

                    </div>

                  </div>
                </div>
              </div>

              <div data-transition="" data-selector=".active" data-enter="transition-[visibility,opacity] ease-linear duration-150" data-enter-from="!p-0 !h-0 overflow-hidden invisible opacity-0" data-enter-to="visible opacity-100" data-leave="transition-[visibility,opacity] ease-linear duration-150" data-leave-from="visible opacity-100" data-leave-to="!p-0 !h-0 overflow-hidden invisible opacity-0" id="add-new-event" role="tabpanel" aria-labelledby="add-new-event-tab" class="tab-pane !p-0 !h-0 overflow-hidden invisible opacity-0" data-state="leave" style="display: none;">
                <div class="box p-5">
                  <!-- <div class="row">
                    <center class="py-3">
                      <img src="https://api.vietqr.io/image/970436-<?= $LINH->site('stk'); ?>-wgEtlNH.jpg?accountName=LE TUAN ANH&amount=0&addInfo=<?= $LINH->site('noidung_naptien'); ?><?= $getUser['id']; ?>" width="300px">
                    </center>
                    <ul class="list-group">
                      <li class="list-group-item">Số tài khoản: <b id="copySTK" style="color: green;"><?= $LINH->site('stk'); ?></b> <button onclick="copy()" class="copy" data-clipboard-target="#copySTK"><i class="fas fa-copy"></i></button>
                      </li>
                      <li class="list-group-item">Chủ tài khoản: <b>LE TUAN ANH</b>
                      </li>
                      <li class="list-group-item">Ngân hàng: <b>VIETCOMBANK</b>
                      </li>
                      <li class="list-group-item">Nội dung chuyển khoản: <b id="copyNoiDung" style="color: red;"><?= $LINH->site('noidung_naptien'); ?><?=
                                                                                                                                                        $getUser['id']; ?></b>
                        <button onclick="copy()" class="copy" data-clipboard-target="#copyNoiDung">
                          <i class="fas fa-copy"></i>
                        </button>
                      </li>
                    </ul>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
          <!-- END: Calendar Side Menu -->
          <!-- BEGIN: Calendar Content -->
          <div class="col-span-12 lg:col-span-6">
            <div class="box p-5">
              <div class="full-calendar">
                <div class="fc fc-media-screen fc-direction-ltr fc-theme-standard">
                  <div class="fc-header-toolbar fc-toolbar fc-toolbar-ltr">
                    <div class="row mt-3">
                      <?= $LINH->site('luuy_napbank'); ?>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <!-- END: Calendar Content -->
        </div>


        <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>

        <div class="col-span-12 2xl:col-span-9 mt-5">
          <div class="box intro-y p-5">
            <div class="truncate text-base font-medium">LỊCH SỬ NẠP TIỀN</div>
            <div class="overflow-auto">
              <table id="myHistory" class="w-full text-left table-striped table">
                <thead class="">
                  <tr class="">
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap !py-5">
                      Thời gian
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                      Mã giao dịch
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                      Nội dung chuyển khoản
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                      Số tiền nạp
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                      Thực nhận
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap text-center">
                      Trạng thái
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($LINH->get_list("SELECT * FROM `bank_auto` WHERE `user_id` = '" . $getUser['id'] . "' ORDER BY id ASC") as $banks) {
                  ?>
                    <tr class="">
                      <td class="px-5 py-3 border-b dark:border-darkmode-300 ">
                        <?= $banks['transactionDate']; ?>
                      </td>
                      <td class="px-5 py-3 border-b dark:border-darkmode-300">
                        <?= $banks['refNo']; ?>
                      </td>
                      <td class="px-5 py-3 border-b dark:border-darkmode-300">
                        <?= $banks['description']; ?>
                      </td>
                      <td class="px-5 py-3 border-b dark:border-darkmode-300">
                        <?= format_cash($banks['creditAmount']); ?>
                      </td>
                      <td class="px-5 py-3 border-b dark:border-darkmode-300">
                        <?= format_cash($banks['money_real']); ?>
                      </td>
                      <td class="px-5 py-3 border-b dark:border-darkmode-300">
                        <?= status($banks['status']); ?>
                      </td>
                    </tr>
                  <?php } ?>

                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
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