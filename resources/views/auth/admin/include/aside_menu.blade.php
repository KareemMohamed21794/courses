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
                     
                   @if($objAdmin->is_super == 1)
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
                    @endif
                  
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
                    </a>
                </div>



                 <div class="menu-item">
                    <a class="menu-link {{ Request::segment(2)=='administrative_financial_reports' ? 'active' : '' }}" href="{{ url('admin/administrative_financial_reports') }}">
                          <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 19H6.2C5.0799 19 4.51984 19 4.09202 18.782C3.71569 18.5903 3.40973 18.2843 3.21799 17.908C3 17.4802 3 16.9201 3 15.8V8.2C3 7.07989 3 6.51984 3.21799 6.09202C3.40973 5.71569 3.71569 5.40973 4.09202 5.21799C4.51984 5 5.0799 5 6.2 5H17.8C18.9201 5 19.4802 5 19.908 5.21799C20.2843 5.40973 20.5903 5.71569 20.782 6.09202C21 6.51984 21 7.0799 21 8.2V8.5M9 9.5V8.5M9 9.5H11.0001M9 9.5C7.88279 9.49998 7.00244 9.62616 7.0001 10.8325C6.99834 11.7328 7.00009 12 9.00009 12C11.0001 12 11.0001 12.2055 11.0001 13.1667C11.0001 13.889 11 14.5 9 14.5M9 15.5V14.5M9 14.5L7.0001 14.5M14 10H17M14 20L16.025 19.595C16.2015 19.5597 16.2898 19.542 16.3721 19.5097C16.4452 19.4811 16.5147 19.4439 16.579 19.399C16.6516 19.3484 16.7152 19.2848 16.8426 19.1574L21 15C21.5523 14.4477 21.5523 13.5523 21 13C20.4477 12.4477 19.5523 12.4477 19 13L14.8426 17.1574C14.7152 17.2848 14.6516 17.3484 14.601 17.421C14.5561 17.4853 14.5189 17.5548 14.4903 17.6279C14.458 17.7102 14.4403 17.7985 14.405 17.975L14 20Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        <span class="menu-title">{{ __('messages.administrative_financial_reports') }}</span>
                    </a>
                </div>





                  <div class="menu-item">
                    <a class="menu-link {{ Request::segment(2)=='board_director_meetings' ? 'active' : '' }}" href="{{ url('admin/board_director_meetings') }}">
                          <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" version="1.1" id="x31" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                         viewBox="0 0 128 128" xml:space="preserve">
                                    <g>
                                        <ellipse transform="matrix(0.9659 -0.2588 0.2588 0.9659 -11.4851 7.6134)" cx="23.2" cy="47.4" rx="7.8" ry="7.8"/>
                                        <path d="M37.4,97.5h-9.5c0,0-0.5,0-0.9,0c-4.3-0.4-8-3.5-9.1-7.8l-6.5-24.2c-0.4-1.4-1.8-2.1-3-1.8c-1.4,0.4-2.1,1.8-1.8,3
                                            l6.4,24.2c1.7,6.3,7,10.9,13.5,11.4c0.6,0.1,1.3,0.1,1.3,0.1h9.5c1.4,0,2.4-1.1,2.5-2.5C39.8,98.5,38.8,97.5,37.4,97.5z"/>
                                        <path d="M48.6,83.9h-13c-0.3-4.9-1.1-9.8-2.3-14.7c-0.1-0.4-0.4-1.4-0.4-1.5c-1.7-6.3-7.7-10.3-14-9.7c0,0-0.8,0.1-1,0.1
                                            c-2.3,0.6-3.7,3-3.1,5.4l6.7,24.9c0.7,2.8,3.1,4.9,6.1,5.1h0.6h15.5v17.8c0,2.7,2.1,4.9,4.9,4.9c2.7,0,4.9-2.1,4.9-4.9V88.8
                                            c0-1.3-0.5-2.5-1.5-3.4C51.1,84.4,49.8,83.9,48.6,83.9z"/>
                                    </g>
                                    <g>
                                        <ellipse transform="matrix(0.2588 -0.9659 0.9659 0.2588 31.5932 136.028)" cx="104.4" cy="47.4" rx="7.8" ry="7.8"/>
                                        <path d="M90.2,97.5h9.5c0,0,0.5,0,0.9,0c4.3-0.4,8-3.5,9.1-7.8l6.5-24.2c0.4-1.4,1.8-2.1,3-1.8c1.4,0.4,2.1,1.8,1.8,3l-6.4,24.2
                                            c-1.7,6.3-7,10.9-13.5,11.4c-0.6,0.1-1.3,0.1-1.3,0.1h-9.5c-1.4,0-2.4-1.1-2.5-2.5C87.8,98.5,88.9,97.5,90.2,97.5z"/>
                                        <path d="M79,83.9h13c0.3-4.9,1.1-9.8,2.3-14.7c0.1-0.4,0.4-1.4,0.4-1.5c1.7-6.3,7.7-10.3,14-9.7c0,0,0.8,0.1,1,0.1
                                            c2.3,0.6,3.7,3,3.1,5.4L106,88.4c-0.7,2.8-3.1,4.9-6.1,5.1h-0.6H83.9v17.8c0,2.7-2.1,4.9-4.9,4.9s-4.9-2.1-4.9-4.9V88.8
                                            c0-1.3,0.5-2.5,1.5-3.4C76.5,84.4,77.8,83.9,79,83.9z"/>
                                    </g>
                                    <rect x="38.8" y="70.8" width="50.6" height="6"/>
                                    <circle cx="64.1" cy="43.2" r="7.2"/>
                                    <path d="M52.5,67.9v-4.3h-0.1c0-0.5,0.4-0.9,0.9-0.9c0.5,0,0.9,0.4,0.9,0.9v4.3h19.9v-4.3h-0.1c0-0.5,0.4-0.9,0.9-0.9
                                        s0.9,0.4,0.9,0.9v4.3h6.2v-6.1c0-5-4-9-9-9h-18c-5,0-9,4-9,9v6.1H52.5z"/>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        <span class="menu-title">{{ __('messages.board_director_meetings') }}</span>
                    </a>
                </div>


                 <div class="menu-item">
                    <a class="menu-link {{ Request::segment(2)=='permits' ? 'active' : '' }}" href="{{ url('admin/permits') }}">
                          <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 52 52" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"><path d="M39.18,11.4,30.06,2.28A1.1,1.1,0,0,0,29.35,2a1,1,0,0,0-1,1v7.26A2.71,2.71,0,0,0,31.06,13h7.26a1,1,0,0,0,1-1C39.46,11.83,39.46,11.69,39.18,11.4Zm.28,7.26A1.42,1.42,0,0,0,38,17.24H28.35a4.13,4.13,0,0,1-4.13-4.13V3.42A1.42,1.42,0,0,0,22.8,2H9A4.13,4.13,0,0,0,4.85,6.13V39.32A4.13,4.13,0,0,0,9,43.45h14.1c1.14,0,1.42-.71,1.28-2a13.94,13.94,0,0,1,3-10.25c3.42-4,9.12-4.27,10-4.27s2.28,0,2.14-1.29Zm-29.77-8,3.42-.43a.14.14,0,0,0,.14-.14L14.82,7a.42.42,0,0,1,.57,0L17,10.12l.14.14,3.42.43a.28.28,0,0,1,.14.43l-2.57,2.56V14l.57,3.42c0,.15-.14.43-.42.29l-3-1.57H15l-3,1.57c-.14.14-.43,0-.43-.29L12,14v-.28L9.41,11.26A1.09,1.09,0,0,1,9.69,10.69ZM22.23,33.91a1.43,1.43,0,0,1-1.43,1.42h-9a1.43,1.43,0,0,1-1.43-1.42V32.48a1.43,1.43,0,0,1,1.43-1.42h9a1.43,1.43,0,0,1,1.43,1.42Zm7.54-8.41a1.43,1.43,0,0,1-1.42,1.43H11.83A1.43,1.43,0,0,1,10.4,25.5V24.08a1.43,1.43,0,0,1,1.43-1.43H28.49a1.43,1.43,0,0,1,1.43,1.43V25.5Z"/><path d="M37.32,37a2,2,0,1,0,2,2A2.14,2.14,0,0,0,37.32,37Z"/><path data-name="Shape" d="M37.32,30.34a9.83,9.83,0,1,0,9.83,9.83A10,10,0,0,0,37.32,30.34ZM37.61,46A.44.44,0,0,1,37,46c-1-.85-4.42-3.7-4.42-7A4.7,4.7,0,0,1,42,39C41.88,42.31,38.61,45.16,37.61,46Z"/></svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        <span class="menu-title">{{ __('messages.permits') }}</span>
                    </a>
                </div>




                  <div class="menu-item">
                    <a class="menu-link {{ Request::segment(2)=='qualification_leaders' ? 'active' : '' }}" href="{{ url('admin/qualification_leaders') }}">
                          <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
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
                        <span class="menu-title">{{ __('messages.qualification_leaders') }}</span>
                    </a>
                </div>




              

                @if($objAdmin->is_super == 1)
                  <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ 
                  Request::segment(2)=='report_secondary_registrations' ||
                  Request::segment(2)=='report_administrative_financial' || Request::segment(2)=='report_board_director_meetings'  || Request::segment(2)=='report_qualification_leaders'  ? 'show here' : '' }}">


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
                                <a class="menu-link {{ Request::segment(2)=='report_administrative_financial' ? 'active' : '' }}" href="{{ url('admin/report_administrative_financial') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('messages.report_administrative_financial') }}</span>
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

                 @endif

               
                

            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
</div>
<!--end::Aside-->
