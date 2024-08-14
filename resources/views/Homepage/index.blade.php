@extends('Layout.Layouts')

@section('title', 'Abic Realty - Agent')

@section('content')

    <main>
        <section class="main-section pt-xl-5">
         
           

            <div class="container ">

                <div class="card">
                    <div class="company text-center pt-4 ">
                        <img src="/assets/img/abic.png" alt="">
                        {{-- <h1 class="top-title text-white">ABIC REALTY</h1> --}}
                    </div>
                    <div class="card-body">
                        <div class="profile text-center">
                            <img src="/assets/gq-gal-gadot-accent.webp" alt="">
                            <h2 class="name">GAL GADOT</h2>
                            <h3 class="position">Property Specialist</h3>
                            <div class="description d-flex justify-content-center">
                                <p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, nam
                                    obcaecati assumenda amet tempora accusamus consectetur repellendus aperiam, earum quam
                                    dolore quo atque consequatur quod temporibus ullam optio magni sit?</p>
                            </div>

                        </div>
                        <div class="social-media">
                            <div class="social facebook"><img src="../assets/img/facebook.png" alt=""></div>
                            <div class="social instagram"><img src="../assets/img/instagram.png" alt=""></div>
                            <div class="social telegram"><img src="../assets/img/telegram.png" alt=""></div>
                            <div class="social wechat"><img src="../assets/img/wechat.png" alt=""></div>
                            <div class="social viber"><img src="../assets/img/viber.png" alt=""></div>
                            <div class="social whatsup"><img src="../assets/img/whatsapp.png" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection

@section('scripts')

@endsection
