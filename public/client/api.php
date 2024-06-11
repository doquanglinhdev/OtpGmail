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
                <style>
                    ul[role="tablist"] {
                        display: flex;
                        flex-wrap: wrap;
                    }

                    li[role="presentation"] {
                        flex: 1 1 auto;
                        margin: 5px;
                    }

                    button[role="tab"] {
                        display: block;
                        width: 100%;
                        padding: 10px;
                        text-align: center;
                        border: 0;
                        background-color: #f8fafc;
                        /* bg-slate-50 */
                        transition: background-color 0.3s, color 0.3s;
                        border-radius: 0.6rem;
                        color: #64748b;
                        /* text-slate-500 */
                    }

                    button[role="tab"].active,
                    button[role="tab"][aria-selected="true"] {
                        color: white;
                        font-weight: 500;
                        /* font-medium */
                    }

                    /* Dark mode */
                    @media (prefers-color-scheme: dark) {
                        button[role="tab"] {
                            color: #cbd5e1;
                            /* dark:text-slate-400 */
                        }

                        button[role="tab"].active,
                        button[role="tab"][aria-selected="true"] {
                            color: white;
                            /* dark:text-white */
                        }
                    }

                    /* Responsive adjustments */
                    @media (max-width: 600px) {
                        ul[role="tablist"] {
                            flex-direction: column;
                        }

                        li[role="presentation"] {
                            margin: 5px 0;
                        }
                    }
                </style>
                <div class="col-span-12 2xl:col-span-9 mt-5">

                    <div class="col-span-12 xl:col-span-4 2xl:col-span-3">
                        <div class="box intro-y p-2">
                            <ul role="tablist" class="flex">
                                <li id="info-profile-tab" role="presentation" class="focus-visible:outline-none flex-1 bg-slate-50 first:rounded-l-[0.6rem] last:rounded-r-[0.6rem] [&amp;[aria-selected='true']_button]:text-current">
                                    <button data-tw-target="#info-profile" role="tab" class="cursor-pointer block appearance-none px-3 py-2 border-transparent transition-colors dark:text-slate-400 [&amp;.active]:dark:text-white border-0 [&amp;.active]:bg-primary [&amp;.active]:text-white [&amp;.active]:font-medium w-full whitespace-nowrap rounded-[0.6rem] text-slate-500 active" aria-selected="true">THÔNG TIN TÀI KHOẢN</button>
                                </li>
                                <li id="get-list-tab" role="presentation" class="focus-visible:outline-none flex-1 bg-slate-50 first:rounded-l-[0.6rem] last:rounded-r-[0.6rem] [&amp;[aria-selected='true']_button]:text-current">
                                    <button data-tw-target="#get-list" role="tab" class="cursor-pointer block appearance-none px-3 py-2 border-transparent transition-colors dark:text-slate-400 [&amp;.active]:dark:text-white border-0 [&amp;.active]:bg-primary [&amp;.active]:text-white [&amp;.active]:font-medium w-full whitespace-nowrap rounded-[0.6rem] text-slate-500" aria-selected="false">LẤY DANH SACH ỨNG DỤNG</button>
                                </li>
                                <li id="create-otp-tab" role="presentation" class="focus-visible:outline-none flex-1 bg-slate-50 first:rounded-l-[0.6rem] last:rounded-r-[0.6rem] [&amp;[aria-selected='true']_button]:text-current">
                                    <button data-tw-target="#create-otp" role="tab" class="cursor-pointer block appearance-none px-3 py-2 border-transparent transition-colors dark:text-slate-400 [&amp;.active]:dark:text-white border-0 [&amp;.active]:bg-primary [&amp;.active]:text-white [&amp;.active]:font-medium w-full whitespace-nowrap rounded-[0.6rem] text-slate-500" aria-selected="false">TẠO YÊU CẦU</button>
                                </li>
                                <li id="get-otp-tab" role="presentation" class="focus-visible:outline-none flex-1 bg-slate-50 first:rounded-l-[0.6rem] last:rounded-r-[0.6rem] [&amp;[aria-selected='true']_button]:text-current">
                                    <button data-tw-target="#get-otp" role="tab" class="cursor-pointer block appearance-none px-3 py-2 border-transparent transition-colors dark:text-slate-400 [&amp;.active]:dark:text-white border-0 [&amp;.active]:bg-primary [&amp;.active]:text-white [&amp;.active]:font-medium w-full whitespace-nowrap rounded-[0.6rem] text-slate-500" aria-selected="false">KIỂM TRA YÊU CẦU</button>
                                </li>
                                <li id="cancel-otp-tab" role="presentation" class="focus-visible:outline-none flex-1 bg-slate-50 first:rounded-l-[0.6rem] last:rounded-r-[0.6rem] [&amp;[aria-selected='true']_button]:text-current">
                                    <button data-tw-target="#cancel-otp" role="tab" class="cursor-pointer block appearance-none px-3 py-2 border-transparent transition-colors dark:text-slate-400 [&amp;.active]:dark:text-white border-0 [&amp;.active]:bg-primary [&amp;.active]:text-white [&amp;.active]:font-medium w-full whitespace-nowrap rounded-[0.6rem] text-slate-500" aria-selected="false">HỦY YÊU CẦU</button>
                                </li>
                            </ul>
                        </div>
                        <style>
                            .dash-sidebar.custom-sidebar .dash-navbar>.dash-item>.dash-link {
                                background: transparent;
                                box-shadow: none;
                                color: #000;
                                font-size: 18px;
                            }

                            .dash-sidebar.custom-sidebar .dash-submenu .dash-link {
                                padding: 0 15px 0 22px;
                                font-size: 16px;
                            }

                            .dash-sidebar.custom-sidebar .dash-submenu .dash-item:before,
                            .dash-sidebar.custom-sidebar .dash-submenu .dash-item::after,
                            .dash-sidebar.custom-sidebar .dash-link .dash-mtext::after {
                                display: none;
                            }

                            .dash-sidebar.custom-sidebar .dash-link .dash-arrow {
                                margin-top: 0;
                            }

                            .dash-sidebar.custom-sidebar .dash-hasmenu.dash-trigger>.dash-link>.dash-arrow {
                                transform: rotate(-180deg);
                                -webkit-transform: rotate(-180deg);
                                -moz-transform: rotate(-180deg);
                                -ms-transform: rotate(-180deg);
                                -o-transform: rotate(-180deg);
                            }

                            .dash-sidebar.custom-sidebar .dash-arrow>svg {
                                width: 14px;
                                height: 14px;
                            }

                            .dash-container .custom-content {
                                padding: 0;
                            }

                            .dash-container .custom-content .content-inner {
                                padding: 70px 100px;
                                border-bottom: 1px solid var(--bs-border-color);
                            }

                            .dash-container .custom-content .content-inner .row .col-md-6 {
                                padding: 0 15px;
                            }

                            .custom-content .row {
                                margin: 0 0 0 0;
                            }

                            .dash-container .custom-content .content-inner h2 {
                                padding: 0 15px;
                            }

                            .dash-container .custom-content p {
                                font-size: 16px;
                            }

                            .dash-container .custom-content a {
                                font-weight: bold;
                            }

                            .api-request-example {
                                max-width: 85%;
                                width: 100%;
                            }

                            .api-request-example .api-request-example-topbar {
                                background: #3c4257;
                                color: #a3acb9;
                                padding: 10px 20px;
                                font-size: 13px;
                                text-transform: uppercase;
                                line-height: 1;
                                border-radius: 8px 8px 0 0;
                                -webkit-border-radius: 8px 8px 0 0;
                                -moz-border-radius: 8px 8px 0 0;
                                -ms-border-radius: 8px 8px 0 0;
                                -o-border-radius: 8px 8px 0 0;
                            }

                            .api-request-example-bottom {
                                background: #545c76;
                                padding: 12px 20px;
                                border-radius: 0 0 8px 8px;
                                -webkit-border-radius: 0 0 8px 8px;
                                -moz-border-radius: 0 0 8px 8px;
                                -ms-border-radius: 0 0 8px 8px;
                                -o-border-radius: 0 0 8px 8px;
                            }

                            .api-request-example-bottom code {
                                color: #c1c9d2;
                                font-size: 14px;
                            }

                            .libraries-client {
                                max-width: 85%;
                                width: 100%;
                                padding: 10px 0 0 0;
                                border: 1px solid var(--bs-border-color);
                                border-radius: 8px;
                                -webkit-border-radius: 8px;
                                -moz-border-radius: 8px;
                                -ms-border-radius: 8px;
                                -o-border-radius: 8px;
                            }

                            .libraries-client h6 {
                                font-size: 12px;
                                color: #697386;
                            }

                            .code-copy-box {
                                background-color: #f7fafc;
                                padding-bottom: 10px;
                            }

                            .custom-content .nav.nav-tabs li a {
                                border: 0;
                                color: #5f5a5a;
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                gap: 5px;
                                font-size: 12px;
                                padding: 5px 12px;
                            }

                            .custom-content .nav.nav-tabs li a.active {
                                color: var(--black);
                                border-bottom: 2px solid var(--bs-cyan);
                            }

                            .custom-content .nav.nav-tabs li a svg {
                                width: 20px;
                                height: 20px;
                            }

                            .codecopy-topbar h6,
                            .gradle {
                                font-size: 12px;
                                color: #697386;
                                text-transform: uppercase;
                            }

                            .code-main p:not(:first-child) {
                                padding-left: 15px;
                            }

                            .code-main p:last-child {
                                padding-left: 0;
                            }

                            .code-main p,
                            .code-main p span {
                                font-size: 14px !important;
                                line-height: 20.5px;
                            }

                            .text-blue {
                                color: #067ab8;
                            }

                            .lang-select-custm {
                                position: relative;
                                z-index: 4;
                                width: 100%;
                            }

                            .lang-select-custm select {
                                position: static;
                                z-index: 1;
                                display: block;
                                margin: 0;
                                width: 100%;
                                padding: 2px 28px 2px 8px;
                                background-color: transparent;
                                border: 0;
                                border-radius: 4px;
                                color: #c1c9d2;
                                cursor: pointer;
                                font-size: 14px;
                                font-weight: 500;
                                line-height: 20px;
                                outline: 0;
                                white-space: nowrap;
                            }

                            .code-copy-box-dark {
                                background-color: #3c4257;
                                border-radius: 10px;
                                -webkit-border-radius: 10px;
                                -moz-border-radius: 10px;
                                -ms-border-radius: 10px;
                                -o-border-radius: 10px;
                            }

                            .code-copy-box-dark .codecopy-code {
                                background-color: #4f566b;
                                padding: 15px 25px;
                                border-radius: 0 0 10px 10px;
                                width: 100%;
                                overflow: scroll;
                                max-height: 450px;
                                display: block;
                                overflow-x: auto;
                            }

                            .code-copy-box-dark .codecopy-code::-webkit-scrollbar {
                                display: none;
                            }

                            .code-copy-box-dark button svg {
                                fill: #a4cdfe;
                            }

                            .code-copy-box-dark .codecopy-topbar h6 {
                                color: #c1c9d2;
                                padding: 10px;
                                border-radius: 10px 10px 0 0;
                                -webkit-border-radius: 10px 10px 0 0;
                                -moz-border-radius: 10px 10px 0 0;
                                -ms-border-radius: 10px 10px 0 0;
                                -o-border-radius: 10px 10px 0 0;

                            }

                            .code-copy-box-dark .codecopy-line div {
                                color: #a3acb9;
                                line-height: 19px;
                            }

                            .code-copy-box-dark .text-blue {
                                color: #f5fbff;
                                margin-bottom: 0;
                            }

                            .code-copy-box-dark .text-green {
                                color: #85d996;
                            }

                            .code-copy-box-dark .text-grey {
                                color: #697386;
                            }

                            .your-key-box {
                                background-color: #f7fafc;
                                border: 1px solid var(--bs-border-color);
                                border-radius: 10px;
                                -webkit-border-radius: 10px;
                                -moz-border-radius: 10px;
                                -ms-border-radius: 10px;
                                -o-border-radius: 10px;
                            }

                            .your-key-box .key-box-topbar {
                                background-color: #e3e8ee;
                                padding: 10px;
                                border-radius: 10px 10px 0 0;
                                -webkit-border-radius: 10px 10px 0 0;
                                -moz-border-radius: 10px 10px 0 0;
                                -ms-border-radius: 10px 10px 0 0;
                                -o-border-radius: 10px 10px 0 0;
                            }

                            .your-key-box .key-box-topbar h6 {
                                font-size: 12px;
                                color: #4f566b;
                                text-transform: uppercase;
                                margin-bottom: 0;
                            }

                            .your-key-box .key-box-main {
                                padding: 15px 25px;
                                display: block;
                                overflow-x: auto;
                            }

                            .your-key-box .key-box-main p {
                                font-size: 14px;
                            }

                            .your-key-box .key-box-main p:last-child {
                                margin-bottom: 0;
                            }

                            .dash-sidebar .m-header a img {
                                width: 100% !important;
                                height: 100% !important;
                                object-fit: contain;
                                margin: 0 auto;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                vertical-align: middle;
                            }

                            .api-hamburger .hamburger-box {
                                width: 20px;
                                height: 20px;
                                position: relative;
                            }

                            .api-hamburger .hamburger-box .hamburger-inner {
                                margin-top: 10px;
                                margin-left: 10px;
                            }

                            .api-hamburger {
                                display: none;
                            }

                            @media screen and (max-width:1024px) {
                                .api-hamburger .mob-hamburger {
                                    display: block;
                                    margin-left: 100px;
                                }

                                .dash-container .custom-content .content-inner {
                                    padding-top: 20px;
                                }

                                .dash-custom-content.dash-container {
                                    top: 0;
                                }

                                .api-hamburger {
                                    display: block;
                                }
                            }

                            @media screen and (max-width:767px) {
                                .dash-container .custom-content .content-inner {
                                    padding: 40px 0;
                                }

                                .api-hamburger .mob-hamburger {
                                    margin-left: 10px;
                                }

                                .dash-container .custom-content .content-inner {
                                    padding-top: 20px;
                                }
                            }
                        </style>
                        <div class="tab-content mt-5">
                            <div data-transition="" data-selector=".active" data-enter="transition-[visibility,opacity] ease-linear duration-150" data-enter-from="!p-0 !h-0 overflow-hidden invisible opacity-0" data-enter-to="visible opacity-100" data-leave="transition-[visibility,opacity] ease-linear duration-150" data-leave-from="visible opacity-100" data-leave-to="!p-0 !h-0 overflow-hidden invisible opacity-0" id="info-profile" role="tabpanel" aria-labelledby="info-profile-tab" class="tab-pane active visible opacity-100" data-state="enter">
                                <div class="box p-5">
                                    <div class="mt-5 grid grid-cols-12 gap-6">
                                        <div class="intro-y col-span-12 lg:col-span-6">

                                            <!-- BEGIN: Basic Tooltip -->
                                            <div class="preview-component intro-y box">
                                                <div class="your-key-box pb-0 mb-3">
                                                    <div class="key-box-topbar codecopy-topbar d-flex justify-content-between align-items-center ps-3 pb-2">
                                                        <h6>Endpoints</h6>
                                                        <!-- <div class="codecopy-top-right d-flex align-items-start px-2">
                                                            <div class="copy-opc">
                                                                <button class="ClickToCopy btn p-0 ps-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Click To copy">
                                                                    <i class="ti ti-clipboard"></i>
                                                                </button>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <div class="key-box-main">
                                                        <span class="text-blue">GET</span>
                                                        <strong class="text-green copy-content">https://api.otpgmail.site/user?api={api_key}</strong>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="intro-y col-span-12 lg:col-span-6">
                                            <!-- BEGIN: Custom Content Tooltip -->
                                            <div class="code-copy-box code-copy-box-dark pt-2 pb-0 mb-3">
                                                <div class="codecopy-topbar d-flex justify-content-between align-items-center ps-3 pb-2">
                                                    <h6 class="mb-0">Success Response</h6>
                                                    <!-- <div class="codecopy-top-right d-flex align-items-start px-2">
                                                <div class="copy-opc">
                                                    <button class="ClickToCopy btn p-0 ps-2 text-white" data-bs-toggle="tooltip" title="" data-bs-original-title="Click To copy">
                                                        <i class="ti ti-clipboard"></i>
                                                    </button>
                                                </div>
                                            </div> -->
                                                </div>
                                                <div class="codecopy-code d-flex pe-3">
                                                    <div class="codecopy-line px-3">
                                                        <div></div>

                                                    </div>
                                                    <div class="code-main">
                                                        <p class="mb-0">
                                                            <span class="text-green">HTTP/1.1 200 OK</span>
                                                        </p>
                                                        <pre class="text-blue copy-content">
{
  "status": "success",
  "data": {
    "username": "admin",
    "balance": "999000"
  }
}
                                                        </pre>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div data-transition="" data-selector=".active" data-enter="transition-[visibility,opacity] ease-linear duration-150" data-enter-from="!p-0 !h-0 overflow-hidden invisible opacity-0" data-enter-to="visible opacity-100" data-leave="transition-[visibility,opacity] ease-linear duration-150" data-leave-from="visible opacity-100" data-leave-to="!p-0 !h-0 overflow-hidden invisible opacity-0" id="get-list" role="tabpanel" aria-labelledby="get-list-tab" class="tab-pane !p-0 !h-0 overflow-hidden invisible opacity-0" data-state="leave" style="display: none;">
                                <div class="box p-5">

                                    <div class="mt-5 grid grid-cols-12 gap-6">
                                        <div class="intro-y col-span-12 lg:col-span-6">

                                            <!-- BEGIN: Basic Tooltip -->
                                            <div class="preview-component intro-y box">
                                                <div class="your-key-box pb-0 mb-3">
                                                    <div class="key-box-topbar codecopy-topbar d-flex justify-content-between align-items-center ps-3 pb-2">
                                                        <h6>Endpoints</h6>
                                                        <!-- <div class="codecopy-top-right d-flex align-items-start px-2">
                                                            <div class="copy-opc">
                                                                <button class="ClickToCopy btn p-0 ps-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Click To copy">
                                                                    <i class="ti ti-clipboard"></i>
                                                                </button>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <div class="key-box-main">
                                                        <span class="text-blue">GET</span>
                                                        <strong class="text-green copy-content">https://api.otpgmail.site/services?api={api_key}</strong>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="intro-y col-span-12 lg:col-span-6">
                                            <!-- BEGIN: Custom Content Tooltip -->
                                            <div class="code-copy-box code-copy-box-dark pt-2 pb-0 mb-3">
                                                <div class="codecopy-topbar d-flex justify-content-between align-items-center ps-3 pb-2">
                                                    <h6 class="mb-0">Success Response</h6>
                                                    <!-- <div class="codecopy-top-right d-flex align-items-start px-2">
                                                <div class="copy-opc">
                                                    <button class="ClickToCopy btn p-0 ps-2 text-white" data-bs-toggle="tooltip" title="" data-bs-original-title="Click To copy">
                                                        <i class="ti ti-clipboard"></i>
                                                    </button>
                                                </div>
                                            </div> -->
                                                </div>
                                                <div class="codecopy-code d-flex pe-3">
                                                    <div class="codecopy-line px-3">
                                                        <div></div>

                                                    </div>
                                                    <div class="code-main">
                                                        <p class="mb-0">
                                                            <span class="text-green">HTTP/1.1 200 OK</span>
                                                        </p>
                                                        <pre class="text-blue copy-content">
[
  {
    "service_name": "OTP FACEBOOK",
    "service_type": "facebook",
    "price": "200"
  },
  {
    "service_name": "OTP TIKTOK",
    "service_type": "tiktok",
    "price": "250"
  }
]
                                                        </pre>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div data-transition="" data-selector=".active" data-enter="transition-[visibility,opacity] ease-linear duration-150" data-enter-from="!p-0 !h-0 overflow-hidden invisible opacity-0" data-enter-to="visible opacity-100" data-leave="transition-[visibility,opacity] ease-linear duration-150" data-leave-from="visible opacity-100" data-leave-to="!p-0 !h-0 overflow-hidden invisible opacity-0" id="create-otp" role="tabpanel" aria-labelledby="create-otp-tab" class="tab-pane !p-0 !h-0 overflow-hidden invisible opacity-0" data-state="leave" style="display: none;">
                                <div class="box p-5">

                                    <div class="mt-5 grid grid-cols-12 gap-6">
                                        <div class="intro-y col-span-12 lg:col-span-6">

                                            <!-- BEGIN: Basic Tooltip -->
                                            <div class="preview-component intro-y box">
                                                <div class="your-key-box pb-0 mb-3">
                                                    <div class="key-box-topbar codecopy-topbar d-flex justify-content-between align-items-center ps-3 pb-2">
                                                        <h6>Endpoints</h6>
                                                        <!-- <div class="codecopy-top-right d-flex align-items-start px-2">
                                                            <div class="copy-opc">
                                                                <button class="ClickToCopy btn p-0 ps-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Click To copy">
                                                                    <i class="ti ti-clipboard"></i>
                                                                </button>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <div class="key-box-main">
                                                        <span class="text-blue">GET</span>
                                                        <strong class="text-green copy-content">https://api.otpgmail.site/create-otp?api={api_key}&services={services_type}</strong>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="intro-y col-span-12 lg:col-span-6">
                                            <!-- BEGIN: Custom Content Tooltip -->
                                            <div class="code-copy-box code-copy-box-dark pt-2 pb-0 mb-3">
                                                <div class="codecopy-topbar d-flex justify-content-between align-items-center ps-3 pb-2">
                                                    <h6 class="mb-0">Success Response</h6>
                                                    <!-- <div class="codecopy-top-right d-flex align-items-start px-2">
                                                <div class="copy-opc">
                                                    <button class="ClickToCopy btn p-0 ps-2 text-white" data-bs-toggle="tooltip" title="" data-bs-original-title="Click To copy">
                                                        <i class="ti ti-clipboard"></i>
                                                    </button>
                                                </div>
                                            </div> -->
                                                </div>
                                                <div class="codecopy-code d-flex pe-3">
                                                    <div class="codecopy-line px-3">
                                                        <div></div>

                                                    </div>
                                                    <div class="code-main">
                                                        <p class="mb-0">
                                                            <span class="text-green">HTTP/1.1 200 OK</span>
                                                        </p>
                                                        <pre class="text-blue copy-content">
 {
  "status": "true",
  "data": {
    "id": "1423",
    "username": "admin",
    "price_sell": "200",
    "account": "blogchiase@gmail.com",
    "services_name": "OTP FACEBOOK",
    "service_type": "facebook",
    "code": "",
    "full_text": null,
    "created_at": "2024-05-30 20:43:40",
    "done_at": "0000-00-00 00:00:00",
    "status": "pending"
  }
}
                                                        </pre>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div data-transition="" data-selector=".active" data-enter="transition-[visibility,opacity] ease-linear duration-150" data-enter-from="!p-0 !h-0 overflow-hidden invisible opacity-0" data-enter-to="visible opacity-100" data-leave="transition-[visibility,opacity] ease-linear duration-150" data-leave-from="visible opacity-100" data-leave-to="!p-0 !h-0 overflow-hidden invisible opacity-0" id="get-otp" role="tabpanel" aria-labelledby="get-otp-tab" class="tab-pane !p-0 !h-0 overflow-hidden invisible opacity-0" data-state="leave" style="display: none;">
                                <div class="box p-5">
                                    <div class="mt-5 grid grid-cols-12 gap-6">
                                        <div class="intro-y col-span-12 lg:col-span-6">

                                            <!-- BEGIN: Basic Tooltip -->
                                            <div class="preview-component intro-y box">
                                                <div class="your-key-box pb-0 mb-3">
                                                    <div class="key-box-topbar codecopy-topbar d-flex justify-content-between align-items-center ps-3 pb-2">
                                                        <h6>Endpoints</h6>
                                                        <!-- <div class="codecopy-top-right d-flex align-items-start px-2">
                                                            <div class="copy-opc">
                                                                <button class="ClickToCopy btn p-0 ps-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Click To copy">
                                                                    <i class="ti ti-clipboard"></i>
                                                                </button>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <div class="key-box-main">
                                                        <span class="text-blue">GET</span>
                                                        <strong class="text-green copy-content">https://api.otpgmail.site/get-otp?api={api_key}&id={id}</strong>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="intro-y col-span-12 lg:col-span-6">
                                            <!-- BEGIN: Custom Content Tooltip -->
                                            <div class="code-copy-box code-copy-box-dark pt-2 pb-0 mb-3">
                                                <div class="codecopy-topbar d-flex justify-content-between align-items-center ps-3 pb-2">
                                                    <h6 class="mb-0">Success Response</h6>
                                                    <!-- <div class="codecopy-top-right d-flex align-items-start px-2">
                                                <div class="copy-opc">
                                                    <button class="ClickToCopy btn p-0 ps-2 text-white" data-bs-toggle="tooltip" title="" data-bs-original-title="Click To copy">
                                                        <i class="ti ti-clipboard"></i>
                                                    </button>
                                                </div>
                                            </div> -->
                                                </div>
                                                <div class="codecopy-code d-flex pe-3">
                                                    <div class="codecopy-line px-3">
                                                        <div></div>

                                                    </div>
                                                    <div class="code-main">
                                                        <p class="mb-0">
                                                            <span class="text-green">HTTP/1.1 200 OK</span>
                                                        </p>
                                                        <pre class="text-blue copy-content">
{
  "id": "222",
  "username": "admin",
  "account": "dqlinh@gmail.com|123456789",
  "services_name": "OTP FACEBOOK",
  "service_type": "facebook",
  "code": "24561",
  "full_text": "24561 là mã xác nhận Facebook của bạn",
  "created_at": "2024-05-30 20:42:58",
  "done_at": "0000-00-00 00:00:00",
  "status": "pending",
  "price": "200"
}
                                                        </pre>
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

        <?php
        require_once("../../templates/client/Footer.php");
        ?>