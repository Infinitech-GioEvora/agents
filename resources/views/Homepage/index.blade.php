@extends('Layout.Layouts')

@section('title', 'Agent')

@section('content')

    <main>
        <section class="main-section">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-5 left-content">
                        <div class="employee-img p-0"></div>
                        <img src={{ '/profiles/' . $record->profile }} alt="{{ $record->profile }}" />

                    </div>
                    <div class="col-12 col-md-7 right-content">
                        <div class="employee-details mb-4">
                            <h1 class="employee-name">{{ $record->firstname }} {{ $record->lastname }}</h1>
                            <h2 class="employee-position mb-4">{{ $record->position }}</h2>
                            <p class="employee-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus
                                error eius
                                omnis facilis officia modi dolor atque quo eligendi accusamus blanditiis fugiat sapiente
                                aspernatur est nisi, quasi voluptates veritatis pariatur?</p>
                        </div>

                        <div class="employee-contact mb-4">
                            <div class="location"><b>Office Address:</b> Unit 311, Campos Rueda Bldg., Urban Avenue,
                                Makati City
                            </div>
                            <div class="mobile-number"><b>Mobile No.:</b> +63992 440 1097</div>
                            <div class="tel"><b>Telephone No.:</b> (02) 7001-6157</div>
                            <div class="website"><b>Website:</b> www.infinitech.com</div>
                        </div>

                        <div class="contacts mb-xl-4">
                            <form method="get" action="/download-vcard">
                                <button type="submit" >
                                    <i class="fa-solid fa-id-card"></i>
                                    <span> Add to contacts</span>
                                </button>
                                <input type="hidden" name="id" value="{{ $record->employeeID }}">
                            </form>
                           
                        </div>

                        <div class="employee-social d-flex ">
                            <div class="social facebook" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" data-bs-title="Facebook" >
                                <a href="{{ $record->facebook }}" >
                                    <i class="fa-brands fa-facebook" ></i>
                                </a>
                            </div>
                            <div class="social telegram" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Telegram">
                                <a href="https://t.me/+63{{ $record->telegram }}">
                                    <i class="fa-brands fa-telegram"></i>
                                </a>
                            </div>
                            <div class="social telegram" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wechat">
                                <a type="button" class=" btn-wechat" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-brands fa-weixin"></i>
                                </a>
                            </div>
                            <div class="social telegram" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Viber">
                                <a href="viber://add?number={{ $record->viber }}">
                                    <i class="fa-brands fa-viber"></i>
                                    
                                </a>
                            </div>
                            <div class="social viber" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Whatsapp">
                                <a href="{{ $record->whatsapp }}">
                                    <i class='bx bxl-whatsapp'></i>
                                </a>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="modal fade wechat-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Scan me</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="wechatImage" src="{{ '/wechat/' . $record->wechat }}" alt="{{ $record->wechat }}" />

                    <button class="button btn-download">
                        <span class="button-content">Download QR</span>
                    </button>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    @parent

    <script src="{{ asset('js/Admin/Schedules.js') }}"></script>


@endsection
