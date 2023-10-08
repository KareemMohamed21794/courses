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
                <div class="menu-item">
                    <div class="menu-content pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{ __('messages.Dashboard') }}</span>
                    </div>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ Request::segment(2)=='' || Request::segment(2)=='dashboard' ? 'active' : '' }}" href="{{ url('/admin') }}">
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


                @if(Request::segment(1)=='admin')
                     
                    @can('Admin-viewAny')
                    <div class="menu-item">
                        <a class="menu-link {{ Request::segment(2)=='admins'  ? 'active' : '' }}" href="{{ url('/admin/admins') }}">
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
                            <span class="menu-title"> {{ __('messages.Admins') }}</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ Request::segment(2)=='lawyers'  ? 'active' : '' }}" href="{{ url('/admin/lawyers') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg id="Glyph" height="24" viewBox="0 0 64 64" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m55.87 17.23c-.01-3.1-.01-5.77 0-6.13a1.00622 1.00622 0 0 0 -.75-.99c-4.11-1.09-10.48-2.78-15.45-4.11-5.01-1.33-6.74-1.79-7.42-1.93l.01-.04a3.38189 3.38189 0 0 0 -.52 0l.01.04c-.68.13995-2.41.6-7.42 1.93-4.97 1.33-11.34 3.02-15.45 4.11a1.00508 1.00508 0 0 0 -.75.95c0 .16-.02 19.15.04 19.78a27.262 27.262 0 0 0 5.51 15.61 43.10488 43.10488 0 0 0 16.58 13.17 3.852 3.852 0 0 0 1.61.38h.13a3.69484 3.69484 0 0 0 1.75-.38 43.41809 43.41809 0 0 0 6.47-3.63 40.70519 40.70519 0 0 0 9.74-9.09 26.97461 26.97461 0 0 0 5.87-16.06c.05-.67.05-3.82.04-13.61zm-4.02 13.3-.01.18a23.1167 23.1167 0 0 1 -5.03 13.73 37.1301 37.1301 0 0 1 -8.82 8.23 38.91978 38.91978 0 0 1 -5.57 3.15.99792.99792 0 0 1 -.42.1 1.03519 1.03519 0 0 1 -.42-.1 38.98973 38.98973 0 0 1 -14.71-11.78 22.92912 22.92912 0 0 1 -4.7-13.33c-.04-1.11-.05-11.66-.05-16.55a1.00548 1.00548 0 0 1 .75-.97c3.85-1.02 8.6-2.29 12.49-3.32l6.39-1.7a.88594.88594 0 0 1 .51 0l6.16 1.64c3.92 1.04 8.77 2.34 12.7 3.38a.985.985 0 0 1 .74.96l.01 3.09c.01 4.27.02 12.22-.02 13.29z"/>
                                    <path d="m34.63 16.44 2.46-4.92-5.09-1.35-5.09 1.35 2.46 4.92z"/>
                                    <path d="m26.57 38.98 5.43 4.75 5.43-4.75-3.04-20.54h-4.78z"/>
                                    <path d="m49.87 14.92c-3.4-.9-7.37-1.95-10.81-2.87l-2.77 5.55 3.2 21.63a1.02835 1.02835 0 0 1 -.33.9l-6.5 5.69a1.02745 1.02745 0 0 1 -1.31994 0l-6.5-5.69a1.02835 1.02835 0 0 1 -.33-.9l3.2-21.63-2.77-5.55c-3.45.92-7.42 1.98-10.82 2.88 0 5.62.02 14.74.04 15.64a21.14713 21.14713 0 0 0 4.32 12.28 36.8906 36.8906 0 0 0 13.51994 10.96 37.58893 37.58893 0 0 0 4.87-2.8 34.8211 34.8211 0 0 0 8.36-7.79 21.13959 21.13959 0 0 0 4.61-12.57c0-.08.01-.16.01-.24.04-.99.03-8.91.02-13.17z"/>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title"> {{ __('messages.lawyers') }}</span>
                        </a>
                    </div>

                    @endcan



                @endif

               
                

            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
</div>
<!--end::Aside-->
