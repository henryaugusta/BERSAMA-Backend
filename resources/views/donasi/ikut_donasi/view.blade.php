@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Donasi</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Donasi Makan Gratis</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Ikut Donasi</li>
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

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Rekening Donasi</h5>
                    <div class="row">

                        @forelse($donation_accounts as $data)
                            <div class="col-md-3">
                                <div class="card">
                                    <img class="card-img-top"
                                         style="height: 80px; object-fit: contain"
                                         src="{{asset($data->merchant_detail->photo)}}"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">{{$data->merchant_names}}</h4>
                                        <p>Nomor Akun : {{$data->account_number}}</p>
                                        <p>Atas Nama : {{$data->name}}</p>

                                    </div>
                                </div>
                            </div>
                        @empty

                        @endforelse
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Bukti Transfer</h5>
                    <form action='{{ url("donasi/store") }}' enctype="multipart/form-data"
                          method="post">
                        @csrf
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tampilkan Nama Saya Sebagai : </label>
                                    <input type="text" name="show_as"  class="form-control"
                                           value="{{ old('show_as') }}"
                                           placeholder="Isi Kolom Ini Jika Tidak Ingin Menampilkan Nama Asli">
                                </div>

                                <div class="form-group">
                                    <label>Alamat Tujuan Donasi</label>
                                    <select class="form-control" name="account_id" required>
                                        <option value="">Alamat Tujuan Donasi</option>
                                        @forelse($donation_accounts as $item)
                                            <option
                                                value={{$item->id}}>{{$item->merchant_names." - ".$item->account_number}}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>Jumlah Donasi</label>
                                    <input type="number" min="1000" required step="any"  name="amount"  class="form-control"
                                           value="{{ old('amount') }}"
                                           placeholder="Jumlah Donasi Sesuai Bukti Transfer">
                                </div>


                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="formFile" class="form-label">Bukti Transfer</label>
                                    <input name="photo" class="form-control" type="file" id="formFile">
                                </div>

                                <div class="mt-5">
                                    <img style="border-radius: 20px; height: 200px; object-fit: cover"
                                         id="imgPreview"
                                         src="https://www.generationsforpeace.org/wp-content/uploads/2018/03/empty-300x240.jpg"
                                    >
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Pesan dari Donatur</label>
                                    <textarea
                                        class="form-control" style="height: 300px !important;" name="donation_message"
                                        id="textarea" rows="10"
                                        placeholder="Pesan dari Donatur">{{old('donation_message')}}</textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan Data Donasi</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Catatan : </h5>
                    <h5 class="card-text">
                        <ul>
                            <li>
                                Semua Data Donasi bersifat transparan dan ditampilkan untuk umum
                            </li>
                            <li>
                                Data Donasi anda dapat ditrack pada menu Donasi Saya
                            </li>
                        </ul>
                    </h5>
                </div>
            </div>
        </div>
    </div>

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
