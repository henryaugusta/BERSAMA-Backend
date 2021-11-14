@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Event Makan Gratis</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Makan Gratis</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Detail</li>
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

    <form action="{{ url('makan-gratis/update') }}" enctype="multipart/form-data" method="post">
        @csrf
        <input type="hidden" value="{{$data->id}}" name="id">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-lg-7 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Nama Event</h3>

                        <div class="form-group">
                            <label for="formFile" class="form-label">Foto Cover</label>
                            <input name="photo" class="form-control" type="file" id="formFile">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Kuota Porsi Daftar Offline</label>
                            <input type="number" min="0" name="offline_quotas" required class="form-control"
                                   value="{{ old('offline_quotas',$data->offline_quotas) }}"
                                   placeholder="Kuota Makanan Pendaftaran Offline">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Kuota Porsi Daftar Online</label>
                            <input type="text" min="0" name="online_quotas" required class="form-control"
                                   value="{{ old('online_quotas',$data->online_quotas) }}"
                                   placeholder="Kuota Makanan Pendaftaran Online">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Nama</label>
                            <input type="text" name="name" required class="form-control"
                                   value="{{ old('name',$data->name) }}"
                                   placeholder="Nama Kegiatan">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Lokasi</label>
                            <input type="text" name="location" required class="form-control"
                                   value="{{ old('location',$data->location) }}"
                                   placeholder="Lokasi Kegiatan : Misal Alun-alun Jombang">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Menu Makanan</label>
                            <input type="text" name="food" class="form-control"
                                   value="{{ old('food',$data->food) }}"
                                   placeholder="Menu Makanan">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Waktu Mulai</label>
                            <input type="datetime-local" name="time_start" class="form-control"
                                   value="{{ old('time_start',$data->time_start) }}"
                                   placeholder="Waktu Mulai">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Waktu Selesai</label>
                            <input type="datetime-local" name="time_end" class="form-control"
                                   value="{{ old('time_end',$data->time_end) }}"
                                   placeholder="Waktu Selesai">
                        </div>

                        <div class="ml-2 row">

                            <div class="form-group mr-2">
                                <label for="basicInput">Latitude</label>
                                <input type="text" name="lat" class="form-control"
                                       value="{{old('lat',$data->lat)}}"
                                       placeholder="Latitude">
                            </div>

                            <div class="form-group">
                                <label for="basicInput">Longitude</label>
                                <input type="text" name="long" class="form-control"
                                       value="{{old('long',$data->long)}}"
                                       placeholder="Longitude">
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="basicInput">Kontak PIC</label>
                            <input type="text" name="pic_contact" class="form-control"
                                   value="{{ old('pic_contact',$data->pic_contact) }}"
                                   placeholder="Kontak PIC">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Nama PIC</label>
                            <input type="text" name="pic_name" class="form-control"
                                   value="{{ old('pic_name',$data->pic_name) }}"
                                   placeholder="Nama PIC">
                        </div>

                        <div class="form-group">
                            <label for="">Status</label>
                            <select class="form-control" name="status" id="">
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
                            <textarea class="form-control" name="m_description" id="textarea" rows="10"
                                      placeholder="Deskripsi">{{old('m_description')}}</textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-primary">Simpan Perubahan</button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-5 col-lg-5 col-sm-12">
                <div class="card">
                    <img
                        id="imgPreview" style="height: 200px; object-fit: cover"
                        class="card-img-top img-fluid" src="{{asset($data->photo)}}" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Card title</h4>
                        <p class="card-text">Some quick example text to build on the card title and make
                            up the bulk of the card's content.</p>
                        <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>

            </div>


        </div>
    </form>





@endsection


@section('app-script')

    <script src="{{ URL::to('bootstrap_ui') }}/assets/libs/tinymce/tinymce.min.js"></script>
    <script src="{{ URL::to('bootstrap_ui') }}/assets/libs/tinymce/plugins/code/plugin.min.js"></script>
    <script>
        tinymce.init({selector: '#textarea'});
        tinymce.init({
            selector: '#dark',
            toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code',
            plugins: 'code'
        });
    </script>

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

    <script>
        var el = document.getElementById('formFile');
        el.onchange = function () {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(document.getElementById("formFile").files[0])
            fileReader.onload = function (oFREvent) {
                document.getElementById("imgPreview").src = oFREvent.target.result;
            };
        }


        $(document).ready(function () {
            $.myfunction = function () {
                $("#previewName").text($("#inputTitle").val());
                var title = $.trim($("#inputTitle").val())
                if (title == "") {
                    $("#previewName").text("Judul")
                }
            };

            $("#inputTitle").keyup(function () {
                $.myfunction();
            });

        });
    </script>





@endsection
