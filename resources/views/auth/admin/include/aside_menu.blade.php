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

                
                @if($objAdmin->is_super == 1)
                {{-- START Dashboard --}}
                 <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ 
                  Request::segment(2)=='' ||Request::segment(2)=='dashboard'||Request::segment(2)=='scouting_statistics'||Request::segment(2)=='indicative_statistics'? 'show here' : ''}}">


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

                            <div class="menu-item">
                                 <a class="menu-link {{ Request::segment(2)=='scouting_statistics' ? 'active' : '' }}" href="{{ url('/admin/scouting_statistics') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.Scouting_statistics') }}</span>
                                </a>
                            </div>


                            <div class="menu-item">
                                 <a class="menu-link {{ Request::segment(2)=='indicative_statistics' ? 'active' : '' }}" href="{{ url('/admin/indicative_statistics') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.Indicative_statistics') }}</span>
                                </a>
                            </div>

                        </div>
                    </div>
                    @endif


                     {{-- End Dashboard --}}

                @if(Request::segment(1)=='admin')


                 {{-- START Users --}}
      
                  @if($objAdmin->is_super == 1)


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
                            <span class="menu-title">{{ __('messages.Users') }}</span>
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
                                 <a class="menu-link {{ Request::segment(2)=='secretariats' ? 'active' : '' }}" href="{{ url('/admin/secretariats') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.secretariats') }}</span>
                                </a>
                            </div>


                            <div class="menu-item">
                                 <a class="menu-link {{ Request::segment(2)=='monitors' ? 'active' : '' }}" href="{{ url('/admin/monitors') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.monitors') }}</span>
                                </a>
                            </div>


                            <div class="menu-item">
                                 <a class="menu-link {{ Request::segment(2)=='training_commissioners' ? 'active' : '' }}" href="{{ url('/admin/training_commissioners') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.training_commissioners') }}</span>
                                </a>
                            </div>


                             <div class="menu-item">
                                 <a class="menu-link {{ Request::segment(2)=='treasurers' ? 'active' : '' }}" href="{{ url('/admin/treasurers') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.treasurers') }}</span>
                                </a>
                            </div>


                         

                        </div>
                    </div>


                  {{--   <div class="menu-item">
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
                    </div> --}}
                    @endif
                   {{-- end Users --}}

                    <div class="menu-item">
                        <a class="menu-link {{ Request::segment(2)=='leaders'  ? 'active' : '' }}" href="{{ url('/admin/leaders') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg height="24" width="24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                     viewBox="0 0 24 24" xml:space="preserve">
                                    <g id="group">
                                        <path d="M24,15.9c0-2.8-1.5-5-3.7-6.1C21.3,8.8,22,7.5,22,6c0-2.8-2.2-5-5-5c-2.1,0-3.8,1.2-4.6,3c0,0,0,0,0,0c-0.1,0-0.3,0-0.4,0
                                        c-0.1,0-0.3,0-0.4,0c0,0,0,0,0,0C10.8,2.2,9.1,1,7,1C4.2,1,2,3.2,2,6c0,1.5,0.7,2.8,1.7,3.8C1.5,10.9,0,13.2,0,15.9V20h5v3h14v-3h5
                                        V15.9z M17,3c1.7,0,3,1.3,3,3c0,1.6-1.3,3-3,3c0-1.9-1.1-3.5-2.7-4.4c0,0,0,0,0,0C14.8,3.6,15.8,3,17,3z M13.4,4.2
                                        C13.4,4.2,13.4,4.2,13.4,4.2C13.4,4.2,13.4,4.2,13.4,4.2z M15,9c0,1.7-1.3,3-3,3s-3-1.3-3-3s1.3-3,3-3S15,7.3,15,9z M10.6,4.2
                                        C10.6,4.2,10.6,4.2,10.6,4.2C10.6,4.2,10.6,4.2,10.6,4.2z M7,3c1.2,0,2.2,0.6,2.7,1.6C8.1,5.5,7,7.1,7,9C5.3,9,4,7.7,4,6S5.3,3,7,3
                                        z M5.1,18H2v-2.1C2,13.1,4.1,11,7,11v0c0,0,0,0,0,0c0.1,0,0.2,0,0.3,0c0,0,0,0,0,0c0.3,0.7,0.8,1.3,1.3,1.8
                                        C6.7,13.8,5.4,15.7,5.1,18z M17,21H7v-2.1c0-2.8,2.2-4.9,5-4.9c2.9,0,5,2.1,5,4.9V21z M22,18h-3.1c-0.3-2.3-1.7-4.2-3.7-5.2
                                        c0.6-0.5,1-1.1,1.3-1.8c0.1,0,0.2,0,0.4,0v0c2.9,0,5,2.1,5,4.9V18z"/>
                                    </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            @if($objAdmin->is_super == 1)
                            <span class="menu-title"> {{ __('messages.scout_groups') }}</span>
                            @else
                            <span class="menu-title"> {{ __('messages.group_info') }}</span>
                            @endif
                        </a>
                    </div>

                @endif


                <div class="menu-item">
                     <a class="menu-link {{ Request::segment(2)=='annual_registration_archive' ? 'active' : '' }}" href="{{ url('/admin/annual_registration_archive') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('messages.annual_registration_archive') }}</span>
                    </a>
                </div>


                 {{-- @if($objAdmin->is_super == 0) --}}


                 <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Request::segment(2)=='total_permits'||Request::segment(2)=='total_secondary_registration'||Request::segment(2)=='financial_movements' ? 'show here' : ''}}">


                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 -64 640 640" xmlns="http://www.w3.org/2000/svg"><path d="M608 32H32C14.33 32 0 46.33 0 64v384c0 17.67 14.33 32 32 32h576c17.67 0 32-14.33 32-32V64c0-17.67-14.33-32-32-32zM176 327.88V344c0 4.42-3.58 8-8 8h-16c-4.42 0-8-3.58-8-8v-16.29c-11.29-.58-22.27-4.52-31.37-11.35-3.9-2.93-4.1-8.77-.57-12.14l11.75-11.21c2.77-2.64 6.89-2.76 10.13-.73 3.87 2.42 8.26 3.72 12.82 3.72h28.11c6.5 0 11.8-5.92 11.8-13.19 0-5.95-3.61-11.19-8.77-12.73l-45-13.5c-18.59-5.58-31.58-23.42-31.58-43.39 0-24.52 19.05-44.44 42.67-45.07V152c0-4.42 3.58-8 8-8h16c4.42 0 8 3.58 8 8v16.29c11.29.58 22.27 4.51 31.37 11.35 3.9 2.93 4.1 8.77.57 12.14l-11.75 11.21c-2.77 2.64-6.89 2.76-10.13.73-3.87-2.43-8.26-3.72-12.82-3.72h-28.11c-6.5 0-11.8 5.92-11.8 13.19 0 5.95 3.61 11.19 8.77 12.73l45 13.5c18.59 5.58 31.58 23.42 31.58 43.39 0 24.53-19.05 44.44-42.67 45.07zM416 312c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h112c4.42 0 8 3.58 8 8v16zm160 0c0 4.42-3.58 8-8 8h-80c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16zm0-96c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h272c4.42 0 8 3.58 8 8v16z"/></svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('messages.Financial_Details') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">

                        

                           <div class="menu-item">
                                 <a class="menu-link {{ Request::segment(2)=='total_permits' ? 'active' : '' }}" href="{{ url('/admin/total_permits') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.Total_activity_permit_fees') }}</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                 <a class="menu-link {{ Request::segment(2)=='total_secondary_registration' ? 'active' : '' }}" href="{{ url('/admin/total_secondary_registration') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.total_secondary_registration') }}</span>
                                </a>
                            </div>



                              <div class="menu-item">
                                 <a class="menu-link {{ Request::segment(2)=='financial_movements' ? 'active' : '' }}" href="{{ url('/admin/financial_movements') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.group_finances') }}</span>
                                </a>
                            </div>



                

                         

                        </div>
                    </div>


                  

                    {{-- @endif --}}


                 <div class="menu-item">
                    <a class="menu-link {{ Request::segment(2)=='advertisements' ? 'active' : '' }}" href="{{ url('admin/advertisements') }}">
                         @if($objAdmin->is_super == 1)
                          <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->

                                <span class="svg-icon svg-icon-2">

                                    <svg height="24px" width="24px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                         viewBox="0 0 24 24" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:none;}
                                    </style>
                                    <g id="surface1">
                                        <path d="M19,3c0,2.2-4.3,6-9,6v6c4.7,0,9,3.6,9,6h2v-7.3c0.6-0.3,1-1,1-1.7s-0.4-1.4-1-1.7V3H19z M5,9c-0.8,0-1.5,0.5-1.8,1.2
                                            C2.5,10.5,2,11.2,2,12s0.5,1.5,1.2,1.8C3.5,14.5,4.2,15,5,15h0.2l2.2,7l3.5-1.1L9,15V9H5z"/>
                                    </g>
                                    <rect class="st0" width="24" height="24"/>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                           
                            <span class="menu-title"> {{ __('messages.issued') }}</span>
                            <span class="circle-badge">{{$advirtesment_counter}}</span>
                            @else

                             <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24px" height="24px" viewBox="0 -2 1028 1028" class="icon"  version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M91.448447 896c-50.086957 0-91.428571-40.546584-91.428571-91.428571V91.428571C0.019876 41.341615 40.56646 0 91.448447 0h671.006211c50.086957 0 91.428571 40.546584 91.428572 91.428571v337.093168l-3.180124-0.795031c-13.515528-3.975155-26.236025-5.565217-40.546584-5.565217h-0.795031l-0.795031-2.385093h-2.385094V91.428571c0-23.055901-20.670807-43.726708-43.726708-43.726708H91.448447c-23.055901 0-43.726708 20.670807-43.726708 43.726708v713.142858c0 23.055901 20.670807 43.726708 43.726708 43.726708h352.198758l0.795031 0.795031c8.745342 11.925466 3.975155 20.670807 0.795031 27.031056-3.180124 5.565217-4.770186 9.540373 0.795031 15.10559l4.770186 4.770186H91.448447z" fill="" /><path d="M143.125466 174.906832c-8.745342 0-15.900621-11.130435-15.900621-24.645962 0-13.515528 7.15528-24.645963 15.900621-24.645963h270.310559c8.745342 0 15.900621 11.130435 15.900621 24.645963 0 13.515528-7.15528 24.645963-15.900621 24.645962h-270.310559z" fill="" /><path d="M413.436025 128h-270.310559c-7.15528 0-13.515528 9.540373-13.515528 22.26087s6.360248 22.26087 13.515528 22.260869h270.310559c7.15528 0 13.515528-9.540373 13.515528-22.260869s-5.565217-22.26087-13.515528-22.26087zM139.945342 302.111801c-7.15528 0-12.720497-10.335404-12.720497-24.645962s5.565217-24.645963 12.720497-24.645963h193.987577c7.15528 0 12.720497 10.335404 12.720497 24.645963s-5.565217 24.645963-12.720497 24.645962H139.945342z" fill="" /><path d="M333.932919 255.204969H139.945342c-5.565217 0-9.540373 9.540373-9.540373 22.26087s3.975155 22.26087 9.540373 22.260869h193.987577c5.565217 0 9.540373-9.540373 9.540373-22.260869s-4.770186-22.26087-9.540373-22.26087zM734.628571 1024c-27.826087 0-58.037267-1.590062-96.993788-4.770186-56.447205-4.770186-108.124224-31.006211-158.211181-79.503106L253.634783 718.708075c-52.47205-50.881988-54.857143-117.664596-7.950311-168.546584 19.875776-20.670807 50.881988-33.391304 84.273292-33.391305 33.391304 0 63.602484 12.720497 82.68323 34.981367 0.795031 0.795031 2.385093 2.385093 5.565217 3.975155 0.795031 0.795031 2.385093 1.590062 3.180124 2.385093V451.57764v-52.47205c0-40.546584 0-81.888199 0.795031-122.434783 0.795031-60.42236 47.701863-106.534161 109.714286-106.534161h0.795031c59.627329 0 104.944099 43.726708 108.124224 103.354037 0.795031 13.515528 0.795031 27.826087 0 42.136646v18.285714h11.925466c41.341615 0 73.142857 14.310559 96.198757 44.52174 0.795031 1.590062 5.565217 3.180124 11.925466 3.180124 2.385093 0 4.770186 0 6.360249-0.795031 7.15528-0.795031 14.310559-1.590062 20.670807-1.590062 31.801242 0 59.627329 12.720497 83.478261 38.956521 3.975155 3.975155 12.720497 7.15528 20.670807 7.15528h3.180125c5.565217-0.795031 11.925466-1.590062 17.490683-1.590062 59.627329 0 107.329193 42.136646 108.124224 96.993789 2.385093 100.968944 3.975155 200.347826-7.15528 298.931677-13.515528 119.254658-77.118012 182.857143-201.142857 198.757764-23.055901 3.975155-49.291925 5.565217-77.913044 5.565217zM325.982609 562.086957c-16.695652 0-32.596273 6.360248-44.521739 17.490683-14.310559 14.310559-22.26087 31.006211-22.26087 49.291925 0 19.080745 8.745342 38.161491 24.645963 54.062112l30.21118 30.21118c65.987578 65.192547 134.360248 131.975155 202.732919 197.962733 33.391304 31.801242 71.552795 52.47205 113.689441 60.42236 32.596273 6.360248 65.192547 9.540373 96.993789 9.540373 28.621118 0 57.242236-2.385093 85.068323-7.950311 100.968944-18.285714 147.080745-66.782609 156.621118-160.596273 8.745342-89.838509 7.950311-182.062112 6.360248-271.10559v-14.310559c-0.795031-32.596273-23.850932-54.857143-56.447205-54.857143-8.745342 0-16.695652 1.590062-25.440993 4.770187V601.043478c0 11.130435 0 32.596273-22.26087 32.596274h-0.795031c-7.15528 0-12.720497-1.590062-15.900621-5.565218-6.360248-6.360248-7.15528-18.285714-7.15528-27.826087v-4.770186c0-36.571429 0.795031-73.937888 0-111.304348-0.795031-32.596273-23.850932-55.652174-55.652174-55.652174-7.950311 0-15.900621 1.590062-23.0559 3.975155v128.795031c0 11.130435-2.385093 19.875776-7.950311 25.440994-3.975155 3.975155-9.540373 6.360248-16.695652 6.360249h-0.795031c-21.465839-0.795031-21.465839-23.055901-21.465838-31.006211v-52.47205-66.782609c0-15.10559-6.360248-31.006211-18.285715-42.931677-11.130435-11.130435-26.236025-17.490683-41.341615-17.490683-6.360248 0-13.515528 0.795031-19.875776 3.180124V442.832298c0 27.031056 0 55.652174-1.590062 83.478261-0.795031 7.15528-7.15528 12.720497-13.515528 18.285714-2.385093 2.385093-5.565217 4.770186-7.950311 7.15528l-2.385093 2.385093-1.590062-3.975155c-1.590062-2.385093-3.975155-4.770186-6.360248-6.360249-4.770186-5.565217-10.335404-11.130435-13.515528-17.490683-2.385093-4.770186-1.590062-10.335404-1.590062-15.10559v-6.360249-69.167701c0-50.881988 0-103.354037-0.795032-155.031056 0-38.161491-24.645963-63.602484-60.42236-64.397516-38.956522 0-65.192547 27.826087-65.192546 68.372671v374.459627l-10.335404 6.360249-0.795031-1.590062c-7.15528-7.950311-15.10559-15.900621-22.26087-23.850932-16.695652-17.490683-34.186335-36.571429-51.677018-54.062112-15.900621-15.10559-35.776398-23.850932-56.447205-23.850931z" /></svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title"> {{ __('messages.incoming') }}</span>
                            <span class="circle-badge">{{$advirtesment_counter}}</span>
                            <!-- <span class="menu-title"> {{ __('messages.advertisements') }}</span> -->
                            @endif
                        
                    </a>
                </div>





                 <div class="menu-item">
                    <a class="menu-link {{ Request::segment(2)=='requests' ? 'active' : '' }}" href="{{ url('admin/requests') }}">
                          @if($objAdmin->is_super == 1)
                          <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24px" height="24px" viewBox="0 -2 1028 1028" class="icon"  version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M91.448447 896c-50.086957 0-91.428571-40.546584-91.428571-91.428571V91.428571C0.019876 41.341615 40.56646 0 91.448447 0h671.006211c50.086957 0 91.428571 40.546584 91.428572 91.428571v337.093168l-3.180124-0.795031c-13.515528-3.975155-26.236025-5.565217-40.546584-5.565217h-0.795031l-0.795031-2.385093h-2.385094V91.428571c0-23.055901-20.670807-43.726708-43.726708-43.726708H91.448447c-23.055901 0-43.726708 20.670807-43.726708 43.726708v713.142858c0 23.055901 20.670807 43.726708 43.726708 43.726708h352.198758l0.795031 0.795031c8.745342 11.925466 3.975155 20.670807 0.795031 27.031056-3.180124 5.565217-4.770186 9.540373 0.795031 15.10559l4.770186 4.770186H91.448447z" fill="" /><path d="M143.125466 174.906832c-8.745342 0-15.900621-11.130435-15.900621-24.645962 0-13.515528 7.15528-24.645963 15.900621-24.645963h270.310559c8.745342 0 15.900621 11.130435 15.900621 24.645963 0 13.515528-7.15528 24.645963-15.900621 24.645962h-270.310559z" fill="" /><path d="M413.436025 128h-270.310559c-7.15528 0-13.515528 9.540373-13.515528 22.26087s6.360248 22.26087 13.515528 22.260869h270.310559c7.15528 0 13.515528-9.540373 13.515528-22.260869s-5.565217-22.26087-13.515528-22.26087zM139.945342 302.111801c-7.15528 0-12.720497-10.335404-12.720497-24.645962s5.565217-24.645963 12.720497-24.645963h193.987577c7.15528 0 12.720497 10.335404 12.720497 24.645963s-5.565217 24.645963-12.720497 24.645962H139.945342z" fill="" /><path d="M333.932919 255.204969H139.945342c-5.565217 0-9.540373 9.540373-9.540373 22.26087s3.975155 22.26087 9.540373 22.260869h193.987577c5.565217 0 9.540373-9.540373 9.540373-22.260869s-4.770186-22.26087-9.540373-22.26087zM734.628571 1024c-27.826087 0-58.037267-1.590062-96.993788-4.770186-56.447205-4.770186-108.124224-31.006211-158.211181-79.503106L253.634783 718.708075c-52.47205-50.881988-54.857143-117.664596-7.950311-168.546584 19.875776-20.670807 50.881988-33.391304 84.273292-33.391305 33.391304 0 63.602484 12.720497 82.68323 34.981367 0.795031 0.795031 2.385093 2.385093 5.565217 3.975155 0.795031 0.795031 2.385093 1.590062 3.180124 2.385093V451.57764v-52.47205c0-40.546584 0-81.888199 0.795031-122.434783 0.795031-60.42236 47.701863-106.534161 109.714286-106.534161h0.795031c59.627329 0 104.944099 43.726708 108.124224 103.354037 0.795031 13.515528 0.795031 27.826087 0 42.136646v18.285714h11.925466c41.341615 0 73.142857 14.310559 96.198757 44.52174 0.795031 1.590062 5.565217 3.180124 11.925466 3.180124 2.385093 0 4.770186 0 6.360249-0.795031 7.15528-0.795031 14.310559-1.590062 20.670807-1.590062 31.801242 0 59.627329 12.720497 83.478261 38.956521 3.975155 3.975155 12.720497 7.15528 20.670807 7.15528h3.180125c5.565217-0.795031 11.925466-1.590062 17.490683-1.590062 59.627329 0 107.329193 42.136646 108.124224 96.993789 2.385093 100.968944 3.975155 200.347826-7.15528 298.931677-13.515528 119.254658-77.118012 182.857143-201.142857 198.757764-23.055901 3.975155-49.291925 5.565217-77.913044 5.565217zM325.982609 562.086957c-16.695652 0-32.596273 6.360248-44.521739 17.490683-14.310559 14.310559-22.26087 31.006211-22.26087 49.291925 0 19.080745 8.745342 38.161491 24.645963 54.062112l30.21118 30.21118c65.987578 65.192547 134.360248 131.975155 202.732919 197.962733 33.391304 31.801242 71.552795 52.47205 113.689441 60.42236 32.596273 6.360248 65.192547 9.540373 96.993789 9.540373 28.621118 0 57.242236-2.385093 85.068323-7.950311 100.968944-18.285714 147.080745-66.782609 156.621118-160.596273 8.745342-89.838509 7.950311-182.062112 6.360248-271.10559v-14.310559c-0.795031-32.596273-23.850932-54.857143-56.447205-54.857143-8.745342 0-16.695652 1.590062-25.440993 4.770187V601.043478c0 11.130435 0 32.596273-22.26087 32.596274h-0.795031c-7.15528 0-12.720497-1.590062-15.900621-5.565218-6.360248-6.360248-7.15528-18.285714-7.15528-27.826087v-4.770186c0-36.571429 0.795031-73.937888 0-111.304348-0.795031-32.596273-23.850932-55.652174-55.652174-55.652174-7.950311 0-15.900621 1.590062-23.0559 3.975155v128.795031c0 11.130435-2.385093 19.875776-7.950311 25.440994-3.975155 3.975155-9.540373 6.360248-16.695652 6.360249h-0.795031c-21.465839-0.795031-21.465839-23.055901-21.465838-31.006211v-52.47205-66.782609c0-15.10559-6.360248-31.006211-18.285715-42.931677-11.130435-11.130435-26.236025-17.490683-41.341615-17.490683-6.360248 0-13.515528 0.795031-19.875776 3.180124V442.832298c0 27.031056 0 55.652174-1.590062 83.478261-0.795031 7.15528-7.15528 12.720497-13.515528 18.285714-2.385093 2.385093-5.565217 4.770186-7.950311 7.15528l-2.385093 2.385093-1.590062-3.975155c-1.590062-2.385093-3.975155-4.770186-6.360248-6.360249-4.770186-5.565217-10.335404-11.130435-13.515528-17.490683-2.385093-4.770186-1.590062-10.335404-1.590062-15.10559v-6.360249-69.167701c0-50.881988 0-103.354037-0.795032-155.031056 0-38.161491-24.645963-63.602484-60.42236-64.397516-38.956522 0-65.192547 27.826087-65.192546 68.372671v374.459627l-10.335404 6.360249-0.795031-1.590062c-7.15528-7.950311-15.10559-15.900621-22.26087-23.850932-16.695652-17.490683-34.186335-36.571429-51.677018-54.062112-15.900621-15.10559-35.776398-23.850932-56.447205-23.850931z" /></svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                          
                            <span class="menu-title"> {{ __('messages.incoming') }}</span>
                            <span class="circle-badge">{{$information_counter}}</span>
                            @else
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->

                                <span class="svg-icon svg-icon-2">

                                    <svg height="24px" width="24px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                         viewBox="0 0 24 24" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:none;}
                                    </style>
                                    <g id="surface1">
                                        <path d="M19,3c0,2.2-4.3,6-9,6v6c4.7,0,9,3.6,9,6h2v-7.3c0.6-0.3,1-1,1-1.7s-0.4-1.4-1-1.7V3H19z M5,9c-0.8,0-1.5,0.5-1.8,1.2
                                            C2.5,10.5,2,11.2,2,12s0.5,1.5,1.2,1.8C3.5,14.5,4.2,15,5,15h0.2l2.2,7l3.5-1.1L9,15V9H5z"/>
                                    </g>
                                    <rect class="st0" width="24" height="24"/>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title"> {{ __('messages.issued') }}</span>
                            <span class="circle-badge">{{$information_counter}}</span>
                            <!-- <span class="menu-title"> {{ __('messages.requests') }}</span> -->
                            @endif
                        
                    </a>
                </div>


                


                 <div class="menu-item">
                    <a class="menu-link {{ Request::segment(2)=='secondary_registrations' ? 'active' : '' }}" href="{{ url('admin/secondary_registrations') }}">
                          <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 16 16" id="register-16px" xmlns="http://www.w3.org/2000/svg">
                                      <path id="Path_184" data-name="Path 184" d="M57.5,41a.5.5,0,0,0-.5.5V43H47V31h2v.5a.5.5,0,0,0,.5.5h5a.5.5,0,0,0,.5-.5V31h2v.5a.5.5,0,0,0,1,0v-1a.5.5,0,0,0-.5-.5H55v-.5A1.5,1.5,0,0,0,53.5,28h-3A1.5,1.5,0,0,0,49,29.5V30H46.5a.5.5,0,0,0-.5.5v13a.5.5,0,0,0,.5.5h11a.5.5,0,0,0,.5-.5v-2A.5.5,0,0,0,57.5,41ZM50,29.5a.5.5,0,0,1,.5-.5h3a.5.5,0,0,1,.5.5V31H50Zm11.854,4.646-2-2a.5.5,0,0,0-.708,0l-6,6A.5.5,0,0,0,53,38.5v2a.5.5,0,0,0,.5.5h2a.5.5,0,0,0,.354-.146l6-6A.5.5,0,0,0,61.854,34.146ZM54,40V38.707l5.5-5.5L60.793,34.5l-5.5,5.5Zm-2,.5a.5.5,0,0,1-.5.5h-2a.5.5,0,0,1,0-1h2A.5.5,0,0,1,52,40.5Zm0-3a.5.5,0,0,1-.5.5h-2a.5.5,0,0,1,0-1h2A.5.5,0,0,1,52,37.5ZM54.5,35h-5a.5.5,0,0,1,0-1h5a.5.5,0,0,1,0,1Z" transform="translate(-46 -28)"/>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        <span class="menu-title">{{ __('messages.secondary_registrations') }}</span>
                        <span class="circle-badge">{{$secondary_registration_counter}}</span>
                    </a>
                </div>



                <div class="menu-item">
                    <a class="menu-link {{ Request::segment(2)=='administrative' ? 'active' : '' }}" href="{{ url('admin/administrative') }}">
                          <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg height="24px" width="24px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                 viewBox="0 0 430.843 430.843" xml:space="preserve">
                            <g>
                                <path d="M397.462,116.802l-28.893-5.781c-1.462-1.67-3.259-3.015-5.258-3.96c2.272-2.54,4.202-5.108,5.667-7.234
                                    c3.533-5.125,6.475-10.647,8.517-15.972c1.003-2.246,1.853-4.504,2.553-6.717c2.736-2.298,4.347-5.731,4.347-9.331v-8.82
                                    c0-2.536-0.79-5.007-2.253-7.063V39.505C382.142,17.721,364.419,0,342.634,0h-12.809c-21.78,0-39.506,17.721-39.506,39.505v12.42
                                    c-1.458,2.055-2.256,4.528-2.256,7.061v8.82c0,3.6,1.609,7.027,4.352,9.329c0.697,2.21,1.551,4.471,2.556,6.723
                                    c2.036,5.322,4.98,10.844,8.516,15.966c1.468,2.132,3.398,4.702,5.681,7.253c-1.994,0.946-3.778,2.287-5.238,3.95l-28.287,5.73
                                    c-0.16,0.211-0.317,0.425-0.482,0.632c-0.515,1.367-1.066,2.719-1.649,4.047c-0.768,1.965-1.627,3.945-2.572,5.92l9.089,1.817
                                    c16.117,3.223,27.814,17.495,27.814,33.937v104.352c0,3.454-0.5,6.824-1.49,10.067v8.134c0,13.706-8.502,25.46-20.51,30.268v59.091
                                    c0,13.985,11.338,25.322,25.325,25.322c13.98,0,25.317-11.336,25.317-25.322c0,13.985,11.334,25.322,25.324,25.322
                                    c13.98,0,25.314-11.336,25.314-25.322V266.978c2.219,1.448,4.861,2.294,7.705,2.294c7.796,0,14.103-6.317,14.103-14.105v-11.439
                                    c0.959-2.055,1.491-4.346,1.491-6.761V132.613C410.421,124.927,404.995,118.308,397.462,116.802z M328.651,143.241
                                    c-0.107,1.033-0.834,1.899-1.841,2.177c-0.226,0.065-0.45,0.092-0.678,0.092c-0.782,0-1.537-0.361-2.021-1.005l-7.117-9.439
                                    c-0.329-0.439-0.51-0.975-0.51-1.526l0.008-15.128c0.002-0.888,0.468-1.711,1.229-2.172c0.757-0.458,1.702-0.479,2.49-0.068
                                    c2.067,1.097,4.139,1.833,6.146,2.187c1.207,0.218,2.086,1.269,2.086,2.494v6.313c0.366,0.145,0.692,0.366,0.957,0.662
                                    c0.481,0.534,0.714,1.244,0.64,1.954L328.651,143.241z M355.457,135.065l-7.102,9.43c-0.49,0.646-1.242,1.013-2.022,1.013
                                    c-0.227,0-0.459-0.033-0.685-0.092c-1.005-0.279-1.734-1.145-1.84-2.181l-1.384-13.456c-0.074-0.71,0.155-1.419,0.637-1.954
                                    c0.264-0.296,0.589-0.517,0.957-0.662v-6.313c0-1.226,0.881-2.276,2.091-2.494c1.998-0.353,4.069-1.088,6.14-2.185
                                    c0.791-0.412,1.731-0.389,2.489,0.068c0.765,0.459,1.224,1.284,1.224,2.172l0.003,15.13
                                    C355.965,134.092,355.787,134.628,355.457,135.065z M358.034,91.962c-6.194,8.983-11.993,13.002-15.003,13.002h-13.6
                                    c-3.008,0-8.813-4.02-15.005-13.002c-4.884-7.088-8.283-14.928-9.08-20.98l-0.139-1.049l-2.459-1.595
                                    c-0.718-0.469-1.153-1.265-1.153-2.126v-4.164c0-1.399,1.137-2.535,2.535-2.535h1.031v-4.517c0-0.96,0.543-1.834,1.401-2.265
                                    c3.486-1.736,10.407-4.66,17.571-4.66c5.71,0,10.449,1.902,14.081,5.65c4.521,4.68,9.741,7.048,15.494,7.048
                                    c3.268,0,6.634-0.768,10.02-2.289c0.783-0.351,1.693-0.282,2.417,0.187c0.339,0.217,0.607,0.508,0.806,0.845h1.381
                                    c1.399,0,2.536,1.136,2.536,2.535v4.165c0,0.86-0.438,1.656-1.153,2.125l-2.456,1.596l-0.143,1.046
                                    C366.318,77.032,362.918,84.874,358.034,91.962z"/>
                                <path d="M124.486,285.664v-8.15c-0.987-3.242-1.486-6.607-1.486-10.05v-104.37c0-16.4,11.666-30.667,27.737-33.92l8.688-1.759
                                    c-0.955-1.997-1.825-3.997-2.598-5.981c-0.586-1.334-1.137-2.685-1.65-4.046c-0.19-0.239-0.373-0.483-0.556-0.729l-28.179-5.637
                                    c-1.461-1.67-3.257-3.015-5.257-3.96c2.273-2.54,4.201-5.108,5.667-7.234c3.534-5.125,6.475-10.647,8.516-15.972
                                    c1.004-2.246,1.853-4.504,2.554-6.717c2.735-2.298,4.348-5.731,4.348-9.331v-8.82c0-2.536-0.791-5.007-2.252-7.063V39.505
                                    C140.018,17.721,122.293,0,100.506,0H87.699c-21.78,0-39.504,17.721-39.504,39.505v12.42c-1.461,2.055-2.259,4.528-2.259,7.061
                                    v8.82c0,3.6,1.612,7.027,4.354,9.329c0.696,2.21,1.549,4.471,2.555,6.723c2.035,5.322,4.979,10.844,8.514,15.966
                                    c1.47,2.132,3.399,4.702,5.681,7.253c-1.993,0.946-3.779,2.287-5.237,3.95l-28.461,5.766c-7.515,1.522-12.92,8.128-12.92,15.803
                                    v104.372c0,2.415,0.535,4.707,1.486,6.761v11.439c0,7.788,6.313,14.105,14.106,14.105c2.84,0,5.489-0.847,7.702-2.294v108.045
                                    c0,13.985,11.337,25.322,25.324,25.322c13.98,0,25.317-11.336,25.317-25.322c0,13.985,11.333,25.322,25.326,25.322
                                    c13.979,0,25.312-11.336,25.312-25.322v-59.093C132.99,311.122,124.486,299.367,124.486,285.664z M86.524,143.241
                                    c-0.107,1.033-0.833,1.899-1.84,2.177c-0.226,0.065-0.451,0.092-0.678,0.092c-0.784,0-1.538-0.361-2.02-1.005l-7.117-9.439
                                    c-0.331-0.439-0.509-0.975-0.509-1.526l0.006-15.128c0.002-0.888,0.469-1.711,1.23-2.172c0.756-0.458,1.701-0.479,2.488-0.068
                                    c2.069,1.097,4.141,1.833,6.147,2.187c1.206,0.218,2.087,1.269,2.087,2.494v6.313c0.363,0.145,0.69,0.366,0.956,0.662
                                    c0.48,0.534,0.713,1.244,0.64,1.954L86.524,143.241z M113.331,135.065l-7.103,9.43c-0.488,0.646-1.241,1.013-2.022,1.013
                                    c-0.227,0-0.458-0.033-0.684-0.092c-1.003-0.279-1.733-1.145-1.839-2.181l-1.384-13.456c-0.074-0.71,0.156-1.419,0.635-1.954
                                    c0.264-0.296,0.59-0.517,0.959-0.662v-6.313c0-1.226,0.881-2.276,2.089-2.494c2-0.353,4.069-1.088,6.142-2.185
                                    c0.789-0.412,1.731-0.389,2.489,0.068c0.765,0.459,1.224,1.284,1.224,2.172l0.002,15.13
                                    C113.838,134.092,113.662,134.628,113.331,135.065z M115.906,91.962c-6.193,8.983-11.99,13.002-15,13.002H87.303
                                    c-3.006,0-8.811-4.02-15.002-13.002c-4.886-7.088-8.285-14.928-9.082-20.98l-0.14-1.049l-2.457-1.595
                                    c-0.718-0.469-1.153-1.265-1.153-2.126v-4.164c0-1.399,1.135-2.535,2.534-2.535h1.031v-4.517c0-0.96,0.546-1.834,1.403-2.265
                                    c3.488-1.736,10.406-4.66,17.57-4.66c5.71,0,10.45,1.902,14.082,5.65c4.522,4.68,9.742,7.048,15.495,7.048
                                    c3.268,0,6.633-0.768,10.019-2.289c0.784-0.351,1.692-0.282,2.416,0.187c0.338,0.217,0.607,0.508,0.807,0.845h1.381
                                    c1.399,0,2.536,1.136,2.536,2.535v4.165c0,0.86-0.438,1.656-1.155,2.125l-2.455,1.596l-0.142,1.046
                                    C124.191,77.032,120.793,84.874,115.906,91.962z"/>
                                <path d="M287.868,274.225c0.959-2.054,1.491-4.347,1.491-6.762V163.11c0-7.686-5.427-14.306-12.958-15.813l-28.894-5.78
                                    c-1.461-1.67-3.259-3.016-5.258-3.959c2.273-2.542,4.2-5.109,5.667-7.234c3.533-5.126,6.475-10.647,8.515-15.974
                                    c1.005-2.246,1.854-4.503,2.553-6.718c2.735-2.296,4.35-5.731,4.35-9.331v-8.82c0-2.535-0.791-5.007-2.254-7.063V70.002
                                    c0-21.784-17.723-39.504-39.508-39.504h-12.809c-21.781,0-39.505,17.72-39.505,39.504v12.42c-1.46,2.055-2.258,4.528-2.258,7.061
                                    v8.82c0,3.6,1.611,7.027,4.354,9.329c0.697,2.21,1.549,4.473,2.555,6.723c2.035,5.324,4.978,10.845,8.514,15.968
                                    c1.469,2.132,3.398,4.702,5.681,7.251c-1.994,0.946-3.778,2.289-5.236,3.951l-28.462,5.766c-7.515,1.521-12.92,8.128-12.92,15.804
                                    v104.37c0,2.415,0.535,4.708,1.485,6.762v11.439c0,7.788,6.313,14.107,14.106,14.107c2.841,0,5.489-0.848,7.701-2.295V405.52
                                    c0,13.986,11.339,25.323,25.326,25.323c13.979,0,25.317-11.336,25.317-25.323c0,13.986,11.331,25.323,25.324,25.323
                                    c13.98,0,25.311-11.336,25.311-25.323V297.475c2.219,1.448,4.864,2.296,7.708,2.296c7.793,0,14.103-6.319,14.103-14.107V274.225z
                                     M207.587,173.739c-0.106,1.033-0.834,1.897-1.839,2.176c-0.225,0.064-0.451,0.092-0.678,0.092c-0.784,0-1.539-0.361-2.02-1.005
                                    l-7.119-9.441c-0.33-0.438-0.509-0.975-0.509-1.526l0.008-15.128c0.002-0.889,0.467-1.711,1.229-2.172
                                    c0.757-0.458,1.703-0.481,2.489-0.069c2.069,1.098,4.139,1.833,6.147,2.188c1.205,0.217,2.086,1.269,2.086,2.494v6.311
                                    c0.365,0.147,0.691,0.368,0.957,0.662c0.48,0.535,0.712,1.244,0.638,1.955L207.587,173.739z M234.394,165.561l-7.104,9.432
                                    c-0.487,0.645-1.239,1.012-2.021,1.012c-0.227,0-0.458-0.033-0.685-0.092c-1.002-0.281-1.731-1.145-1.837-2.182l-1.384-13.455
                                    c-0.074-0.711,0.155-1.42,0.634-1.955c0.264-0.294,0.592-0.515,0.959-0.662v-6.311c0-1.226,0.882-2.277,2.089-2.494
                                    c2.001-0.354,4.069-1.089,6.143-2.186c0.788-0.411,1.732-0.388,2.489,0.07c0.765,0.458,1.225,1.282,1.225,2.172l0.001,15.129
                                    C234.902,164.588,234.725,165.124,234.394,165.561z M236.968,122.46c-6.191,8.981-11.99,13.001-15,13.001h-13.603
                                    c-3.006,0-8.811-4.021-15.002-13.001c-4.885-7.088-8.285-14.928-9.082-20.982l-0.139-1.048l-2.457-1.596
                                    c-0.719-0.468-1.153-1.264-1.153-2.124v-4.164c0-1.4,1.134-2.535,2.534-2.535h1.031v-4.517c0-0.961,0.544-1.836,1.401-2.266
                                    c3.488-1.737,10.408-4.66,17.572-4.66c5.71,0,10.45,1.902,14.082,5.651c4.521,4.678,9.741,7.048,15.494,7.048
                                    c3.268,0,6.634-0.769,10.02-2.289c0.783-0.352,1.69-0.282,2.415,0.185c0.338,0.219,0.607,0.508,0.808,0.847h1.381
                                    c1.399,0,2.535,1.134,2.535,2.535v4.165c0,0.86-0.437,1.656-1.153,2.124l-2.455,1.596l-0.142,1.047
                                    C245.255,107.529,241.856,115.372,236.968,122.46z"/>
                            </g>
                            </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        <span class="menu-title">{{ __('messages.administrative') }}</span>
                        <span class="circle-badge">{{$administrative_counter}}</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ Request::segment(2)=='financial' ? 'active' : '' }}" href="{{ url('admin/financial') }}">
                          <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 -64 640 640" xmlns="http://www.w3.org/2000/svg"><path d="M608 32H32C14.33 32 0 46.33 0 64v384c0 17.67 14.33 32 32 32h576c17.67 0 32-14.33 32-32V64c0-17.67-14.33-32-32-32zM176 327.88V344c0 4.42-3.58 8-8 8h-16c-4.42 0-8-3.58-8-8v-16.29c-11.29-.58-22.27-4.52-31.37-11.35-3.9-2.93-4.1-8.77-.57-12.14l11.75-11.21c2.77-2.64 6.89-2.76 10.13-.73 3.87 2.42 8.26 3.72 12.82 3.72h28.11c6.5 0 11.8-5.92 11.8-13.19 0-5.95-3.61-11.19-8.77-12.73l-45-13.5c-18.59-5.58-31.58-23.42-31.58-43.39 0-24.52 19.05-44.44 42.67-45.07V152c0-4.42 3.58-8 8-8h16c4.42 0 8 3.58 8 8v16.29c11.29.58 22.27 4.51 31.37 11.35 3.9 2.93 4.1 8.77.57 12.14l-11.75 11.21c-2.77 2.64-6.89 2.76-10.13.73-3.87-2.43-8.26-3.72-12.82-3.72h-28.11c-6.5 0-11.8 5.92-11.8 13.19 0 5.95 3.61 11.19 8.77 12.73l45 13.5c18.59 5.58 31.58 23.42 31.58 43.39 0 24.53-19.05 44.44-42.67 45.07zM416 312c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h112c4.42 0 8 3.58 8 8v16zm160 0c0 4.42-3.58 8-8 8h-80c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16zm0-96c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h272c4.42 0 8 3.58 8 8v16z"/></svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        <span class="menu-title">{{ __('messages.financial') }}</span>
                        <span class="circle-badge">{{$financial_counter}}</span>
                    </a>
                </div>





                  <div class="menu-item">
                    <a class="menu-link {{ Request::segment(2)=='board_director_meetings' ? 'active' : '' }}" href="{{ url('admin/board_director_meetings') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg version="1.1" width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                     viewBox="0 0 454.231 454.231" xml:space="preserve">
                                <g id="XMLID_238_">
                                    <circle id="XMLID_245_" cx="239.971" cy="40.832" r="36.243"/>
                                    <path id="XMLID_1285_" d="M291.289,308.145v2.323c1.186-0.022,2.364,0.027,3.524,0.151l37.269,4.105v-19.422
                                        c0-2.607-1.389-4.884-3.463-6.149c-2.698,10.892-12.552,18.991-24.265,18.991H291.289z"/>
                                    <path id="XMLID_1286_" d="M185.954,233.568l0.52-103.59c0.01-1.863,1.524-3.365,3.385-3.36c1.862,0.005,3.368,1.516,3.368,3.377
                                        l0.003,109.104c4.848,5.062,7.773,11.722,8.035,19.047c55.047,0,30.015,0,84.929,0c-0.029-3.807-0.071-6.64-0.115-11.872
                                        l-22.213-13.538c-13.698-8.348-18.034-26.22-9.686-39.917c6.752-11.078,19.732-16.029,31.696-13.103
                                        c-0.013-13.622-0.021-29.96-0.023-49.664c0-2.007,1.616-3.64,3.624-3.66c2.007-0.02,3.656,1.581,3.695,3.589l0.265,52.773
                                        c1,0.575-3.188-1.966,35.083,21.359l-0.374-74.309c-0.114-22.704-18.679-41.175-41.384-41.175h-18.418
                                        c-2.291,5.985-18.727,50.215-21.184,56.634l5.111-24.077c0.359-1.691,0.098-3.454-0.734-4.969l-7.019-12.765l6.24-11.059
                                        c0.433-0.787,0.418-1.744-0.039-2.517s-1.289-1.247-2.187-1.247h-17.126c-0.898,0-1.729,0.474-2.187,1.247s-0.472,1.73-0.039,2.517
                                        l6.24,11.059l-7.045,12.813c-0.817,1.486-1.084,3.212-0.754,4.875l4.469,24.123c-2.232-5.723-18.071-50.415-20.497-56.634h-18.712
                                        c-22.705,0-41.27,18.471-41.384,41.176l-0.51,101.595l19.452-1.212C176.034,229.837,181.354,231.1,185.954,233.568z"/>
                                    <path id="XMLID_1287_" d="M272.146,364.891v-2.524c-3.832-8.524-2.635-5.862-5.723-12.73c-4.874-10.841-2.222-23.149,5.723-31.075
                                        v-10.417h-20.03v98.895h17c6.619,0,12.641,2.591,17.118,6.805v-20.14l-3.465-7.708C276.331,381.19,272.146,373.525,272.146,364.891
                                        z"/>
                                    <rect id="XMLID_1340_" x="193.233" y="308.145" width="8.884" height="98.895"/>
                                    <path id="XMLID_1342_" d="M305.612,258.177l-11.831-7.211l0.036,7.179C304.791,258.145,304.612,258.127,305.612,258.177z"/>
                                    <circle id="XMLID_1353_" cx="72.623" cy="141.854" r="34.701"/>
                                    <circle id="XMLID_1355_" cx="381.609" cy="144.467" r="33.562"/>
                                    <path id="XMLID_1358_" d="M443.192,212.604c-6.097,0-11.039,4.942-11.039,11.039v109.963h-18.068l7.685-116.711
                                        c0.785-11.929-8.245-22.237-20.173-23.029l-38.54-2.557c-10.53-0.699-19.796,6.255-22.374,16.099l31.418-5.659l-42.665,19.926
                                        l-42.896-26.144c-6.849-4.174-15.784-2.006-19.958,4.843c-4.175,6.849-2.006,15.784,4.843,19.958l49.545,30.196
                                        c2.312,1.409,4.931,2.122,7.559,2.122c2.093,0,4.191-0.452,6.145-1.364l49.719-23.221c-47.209,39.412-44.645,37.643-48.073,39.167
                                        l-3.159,47.61l36.104,3.977l-73.397,5.608c-5.66,0.433-10.755,3.595-13.654,8.476s-3.24,10.868-0.912,16.046l40.643,90.406
                                        c3.951,8.789,14.273,12.692,23.04,8.749c8.778-3.946,12.695-14.262,8.749-23.04l-30.469-67.775
                                        c27.416-2.095,3.517-1.606,108.89-1.606v21.398h-71.561v-20.47l-20.03,5.377c11.18,24.869,14.294,31.797,20.03,44.556v-7.385
                                        h71.561v32.878c0,6.097,4.942,11.039,11.039,11.039s11.039-4.942,11.039-11.039v-87.394V223.644
                                        C454.231,217.547,449.289,212.604,443.192,212.604z"/>
                                    <path id="XMLID_1359_" d="M269.116,422.04L269.116,422.04h-32V293.145h67.237h0c5.521,0,10-4.476,10-10c0-5.525-4.479-10-10-10h0
                                        c-3.887,0-124.895,0-128.154,0c6.442-1.815,10.977-7.923,10.543-14.874c-0.499-8.005-7.393-14.103-15.397-13.591l-50.138,3.125
                                        l-28.452-37.523l22.731,17.762l-1.272-19.175c-0.792-11.932-11.107-20.964-23.039-20.172l-38.53,2.556
                                        c-11.932,0.792-20.964,11.107-20.172,23.039l6.698,100.961c-0.625,7.213,3.29,14.549,11.041,17.741H22.078V223.031
                                        c0-6.097-4.942-11.039-11.039-11.039S0,216.934,0,223.031c0,1.389,0,202.913,0,209.181c0,6.097,4.942,11.039,11.039,11.039
                                        s11.039-4.942,11.039-11.039v-33.05h43.8l20.034-22.078H22.078v-22.011c11.154,0,73.713,0,81.742,0l15.119,6.227l-49.935,55.029
                                        c-6.468,7.127-5.934,18.149,1.194,24.617c7.139,6.477,18.159,5.922,24.616-1.195l66.609-73.405
                                        c3.815-4.204,5.344-10.003,4.096-15.542c-1.248-5.538-5.115-10.122-10.364-12.283L87.09,310.488l34.339,7.129l39.001,8.097
                                        c3.286,0.682,6.316,1.919,9.011,3.592l-3.88-16.536c-1.811-7.715-8.754-13.445-16.966-13.445h-16.111h-12.268l-0.516-7.775
                                        c-3.994,0.249-2.111,0.132-9.622,0.6c-8.381,0.522-15.845-4.466-18.881-11.818l-21.584-52.5l33.156,43.725
                                        c2.968,3.914,7.677,6.023,12.476,5.72l29.937-1.866c-2.235,1.834-3.662,4.617-3.662,7.733c0,2.666,1.05,5.082,2.75,6.874l0,0
                                        c1.822,1.921,4.393,3.126,7.25,3.126h0h65.597V422.04h-25.915l-3.52-15l-9.269-39.499c-1.833,2.963-0.481,1.225-28.315,31.898
                                        l7.646,32.582c2.19,9.332,11.574,15.186,20.947,12.984c2.528-0.593,4.785-1.722,6.707-3.219c1.835,0.415-5.191,0.253,83.718,0.253
                                        h0c5.521,0,10-4.476,10-10C279.116,426.515,274.637,422.04,269.116,422.04z"/>
                                </g>
                                </svg>
                                </span>    
                                <!--end::Svg Icon-->
                            </span>
                        <span class="menu-title">{{ __('messages.board_director_meetings') }}</span>
                        <span class="circle-badge">{{$board_director_meetings_counter}}</span>
                    </a>
                </div>


                 <div class="menu-item">
                    <a class="menu-link {{ Request::segment(2)=='permits' ? 'active' : '' }}" href="{{ url('admin/permits') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 52 52" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M39.18,11.4,30.06,2.28A1.1,1.1,0,0,0,29.35,2a1,1,0,0,0-1,1v7.26A2.71,2.71,0,0,0,31.06,13h7.26a1,1,0,0,0,1-1C39.46,11.83,39.46,11.69,39.18,11.4Zm.28,7.26A1.42,1.42,0,0,0,38,17.24H28.35a4.13,4.13,0,0,1-4.13-4.13V3.42A1.42,1.42,0,0,0,22.8,2H9A4.13,4.13,0,0,0,4.85,6.13V39.32A4.13,4.13,0,0,0,9,43.45h14.1c1.14,0,1.42-.71,1.28-2a13.94,13.94,0,0,1,3-10.25c3.42-4,9.12-4.27,10-4.27s2.28,0,2.14-1.29Zm-29.77-8,3.42-.43a.14.14,0,0,0,.14-.14L14.82,7a.42.42,0,0,1,.57,0L17,10.12l.14.14,3.42.43a.28.28,0,0,1,.14.43l-2.57,2.56V14l.57,3.42c0,.15-.14.43-.42.29l-3-1.57H15l-3,1.57c-.14.14-.43,0-.43-.29L12,14v-.28L9.41,11.26A1.09,1.09,0,0,1,9.69,10.69ZM22.23,33.91a1.43,1.43,0,0,1-1.43,1.42h-9a1.43,1.43,0,0,1-1.43-1.42V32.48a1.43,1.43,0,0,1,1.43-1.42h9a1.43,1.43,0,0,1,1.43,1.42Zm7.54-8.41a1.43,1.43,0,0,1-1.42,1.43H11.83A1.43,1.43,0,0,1,10.4,25.5V24.08a1.43,1.43,0,0,1,1.43-1.43H28.49a1.43,1.43,0,0,1,1.43,1.43V25.5Z"/>
                                    <path d="M37.32,37a2,2,0,1,0,2,2A2.14,2.14,0,0,0,37.32,37Z"/>
                                    <path data-name="Shape" d="M37.32,30.34a9.83,9.83,0,1,0,9.83,9.83A10,10,0,0,0,37.32,30.34ZM37.61,46A.44.44,0,0,1,37,46c-1-.85-4.42-3.7-4.42-7A4.7,4.7,0,0,1,42,39C41.88,42.31,38.61,45.16,37.61,46Z"/>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{ __('messages.permits') }}</span>
                        <span class="circle-badge">{{$permit_counter}}</span>
                    </a>
                </div>


                <div class="menu-item">
                    <a class="menu-link {{ Request::segment(2)=='commander_medals' ? 'active' : '' }}" href="{{ url('admin/commander_medals') }}">
                          <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 52 52" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"><path d="M39.18,11.4,30.06,2.28A1.1,1.1,0,0,0,29.35,2a1,1,0,0,0-1,1v7.26A2.71,2.71,0,0,0,31.06,13h7.26a1,1,0,0,0,1-1C39.46,11.83,39.46,11.69,39.18,11.4Zm.28,7.26A1.42,1.42,0,0,0,38,17.24H28.35a4.13,4.13,0,0,1-4.13-4.13V3.42A1.42,1.42,0,0,0,22.8,2H9A4.13,4.13,0,0,0,4.85,6.13V39.32A4.13,4.13,0,0,0,9,43.45h14.1c1.14,0,1.42-.71,1.28-2a13.94,13.94,0,0,1,3-10.25c3.42-4,9.12-4.27,10-4.27s2.28,0,2.14-1.29Zm-29.77-8,3.42-.43a.14.14,0,0,0,.14-.14L14.82,7a.42.42,0,0,1,.57,0L17,10.12l.14.14,3.42.43a.28.28,0,0,1,.14.43l-2.57,2.56V14l.57,3.42c0,.15-.14.43-.42.29l-3-1.57H15l-3,1.57c-.14.14-.43,0-.43-.29L12,14v-.28L9.41,11.26A1.09,1.09,0,0,1,9.69,10.69ZM22.23,33.91a1.43,1.43,0,0,1-1.43,1.42h-9a1.43,1.43,0,0,1-1.43-1.42V32.48a1.43,1.43,0,0,1,1.43-1.42h9a1.43,1.43,0,0,1,1.43,1.42Zm7.54-8.41a1.43,1.43,0,0,1-1.42,1.43H11.83A1.43,1.43,0,0,1,10.4,25.5V24.08a1.43,1.43,0,0,1,1.43-1.43H28.49a1.43,1.43,0,0,1,1.43,1.43V25.5Z"/><path d="M37.32,37a2,2,0,1,0,2,2A2.14,2.14,0,0,0,37.32,37Z"/><path data-name="Shape" d="M37.32,30.34a9.83,9.83,0,1,0,9.83,9.83A10,10,0,0,0,37.32,30.34ZM37.61,46A.44.44,0,0,1,37,46c-1-.85-4.42-3.7-4.42-7A4.7,4.7,0,0,1,42,39C41.88,42.31,38.61,45.16,37.61,46Z"/></svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        <span class="menu-title">{{ __('messages.commander_medals_monzer') }}</span>
                        <span class="circle-badge">{{$commander_medal_counter}}</span>
                    </a>
                </div>



     {{-- Leaders --}}

      <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ 
          Request::segment(2)=='qualification_leaders' ||
          Request::segment(2)=='organizing_study' || Request::segment(2)=='study_report' || Request::segment(2)=='achievements_study_requirements'  ? 'show here' : '' }}">


                 <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
                                <span class="svg-icon svg-icon-2">
                                     <svg width="24" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                 viewBox="0 0 57.001 57.001" xml:space="preserve">
                            <g>
                                <g>
                                </g>
                                <g>
                                    <path d="M39,13.001c3.309,0,6-2.691,6-6s-2.691-6-6-6s-6,2.691-6,6S35.691,13.001,39,13.001z M39,3.001c2.206,0,4,1.794,4,4
                                        s-1.794,4-4,4c-0.117,0-0.226-0.025-0.34-0.034C39.476,10.234,40,9.182,40,8.001h-2c0,0.986-0.719,1.803-1.66,1.966
                                        C35.524,9.234,35,8.182,35,7.001C35,4.795,36.794,3.001,39,3.001z"/>
                                    <path d="M8,25.001c3.309,0,6-2.691,6-6s-2.691-6-6-6s-6,2.691-6,6S4.691,25.001,8,25.001z M8,15.001c2.206,0,4,1.794,4,4
                                        c0,1.181-0.524,2.233-1.34,2.966C9.719,21.804,9,20.987,9,20.001H7c0,1.181,0.524,2.233,1.34,2.966
                                        C8.226,22.976,8.117,23.001,8,23.001c-2.206,0-4-1.794-4-4S5.794,15.001,8,15.001z"/>
                                    <path d="M56.316,2.053l-6-2c-0.306-0.104-0.639-0.052-0.901,0.136C49.154,0.378,49,0.68,49,1.001v8v5H35
                                        c-0.234,0-0.461,0.082-0.641,0.231l-6,5c-0.105,0.089-0.192,0.198-0.254,0.321l-2.836,5.673l-6.314,2.705l-5.639-1.879
                                        c-0.102-0.033-0.209-0.051-0.316-0.051H5c-2.757,0-5,2.243-5,5v11c0,0.553,0.447,1,1,1h3v12H0v2h5h5h4c0.553,0,1-0.447,1-1v-5h2h5
                                        h7c0.553,0,1-0.447,1-1v-5h6h5c0.553,0,1-0.447,1-1v-5h6h5h3v-2h-2v-8c0-2.757-2.243-5-5-5h-4v-4h5c2.757,0,5-2.243,5-5v-6
                                        c0-0.553-0.447-1-1-1h-3V5.722l5.316-1.772C56.725,3.813,57,3.432,57,3.001S56.725,2.189,56.316,2.053z M40.523,16.001L40,17.309
                                        l-0.523-1.308H40.523z M14,49.001c-0.553,0-1,0.447-1,1v5h-2v-12h5v6H14z M18,49.001v-7c0-0.553-0.447-1-1-1h-7
                                        c-0.553,0-1,0.447-1,1v13H6v-23H4v9H2v-10c0-1.654,1.346-3,3-3h3v7h2v-7h2.838l5.846,1.948c0.232,0.079,0.486,0.066,0.71-0.029
                                        l6.235-2.672l0.607,0.91l0.303,0.455l-6.708,3.353l-6.69-0.956c-0.287-0.042-0.578,0.045-0.797,0.234
                                        C12.126,31.436,12,31.711,12,32.001v5c0,0.553,0.447,1,1,1h5c1.654,0,3,1.346,3,3v8H18z M29,43.001c-0.553,0-1,0.447-1,1v5h-5v-8
                                        c0-2.757-2.243-5-5-5h-4v-2.847l5.858,0.837c0.202,0.029,0.406-0.005,0.589-0.096l8-4c0.146-0.073,0.261-0.184,0.354-0.313
                                        c0.008-0.011,0.023-0.015,0.031-0.026l3.905-5.857L35,22.001v21H29z M47,37.001h-5v-6h5V37.001z M53,15.001c0,1.654-1.346,3-3,3
                                        h-6c-0.553,0-1,0.447-1,1v6c0,0.553,0.447,1,1,1h5c1.654,0,3,1.346,3,3v8h-3v-7c0-0.553-0.447-1-1-1h-7c-0.553,0-1,0.447-1,1v8v5
                                        h-3v-23c0-0.379-0.214-0.725-0.553-0.895c-0.338-0.168-0.745-0.133-1.047,0.095l-4,3c-0.091,0.067-0.17,0.15-0.232,0.245
                                        L28,27.198l-0.846-1.27l2.646-5.293l5.562-4.634h1.961l1.748,4.371c0.153,0.38,0.52,0.629,0.929,0.629s0.776-0.249,0.929-0.629
                                        l1.748-4.371H50c0.553,0,1-0.447,1-1v-5h2V15.001z M51,3.613V2.389l1.838,0.612L51,3.613z"/>
                                    <rect x="24" y="5.001" width="2" height="2"/>
                                    <rect x="20" y="5.001" width="2" height="2"/>
                                    <rect x="16" y="5.001" width="2" height="2"/>
                                </g>
                            </g>
                            </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('messages.leaders') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                <div class="menu-sub menu-sub-accordion">


                      <div class="menu-item">
                        <a class="menu-link {{ Request::segment(2)=='qualification_leaders' ? 'active' : '' }}" href="{{ url('admin/qualification_leaders') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">{{ __('messages.qualification_leaders') }}</span>
                            <span class="circle-badge">{{$qualification_leader_counter}}</span>
                        </a>
                    </div>

                    
                    <div class="menu-item">
                        <a class="menu-link {{ Request::segment(2)=='organizing_study' ? 'active' : '' }}" href="{{ url('admin/organizing_study') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">{{ __('messages.organizing_study') }}</span>
                            <span class="circle-badge">{{$organizing_study_counter}}</span>
                        </a>
                    </div>


                     <div class="menu-item">
                        <a class="menu-link {{ Request::segment(2)=='study_report' ? 'active' : '' }}" href="{{ url('admin/study_report') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">{{ __('messages.study_report') }}</span>
                        </a>
                    </div>

                  



                    <div class="menu-item">
                        <a class="menu-link {{ Request::segment(2)=='achievements_study_requirements' ? 'active' : '' }}" href="{{ url('admin/achievements_study_requirements') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">{{ __('messages.achievements_study_requirements') }}</span>
                            <span class="circle-badge">{{$achivement_study_counter}}</span>
                        </a>
                    </div>

                </div>
            </div>


     {{-- Leaders --}}



              

                @if($objAdmin->is_super == 1)
                  <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ 
                  Request::segment(2)=='report_secondary_registrations' ||Request::segment(2)=='report_administrative'||Request::segment(2)=='report_financial' || Request::segment(2)=='report_board_director_meetings'  || Request::segment(2)=='report_qualification_leaders'  ? 'show here' : '' }}">


                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg height="24" viewBox="-2 0 428 428" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m317 278.90625-25 25.402344c-.71875.839844-1.648438 1.476562-2.691406 1.84375l-62.886719 20.847656h38.695313c4.417968 0 8 3.582031 8 8s-3.582032 8-8 8h-213.007813c-4.417969 0-8-3.582031-8-8s3.582031-8 8-8h166.382813c-.679688 0-1.3125-.738281-1.875-1.300781-2.140626-2.105469-2.890626-5.253907-1.929688-8.097657l4.820312-14.601562h-167.398437c-4.417969 0-8-3.582031-8-8s3.582031-8 8-8h172.746094l11.28125-33.898438c.28125-1.105468.835937-2.121093 1.617187-2.949218l79.246094-79.507813v-89.644531h-72.089844c-4.417968 0-7.910156-3.128906-7.910156-7.550781v-73.449219h-237v428h317zm-264.890625-31.90625h113.007813c4.417968 0 8 3.582031 8 8s-3.582032 8-8 8h-113.007813c-4.417969 0-8-3.582031-8-8s3.582031-8 8-8zm213.007813 136h-213.007813c-4.417969 0-8-3.582031-8-8s3.582031-8 8-8h213.007813c4.417968 0 8 3.582031 8 8s-3.582032 8-8 8zm0 0"/>
                                    <path d="m253 11.808594v53.191406h53.554688zm0 0"/>
                                    <path d="m234.945312 307.640625 37.027344-12.378906-24.648437-24.648438zm0 0"/>
                                    <path d="m286.765625 287.425781 101.289063-101.511719-31.382813-31.382812-101.511719 101.289062zm0 0"/>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('messages.reports') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">

                            
                            <div class="menu-item">
                                <a class="menu-link {{ Request::segment(2)=='report_secondary_registrations' ? 'active' : '' }}" href="{{ url('admin/report_secondary_registrations') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.report_secondary_registration') }}</span>
                                </a>
                            </div>


                             <div class="menu-item">
                                <a class="menu-link {{ Request::segment(2)=='report_administrative' ? 'active' : '' }}" href="{{ url('admin/report_administrative') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.report_administrative') }}</span>
                                </a>
                            </div>



                            <div class="menu-item">
                                <a class="menu-link {{ Request::segment(2)=='report_financial' ? 'active' : '' }}" href="{{ url('admin/report_financial') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.report_financial') }}</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link {{ Request::segment(2)=='report_board_director_meetings' ? 'active' : '' }}" href="{{ url('admin/report_board_director_meetings') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.report_board_director_meetings') }}</span>
                                </a>
                            </div>



                            <div class="menu-item">
                                <a class="menu-link {{ Request::segment(2)=='report_qualification_leaders' ? 'active' : '' }}" href="{{ url('admin/report_qualification_leaders') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.report_qualification_leaders') }}</span>
                                </a>
                            </div>

                        </div>
                    </div>




                     <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ 
                  Request::segment(2)=='report_archive_secondary_registrations' ||
                  Request::segment(2)=='report_archive_administrative' || Request::segment(2)=='report_archive_financial'  || Request::segment(2)=='report_archive_board_director_meetings'  ? 'show here' : '' }}">


                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg height="24" viewBox="-2 0 428 428" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m317 278.90625-25 25.402344c-.71875.839844-1.648438 1.476562-2.691406 1.84375l-62.886719 20.847656h38.695313c4.417968 0 8 3.582031 8 8s-3.582032 8-8 8h-213.007813c-4.417969 0-8-3.582031-8-8s3.582031-8 8-8h166.382813c-.679688 0-1.3125-.738281-1.875-1.300781-2.140626-2.105469-2.890626-5.253907-1.929688-8.097657l4.820312-14.601562h-167.398437c-4.417969 0-8-3.582031-8-8s3.582031-8 8-8h172.746094l11.28125-33.898438c.28125-1.105468.835937-2.121093 1.617187-2.949218l79.246094-79.507813v-89.644531h-72.089844c-4.417968 0-7.910156-3.128906-7.910156-7.550781v-73.449219h-237v428h317zm-264.890625-31.90625h113.007813c4.417968 0 8 3.582031 8 8s-3.582032 8-8 8h-113.007813c-4.417969 0-8-3.582031-8-8s3.582031-8 8-8zm213.007813 136h-213.007813c-4.417969 0-8-3.582031-8-8s3.582031-8 8-8h213.007813c4.417968 0 8 3.582031 8 8s-3.582032 8-8 8zm0 0"/>
                                    <path d="m253 11.808594v53.191406h53.554688zm0 0"/>
                                    <path d="m234.945312 307.640625 37.027344-12.378906-24.648437-24.648438zm0 0"/>
                                    <path d="m286.765625 287.425781 101.289063-101.511719-31.382813-31.382812-101.511719 101.289062zm0 0"/>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('messages.archives') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">

                            
                            <div class="menu-item">
                                <a class="menu-link {{ Request::segment(2)=='report_archive_secondary_registrations' ? 'active' : '' }}" href="{{ url('admin/report_archive_secondary_registrations') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">أرشيف  التسجيل السنوي</span>
                                </a>
                            </div>


                             <div class="menu-item">
                                <a class="menu-link {{ Request::segment(2)=='report_archive_administrative' ? 'active' : '' }}" href="{{ url('admin/report_archive_administrative') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">أرشيف تقرير الإداري السنوي</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link {{ Request::segment(2)=='report_archive_financial' ? 'active' : '' }}" href="{{ url('admin/report_archive_financial') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">أرشيف تقرير المالي السنوي</span>
                                </a>
                            </div>



                            <div class="menu-item">
                                <a class="menu-link {{ Request::segment(2)=='report_archive_board_director_meetings' ? 'active' : '' }}" href="{{ url('admin/report_archive_board_director_meetings') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">أرشيف  محاضر اجتماعات الهيئة العامة</span>
                                </a>
                            </div>

                        </div>
                    </div>

                 @endif


               {{-- START SETTINGS --}}
                 @if($objAdmin->is_super == 1)


                  <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Request::segment(2)=='setup'||Request::segment(2)=='type_activities'||Request::segment(2)=='payment_methods'||Request::segment(2)=='payments_received' ? 'show here' : ''}}">


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
                            <span class="menu-title">{{ __('messages.Settings') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">

                          
                           
                              <div class="menu-item">
                                 <a class="menu-link {{ Request::segment(2)=='setup' ? 'active' : '' }}" href="{{ url('/admin/setup') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.setup') }}</span>
                                </a>
                            </div>


                             <div class="menu-item">
                                 <a class="menu-link {{ Request::segment(2)=='type_activities' ? 'active' : '' }}" href="{{ url('/admin/type_activities') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.type_activity') }}</span>
                                </a>
                            </div>



                              <div class="menu-item">
                                 <a class="menu-link {{ Request::segment(2)=='payment_methods' ? 'active' : '' }}" href="{{ url('/admin/payment_methods') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.payment_methods') }}</span>
                                </a>
                            </div>


                             <div class="menu-item">
                                 <a class="menu-link {{ Request::segment(2)=='payments_received' ? 'active' : '' }}" href="{{ url('/admin/payments_received') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.financial_movements') }}</span>
                                </a>
                            </div>




                         

                        </div>
                    </div>


                    @endif

                    {{-- END SETTINGS --}}

               
                

            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
</div>
<!--end::Aside-->
