@extends('layouts.main')

@section('content')

<h1>Daftar Kategori</h1>

<a href="{{ route('categories.create') }}"
   class="btn btn-primary mb-3">
   + Tambah Kategori
</a>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($categories as $index => $category)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $category->name }}</td>
            <td>
                <a href="{{ route('categories.edit', $category->id) }}"
                   class="btn btn-warning btn-sm">
                   Edit
                </a>

                <form action="{{ route('categories.destroy', $category->id) }}"
                      method="POST"
                      style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin hapus data?')">
                        Hapus
                    </button>

                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
