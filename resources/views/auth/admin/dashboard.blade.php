@extends('auth.admin.include.master')
@section('title', $title)
@section('content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            
            @if(Auth::guard('admin')->check())
                @if(Auth::user()->is_super)
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-8">
                        <div class="col-xl-3">
                            <!--begin::Statistics Widget 5-->
                            <a href="{{ url('/admin/leaders') }}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                    <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
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
                                    <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{ $count_leaders }}</div>
                                    <div class="fw-bold text-gray-400">{{ __('messages.scout_groups') }}</div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Statistics Widget 5-->
                        </div>

                        <div class="col-xl-3">
                            <!--begin::Statistics Widget 5-->
                            <a href="{{ url('admin/secondary_registrations') }}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                    <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
                                    <svg width="24" height="24" viewBox="0 0 16 16" id="register-16px" xmlns="http://www.w3.org/2000/svg">
                                      <path id="Path_184" data-name="Path 184" d="M57.5,41a.5.5,0,0,0-.5.5V43H47V31h2v.5a.5.5,0,0,0,.5.5h5a.5.5,0,0,0,.5-.5V31h2v.5a.5.5,0,0,0,1,0v-1a.5.5,0,0,0-.5-.5H55v-.5A1.5,1.5,0,0,0,53.5,28h-3A1.5,1.5,0,0,0,49,29.5V30H46.5a.5.5,0,0,0-.5.5v13a.5.5,0,0,0,.5.5h11a.5.5,0,0,0,.5-.5v-2A.5.5,0,0,0,57.5,41ZM50,29.5a.5.5,0,0,1,.5-.5h3a.5.5,0,0,1,.5.5V31H50Zm11.854,4.646-2-2a.5.5,0,0,0-.708,0l-6,6A.5.5,0,0,0,53,38.5v2a.5.5,0,0,0,.5.5h2a.5.5,0,0,0,.354-.146l6-6A.5.5,0,0,0,61.854,34.146ZM54,40V38.707l5.5-5.5L60.793,34.5l-5.5,5.5Zm-2,.5a.5.5,0,0,1-.5.5h-2a.5.5,0,0,1,0-1h2A.5.5,0,0,1,52,40.5Zm0-3a.5.5,0,0,1-.5.5h-2a.5.5,0,0,1,0-1h2A.5.5,0,0,1,52,37.5ZM54.5,35h-5a.5.5,0,0,1,0-1h5a.5.5,0,0,1,0,1Z" transform="translate(-46 -28)"/>
                                    </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{ $count_secondary_registrations }}</div>
                                    <div class="fw-bold text-gray-400">{{ __('messages.secondary_registrations') }}</div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Statistics Widget 5-->
                        </div>

                        <div class="col-xl-3">
                            <!--begin::Statistics Widget 5-->
                            <a href="{{ url('admin/administrative_financial_reports') }}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                    <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
                                    <svg width="24" height="24" viewBox="0 -64 640 640" xmlns="http://www.w3.org/2000/svg"><path d="M608 32H32C14.33 32 0 46.33 0 64v384c0 17.67 14.33 32 32 32h576c17.67 0 32-14.33 32-32V64c0-17.67-14.33-32-32-32zM176 327.88V344c0 4.42-3.58 8-8 8h-16c-4.42 0-8-3.58-8-8v-16.29c-11.29-.58-22.27-4.52-31.37-11.35-3.9-2.93-4.1-8.77-.57-12.14l11.75-11.21c2.77-2.64 6.89-2.76 10.13-.73 3.87 2.42 8.26 3.72 12.82 3.72h28.11c6.5 0 11.8-5.92 11.8-13.19 0-5.95-3.61-11.19-8.77-12.73l-45-13.5c-18.59-5.58-31.58-23.42-31.58-43.39 0-24.52 19.05-44.44 42.67-45.07V152c0-4.42 3.58-8 8-8h16c4.42 0 8 3.58 8 8v16.29c11.29.58 22.27 4.51 31.37 11.35 3.9 2.93 4.1 8.77.57 12.14l-11.75 11.21c-2.77 2.64-6.89 2.76-10.13.73-3.87-2.43-8.26-3.72-12.82-3.72h-28.11c-6.5 0-11.8 5.92-11.8 13.19 0 5.95 3.61 11.19 8.77 12.73l45 13.5c18.59 5.58 31.58 23.42 31.58 43.39 0 24.53-19.05 44.44-42.67 45.07zM416 312c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h112c4.42 0 8 3.58 8 8v16zm160 0c0 4.42-3.58 8-8 8h-80c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16zm0-96c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h272c4.42 0 8 3.58 8 8v16z"/></svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{ $count_administrative_financial_reports }}</div>
                                    <div class="fw-bold text-gray-400">{{ __('messages.administrative_financial_reports') }}</div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Statistics Widget 5-->
                        </div>

                        <div class="col-xl-3">
                            <!--begin::Statistics Widget 5-->
                            <a href="{{ url('admin/board_director_meetings') }}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                    <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
                                    <svg height="24" width="24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                             viewBox="0 0 512 512"  xml:space="preserve">
                                        <g>
                                            <path class="st0" d="M47.436,302.806c26.222,0,47.417-21.236,47.417-47.436c0-26.192-21.195-47.437-47.417-47.437
                                                C21.236,207.932,0,229.178,0,255.37C0,281.57,21.236,302.806,47.436,302.806z"/>
                                            <path class="st0" d="M47.386,318.985c-25.506,0-46.324,20.679-46.324,46.314v57.588h54.876l35.408-72.328
                                                C85.278,332.106,67.946,318.985,47.386,318.985z"/>
                                            <path class="st0" d="M125.037,212.114c23.48,0,42.481-19.01,42.481-42.5c0-23.45-19.001-42.49-42.481-42.49
                                                c-23.47,0-42.49,19.04-42.49,42.49C82.547,193.104,101.568,212.114,125.037,212.114z"/>
                                            <path class="st0" d="M83.431,310.563v9.158h23.023l42.113-85.825c-6.684-4.708-14.739-7.3-23.53-7.3
                                                c-5.94,0-11.64,1.231-16.715,3.466c3.218,7.806,5.075,16.338,5.075,25.267C113.397,278.492,101.508,298.793,83.431,310.563z"/>
                                            <path class="st0" d="M250.989,129.825c23.48,0,42.49-19.01,42.49-42.5c0-23.45-19.01-42.49-42.49-42.49
                                                c-23.47,0-42.49,19.04-42.49,42.49C208.499,110.815,227.519,129.825,250.989,129.825z"/>
                                            <path class="st0" d="M250.989,144.276c-22.944,0-41.577,18.614-41.577,41.587v18.026h83.153v-18.026
                                                C292.566,162.89,273.962,144.276,250.989,144.276z"/>
                                            <polygon class="st0" points="176.149,219.871 66.437,443.745 66.437,467.166 445.563,467.166 445.563,443.745 335.851,219.871  "/>
                                            <path class="st0" d="M464.563,302.806c26.202,0,47.437-21.236,47.437-47.436c0-26.192-21.235-47.437-47.437-47.437
                                                c-26.221,0-47.417,21.246-47.417,47.437C417.146,281.57,438.342,302.806,464.563,302.806z"/>
                                            <path class="st0" d="M464.613,318.985c-20.56,0-37.892,13.121-43.961,31.575l35.409,72.328h54.876v-57.588
                                                C510.937,339.664,490.119,318.985,464.613,318.985z"/>
                                            <path class="st0" d="M386.962,212.114c23.471,0,42.491-19.01,42.491-42.5c0-23.45-19.02-42.49-42.491-42.49
                                                c-23.48,0-42.48,19.04-42.48,42.49C344.482,193.104,363.482,212.114,386.962,212.114z"/>
                                            <path class="st0" d="M386.962,226.596c-8.789,0-16.844,2.592-23.529,7.3l42.113,85.825h23.024v-9.158
                                                c-18.078-11.77-29.966-32.071-29.966-55.234c0-8.929,1.857-17.461,5.075-25.267C398.603,227.826,392.902,226.596,386.962,226.596z"
                                                />
                                        </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{ $count_board_director_meetings }}</div>
                                    <div class="fw-bold text-gray-400">{{ __('messages.board_director_meetings') }}</div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Statistics Widget 5-->
                        </div>


                    </div>
                    <!--end::Row-->

                    <div class="row g-5 g-xl-8">
                        <div class="col-xl-6">
                            <!--begin::Statistics Widget 5-->
                            <a href="{{ url('admin/permits') }}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                    <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
                                        <svg width="24" height="24" viewBox="0 0 52 52" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"><path d="M39.18,11.4,30.06,2.28A1.1,1.1,0,0,0,29.35,2a1,1,0,0,0-1,1v7.26A2.71,2.71,0,0,0,31.06,13h7.26a1,1,0,0,0,1-1C39.46,11.83,39.46,11.69,39.18,11.4Zm.28,7.26A1.42,1.42,0,0,0,38,17.24H28.35a4.13,4.13,0,0,1-4.13-4.13V3.42A1.42,1.42,0,0,0,22.8,2H9A4.13,4.13,0,0,0,4.85,6.13V39.32A4.13,4.13,0,0,0,9,43.45h14.1c1.14,0,1.42-.71,1.28-2a13.94,13.94,0,0,1,3-10.25c3.42-4,9.12-4.27,10-4.27s2.28,0,2.14-1.29Zm-29.77-8,3.42-.43a.14.14,0,0,0,.14-.14L14.82,7a.42.42,0,0,1,.57,0L17,10.12l.14.14,3.42.43a.28.28,0,0,1,.14.43l-2.57,2.56V14l.57,3.42c0,.15-.14.43-.42.29l-3-1.57H15l-3,1.57c-.14.14-.43,0-.43-.29L12,14v-.28L9.41,11.26A1.09,1.09,0,0,1,9.69,10.69ZM22.23,33.91a1.43,1.43,0,0,1-1.43,1.42h-9a1.43,1.43,0,0,1-1.43-1.42V32.48a1.43,1.43,0,0,1,1.43-1.42h9a1.43,1.43,0,0,1,1.43,1.42Zm7.54-8.41a1.43,1.43,0,0,1-1.42,1.43H11.83A1.43,1.43,0,0,1,10.4,25.5V24.08a1.43,1.43,0,0,1,1.43-1.43H28.49a1.43,1.43,0,0,1,1.43,1.43V25.5Z"/><path d="M37.32,37a2,2,0,1,0,2,2A2.14,2.14,0,0,0,37.32,37Z"/><path data-name="Shape" d="M37.32,30.34a9.83,9.83,0,1,0,9.83,9.83A10,10,0,0,0,37.32,30.34ZM37.61,46A.44.44,0,0,1,37,46c-1-.85-4.42-3.7-4.42-7A4.7,4.7,0,0,1,42,39C41.88,42.31,38.61,45.16,37.61,46Z"/></svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{ $count_permits }}</div>
                                    <div class="fw-bold text-gray-400">{{ __('messages.permits') }}</div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Statistics Widget 5-->
                        </div>

                        <div class="col-xl-6">
                            <!--begin::Statistics Widget 5-->
                            <a href="{{ url('admin/qualification_leaders') }}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                    <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
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
                                    <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{ $count_qualificationLeaders }}</div>
                                    <div class="fw-bold text-gray-400">{{ __('messages.total_leaders') }}</div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Statistics Widget 5-->
                        </div>
                    </div>
                    <!--end::Row-->


                    <div class="row g-5 g-xl-8">
                         

                        <div class="col-xl">
                            <!--begin::Statistics Widget 5-->
                            <a href="{{ url('admin/qualification_leaders') }}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                    <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
<path d="M15 16L20 21M20 16L15 21M11 14C7.13401 14 4 17.134 4 21H11M15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{ $count_qualificationLeaders_ghayr_muahal }}</div>
                                    <div class="fw-bold text-gray-400"> غير مؤهل</div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Statistics Widget 5-->
                        </div>

                        <div class="col-xl">
                            <!--begin::Statistics Widget 5-->
                            <a href="{{ url('admin/qualification_leaders') }}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                    <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
<path d="M20 18L14 18M11 21H4C4 17.134 7.13401 14 11 14C11.695 14 12.3663 14.1013 13 14.2899M15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{ $count_qualificationLeaders_musaeid_qayid_wahdah }}</div>
                                    <div class="fw-bold text-gray-400">مساعد قائد وحدة شارة خشبية </div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Statistics Widget 5-->
                        </div>

                        <div class="col-xl">
                            <!--begin::Statistics Widget 5-->
                            <a href="{{ url('admin/qualification_leaders') }}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                    <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
<path d="M14.9999 15.2547C13.8661 14.4638 12.4872 14 10.9999 14C7.40399 14 4.44136 16.7114 4.04498 20.2013C4.01693 20.4483 4.0029 20.5718 4.05221 20.6911C4.09256 20.7886 4.1799 20.8864 4.2723 20.9375C4.38522 21 4.52346 21 4.79992 21H9.94465M13.9999 19.2857L15.7999 21L19.9999 17M14.9999 7C14.9999 9.20914 13.2091 11 10.9999 11C8.79078 11 6.99992 9.20914 6.99992 7C6.99992 4.79086 8.79078 3 10.9999 3C13.2091 3 14.9999 4.79086 14.9999 7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{ $count_qualificationLeaders_qayid_wahda }}</div>
                                    <div class="fw-bold text-gray-400"> قائد وحدة شارة خشبية   </div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Statistics Widget 5-->
                        </div>

                        <div class="col-xl">
                            <!--begin::Statistics Widget 5-->
                            <a href="{{ url('admin/qualification_leaders') }}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                    <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
<path d="M10.5 21H4C4 17.4735 6.60771 14.5561 10 14.0709M16.4976 16.2119C15.7978 15.4328 14.6309 15.2232 13.7541 15.9367C12.8774 16.6501 12.7539 17.843 13.4425 18.6868C13.8312 19.1632 14.7548 19.9983 15.4854 20.6353C15.8319 20.9374 16.0051 21.0885 16.2147 21.1503C16.3934 21.203 16.6018 21.203 16.7805 21.1503C16.9901 21.0885 17.1633 20.9374 17.5098 20.6353C18.2404 19.9983 19.164 19.1632 19.5527 18.6868C20.2413 17.843 20.1329 16.6426 19.2411 15.9367C18.3492 15.2307 17.1974 15.4328 16.4976 16.2119ZM15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{ $count_qualificationLeaders_musaeid_qayid_tadrib }}</div>
                                    <div class="fw-bold text-gray-400"> مساعد قائد تدريب</div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Statistics Widget 5-->
                        </div>

                        <div class="col-xl">
                            <!--begin::Statistics Widget 5-->
                            <a href="{{ url('admin/qualification_leaders') }}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                    <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
<path d="M11 21H4C4 17.4735 6.60771 14.5561 10 14.0709M19.8726 15.2038C19.8044 15.2079 19.7357 15.21 19.6667 15.21C18.6422 15.21 17.7077 14.7524 17 14C16.2923 14.7524 15.3578 15.2099 14.3333 15.2099C14.2643 15.2099 14.1956 15.2078 14.1274 15.2037C14.0442 15.5853 14 15.9855 14 16.3979C14 18.6121 15.2748 20.4725 17 21C18.7252 20.4725 20 18.6121 20 16.3979C20 15.9855 19.9558 15.5853 19.8726 15.2038ZM15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{ $count_qualificationLeaders_qayid_tadrib }}</div>
                                    <div class="fw-bold text-gray-400"> قائد تدريب</div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Statistics Widget 5-->
                        </div>
                    </div>
                    <!--end::Row-->
                @endif
            @endif


             
             
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection