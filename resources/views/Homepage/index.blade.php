@extends('Layout.Layouts')

@section('title', 'Agent')

@section('content')

    <main>
        <section class="main-section pt-xl-5">
            <div class="container ">
                <div class="company text-center pt-4 ">
                    <img src="/assets/img/abic.png" alt="">
                </div>
                <div class="card-body">
                    <div class="profile text-center">
                        <img src={{ '/profiles/' . $record->profile }} alt="{{ $record->profile }}" />
                        {{-- <img src="/profiles/1723702634_1.jpg" alt=""> --}}
                        <h2 class="name">{{ $record->firstname }} {{ $record->lastname }}</h2>
                        <h3 class="position">{{ $record->position }}</h3>
                        <div class="desc">
                            <h5 class="address"><b><i class="fa-solid fa-location-dot"></i> Office Address: </b> 202 Campus
                                Rueda Urban Avenue, Makati City</h5>
                            <h5 class="telnumber"><b><i class="fa-solid fa-phone"></i> Telephone No:</b> (02) 8646-6136</h5>
                            <h5 class="mobile"><b><i class="fa-solid fa-mobile"></i> Mobile No:</b> +639xx xxx xxxx</h5>
                            <h5 class="website"><b><i class="fa-solid fa-globe"></i> Website:</b> <a
                                    href="www.abicfang.com">www.abicfang.com</a></h5>
                        </div>

                    </div>
                    <div class="social-media">
                        <a href="{{ $record->facebook }}" class="social" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Facebook">
                            <img src="../assets/img/facebook.png" alt="">
                        </a>

                        <a href="https://web.telegram.org/k/#{{ $record->telegram }}" class="social"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Facebook">
                            <img src="../assets/img/telegram.png" alt="">
                        </a>    
                        <a href="{{ $record->wechat }}" class="social" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Facebook">
                            <img src="../assets/img/wechat.png" alt="">
                        </a>
                        <a href="viber://add?number={{ $record->viber }}" class="social" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Viber">
                            <img src="../assets/img/viber.png" alt="Viber">
                         </a>
                        <a href="https://wa.me/{{ $record->whatsapp }}" class="social" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-title="WhatsApp">
                            <img src="../assets/img/whatsapp.png" alt="WhatsApp">
                        </a>

                    </div>
                </div>

            </div>
        </section>
    </main>

@endsection

@section('scripts')


@endsection
