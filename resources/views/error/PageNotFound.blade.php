@extends('Layout.Layouts')

@section('title', 'Page Not Found')

@section('content')

    <main>
       <section class="notfound-section">
        <div class="container">
            <img src="/assets/img/404 Error Page not Found with people connecting a plug-cuate.svg" alt="">
        </div>
       </section>
    </main>

  


@endsection

@section('scripts')
    @parent

    <script src="{{ asset('js/Admin/Schedules.js') }}"></script>


@endsection
