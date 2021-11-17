@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Makan Gratis</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Event Makan Gratis</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Cari</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">
            <div class="customize-input float-right">

            </div>
        </div>
    </div>
@endsection

@section('page-wrapper')

    @include('main.components.message')

    <div class="row">
        @forelse ($datas as $data)
            <div class="col-md-3 col-lg-4">

                <div class="card rounded-top">
                    <img class="card-img-top img-fluid"
                         style="width: 100% !important; height:200px !important; object-fit: cover"
                         src="{{asset($data->photo)}}"
                         alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">{!! $data->name !!}</h4>
                        <p class="card-text">
                            {!! $data->m_description !!}</p>
                        <p><i class=" fab fa-pushed"></i> Sisa Kuota Online : {{$data->online_quota_remain}} <br>
                            <i class=" fab fa-pushed"></i> Sisa Kuota Offline : {{$data->offline_quota_remain}}<br>
                            <i class=" fas fa-star"></i> Menu Makanan : {{$data->food}}</p>
                        <p><i class="fas fa-calendar-check"></i> Tanggal Mulai : {{$data->time_start}}<br>
                            <i class="fas fa-calendar-times"></i> Tanggal Selesai : {{$data->time_end}}</p>
                        <p class="card-text"><small class="text-muted">{{$data->created_at}}</small></p>

                        <a href='{{url("makan-gratis/$data->id/detail/")}}'>
                            <button type="button" class="btn btn-outline-primary mt-2">Lihat Detail</button>
                        </a>

                        <form method="post" action="{{url('/register_to_event')}}">
                            @csrf
                            <input type="hidden" name="event_id" value="{{$data->id}}">
                            <input type="hidden" name="redirectTo" value="{{Request::path()}}">
                            <button type="submit" class="btn btn-primary mt-2">Daftar Makan GRATIS</button>
                        </form>

                    </div>
                </div>
            </div>
        @empty

        @endforelse


    </div>

    <!-- Destroy Modal -->
    <div class="modal fade" id="destroy-modal" tabindex="-1" role="dialog" aria-labelledby="destroy-modalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="destroy-modalLabel">Apakah Anda Yakin Menghapus Konten Ini ?</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a class="btn-destroy" href="">
                        <button type="button" class="btn btn-danger">Hapus</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Destroy Modal -->


@endsection


@section('app-script')
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.3/r-2.2.7/sb-1.0.1/sp-1.2.2/datatables.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
            src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js">
    </script>




    <script type="text/javascript">
        $(function () {
            var table = $('#table_data').DataTable({
                processing: true,
                serverSide: false,
                columnDefs: [{
                    orderable: true,
                    targets: 0
                }],
                dom: 'T<"clear">lfrtip<"bottom"B>',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                buttons: [
                    'copyHtml5',
                    {
                        extend: 'excelHtml5',
                        title: 'Data Santri Export {{ \Carbon\Carbon::now()->year }}'
                    },
                    'csvHtml5',
                ],

            });

            $('body').on("click", ".btn-delete", function () {
                var id = $(this).attr("id")
                $(".btn-destroy").attr("href", window.location.origin + "/news/" + id + "/delete")
                $("#destroy-modal").modal("show")
            });

            $('body').on("click", ".btn-add-new", function () {
                var id = $(this).attr("id")
                $(".btn-destroy").attr("id", id)
                $("#insert-modal").modal("show")
            });

        });
    </script>




@endsection
