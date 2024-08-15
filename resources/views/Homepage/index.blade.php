@extends('Layout.Layouts')

@section('title', 'Agent')

@section('content')

    <main>
        <section class="main-section pt-xl-5">



            <div class="container ">


                <div class="company text-center pt-4 ">
                    <img src="/assets/img/abic.png" alt="">
                    {{-- <h1 class="top-title text-white">ABIC REALTY</h1> --}}
                </div>
                <div class="card-body">
                    <div class="profile text-center">
                        <img src="/assets/gq-gal-gadot-accent.webp" alt="">
                        <h2 class="name">$record['lastname']</h2>
                        <h3 class="position">Property Specialist</h3>
                        <div class="desc">
                            <h5 class="address"><b><i class="fa-solid fa-location-dot"></i> Office Address: </b> 202 Campus Rueda Urban Avenue, Makati City</h5>
                            <h5 class="telnumber"><b><i class="fa-solid fa-phone"></i> Telephone No:</b> (02) 8646-6136</h5>
                            <h5 class="mobile"><b><i class="fa-solid fa-mobile"></i> Mobile No:</b> +639xx xxx xxxx</h5>
                            <h5 class="website"><b><i class="fa-solid fa-globe"></i> Website:</b> <a href="www.abicfang.com">www.abicfang.com</a></h5>
                        </div>

                    </div>
                    <div class="social-media">
                        <a href="#" class="social" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Facebook">
                            <img src="../assets/img/facebook.png" alt="">
                        </a>

                        <a href="#" class="social" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Facebook">
                            <img src="../assets/img/instagram.png" alt="">
                        </a>

                        <a href="#" class="social" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Facebook">
                            <img src="../assets/img/telegram.png" alt="">
                        </a>
                        <a href="#" class="social" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Facebook">
                            <img src="../assets/img/wechat.png" alt="">
                        </a>
                        <a href="#" class="social" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Facebook">
                            <img src="../assets/img/viber.png" alt="">
                        </a>
                        <a href="#" class="social" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Facebook">
                            <img src="../assets/img/whatsapp.png" alt="">
                        </a>

                    </div>
                </div>

            </div>
        </section>
    </main>

@endsection

@section('scripts')


@endsection
