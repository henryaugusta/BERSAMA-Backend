@extends('layouts.landing')
@section('css')
    <!-- CSS only -->

    <style>
        body {
            padding-top: 90px;
        }

        .card-img-top {
            width: 100%;
            height: 15vw;
            object-fit: cover;
        }
    </style>
@endsection
@section ('content')
    <div class="container">
        <!--========== ABOUT ==========-->
        <section class="about section bd-container">
            <div class="about__container  bd-grid">
                <div class="about__data">
                    <span class="section-subtitle about__initial">List Event Makan Gratis</span>
                    <h2 class="section-title about__initial">Kegiatan Makan Gratis</h2>
                    <p class="about__description">Daftar Lokasi dan Waktu Pembagian Makan Gratis Dalam Waktu Dekat</p>
                </div>

                <img src="assets/img/about.jpg" alt="" class="about__img">
            </div>
        </section>

        <hr>
        <div class="row">
            @foreach ($datas as $data)
                <div class="col-md-6 col-lg-4 col-12">

                    <div class="card rounded-top h-100">
                        <img class="card-img-top" style="height: 200px!important;" src="{{asset($data->photo)}}" alt="Card image cap">
                        <div class="card-body  d-flex flex-column">
                            <h4 class="card-title">{!! $data->name !!}</h4>
                            <div class="mt-auto">
                                <p class="card-text">
                                    {!! $data->m_description !!}<br>
                                    <i class=" fas fa-star"></i> Menu Makanan :<br> {{$data->food}}
                                </p>
                                <p><i class="fas fa-calendar-check"></i> Tanggal Mulai :<br> </p>
                                <p class="card-text"><small class="text-muted">{{$data->time_start}}</small></p>
                                <i class="fas fa-calendar-times"></i> Tanggal Selesai :
                                <p class="card-text"><small class="text-muted">{{$data->time_end}}</small></p>
                                <a href='{{url("makan-gratis/$data->id/detail/")}}'>
                                    <button type="button" class="btn btn-outline-success mt-2">Lihat Detail</button>
                                </a>

                                <a href='{{url("makan-gratis/$data->id/detail/")}}'><br>
                                    <button type="submit" class="btn btn-success mt-2">Daftar Makan GRATIS</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection
