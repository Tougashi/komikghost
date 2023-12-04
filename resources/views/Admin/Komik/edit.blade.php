@extends('layouts.index')
@section('container')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        {{-- <div class="breadcrumb-title pe-3">Menu</div> --}}
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item" aria-current="page">EDIT DATA KOMIK</li>
                    <li class="breadcrumb-item" aria-current="page">ISI DATA DENGAN BENAR</li>
                </ol>
            </nav>
        </div>
        {{-- <div class="ms-auto"><a href="/" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Tambahkan Data</a></div> --}}
        <div class="ms-auto"><a href="/komik-list" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bx-arrow-back"></i>Batal</a></div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="p-4 border rounded">
                @if($message = Session::get('success')) 
                <div class="alert alert-success" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <form class="row g-3" action="{{ route('komik.update', encrypt($komik->id) ) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" id="judul" value="{{ $komik->judul }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="subjudul" class="form-label">Sub Judul</label>
                        <input type="text" class="form-control" name="subjudul" id="subjudul" value="{{ $komik->subjudul }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="deskripsi" class="form-label">Deskripsi / Sinopsis</label>
                        <input type="text" class="form-control" name="deskripsi" id="deskripsi" value="{{ $komik->deskripsi }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select class="form-select" name="category_id" id="category_id" required>
                            <option selected disabled value="">Pilih...</option>
                            @foreach ($categories as $value)
                            <option value="{{ $value->id }}">{{ $value->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="jumlah_ch" class="form-label">Jumlah Chapter</label>
                        <input type="text" class="form-control" name="jumlah_ch" id="jumlah_ch"  value="{{ $komik->jumlah_ch }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="created_at" class="form-label">Tanggal Dibuat</label>
                        <input type="date" class="form-control" name="created_at" id="created_at"  value="{{ $komik->created_at }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="cover" class="form-label">Sampul Komik | Tampilan Sampul</label>
                        <p></p>
                        <input type="file" name="cover" class="form-control" id="cover" value="{{ asset('storage' . $komik->cover) }}" required onchange="previewCover()">
                    </div>
                    <div class="col-md-4">
                        <img class="cover-preview img-fluid" src="{{ asset('storage/' . $komik->cover) }}" style="max-width: 40%; height: auto;">
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                            <label class="form-check-label" for="invalidCheck2">Sudah benar?</label>
                        </div>
                    </div>
                    
                     @error('komik')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewCover() {
        var preview = document.querySelector('.cover-preview');
        var fileInput = document.querySelector('#cover');
        var file = fileInput.files[0];
    
        if (file) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                preview.src = e.target.result;
            }
    
            reader.readAsDataURL(file);
        } else {
            preview.src = "{{ asset('storage/' . $komik->cover) }}";
        }
    }
    </script>
@endsection