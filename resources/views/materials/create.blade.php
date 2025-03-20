@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Tambah Materi</h1>
    <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul Materi</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="file_path" class="form-label">Upload File</label>
            <input type="file" name="file_path" class="form-control">
        </div>

        <!-- Pilih Mata Kuliah -->
        <div class="mb-3">
            <label for="course_id" class="form-label">Mata Kuliah</label>
            <select name="course_id" id="course_id" class="form-control">
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Pilih CPMK -->
        <div class="mb-3">
            <label for="cpmk_id" class="form-label">CPMK</label>
            <select name="cpmk_id" id="cpmk_id" class="form-control">
                <option value="">-- Pilih CPMK --</option>
                @foreach ($cpmks as $cpmk)
                    <option value="{{ $cpmk->id }}" data-course="{{ $cpmk->course_id }}">
                        {{ $cpmk->code }} - {{ $cpmk->course->name }} - {{ $cpmk->description }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

<!-- JavaScript untuk Filter CPMK Tanpa AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#course_id').change(function() {
            let selectedCourse = $(this).val();
            $('#cpmk_id option').each(function() {
                if ($(this).data('course') == selectedCourse || $(this).val() == '') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            $('#cpmk_id').val('');
        });
    });
</script>
@endsection
