@extends('layouts.app')

@section('title')
{{ trans('welcome.home') }}
@endsection

@section('js')
            <script> 

                $(document).ready(function(){
                    $('[data-toggle="popover"]').popover();   
                });

                @role('staff')
                    function destroy_chat(chat_id)
                    {
                        if (confirm('{{ trans("forms.confirm") }}')) {
                            var form = document.getElementById('destroy_chat_'+chat_id);
                            form.submit();
                        }
                    }
                @endrole
            </script>
@endsection

@section('style')
    <!-- Chatbox -->
    <style>
        .container img {
            float: left;
            max-width: 30px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }

        .my-custom-scrollbar {
            position: relative;
            height: 368px;
            overflow: auto;
        }
            
        .table-wrapper-scroll-y {
            display: block;
        }
    </style>
@endsection

@section('content')

    <div class="row mt-4">
        <div class="col-md-8"> 

            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>

                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="{{ asset('images/carousel/ct_camping_dust2.png') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h4 class="fw-bold"> {{ trans('welcome.friendly_community') }} </h4>
                      <p> {{ trans('welcome.friendly_community_message') }} </p>
                    </div>
                  </div>

                  <div class="carousel-item">
                    <img src="{{ asset('images/carousel/ct_kill_tt_inferno.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h4 class="fw-bold"> {{ trans('welcome.competitive_community') }} </h4>
                      <p> {{ trans('welcome.competitive_community_message') }} </p>
                    </div>
                  </div>

                  <div class="carousel-item">
                    <img src="{{ asset('images/carousel/tt_rush_nuke.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h4 class="fw-bold"> {{ trans('welcome.protected_server') }} </h4>
                      <p> {{ trans('welcome.protected_server_message') }} </p>
                    </div>
                  </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden"> {{ trans('forms.previous') }} </span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden"> {{ trans('forms.next') }} </span>
                </button>
              </div>

        </div>

        <div class="col-md-4 pt-3">

            <div class="text-center"> <h1> {{ trans('welcome.welcome_title', ['community' => config('app.name')]) }} </h1> </div>
            <div class="text-center"> {{ trans('welcome.welcome_message') }} </div>

            <div class="text-center mt-3"> 
                <a type="button" class="btn btn-success m-1" href="{{ route('buy_administrator') }}">
                    <i class="fa-solid fa-crown"></i> {{ trans('home.buy_administrator') }}
                </a>

                <a type="button" class="btn btn-warning m-1" href="#rules" >
                    <i class="fa-solid fa-server"></i> {{ trans('welcome.see_rules') }}
                </a>

                <a type="button" class="btn btn-danger m-1" href="#servers" >
                    <i class="fa-solid fa-server"></i> {{ trans('welcome.go_to_servers') }}
                </a>
            </div>

            <div class="text-center mt-5 fst-italic"> {{ trans('welcome.community_managed_by') }} 
                @foreach ($staffs as $staff)
                <span class="fw-bold text-success"> {{ $staff->name }} </span>

                @if (!$loop->last)
                    , 
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <a class="text-decoration-none text-dark fs-4" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa-solid fa-comments"></i> {{ trans('welcome.open_or_close_chat') }}
        </a>
    </div>

    <div class="collapse show" id="collapseExample">
    @include('chat')
    </div>

    <div class="row bg-white rounded shadow p-3 m-1 mt-5" id="rules">
        <div class="col-md-6 p-3">
            <h3 class="ml-4 text-lg leading-7 font-semibold"> <i class="fa-solid fa-ruler"></i> {{ trans('welcome.rules') }} </h3>

            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                {{ trans('welcome.rules_message') }}
            </div>
        </div> 
        
        <div class="col-md-6 p-3">
            <h3 class="ml-4 text-lg leading-7 font-semibold"> <i class="fa-solid fa-user-secret"></i> {{ trans('welcome.vigilance') }} </h3>

            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                {{ trans('welcome.vigilance_message') }}
            </div>
        </div>

        <div class="col-md-6 p-3">
            <h3 class="ml-4 text-lg leading-7 font-semibold"> <i class="fa-regular fa-face-smile"></i> {{ trans('welcome.friendly') }} </h3>

            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                {{ trans('welcome.friendly_message') }}
            </div>
        </div>

        <div class="col-md-6 p-3">
            <h3 class="ml-4 text-lg leading-7 font-semibold"> <i class="fa-solid fa-ruler"></i> {{ trans('welcome.diversity') }} </h3>

            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                {{ trans('welcome.diversity_message') }}
            </div>
        </div>
    </div>


        <div class="text-center mt-4" id="servers">
            <h1> <span class="fas fa-server"> </span> {{ trans('servers.our_servers') }} </h1>
            <div class="mt-3"> {{trans('welcome.invite_users') }} </div>


            <div class="d-flex justify-content-center">
            @if ($servers->isNotEmpty())
                <table>
                    <tr>
                    @php $count = 1; @endphp
                        @foreach ($servers as $server)
                        <td class="pl-3 pt-4">
                            <iframe style="margin-right: 1%" src="https://cache.gametracker.com/components/html0/?host={{ $server->ip }}&bgColor=333333&fontColor=cccccc&titleBgColor=222222&titleColor=ff9900&borderColor=555555&linkColor=ffcc00&borderLinkColor=222222&showMap=1&currentPlayersHeight=100&showCurrPlayers=1&showTopPlayers=0&showBlogs=0&width=240" frameborder="0" scrolling="no" width="240" height="412"></iframe>
                            <br />  
                            <center>
                                @if ($server->ranking_url)
                                    <a class="btn btn-secondary" href="{{ $server->ranking_url }}"> <i class="fas fa-sign-in-alt"></i> {{ trans('servers.view_ranking') }} </a>
                                @endif
                                
                                <a class="btn btn-success" href="steam://connect/{{ $server->ip }}"> <i class="fas fa-sign-in-alt"></i> {{ trans('servers.join') }} </a>
                            </center>
                        </td>

                        @if ($count == 5)
                            @php $count = 0; @endphp
                            </tr>

                            <tr>
                        @endif

                        @php $count++; @endphp

                        @endforeach
                    </tr>
                </table>
            @else
                <div style="color: red"> {{ trans('servers.no_servers') }} </div>
            @endif
            </div>
        </div> 


        <div class="text-center m-4 fw-italic">
            <hr>
            <a href="https://4evergaming.com.ar" target="_blank" class="text-decoration-none text-dark">
                {{ trans('welcome.designed_by') }} <i class="fa-solid fa-heart"></i>
            </a> 
        </div>
@endsection
