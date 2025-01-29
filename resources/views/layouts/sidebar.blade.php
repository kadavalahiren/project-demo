<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo ">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <span class="app-brand-text demo menu-text fw-bold">
                   <h1>LOGO</h1>
                </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1 ps ps--active-y bule_theme_sidebar">
        <!-- Dashboards -->
        <li class="menu-item active open">
        </li>

        <li class="{{ request()->is('/category*') ? 'active' : '' }} menu-item">
            <a href="{{ route('categories.index') }}" class="menu-link">
            <span>
                    <svg width="18px" height="15px" viewBox="0 0 18 15" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>ic_dashboard</title>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="side_menu" transform="translate(-21.000000, -25.000000)" fill="#8A8FA3"
                                fill-rule="nonzero">
                                <g id="Group-63" transform="translate(1.000000, 0.000000)">
                                    <g id="Group-55" transform="translate(20.000000, 23.000000)">
                                        <path
                                            d="M17.8314545,9.18894737 L17.8339091,9.18263158 L9.58090909,2.23368421 C9.432,2.09 9.22745455,2 9,2 C8.77254545,2 8.568,2.09 8.41909091,2.23447368 L0.166090909,9.18263158 L0.168545455,9.18894737 C0.0687272727,9.26157895 0,9.37052632 0,9.5 C0,9.71789474 0.183272727,9.89473684 0.409090909,9.89473684 L2.45454545,9.89473684 L2.45454545,16.2105263 C2.45454545,16.6463158 2.82109091,17 3.27272727,17 L14.7272727,17 C15.1789091,17 15.5454545,16.6463158 15.5454545,16.2105263 L15.5454545,9.89473684 L17.5909091,9.89473684 C17.8167273,9.89473684 18,9.71789474 18,9.5 C18,9.37052632 17.9312727,9.26157895 17.8314545,9.18894737 Z M11.4545455,13.8421053 L6.54545455,13.8421053 C6.09381818,13.8421053 5.72727273,13.4884211 5.72727273,13.0526316 C5.72727273,12.6168421 6.09381818,12.2631579 6.54545455,12.2631579 L11.4545455,12.2631579 C11.9061818,12.2631579 12.2727273,12.6168421 12.2727273,13.0526316 C12.2727273,13.4884211 11.9061818,13.8421053 11.4545455,13.8421053 Z M11.4545455,10.6842105 L6.54545455,10.6842105 C6.09381818,10.6842105 5.72727273,10.3305263 5.72727273,9.89473684 C5.72727273,9.45894737 6.09381818,9.10526316 6.54545455,9.10526316 L11.4545455,9.10526316 C11.9061818,9.10526316 12.2727273,9.45894737 12.2727273,9.89473684 C12.2727273,10.3305263 11.9061818,10.6842105 11.4545455,10.6842105 Z"
                                            id="ic_dashboard"></path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
                <div data-i18n="Collapsed menu">Categories</div>
            </a>
        </li>

        <li class="{{ request()->is('/products*') ? 'active' : '' }} menu-item">
            <a href="{{ route('products.index') }}" class="menu-link">
            <span>
                    <svg width="18px" height="15px" viewBox="0 0 18 15" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>ic_dashboard</title>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="side_menu" transform="translate(-21.000000, -25.000000)" fill="#8A8FA3"
                                fill-rule="nonzero">
                                <g id="Group-63" transform="translate(1.000000, 0.000000)">
                                    <g id="Group-55" transform="translate(20.000000, 23.000000)">
                                        <path
                                            d="M17.8314545,9.18894737 L17.8339091,9.18263158 L9.58090909,2.23368421 C9.432,2.09 9.22745455,2 9,2 C8.77254545,2 8.568,2.09 8.41909091,2.23447368 L0.166090909,9.18263158 L0.168545455,9.18894737 C0.0687272727,9.26157895 0,9.37052632 0,9.5 C0,9.71789474 0.183272727,9.89473684 0.409090909,9.89473684 L2.45454545,9.89473684 L2.45454545,16.2105263 C2.45454545,16.6463158 2.82109091,17 3.27272727,17 L14.7272727,17 C15.1789091,17 15.5454545,16.6463158 15.5454545,16.2105263 L15.5454545,9.89473684 L17.5909091,9.89473684 C17.8167273,9.89473684 18,9.71789474 18,9.5 C18,9.37052632 17.9312727,9.26157895 17.8314545,9.18894737 Z M11.4545455,13.8421053 L6.54545455,13.8421053 C6.09381818,13.8421053 5.72727273,13.4884211 5.72727273,13.0526316 C5.72727273,12.6168421 6.09381818,12.2631579 6.54545455,12.2631579 L11.4545455,12.2631579 C11.9061818,12.2631579 12.2727273,12.6168421 12.2727273,13.0526316 C12.2727273,13.4884211 11.9061818,13.8421053 11.4545455,13.8421053 Z M11.4545455,10.6842105 L6.54545455,10.6842105 C6.09381818,10.6842105 5.72727273,10.3305263 5.72727273,9.89473684 C5.72727273,9.45894737 6.09381818,9.10526316 6.54545455,9.10526316 L11.4545455,9.10526316 C11.9061818,9.10526316 12.2727273,9.45894737 12.2727273,9.89473684 C12.2727273,10.3305263 11.9061818,10.6842105 11.4545455,10.6842105 Z"
                                            id="ic_dashboard"></path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
                <div data-i18n="Collapsed menu">Products</div>
            </a>
        </li>
    </ul>

    <div class="ps__rail-x" style="left: 0px; bottom: -104px;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 104px; right: 4px; height: 328px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 79px; height: 249px;"></div>
    </div>
    <div class="ps__rail-x" style="left: 0px; bottom: -104px;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 104px; right: 4px; height: 328px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 79px; height: 249px;"></div>
    </div>
    </ul>
</aside>
