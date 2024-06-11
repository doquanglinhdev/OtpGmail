<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
require_once("../../templates/client/Header.php");
CheckLogin();
?>

<div class="waveform before:content-[''] before:h-screen before:w-screen before:bg-gradient-to-b before:from-theme-1 before:to-theme-2 before:top-0 before:fixed">
  <div class="relative loading-page loading-page--before-hide [&.loading-page--before-hide]:before:block [&.loading-page--hide]:before:opacity-0 before:content-[''] before:transition-opacity before:duration-300 before:hidden before:h-screen before:w-screen before:fixed before:bg-gradient-to-b before:from-theme-1 before:to-theme-2 before:z-[60] [&.loading-page--before-hide]:after:block [&.loading-page--hide]:after:opacity-0 after:content-[''] after:transition-opacity after:duration-300 after:hidden after:h-16 after:w-16 after:animate-pulse after:fixed after:opacity-50 after:inset-0 after:m-auto after:bg-loading-puff after:bg-cover after:z-[61]">
    <?php require_once("../../templates/client/Nav.php"); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="content relative transition-[margin,width] duration-100 pl-5 xl:pl-0 pr-5 pt-[66px] pb-5 content--compact xl:ml-[275px] [&.content--compact]:xl:ml-[91px]">
      <div class="relative z-10 mt-[35px] rounded-3xl bg-slate-100 px-5 pt-px pb-5 min-h-screen before:content-[''] before:rounded-3xl before:bg-slate-100/30 before:inset-x-0 before:h-20 before:top-0 before:absolute before:z-[-1] before:-mt-3.5 before:mx-5 after:content-[''] after:rounded-3xl after:bg-slate-100/20 after:inset-x-0 after:h-20 after:top-0 after:absolute after:z-[-2] after:-mt-7 after:mx-12">
        <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
          <h2 class="mr-auto text-lg font-medium">THÔNG TIN CÁ NHÂN</h2>
          <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
          </div>
        </div>
        <div class="intro-y mt-5 grid grid-cols-12 gap-6">
          <!-- BEGIN: Calendar Side Menu -->
          <div class="col-span-12 lg:col-span-6">
            <div class="box p-5">
              <div class="full-calendar">
                <div class="fc fc-media-screen fc-direction-ltr fc-theme-standard">
                  <div class="fc-header-toolbar fc-toolbar fc-toolbar-ltr">
                    <div>
                      <label data-tw-merge for="regular-form-1" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                        Tên đăng nhập
                      </label>
                      <input data-tw-merge id="regular-form-5" type="text" value="<?= $getUser['username'] ?>" readonly class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&amp;[type='file']]:border file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                    </div>
                    <div class="mt-3">
                      <label data-tw-merge for="regular-form-2" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                        Email
                      </label>
                      <input data-tw-merge id="regular-form-5" type="text" value="<?= $getUser['email'] ?>" readonly class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&amp;[type='file']]:border file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                    </div>
                    <div class="mt-3">
                      <label data-tw-merge for="regular-form-3" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                        Thời Gia Đăng Ký
                      </label>
                      <input data-tw-merge id="regular-form-5" type="text" value="<?= $getUser['created_at'] ?>" readonly class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&amp;[type='file']]:border file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                    </div>
                    <div class="mt-3">
                      <label data-tw-merge for="regular-form-5" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                        API KEY:
                      </label>
                      <input type="text" id="api" value="<?= $getUser['token'] ?>" readonly class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&amp;[type='file']]:border file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                    </div>
                    <div class="mt-5">
                      <center>
                        <button class="btn-coppy transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer bg-success border-success text-slate-900 dark:border-success shadow-md mb-2 mr-1 text-white" data-clipboard-target="#api">Coppy API</button>
                        <button class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-warning border-warning  text-slate-900 dark:border-warning  shadow-md mb-2 mr-1 text-white" onclick="changeapi()">Change API</button>
                      </center>
                    </div>
                  </div>

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
                    <div class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12">
                      <div class="intro-x flex h-10 items-center">
                        <h2 class="mr-5 truncate text-lg font-medium">Thống kê</h2>
                      </div>
                      <div class="mt-4">
                        <div class="intro-x box p-5">
                          <div class="flex items-center">
                            <i class="fa-solid fa-money-bill"></i>
                            <div class="ml-4">Số dư</div>
                            <div class="ml-auto"><?= format_cash($getUser['money']) ?> đ</div>
                          </div>
                          <div class="mt-5 flex items-center">
                            <i class="fa-solid fa-money-bill-1-wave"></i>
                            <div class="ml-4">Tổng nạp</div>
                            <div class="ml-auto"><?= number_format($getUser['money_total']) ?> đ</div>
                          </div>
                          <div class="mt-5 flex items-center">
                            <i class="fa-solid fa-money-bill-trend-up"></i>
                            <div class="ml-4">Đã Sử dụng</div>
                            <div class="ml-auto"><?= number_format($getUser['money_used']) ?> đ</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
    <script src="<?= URL('assets/js/clipboard.min.js') ?>"></script>
    <script>
      // new ClipboardJS('.btn-coppy');
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

      function randomString(len, an) {
        an = an && an.toLowerCase();
        var str = "",
          i = 0,
          min = an == "a" ? 10 : 0,
          max = an == "n" ? 10 : 62;
        for (; i++ < len;) {
          var r = Math.random() * (max - min) + min << 0;
          str += String.fromCharCode(r += r > 9 ? r < 36 ? 55 : 61 : 48);
        }
        return str;
      }

      function changeapi() {
        var a = randomString(40)

        $.ajax({
          url: '<?= URL('ajaxs/client/change-api.php') ?>',
          type: 'POST',
          dataType: 'JSON',
          data: {
            action: 'change',
            api: a,
          },
          success: (res) => {
            if (res.error) {
              new Notify({
                status: "error",
                title: "Thất bại",
                text: res.error,
                effect: "slide",
                speed: 300,
                customClass: "",
                customIcon: "",
                showIcon: true,
                showCloseButton: true,
                autoclose: true,
                autotimeout: 3000,
                notificationsGap: null,
                notificationsPadding: null,
                type: "outline",
                position: "right top",
                customWrapper: ""
              })
              swal.fire('', res.error, 'error')
            } else {
              new Notify({
                status: "success",
                title: "Thành công",
                text: res.success,
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
              setTimeout(function() {
                window.location = '/profile'
              }, 1000)
            }
          }
        })
      }
    </script>
    <?php
    require_once("../../templates/client/Footer.php");
    ?>