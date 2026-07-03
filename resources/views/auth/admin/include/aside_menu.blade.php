<style type="text/css">
    .svg-icon svg {
fill: #A1A5B7;
}

.menu-link:hover .svg-icon svg {
fill: #009EF7;
}
</style>

<!--begin::Aside-->
<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="{{ url('/admin') }}">
            <img alt="Logo" src="{{ asset('public/images/logo.png'); }}" class="h-25px logo" /> 
        </a>
        <!--end::Logo-->

        <!--begin::Aside toggler-->
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black" />
                    <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->


    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
                {{-- <div class="menu-item">
                    <div class="menu-content pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{ __('messages.Dashboard') }}</span>
                    </div>
                </div> --}}

                
                {{-- START Dashboard --}}
                 <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ 
                  Request::segment(2)=='' ||Request::segment(2)=='dashboard'? 'show here' : ''}}" style="display:none;">


                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('messages.Dashboard') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                 <a class="menu-link {{ Request::segment(2)=='' || Request::segment(2)=='dashboard' ? 'active' : '' }}" href="{{ url('/admin') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.Main_Dashboard') }}</span>
                                </a>
                            </div>
                           

                          

                        </div>
                    </div>

                      <div class="menu-item">
                    <a class="menu-link {{ Request::segment(2)=='' || Request::segment(2)=='dashboard' ? 'active' : '' }}" href="{{ url('/admin/dashboard') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{ __('messages.Dashboard') }} </span>
                    </a>
                </div>
              


                     {{-- End Dashboard --}}

                @if(Request::segment(1)=='admin')

                <div class="menu-item">
                    <a class="menu-link {{ Request::segment(2)=='courses' ? 'active' : '' }}" href="{{ route('admin.courses.index') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M6 3H18C19.1 3 20 3.9 20 5V19C20 20.1 19.1 21 18 21H6C4.9 21 4 20.1 4 19V5C4 3.9 4.9 3 6 3Z" fill="black" opacity="0.3"/>
                                    <path d="M8 7H16V9H8V7ZM8 11H16V13H8V11ZM8 15H13V17H8V15Z" fill="black"/>
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">الكورسات</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ Request::segment(2)=='payments' ? 'active' : '' }}" href="{{ route('admin.payments.index') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2Z" fill="black" opacity="0.3"/>
                                    <path d="M12 6V12L16 14" stroke="black" stroke-width="2"/>
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">طلبات الشراء</span>
                    </a>
                </div>

                 {{-- START Users --}}
      
                  @if($objAdmin->is_super == 1 || $objAdmin->position_id == 4)


                  <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Request::segment(2)=='admins'||Request::segment(2)=='secretariats'||Request::segment(2)=='monitors'||Request::segment(2)=='training_commissioners' ||Request::segment(2)=='treasurers' ? 'show here' : ''}}">


                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg clip-rule="evenodd" fill-rule="evenodd" height="24" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                        <g id="Icon">
                                        <circle cx="11.5" cy="6.744" r="5.5"/>
                                        <path d="m17.5 13.938c-1.966 0-3.562 1.596-3.562 3.562s1.596 3.563 3.562 3.563 3.563-1.597 3.563-3.563-1.597-3.562-3.563-3.562zm0 1.5c1.138 0 2.063.924 2.063 2.062s-.925 2.063-2.063 2.063-2.063-.925-2.063-2.063.925-2.062 2.063-2.062z"/>
                                        <path d="m18.25 14.687v-1.687c0-.414-.336-.75-.75-.75s-.75.336-.75.75v1.688c0 .413.336.75.75.75.414-.001.75-.337.75-.751z"/>
                                        <path d="m20.019 16.042 1.193-1.194c.293-.292.293-.768 0-1.06-.292-.293-.768-.293-1.06 0l-1.194 1.193c-.292.293-.292.768 0 1.061.293.292.768.292 1.061 0z"/>
                                        <path d="m20.312 18.25h1.688c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-1.688c-.413 0-.749.336-.749.75-.001.414.336.75.749.75z"/>
                                        <path d="m18.958 20.019 1.194 1.193c.292.293.768.293 1.06 0 .293-.292.293-.768 0-1.06l-1.193-1.194c-.293-.292-.768-.292-1.061 0-.292.293-.292.768 0 1.061z"/>
                                        <path d="m16.75 20.312v1.688c0 .414.336.75.75.75s.75-.336.75-.75v-1.688c0-.413-.336-.749-.75-.75-.414 0-.75.337-.75.75z"/>
                                        <path d="m14.981 18.958-1.193 1.194c-.293.292-.293.768 0 1.06.292.293.768.293 1.06 0l1.194-1.193c.292-.293.292-.768 0-1.061-.293-.292-.768-.292-1.061 0z"/>
                                        <path d="m14.687 16.75h-1.687c-.414 0-.75.336-.75.75s.336.75.75.75h1.687c.414 0 .751-.336.75-.75 0-.414-.336-.75-.75-.75z"/>
                                        <path d="m16.042 14.981-1.194-1.193c-.292-.293-.768-.293-1.06 0-.293.292-.293.768 0 1.06l1.193 1.194c.293.292.768.292 1.061 0 .292-.293.292-.768 0-1.061z"/>
                                        <path d="m12.936 21.756c-.534-.686-.486-1.681.145-2.311l.194-.195h-.275c-.966 0-1.75-.784-1.75-1.75s.784-1.75 1.75-1.75h.275l-.194-.195c-.656-.655-.682-1.704-.078-2.391-.49-.038-.992-.058-1.503-.058-3.322 0-6.263.831-8.089 2.076-1.393.95-2.161 2.157-2.161 3.424v1.45c0 .451.179.884.498 1.202.319.319.751.498 1.202.498z"/>
                                        </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('messages.users') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">

                              <div class="menu-item">
                                <a class="menu-link {{ Request::segment(2)=='admins'  ? 'active' : '' }}" href="{{ url('/admin/admins') }}">
                                    <span class="menu-icon">

                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                               
                            </span>
                            <span class="menu-title"> {{ __('messages.Admins') }}</span>
                                </a>
                            </div>



                            <div class="menu-item">
                                 <a class="menu-link {{ Request::segment(2)=='users' ? 'active' : '' }}" href="{{ url('/admin/users') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.users') }}</span>
                                </a>
                            </div>

                        </div>
                    </div>


                  
                    @endif
                  

                @endif


     

               

            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
</div>
<!--end::Aside-->
