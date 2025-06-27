<nav class="side-bar">
    <div class="side-bar-logo">
        <a href="javascript:void(0)"><img
                src="{{ asset(get_option('general')['logo'] ?? 'assets/images/logo/backend_logo.png') }}"
                alt="Logo"></a>
        <button class="close-btn"><i class="fal fa-times"></i></button>
    </div>
    <div class="side-bar-manu">
        <ul>
            @canany(['dashboard-read'])
                <li class="{{ Request::routeIs('admin.dashboard.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard.index') }}" class="active">
                        <span class="sidebar-icon">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="2" y="2" width="9" height="6" rx="2" fill="white" />
                                <rect x="2" y="11" width="9" height="11" rx="2" fill="white" />
                                <rect x="13" y="2" width="9" height="11" rx="2" fill="white" />
                                <rect x="13" y="16" width="9" height="6" rx="2" fill="white" />
                            </svg>
                        </span>
                        {{ __('Dashboard') }}
                    </a>
                </li>
            @endcanany

            @canany(['banners-read'])
            <li class="{{ Request::routeIs('admin.banners.index') ? 'active' : '' }}">
                <a href="{{ route('admin.banners.index') }}" class="active">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M336.2 80c-49.1 0-93.3-32-161.9-32-31.3 0-58.3 6.5-80.7 15.2a48 48 0 0 0 2.1-20.7C93.1 19.6 74.2 1.6 51.2 .1 23.2-1.7 0 20.4 0 48c0 17.8 9.7 33.3 24 41.6V496c0 8.8 7.2 16 16 16h16c8.8 0 16-7.2 16-16v-83.4C109.9 395.3 143.3 384 199.8 384c49.1 0 93.3 32 161.9 32 58.5 0 102-22.6 128.5-40C503.8 367.2 512 352.1 512 335.9V95.9c0-34.5-35.3-57.8-66.9-44.1C409.2 67.3 371.6 80 336.2 80zM464 336c-21.8 15.4-60.8 32-102.3 32-59.9 0-102-32-161.9-32-43.4 0-96.4 9.4-127.8 24V128c21.8-15.4 60.8-32 102.3-32 59.9 0 102 32 161.9 32 43.3 0 96.3-17.4 127.8-32v240z"/></svg>
                    </span>
                    {{ __('Banner') }}
                </a>
            </li>
           @endcanany

            @canany(['categories-read', 'services-read'])
                <li
                class="dropdown {{ Request::routeIs('admin.categories.index', 'admin.services.index') || request('categories') ? 'active' : '' }}">
                <a href="#"><span class="sidebar-icon"><svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M501.1 395.7L384 278.6c-23.1-23.1-57.6-27.6-85.4-13.9L192 158.1V96L64 0 0 64l96 128h62.1l106.6 106.6c-13.6 27.8-9.2 62.3 13.9 85.4l117.1 117.1c14.6 14.6 38.2 14.6 52.7 0l52.7-52.7c14.5-14.6 14.5-38.2 0-52.7zM331.7 225c28.3 0 54.9 11 74.9 31l19.4 19.4c15.8-6.9 30.8-16.5 43.8-29.5 37.1-37.1 49.7-89.3 37.9-136.7-2.2-9-13.5-12.1-20.1-5.5l-74.4 74.4-67.9-11.3L334 98.9l74.4-74.4c6.6-6.6 3.4-17.9-5.7-20.2-47.4-11.7-99.6 .9-136.6 37.9-28.5 28.5-41.9 66.1-41.2 103.6l82.1 82.1c8.1-1.9 16.5-2.9 24.7-2.9zm-103.9 82l-56.7-56.7L18.7 402.8c-25 25-25 65.5 0 90.5s65.5 25 90.5 0l123.6-123.6c-7.6-19.9-9.9-41.6-5-62.7zM64 472c-13.2 0-24-10.8-24-24 0-13.3 10.7-24 24-24s24 10.7 24 24c0 13.2-10.7 24-24 24z" />
                        </svg></span>
                    {{ __('Manage Service') }} </a>
                <ul>
                    @can('categories-read')
                    <li>
                        <a class="{{ Request::routeIs('admin.categories.index') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">{{ __('Category') }}
                        </a>
                    </li>
                    @endcan
                    @can('services-read')
                    <li>
                        <a class="{{ Request::routeIs('admin.services.index') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">{{ __('Service List') }}

                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcanany

            @canany(['influencers-read'])
                <li
                class="dropdown {{ Request::routeIs('admin.influencers.index', 'admin.influencers.show')  ? 'active' : '' }}">
                <a href="#"><span class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M630.6 364.9l-90.3-90.2c-12-12-28.3-18.7-45.3-18.7h-79.3c-17.7 0-32 14.3-32 32v79.2c0 17 6.7 33.2 18.7 45.2l90.3 90.2c12.5 12.5 32.8 12.5 45.3 0l92.5-92.5c12.6-12.5 12.6-32.7 .1-45.2zm-182.8-21c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24c0 13.2-10.7 24-24 24zm-223.8-88c70.7 0 128-57.3 128-128C352 57.3 294.7 0 224 0S96 57.3 96 128c0 70.6 57.3 127.9 128 127.9zm127.8 111.2V294c-12.2-3.6-24.9-6.2-38.2-6.2h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 287.9 0 348.1 0 422.3v41.6c0 26.5 21.5 48 48 48h352c15.5 0 29.1-7.5 37.9-18.9l-58-58c-18.1-18.1-28.1-42.2-28.1-67.9z"/></svg>
                </span>
                    {{ __('Manage Influencer') }} </a>
                <ul>
                    <li>
                        <a class="{{ Request::routeIs('admin.influencers.index', 'admin.influencers.show') && !request('status') ? 'active' : '' }}"
                            href="{{ route('admin.influencers.index') }}">{{ __('All Influencer') }}
                        </a>
                    </li>
                    <li>
                        <a class="{{ request('status') == 'pending' ? 'active' : '' }}"
                        href="{{ route('admin.influencers.index', ['status' => 'pending']) }}">{{ __('Pending Influencer') }}
                    </a>
                </li>
                    <li>
                        <a class="{{ request('status') == 'active' ? 'active' : '' }}"
                        href="{{ route('admin.influencers.index', ['status' => 'active']) }}">{{ __('Active Influencer') }}
                    </a>
                </li>
                <li>
                    <a class="{{ request('status') == 'rejected' ? 'active' : '' }}"
                    href="{{ route('admin.influencers.index', ['status' => 'rejected']) }}">{{ __('Rejected Influencer') }}
                </a>
                </li>
                <li>
                        <a class="{{ request('status') == 'banned' ? 'active' : '' }}"
                        href="{{ route('admin.influencers.index', ['status' => 'banned']) }}">{{ __('Banned Influencer') }}
                    </a>
                </li>
            </ul>
            </li>
            @endcanany

            @canany(['clients-read'])
                <li
                class="dropdown {{ Request::routeIs('admin.clients.index', 'admin.clients.show','admin.order.details')  ? 'active' : '' }}">
                <a href="#"><span class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z" />
                </svg>
                </span>
                    {{ __('Manage Clients') }} </a>
                <ul>
                    <li>
                        <a class="{{ Request::routeIs('admin.clients.index', 'admin.clients.show','admin.order.details') && !request('status') ? 'active' : '' }}"
                            href="{{ route('admin.clients.index') }}">{{ __('All Clients') }}
                        </a>
                    </li>
                    <li>
                        <a class="{{ request('status') == 'pending' ? 'active' : '' }}"
                        href="{{ route('admin.clients.index', ['status' => 'pending']) }}">{{ __('Pending Clients') }}
                    </a>
                </li>
                    <li>
                        <a class="{{ request('status') == 'active' ? 'active' : '' }}"
                        href="{{ route('admin.clients.index', ['status' => 'active']) }}">{{ __('Active Clients') }}
                    </a>
                </li>
                <li>
                    <a class="{{ request('status') == 'rejected' ? 'active' : '' }}"
                    href="{{ route('admin.clients.index', ['status' => 'rejected']) }}">{{ __('Rejected Clients') }}
                </a>
                </li>
                <li>
                        <a class="{{ request('status') == 'banned' ? 'active' : '' }}"
                        href="{{ route('admin.clients.index', ['status' => 'banned']) }}">{{ __('Banned Clients') }}
                    </a>
                </li>
            </ul>
            </li>
            @endcanany

            @canany(['supports-read'])
            <li class="dropdown {{ Request::routeIs('admin.supports.index', 'admin.supports.show') ? 'active' : '' }}">
                <a href="#">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M128 160h320v192H128V160zm400 96c0 26.5 21.5 48 48 48v96c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48v-96c26.5 0 48-21.5 48-48s-21.5-48-48-48v-96c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48v96c-26.5 0-48 21.5-48 48zm-48-104c0-13.3-10.7-24-24-24H120c-13.3 0-24 10.7-24 24v208c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V152z" />
                        </svg>
                    </span>
                    {{ __('Support Ticket') }}
                </a>
                <ul>
                    <li><a class="{{ Request::routeIs('admin.supports.index', 'admin.supports.details') ? 'active' : '' }}"
                            href="{{ route('admin.supports.index') }}">{{ __('All Ticket') }}</a></li>
                </ul>
            </li>
            @endcanany

            @canany(['withdraw-methods-read', 'withdraw-request-read'])
            <li
            class="dropdown {{ Request::routeIs('admin.withdraw-request.index', 'admin.withdraw_methods.index', 'admin.withdraw_methods.edit', 'admin.withdraw_methods.create','admin.withdraw-request.show') ? 'active' : '' }}">
            <a href="#"><span class="sidebar-icon"><svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                            d="M0 448c0 17.7 14.3 32 32 32h576c17.7 0 32-14.3 32-32V128H0v320zm448-208c0-8.8 7.2-16 16-16h96c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16h-96c-8.8 0-16-7.2-16-16v-32zm0 120c0-4.4 3.6-8 8-8h112c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H456c-4.4 0-8-3.6-8-8v-16zM64 264c0-4.4 3.6-8 8-8h304c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H72c-4.4 0-8-3.6-8-8v-16zm0 96c0-4.4 3.6-8 8-8h176c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H72c-4.4 0-8-3.6-8-8v-16zM624 32H16C7.2 32 0 39.2 0 48v48h640V48c0-8.8-7.2-16-16-16z" />
                    </svg></span>
                {{ __('Withdrawal Payment') }} </a>
            <ul>
                @can('withdraw-methods-read')
                <li>
                    <a class="{{ Request::routeIs('admin.withdraw_methods.index', 'admin.withdraw_methods.edit', 'admin.withdraw_methods.create') ? 'active' : '' }}" href="{{ route('admin.withdraw_methods.index') }}">{{ __('Withdrawal Method') }}</a>
                </li>
                @endcan

                @can('withdraw-request-read')
                <li>
                    <a class="{{ Request::routeIs('admin.withdraw-request.index','admin.withdraw-request.show') ? 'active' : '' }}" href="{{ route('admin.withdraw-request.index') }}">{{ __('Withdrawal Request') }}</a>
                </li>
                @endcan
             </ul>
           </li>
            @endcanany



        @canany(['expense-categories-read', 'expenses-read'])
            <li
            class="dropdown {{ Request::routeIs('admin.expense-category.index', 'admin.expenses.index', 'admin.expenses.edit', 'admin.expenses.create') || request('expense-categories') ? 'active' : '' }}">
            <a href="#"><span class="sidebar-icon"><svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                            d="M608 32H32C14.3 32 0 46.3 0 64v384c0 17.7 14.3 32 32 32h576c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32zM176 327.9V344c0 4.4-3.6 8-8 8h-16c-4.4 0-8-3.6-8-8v-16.3c-11.3-.6-22.3-4.5-31.4-11.4-3.9-2.9-4.1-8.8-.6-12.1l11.8-11.2c2.8-2.6 6.9-2.8 10.1-.7 3.9 2.4 8.3 3.7 12.8 3.7h28.1c6.5 0 11.8-5.9 11.8-13.2 0-6-3.6-11.2-8.8-12.7l-45-13.5c-18.6-5.6-31.6-23.4-31.6-43.4 0-24.5 19.1-44.4 42.7-45.1V152c0-4.4 3.6-8 8-8h16c4.4 0 8 3.6 8 8v16.3c11.3 .6 22.3 4.5 31.4 11.4 3.9 2.9 4.1 8.8 .6 12.1l-11.8 11.2c-2.8 2.6-6.9 2.8-10.1 .7-3.9-2.4-8.3-3.7-12.8-3.7h-28.1c-6.5 0-11.8 5.9-11.8 13.2 0 6 3.6 11.2 8.8 12.7l45 13.5c18.6 5.6 31.6 23.4 31.6 43.4 0 24.5-19.1 44.4-42.7 45.1zM416 312c0 4.4-3.6 8-8 8H296c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h112c4.4 0 8 3.6 8 8v16zm160 0c0 4.4-3.6 8-8 8h-80c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h80c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H296c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h272c4.4 0 8 3.6 8 8v16z" />
                    </svg></span>
                {{ __('Expense') }} </a>
                <ul>
                    @can('expenses-read')
                    <li><a class="{{ Request::routeIs('admin.expenses.index', 'admin.expenses.edit', 'admin.expenses.create') ? 'active' : '' }}"
                        href="{{ route('admin.expenses.index') }}">{{ __('Expense List') }}</a></li>
                    @endcan

                    @can('expense-categories-read')
                    <li><a class="{{ Request::routeIs('admin.expense-category.index') ? 'active' : '' }}"
                        href="{{ route('admin.expense-category.index') }}">{{ __('Expense Category') }}</a></li>
                    @endcan
                </ul>
           </li>
            @endcanany

            @canany(['coupons-read'])
                <li
                class="{{ Request::routeIs('admin.coupons.index', 'admin.coupons.edit', 'admin.coupons.create') ? 'active' : '' }}">
                <a href="{{ route('admin.coupons.index') }}"><span class="sidebar-icon"><svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M32 448c0 17.7 14.3 32 32 32h160V320H32v128zm256 32h160c17.7 0 32-14.3 32-32V320H288v160zm192-320h-42.1c6.2-12.1 10.1-25.5 10.1-40 0-48.5-39.5-88-88-88-41.6 0-68.5 21.3-103 68.3-34.5-47-61.4-68.3-103-68.3-48.5 0-88 39.5-88 88 0 14.5 3.8 27.9 10.1 40H32c-17.7 0-32 14.3-32 32v80c0 8.8 7.2 16 16 16h480c8.8 0 16-7.2 16-16v-80c0-17.7-14.3-32-32-32zm-326.1 0c-22.1 0-40-17.9-40-40s17.9-40 40-40c19.9 0 34.6 3.3 86.1 80h-86.1zm206.1 0h-86.1c51.4-76.5 65.7-80 86.1-80 22.1 0 40 17.9 40 40s-17.9 40-40 40z" />
                        </svg></span>
                    {{ __('Manage Coupon') }} </a>
            </li>
            @endcanany

            @canany(['users-read'])
                <li class="dropdown {{ Request::routeIs('admin.users.index','admin.users.edit') || request('users') ? 'active' : '' }}">
                    <a href="#"><span class="sidebar-icon"><img
                                src="{{ asset('assets/images/icons/user.svg') }}"alt="user.svg"></span>
                        {{ __('User Management') }} </a>
                    <ul>
                        <li><a class="{{ request('users') == 'admin' ? 'active' : '' }}"
                                href="{{ route('admin.users.index', ['users' => 'admin']) }}">{{ __('Admin') }}</a></li>

                        <li><a class="{{ request('users') == 'user' ? 'active' : '' }}"
                                href="{{ route('admin.users.index', ['users' => 'user']) }}">{{ __('Client') }}</a></li>

                        <li><a class="{{ request('users') == 'influencer' ? 'active' : '' }}"
                            href="{{ route('admin.users.index', ['users' => 'influencer']) }}">{{ __('Influencer') }}</a></li>
                    </ul>
                </li>
            @endcanany


            @canany(['orders-read'])
            <li
            class="{{ Request::routeIs('admin.orders.index') ? 'active' : '' }}">
            <a href="{{ route('admin.orders.index') }}"><span class="sidebar-icon"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="m17.275 20.25l3.475-3.45l-1.05-1.05l-2.425 2.375l-.975-.975l-1.05 1.075zM6 9h12V7H6zm12 14q-2.075 0-3.537-1.463T13 18t1.463-3.537T18 13t3.538 1.463T23 18t-1.463 3.538T18 23M3 22V3h18v8.675q-.475-.225-.975-.375T19 11.075V5H5v14.05h6.075q.125.775.388 1.475t.687 1.325L12 22l-1.5-1.5L9 22l-1.5-1.5L6 22l-1.5-1.5zm3-5h5.075q.075-.525.225-1.025t.375-.975H6zm0-4h7.1q.95-.925 2.213-1.463T18 11H6zm-1 6.05V5z"/></svg></span>
                {{ __('Manage Order') }} </a>
           </li>
            @endcanany

            @canany(['complains-read'])
            <li
            class="{{ Request::routeIs('admin.complains.index') ? 'active' : '' }}">
            <a href="{{ route('admin.complains.index') }}"><span class="sidebar-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M512 288.9c-.5 17.4-15.2 31.1-32.7 31.1H424v16c0 21.9-4.9 42.6-13.6 61.1l60.2 60.2c12.5 12.5 12.5 32.8 0 45.3-12.5 12.5-32.8 12.5-45.3 0l-54.7-54.7C345.9 468 314.4 480 280 480V236c0-6.6-5.4-12-12-12h-24c-6.6 0-12 5.4-12 12v244c-34.4 0-65.9-12-90.6-32.1l-54.7 54.7c-12.5 12.5-32.8 12.5-45.3 0-12.5-12.5-12.5-32.8 0-45.3l60.2-60.2C92.9 378.6 88 357.9 88 336v-16H32.7C15.2 320 .5 306.3 0 288.9-.5 270.8 14 256 32 256h56v-58.7l-46.6-46.6c-12.5-12.5-12.5-32.8 0-45.3 12.5-12.5 32.8-12.5 45.3 0L141.3 160h229.5l54.6-54.6c12.5-12.5 32.8-12.5 45.3 0 12.5 12.5 12.5 32.8 0 45.3L424 197.3V256h56c18 0 32.5 14.8 32 32.9zM257 0c-61.9 0-112 50.1-112 112h224C369 50.1 318.9 0 257 0z"/></svg></span>
                {{ __('Complain') }} </a>
            </li>
            @endcanany

            @canany(['refunds-read'])
            <li
            class="{{ Request::routeIs('admin.refunds.index') ? 'active' : '' }}">
            <a href="{{ route('admin.refunds.index') }}"><span class="sidebar-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M629.7 343.6L529 444.3c-9.4 9.4-24.6 9.4-33.9 0L394.3 343.6c-9.4-9.4-9.4-24.6 0-33.9l10.8-10.8c9.6-9.6 25.1-9.3 34.4 .5L480 342.1V160H292.5a24 24 0 0 1 -17-7l-16-16C244.4 121.9 255.1 96 276.5 96H520c13.3 0 24 10.7 24 24v222.1l40.4-42.8c9.3-9.8 24.9-10.1 34.4-.5l10.8 10.8c9.4 9.4 9.4 24.6 0 33.9zm-265.1 15.4A24 24 0 0 0 347.5 352H160V169.9l40.4 42.8c9.3 9.8 24.9 10.1 34.4 .5l10.8-10.8c9.4-9.4 9.4-24.6 0-33.9L145 67.7c-9.4-9.4-24.6-9.4-33.9 0L10.3 168.4c-9.4 9.4-9.4 24.6 0 33.9l10.8 10.8c9.6 9.6 25.1 9.3 34.4-.5L96 169.9V392c0 13.3 10.7 24 24 24h243.5c21.4 0 32.1-25.9 17-41l-16-16z"/></svg></span>
                {{ __('Refund Request') }} </a>
            </li>
            @endcanany


            @canany(['report-types-read'])
                <li class="{{ Request::routeIs('admin.report-types.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.report-types.index') }}" class="active">
                        <span class="sidebar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M288 248v28c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-28c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12zm-12 72H108c-6.6 0-12 5.4-12 12v28c0 6.6 5.4 12 12 12h168c6.6 0 12-5.4 12-12v-28c0-6.6-5.4-12-12-12zm108-188.1V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V48C0 21.5 21.5 0 48 0h204.1C264.8 0 277 5.1 286 14.1L369.9 98c9 8.9 14.1 21.2 14.1 33.9zm-128-80V128h76.1L256 51.9zM336 464V176H232c-13.3 0-24-10.7-24-24V48H48v416h288z"/></svg>
                        </span>
                        {{ __('Report Type') }}
                    </a>
                </li>
            @endcanany


            @canany(['social-medias-read'])
            <li class="{{ Request::routeIs('admin.social-medias.index') ? 'active' : '' }}">
                <a href="{{ route('admin.social-medias.index') }}" class="active">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M288 248v28c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-28c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12zm-12 72H108c-6.6 0-12 5.4-12 12v28c0 6.6 5.4 12 12 12h168c6.6 0 12-5.4 12-12v-28c0-6.6-5.4-12-12-12zm108-188.1V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V48C0 21.5 21.5 0 48 0h204.1C264.8 0 277 5.1 286 14.1L369.9 98c9 8.9 14.1 21.2 14.1 33.9zm-128-80V128h76.1L256 51.9zM336 464V176H232c-13.3 0-24-10.7-24-24V48H48v416h288z"/></svg>
                    </span>
                    {{ __('Social Media') }}
                </a>
            </li>
           @endcanany


            @canany(['reports-read'])
                <li
                class="dropdown {{ Request::routeIs('admin.client.report', 'admin.influencer.report', 'admin.withdraw.report', 'admin.income.report', 'admin.expense.report', 'admin.orders.report') ? 'active' : '' }}">
                <a href="#"><span class="sidebar-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M464 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM224 416H64v-96h160v96zm0-160H64v-96h160v96zm224 160H288v-96h160v96zm0-160H288v-96h160v96z" />
                        </svg>
                    </span>
                    {{ __('Reports') }} </a>
                <ul>
                    <li>
                        <a class="{{ Request::routeIs('admin.client.report') ? 'active' : '' }}" href="{{ route('admin.client.report') }}">{{ __('Client Report') }}</a>
                    </li>

                    <li>
                        <a class="{{ Request::routeIs('admin.influencer.report') ? 'active' : '' }}" href="{{ route('admin.influencer.report') }}">{{ __('Influencer Report') }}</a>
                    </li>

                    <li>
                        <a class="{{ Request::routeIs('admin.withdraw.report') ? 'active' : '' }}" href="{{ route('admin.withdraw.report') }}">{{ __('Withdraw Report') }}</a>
                    </li>

                    <li>
                        <a class="{{ Request::routeIs('admin.income.report') ? 'active' : '' }}" href="{{ route('admin.income.report') }}">{{ __('Income Report') }}</a>
                    </li>

                    <li>
                        <a class="{{ Request::routeIs('admin.expense.report') ? 'active' : '' }}" href="{{ route('admin.expense.report') }}">{{ __('Expense Report') }}</a>
                    </li>

                    <li>
                        <a class="{{ Request::routeIs('admin.orders.report') ? 'active' : '' }}" href="{{ route('admin.orders.report') }}">{{ __('Order Report') }}</a>
                    </li>
                </ul>
            </li>
            @endcanany

            @canany(['blogs-read', 'term-conditions-read', 'about-us-read', 'help-supports-read'])
                <li
                class="dropdown {{ Request::routeIs('admin.blogs.index', 'admin.blogs.create', 'admin.blogs.edit', 'admin.term-conditions.index', 'admin.about-us.index', 'admin.help-supports.index') ? 'active' : '' }}">

                <a href="#">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M232 224h56v56a8 8 0 0 0 8 8h48a8 8 0 0 0 8-8v-56h56a8 8 0 0 0 8-8v-48a8 8 0 0 0 -8-8h-56v-56a8 8 0 0 0 -8-8h-48a8 8 0 0 0 -8 8v56h-56a8 8 0 0 0 -8 8v48a8 8 0 0 0 8 8zM576 48a48.1 48.1 0 0 0 -48-48H112a48.1 48.1 0 0 0 -48 48v336h512zm-64 272H128V64h384zm112 96H381.5c-.7 19.8-14.7 32-32.7 32H288c-18.7 0-33-17.5-32.8-32H16a16 16 0 0 0 -16 16v16a64.2 64.2 0 0 0 64 64h512a64.2 64.2 0 0 0 64-64v-16a16 16 0 0 0 -16-16z" />
                        </svg>
                    </span>
                    {{ __('CMS Manage') }}
                </a>

                <ul>
                    @can('blogs-read')
                    <li><a class="{{ Request::routeIs('admin.blogs.index', 'admin.blogs.create', 'admin.blogs.edit') ? 'active' : '' }}"
                        href="{{ route('admin.blogs.index') }}">{{ __('Blogs') }}</a></li>
                    @endcan

                    @can('term-conditions-read')
                    <li><a class="{{ Request::routeIs('admin.term-conditions.index') ? 'active' : '' }}"
                        href="{{ route('admin.term-conditions.index') }}">{{ __('Terms & Conditions') }}</a></li>
                    @endcan

                    @can('about-us-read')
                    <li><a class="{{ Request::routeIs('admin.about-us.index') ? 'active' : '' }}"
                        href="{{ route('admin.about-us.index') }}">{{ __('About Us') }}</a></li>
                    @endcan

                    @can('help-supports-read')
                    <li><a class="{{ Request::routeIs('admin.help-supports.index') ? 'active' : '' }}"
                        href="{{ route('admin.help-supports.index') }}">{{ __('Help & Support') }}</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany


            @canany(['roles-read', 'permissions-read'])
                <li
                    class="dropdown {{ Request::routeIs('admin.roles.index', 'admin.roles.create', 'admin.roles.edit', 'admin.permissions.index') ? 'active' : '' }}">
                    <a href="#">
                        <span class="sidebar-icon">
                            <svg width="45" height="45" viewBox="0 0 48 48" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20 10H6C4.89543 10 4 10.8954 4 12V38C4 39.1046 4.89543 40 6 40H42C43.1046 40 44 39.1046 44 38V35.5"
                                    stroke="#333" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M10 23H18" stroke="#333" stroke-width="1" stroke-linecap="round" />
                                <path d="M10 31H34" stroke="#333" stroke-width="1" stroke-linecap="round" />
                                <circle cx="34" cy="16" r="6" fill="none" stroke="#333"
                                    stroke-width="1" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M44.0001 28.4187C42.0469 24.6023 38 22 34 22C30 22 28.0071 23.1329 25.9503 25"
                                    stroke="#333" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        {{ __('Roles & Permissions') }}
                    </a>
                    <ul>
                        @can('roles-read')
                            <li>
                                <a class="{{ Request::routeIs('admin.roles.index', 'admin.roles.create', 'admin.roles.edit') ? 'active' : '' }}"
                                    href="{{ route('admin.roles.index') }}">
                                    {{ __('Roles') }}
                                </a>
                            </li>
                        @endcan

                        @can('permissions-read')
                            <li>
                                <a class="{{ Request::routeIs('admin.permissions.index') ? 'active' : '' }}"
                                    href="{{ route('admin.permissions.index') }}">
                                    {{ __('Permissions') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['adnetworks-read', 'api-keys-read', 'text-generates-read', 'image-generates-read', 'policies-read', 'terms-read', 'gateways-read', 'settings-read', 'notifications-read','gateways-read', 'currencies-read'])
                <li
                    class="dropdown {{ Request::routeIs('admin.api-keys.index', 'admin.api-keys.create', 'admin.api-keys.edit', 'admin.adnetworks.index', 'admin.text-generates.index', 'admin.image-generates.index', 'admin.policies.index', 'admin.terms.index', 'admin.gateways.index', 'admin.settings.index', 'admin.notifications.index', 'admin.system-settings.index','admin.currencies.index', 'admin.currencies.create', 'admin.currencies.edit','admin.service-settings.index','admin.gateways.index','admin.payment-type.index' ) ? 'active' : '' }}">
                    <a href="#">
                        <span class="sidebar-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.2172 0C13.9735 0 14.6582 0.42 15.0363 1.04C15.2203 1.34 15.3429 1.71 15.3122 2.1C15.2918 2.4 15.3838 2.7 15.5473 2.98C16.0685 3.83 17.2233 4.15 18.1226 3.67C19.1344 3.09 20.4118 3.44 20.9943 4.43L21.679 5.61C22.2718 6.6 21.9447 7.87 20.9228 8.44C20.0541 8.95 19.7475 10.08 20.2687 10.94C20.4322 11.21 20.6162 11.44 20.9023 11.58C21.26 11.77 21.536 12.07 21.7301 12.37C22.1083 12.99 22.0776 13.75 21.7097 14.42L20.9943 15.62C20.6162 16.26 19.911 16.66 19.1855 16.66C18.8278 16.66 18.4292 16.56 18.1022 16.36C17.8365 16.19 17.5299 16.13 17.2029 16.13C16.1911 16.13 15.3429 16.96 15.3122 17.95C15.3122 19.1 14.372 20 13.1968 20H11.8069C10.6215 20 9.68125 19.1 9.68125 17.95C9.66081 16.96 8.81259 16.13 7.80085 16.13C7.46361 16.13 7.15702 16.19 6.90153 16.36C6.5745 16.56 6.16572 16.66 5.81825 16.66C5.08245 16.66 4.37729 16.26 3.99917 15.62L3.29402 14.42C2.9159 13.77 2.89546 12.99 3.27358 12.37C3.43709 12.07 3.74368 11.77 4.09115 11.58C4.37729 11.44 4.56125 11.21 4.73498 10.94C5.24596 10.08 4.93937 8.95 4.07071 8.44C3.05897 7.87 2.73194 6.6 3.31446 5.61L3.99917 4.43C4.59191 3.44 5.85913 3.09 6.88109 3.67C7.77019 4.15 8.925 3.83 9.4462 2.98C9.60972 2.7 9.70169 2.4 9.68125 2.1C9.66081 1.71 9.77323 1.34 9.9674 1.04C10.3455 0.42 11.0302 0.02 11.7763 0H13.2172ZM12.5121 7.18C10.9076 7.18 9.60972 8.44 9.60972 10.01C9.60972 11.58 10.9076 12.83 12.5121 12.83C14.1165 12.83 15.3838 11.58 15.3838 10.01C15.3838 8.44 14.1165 7.18 12.5121 7.18Z"
                                    fill="white" />
                            </svg>
                        </span>
                        {{ __('Settings') }}
                    </a>
                    <ul>
                        @can('currencies-read')
                        <li><a class="{{ Request::routeIs('admin.currencies.index', 'admin.currencies.create', 'admin.currencies.edit') ? 'active' : '' }}" href="{{ route('admin.currencies.index') }}">{{ __('Currency') }}</a></li>
                        @endcan

                        @can('notifications-read')
                            <li>
                                <a class="{{ Request::routeIs('admin.notifications.index') ? 'active' : '' }}"
                                    href="{{ route('admin.notifications.index') }}">
                                    {{ __('Notifications') }}
                                </a>
                            </li>
                        @endcan
                        @can('gateways-read')
                        <li>
                            <a class="{{ Request::routeIs('admin.gateways.index') ? 'active' : '' }}"
                                href="{{ route('admin.gateways.index') }}">
                                {{ __('Payment Gateways') }}
                            </a>
                        </li>
                        @endcan
                        @can('payment-type-read')
                        <li>
                            <a class="{{ Request::routeIs('admin.payment-type.index') ? 'active' : '' }}"
                                href="{{ route('admin.payment-type.index') }}">
                                {{ __('Payment Type') }}
                            </a>
                        </li>
                        @endcan
                        @can('settings-read')
                        <li>
                            <a class="{{ Request::routeIs('admin.service-settings.index') ? 'active' : '' }}"
                                href="{{ route('admin.service-settings.index') }}">{{ __('Service Settings') }}</a>
                        </li>
                            <li>
                                <a class="{{ Request::routeIs('admin.system-settings.index') ? 'active' : '' }}"
                                    href="{{ route('admin.system-settings.index') }}">{{ __('System Settings') }}</a>
                            </li>
                            <li>
                                <a class="{{ Request::routeIs('admin.settings.index') ? 'active' : '' }}"
                                    href="{{ route('admin.settings.index') }}">{{ __('General Settings') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany
        </ul>
    </div>
</nav>
