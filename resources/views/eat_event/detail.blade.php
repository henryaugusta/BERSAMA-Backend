@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Event Makan Gratis</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Makan Gratis</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Tambah</li>
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
        <div class="col-12 mb-4">
            <a href='{{url("makan-gratis/$data->id/detail?tab=general")}}'>
                <button type="button" class="btn btn-outline-primary">Informasi Umum</button>
            </a>
            <a href='{{url("makan-gratis/$data->id/detail?tab=participant")}}'>
                <button type="button" class="btn btn-outline-primary">Data Pendaftar</button>
            </a>
            <a href='{{url("makan-gratis/$data->id/detail?tab=expenses")}}'>
                <button type="button" class="btn btn-outline-primary">Pengeluaran</button>
            </a>
            <a href='{{url("makan-gratis/$data->id/detail?tab=documentation")}}'>
                <button type="button" class="btn btn-outline-primary">Dokumentasi Kegiatan</button>
            </a>
        </div>
    </div>

    <div class="row">

        <div class="col-md-4 col-lg-4 col-sm-12">
            <div class="card">
                <img
                    id="imgPreview" style="height: 200px; object-fit: cover"
                    class="card-img-top img-fluid" src="{{asset($data->photo)}}" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title">{{$data->name}}</h4>
                    <div class="card-text">
                        {!! $data->m_description !!}
                        <p class="card-text">
                        <p><i class=" fab fa-pushed"></i> Sisa Kuota Online : {{$data->online_quota_remain}} <br>
                            <i class=" fab fa-pushed"></i> Sisa Kuota Offline : {{$data->offline_quota_remain}}</p>
                        <i class=" fas fa-star"></i> Menu Makanan : {{$data->food}}</p>
                        <p><i class="fas fa-calendar-check"></i> Tanggal Mulai : {{$data->time_start}}<br>
                            <i class="fas fa-calendar-times"></i> Tanggal Selesai : {{$data->time_end}}</p>
                        <p class="card-text"><small class="text-muted">{{$data->created_at}}</small></p>
                    </div>
                    <form method="post" action="{{url('/register_to_event')}}">
                        @csrf
                        <input type="hidden" name="redirectTo" value="{{Request::path()}}">
                        <input type="hidden" name="event_id" value="{{$data->id}}">
                        <button type="submit" class="btn btn-primary mt-2">Daftar Kegiatan Ini</button>
                    </form>

                </div>
            </div>

        </div>


        @if($type=="general")
            <div class="col-lg-8 col-md-8 col-lg-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Nama Event</h3>

                        <div class="form-group">
                            <label for="basicInput">Kuota Porsi Daftar Offline</label>
                            <input readonly type="number" min="0" name="offline_quotas" required class="form-control"
                                   value="{{ old('offline_quotas',$data->offline_quotas) }}"
                                   placeholder="Kuota Makanan Pendaftaran Offline">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Kuota Porsi Daftar Online</label>
                            <input readonly type="text" min="0" name="online_quotas" required class="form-control"
                                   value="{{ old('online_quotas',$data->online_quotas) }}"
                                   placeholder="Kuota Makanan Pendaftaran Online">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Nama</label>
                            <input readonly type="text" name="name" required class="form-control"
                                   value="{{ old('name',$data->name) }}"
                                   placeholder="Nama Kegiatan">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Lokasi</label>
                            <input readonly type="text" name="location" required class="form-control"
                                   value="{{ old('location',$data->location) }}"
                                   placeholder="Lokasi Kegiatan : Misal Alun-alun Jombang">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Menu Makanan</label>
                            <input readonly type="text" name="food" class="form-control"
                                   value="{{ old('food',$data->food) }}"
                                   placeholder="Menu Makanan">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Waktu Mulai</label>
                            <input readonly type="datetime-local" name="time_start" class="form-control"
                                   value="{{ old('time_start',$data->time_start) }}"
                                   placeholder="Waktu Mulai">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Waktu Selesai</label>
                            <input readonly type="datetime-local" name="time_end" class="form-control"
                                   value="{{ old('time_end',$data->time_end) }}"
                                   placeholder="Waktu Selesai">
                        </div>

                        <div class="ml-2 row">

                            <div class="form-group mr-2">
                                <label for="basicInput">Latitude</label>
                                <input readonly type="text" name="lat" class="form-control"
                                       value="{{old('lat',$data->lat)}}"
                                       placeholder="Latitude">
                            </div>

                            <div class="form-group">
                                <label for="basicInput">Longitude</label>
                                <input readonly type="text" name="long" class="form-control"
                                       value="{{old('long',$data->long)}}"
                                       placeholder="Longitude">
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="basicInput">Kontak PIC</label>
                            <input readonly type="text" readonly name="pic_contact" class="form-control"
                                   value="{{ old('pic_contact',$data->pic_contact) }}"
                                   placeholder="Kontak PIC">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Nama PIC</label>
                            <input readonly type="text" name="pic_name" class="form-control"
                                   value="{{ old('pic_name',$data->pic_name) }}"
                                   placeholder="Nama PIC">
                        </div>

                        <div class="form-group">
                            <label for="">Status</label>
                            <select readonly disabled class="form-control" name="status" id="">
                                <option @if($data->status == 1) selected @endif value="1">Aktif (Sudah bisa mendaftar)
                                </option>
                                <option @if($data->status == 1) selected @endif value="2">Pending</option>
                                <option @if($data->status == 0) selected @endif value="0">Non-Aktif/Dihapus ( Tidak
                                    Ditampilkan di Pengguna)
                                </option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            {!! $data->m_description !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($type=="participant")
            <div class="col-lg-7 col-md-7 col-lg-7 col-sm-12">
                <div class="card border-primary">
                    <div class="card-header bg-primary">
                        <h4 class="mb-0 text-white">Pendaftar Online</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table_data" class="table table-hover table-bordered display no-wrap"
                                   style="width:100%">
                                <thead class="">
                                <tr>
                                    <th data-sortable="">No</th>
                                    <th data-sortable="">Nama</th>
                                    <th data-sortable="">Mendaftar Pada :</th>
                                    <th data-sortable="">Waktu Pengambilan</th>
                                    <th data-sortable="">Diinput Pada</th>
                                    <th data-sortable="">Detail</th>
                                    @if(Auth::user()->role=="1")
                                        <th data-sortable="">Hapus</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>

                                @forelse ($participants as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->user->name }}</td>
                                        <td>
                                            {{$data->created_at}}
                                        </td>
                                        <td>{{ $data->created_at }}</td>
                                        <td>
                                            @if($data->taken_at!=null)
                                                {{ $data->taken_at }}
                                            @else
                                                <strong class="text-danger">Belum Diambil</strong>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('/user'.'/'.$data->id.'/detail')}}">
                                                <button type="button" class="btn btn-primary">Detail</button>
                                            </a>
                                        </td>
                                        @if(Auth::user()->role=="1")
                                            <td>
                                                <button id="{{ $data->id }}" type="button"
                                                        class="btn btn-danger btn-delete mr-2">Hapus Pendaftar
                                                </button>
                                            </td>
                                        @endif

                                    </tr>
                                @empty

                                @endforelse


                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        @endif
    </div>


    <!-- Destroy Modal -->
    <div class="modal fade" id="destroy-modal" tabindex="-1" role="dialog" aria-labelledby="destroy-modalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="form_delete_participant" method="post" action="">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="destroy-modalLabel">Apakah Anda Yakin Ingin Menghapus Data User dari
                            List Pendaftar Ini ?</h5>

                        <input type="hidden" name="redirectTo" value="{{Request::path()}}">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Alasan Pembatalan</label>
                            <input type="text" required
                                   class="form-control" name="reason" aria-describedby="helpId"
                                   placeholder="Alasan Pembatalan">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </form>
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
                $("#form_delete_participant").attr("action", window.location.origin + "/makan-gratis/participants/" + id + "/delete")
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
