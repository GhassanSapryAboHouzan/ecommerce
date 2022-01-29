@php
    $current_page = LaravelLocalization::setLocale().'/'.\Route::currentRouteName();
@endphp


<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div style="margin-top:18px"
         id="kt_aside_menu"
         class="aside-menu "
         data-menu-vertical="1"
         data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->

        <ul class="menu-nav ">



            @role(['admin'])
            @foreach($admin_side_menu as $menu)
                @if (count($menu->appearChildren) == 0)

                    <li class="menu-item  menu-item-submenu {{ $menu->id == getParentShowOf($current_page) ? 'menu-item-open' : null }}"
                        aria-haspopup="true" data-menu-toggle="hover">
                        <a href="{{ route('admin.'. $menu->as) }}" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon">
                          <i class="{{ $menu->icon != '' ? $menu->icon : 'fas fa-home' }}"></i>
                    </span>
                            <span
                                class="menu-text">{{Lang()=='ar'? $menu->display_name_ar  : $menu->display_name_en }}</span>
                            <span class="menu-label"><span class="label label-rounded label-success">0</span>
                    </span>
                        </a>
                    </li>
                @else


                    <li class="menu-item  menu-item-submenu
                    {{ in_array($menu->parent_show, [getParentShowOf($current_page), getParentOf($current_page)]) ? 'menu-item-open' : null }}"
                        aria-haspopup="true"
                        data-menu-toggle="hover">
                        <a href="javascript:;"
                           class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i class="{{ $menu->icon != '' ? $menu->icon : 'fas fa-home' }}"></i>
                            </span>
                            <span
                                class="menu-text">{{Lang()=='ar'? $menu->display_name_ar  : $menu->display_name_en }}</span>
                            <i class="menu-arrow"></i>
                            <span class="menu-label"></span>
                        </a>

                        @if ($menu->appearChildren !== null && count($menu->appearChildren) > 0 )
                            <div class="menu-submenu">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    @foreach($menu->appearChildren as $sub_menu)
                                        <li class="menu-item  menu-item-submenu
                                        {{ in_array($menu->parent_show, [getParentShowOf($current_page), getParentOf($current_page)]) ? 'menu-item-open' : null }}"
                                            aria-haspopup="true"
                                            data-menu-toggle="hover">
                                            <a href="{{ route('admin.' . $sub_menu->as) }}"
                                               class="menu-link menu-toggle">
                                                <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                                <span class="menu-text">
                                                    {{Lang()=='ar'? $sub_menu->display_name_ar  : $sub_menu->display_name_en }}
                                                 </span>
                                                <span class="menu-label"></span>
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        @endif

                    </li>
                @endif

            @endforeach
            @endrole

            @role(['supervisor'])
            @foreach($admin_side_menu as $menu)
                @permission($menu->name)
                @if (count($menu->appearChildren) == 0)
                    <li class="menu-item  menu-item-submenu {{ $menu->id == getParentShowOf($current_page) ? 'menu-item-open' : null }}"
                        aria-haspopup="true" data-menu-toggle="hover">
                        <a href="{{ route('admin.'. $menu->as) }}" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon">
                          <i class="{{ $menu->icon != '' ? $menu->icon : 'fas fa-home' }}"></i>
                    </span>
                            <span
                                class="menu-text">{{Lang()=='ar'? $menu->display_name_ar  : $menu->display_name_en }}</span>
                            <span class="menu-label"><span class="label label-rounded label-success">0</span>
                    </span>
                        </a>
                    </li>
                @else

                    <li class="menu-item  menu-item-submenu
                    {{ in_array($menu->parent_show, [getParentShowOf($current_page), getParentOf($current_page)]) ? 'menu-item-open' : null }}"
                        aria-haspopup="true"
                        data-menu-toggle="hover">
                        <a href="javascript:;"
                           class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i class="{{ $menu->icon != '' ? $menu->icon : 'fas fa-home' }}"></i>
                            </span>
                            <span
                                class="menu-text">{{Lang()=='ar'? $menu->display_name_ar  : $menu->display_name_en }}</span>
                            <i class="menu-arrow"></i>
                            <span class="menu-label"></span>
                        </a>

                        @if ($menu->appearChildren !== null && count($menu->appearChildren) > 0 )
                            <div class="menu-submenu">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    @foreach($menu->appearChildren as $sub_menu)
                                        @permission($sub_menu->name)
                                        <li class="menu-item  menu-item-submenu
                                        {{ getParentOf($current_page) != null && (int)(getParentOIdf($current_page)+1) == $sub_menu->id ? 'menu-item-open' : null }}
                                            "
                                            aria-haspopup="true"
                                            data-menu-toggle="hover">
                                            <a href="{{ route('admin.' . $sub_menu->as) }}"
                                               class="menu-link menu-toggle">
                                                <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                                <span class="menu-text">
                                                    {{Lang()=='ar'? $sub_menu->display_name_ar  : $sub_menu->display_name_en }}
                                                 </span>
                                                <span class="menu-label"></span>
                                            </a>
                                        </li>
                                        @endpermission
                                    @endforeach

                                </ul>
                            </div>
                        @endif

                    </li>
                @endif
                @endpermission
            @endforeach
            @endrole

        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>

