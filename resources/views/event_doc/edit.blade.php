@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Dokumentasi Kegiatan</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Dokumentasi Kegiatan</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Edit</li>
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

    <form action='{{ url("event_doc/$data->id/update") }}' method="post" enctype="multipart/form-data">
        <input type="hidden" name="redirectTo" value="{{Request::path()}}">

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Edit Data Dokumentasi</h3>
                        @csrf
                        <div class="form-group">
                            <label for="">Dokumentasi Untuk Event : </label>
                            <select class="form-control form-select" required name="event_id" id="">
                                <option value="">Pilih Event (Kosongkan Jika Tidak ada)</option>
                                @forelse ($events as $item)
                                    <option
                                        @if($data->event_id == $item->id)
                                        selected
                                        @endif
                                        value={{$item->id}}>{{$item->name}}
                                        @if($item->is_deleted!=null) Sudah Dihapus Pada @endif
                                        @if($item->status=="1") (Aktif) @endif
                                        @if($item->status=="2") (Pending) @endif
                                        @if($item->status=="0") (Non-Aktif) @endif
                                    </option>
                                @empty

                                @endforelse

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Tipe Dokumentasi : </label>
                            <select class="form-control form-select" required name="type" id="">
                                <option @if($data->type == 1)
                                        selected
                                        @endif value=1> Foto
                                </option>
                                <option @if($data->type == 2)
                                        selected
                                        @endif
                                        value="2">Video
                                </option>
                                <option @if($data->type == 4)
                                        selected
                                        @endif
                                        value="2">Link Video
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea class="form-control" name="description" rows="5"
                                      placeholder="Keterangan">{{$data->description}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        @if($data->type=="1")
                            <img src="{{asset($data->file)}}" style="border-radius: 20px"
                                 id="imgPreview"
                                 class="img-fluid" alt="Responsive image">
                        @endif

                        @if($data->type=="2")
                            <video width="320" height="240" controls>
                                <source src="{{asset("$data->file")}}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif


                        <div class="form-group mt-3">
                            <label for="">Bukti Pengeluaran</label>
                            <input id="formFile" type="file" class="form-control-file" accept="image/*,video/*"
                                   name="file"
                                   aria-describedby="fileHelpId">
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </form>





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

    <script>
        var el = document.getElementById('formFilezzz');
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
