<div class="xl:ml-0 shadow-xl transition-[margin] duration-300 xl:shadow-none fixed top-0 left-0 z-50 side-menu group after:content-[''] after:fixed after:inset-0 after:bg-black/80 after:xl:hidden side-menu--collapsed [&.side-menu--mobile-menu-open]:ml-0 [&.side-menu--mobile-menu-open]:after:block -ml-[275px] after:hidden">
    <div class="close-mobile-menu fixed ml-[275px] w-10 h-10 items-center justify-center xl:hidden z-50 [&.close-mobile-menu--mobile-menu-open]:flex hidden">
        <a class="mt-5 ml-5" href="#">
            <i data-tw-merge="" data-lucide="x" class="stroke-[1] w-8 h-8 text-white"></i>
        </a>
    </div>
    <div class="side-menu__content pr-1 z-20 relative w-[275px] border-slate-200/80 duration-300 transition-[width] group-[.side-menu--collapsed]:xl:w-[91px] group-[.side-menu--collapsed.side-menu--on-hover]:xl:shadow-[6px_0_12px_-4px_#0000000f] group-[.side-menu--collapsed.side-menu--on-hover]:xl:w-[275px] h-screen flex flex-col after:content-[''] after:absolute after:inset-0 after:bg-gradient-to-b after:from-theme-1 after:to-theme-2/30  after:border-slate-200/80 after:group-[.side-menu--collapsed.side-menu--on-hover]:xl:shadow-[6px_0_12px_-4px_#0000000f] before:content-[''] before:absolute before:inset-0 before:bg-[275px_auto] before:bg-fixed before:bg-no-repeat before:bg-waveform before:bg-theme-2">
        <div class="relative z-10 hidden h-[70px] w-[275px] flex-none items-center overflow-hidden px-5 duration-300 xl:flex group-[.side-menu--collapsed.side-menu--on-hover]:xl:w-[275px] group-[.side-menu--collapsed]:xl:w-[91px]">
            <a class="flex items-center transition-[margin] duration-300 group-[.side-menu--collapsed.side-menu--on-hover]:xl:ml-0 group-[.side-menu--collapsed]:xl:ml-4" href="#">
                <div class="ml-3 mt-3 font-medium text-white transition-opacity group-[.side-menu--collapsed.side-menu--on-hover]:xl:opacity-100 group-[.side-menu--collapsed]:xl:opacity-0">
                    <img src="<?= URL('assets/img/theme/') ?><?= $LINH->site('logo'); ?>" alt="">
                </div>
            </a>
            <a class="toggle-compact-menu ml-auto hidden h-[20px] w-[20px] items-center justify-center rounded-full border border-white/40 text-white transition-[opacity,transform] hover:bg-white/5 group-[.side-menu--collapsed]:xl:rotate-180 group-[.side-menu--collapsed.side-menu--on-hover]:xl:opacity-100 group-[.side-menu--collapsed]:xl:opacity-0 3xl:flex" href="#">
                <i data-tw-merge="" data-lucide="arrow-left" class="h-3.5 w-3.5 stroke-[1.3]"></i>
            </a>
        </div>
        <div class="scrollable-ref w-full h-full z-20 pl-5 pr-4 overflow-y-auto overflow-x-hidden pb-3 [-webkit-mask-image:-webkit-linear-gradient(top,rgba(0,0,0,0),black_30px)] [&:-webkit-scrollbar]:w-0 [&:-webkit-scrollbar]:bg-transparent [&_.simplebar-content]:p-0 [&_.simplebar-track.simplebar-vertical]:w-[10px] [&_.simplebar-track.simplebar-vertical]:mr-0.5 [&_.simplebar-track.simplebar-vertical_.simplebar-scrollbar]:before:bg-slate-400/30">
            <ul class="scrollable">
                <!-- BEGIN: First Child -->
                <li class="side-menu__divider">
                    MENU
                </li>

                <li>
                    <a href="home" class="side-menu__link ">
                        <i data-tw-merge="" data-lucide="home" class="stroke-[1] w-5 h-5 side-menu__link__icon"></i>
                        <div class="side-menu__link__title">Trang chủ</div>
                    </a>
                    <!-- BEGIN: Second Child -->
                    <!-- END: Second Child -->
                </li>
                <li>
                    <a href="history" class="side-menu__link ">
                        <i data-tw-merge="" data-lucide="activity" class="stroke-[1] w-5 h-5 side-menu__link__icon"></i>
                        <div class="side-menu__link__title">Lịch sử thuê otp</div>
                    </a>
                    <!-- BEGIN: Second Child -->
                    <!-- END: Second Child -->
                </li>

                <li>
                    <a href="recharge" class="side-menu__link ">
                        <i data-tw-merge="" data-lucide="dollar-sign" class="stroke-[1] w-5 h-5 side-menu__link__icon"></i>
                        <div class="side-menu__link__title">Nạp tiền</div>
                    </a>
                    <!-- BEGIN: Second Child -->
                    <!-- END: Second Child -->
                </li>
                <li>
                    <a href="api-client" class="side-menu__link ">
                        <i data-tw-merge="" data-lucide="bar-chart2" class="stroke-[1] w-5 h-5 side-menu__link__icon"></i>
                        <div class="side-menu__link__title">Tích hợp API</div>
                    </a>
                    <!-- BEGIN: Second Child -->
                    <!-- END: Second Child -->
                </li>
                <li>
                    <a href="" class="side-menu__link ">
                        <i data-tw-merge="" data-lucide="check-circle" class="stroke-[1] w-5 h-5 side-menu__link__icon"></i>
                        <div class="side-menu__link__title">Check live Gmail</div>
                    </a>
                    <!-- BEGIN: Second Child -->
                    <!-- END: Second Child -->
                </li>
                <li>
                    <a href="profile" class="side-menu__link ">
                        <i data-tw-merge="" data-lucide="user" class="stroke-[1] w-5 h-5 side-menu__link__icon"></i>
                        <div class="side-menu__link__title">Profile</div>
                    </a>
                    <!-- BEGIN: Second Child -->
                    <!-- END: Second Child -->
                </li>
                <?php if ($getUser['level'] == 'admin') { ?>
                    <li>
                        <a href="admin" class="side-menu__link ">
                            <i data-tw-merge="" data-lucide="settings" class="stroke-[1] w-5 h-5 side-menu__link__icon"></i>
                            <div class="side-menu__link__title" style="color: red">TRANG QUẢN TRỊ</div>
                        </a>
                        <!-- BEGIN: Second Child -->
                        <!-- END: Second Child -->
                    </li>
                <?php }  ?>
                <li>
                    <a href="logout" class="side-menu__link ">
                        <i data-tw-merge="" data-lucide="log-out" class="stroke-[1] w-5 h-5 side-menu__link__icon"></i>
                        <div class="side-menu__link__title">Đăng xuất</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="top-bar group fixed inset-x-0 top-0 h-[65px] transition-[margin] duration-300 ease-in-out xl:ml-[275px] group-[.side-menu--collapsed]:xl:ml-[90px] [&.top-bar--active]:mt-3.5">
        <div class="absolute inset-x-0 h-full xl:mr-5 transition-[padding] duration-300 ease-in-out group-[.top-bar--active]:px-5 before:content-[''] before:mx-5 before:xl:mx-5 before:absolute before:top-0 before:inset-x-0 before:-mt-[15px] before:h-[20px] before:backdrop-blur">
            <div class="box group-[.top-bar--active]:box flex h-full w-full items-center border-transparent bg-transparent px-5 shadow-none transition-[padding,background-color,border-color] duration-300 ease-in-out group-[.top-bar--active]:border-transparent group-[.top-bar--active]:bg-theme-2/80 group-[.top-bar--active]:backdrop-blur">
                <div class="flex items-center gap-1 xl:hidden">
                    <a class="p-2 text-white rounded-full open-mobile-menu hover:bg-white/5" href="#">
                        <i data-tw-merge="" data-lucide="align-justify" class="stroke-[1] h-[18px] w-[18px]"></i>
                    </a>

                </div>
                <!-- BEGIN: Breadcrumb -->
                <nav aria-label="breadcrumb" class="flex flex-1 hidden xl:block">
                    <ol class="flex items-center text-theme-1 dark:text-slate-300 text-white/90">
                        <li class="">
                            <a href="#">App</a>
                        </li>
                        <li class="relative ml-5 pl-0.5 before:content-[''] before:w-[14px] before:h-[14px] before:bg-chevron-white before:transform before:rotate-[-90deg] before:bg-[length:100%] before:-ml-[1.125rem] before:absolute before:my-auto before:inset-y-0 dark:before:bg-chevron-white">
                            <a href="#">OtpGmail</a>
                        </li>
                        <li class="relative ml-5 pl-0.5 before:content-[''] before:w-[14px] before:h-[14px] before:bg-chevron-white before:transform before:rotate-[-90deg] before:bg-[length:100%] before:-ml-[1.125rem] before:absolute before:my-auto before:inset-y-0 dark:before:bg-chevron-white text-white/70">
                            <a href="#"><?= $getUser['username'] ?></a>
                        </li>
                    </ol>
                </nav>
                <!-- END: Breadcrumb -->
                <!-- BEGIN: Search -->
                <!-- BEGIN: Notification & User Menu -->
                <div class="flex items-center flex-1">

                    <div class="flex items-center gap-1 ml-auto">
                        <ol class="flex items-center text-theme-1 dark:text-slate-300 text-white/90">
                            <?= isset($_SESSION['username']) ? "<li>
                            <a href='#'>Số dư: " . format_cash($getUser['money']) . " VNĐ</a>
                        </li>" : "<li>
                            
                        </li>" ?>

                        </ol>
                    </div>
                    <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative ml-5"><button data-tw-toggle="dropdown" aria-expanded="false" class="cursor-pointer image-fit h-[36px] w-[36px] overflow-hidden rounded-full border-[3px] border-white/[0.15]"><img src="<?= URL('assets/dist/images/fakers/profile-8.jpg'); ?>" alt="Rocketman - Admin Dashboard Template">
                        </button>

                    </div>
                </div>
                <!-- END: Notification & User Menu -->
            </div>
        </div>
    </div>
</div>