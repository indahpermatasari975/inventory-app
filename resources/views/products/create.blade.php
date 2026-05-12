@extends('layouts.main')

@section('content')

<div class="container mt-4">

    <h1 class="mb-4 text-success fw-bold">
        Tambah Barang Inventaris
    </h1>

    <form action="{{ route('products.store') }}"
          method="POST"
          class="card shadow-sm p-4 border-0 rounded-4">

        @csrf

        {{-- Nama Barang --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">
                Nama Barang
            </label>

            <input
                type="text"
                class="form-control rounded-3"
                name="name"
                placeholder="Masukkan nama barang"
                value="{{ old('name') }}"
                required
            >

            @error('name')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        {{-- Kategori --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">
                Kategori
            </label>

            <select class="form-select rounded-3"
                    name="category_id"
                    required>

                <option value="">
                    Pilih Kategori
                </option>

                @foreach($categories as $c)

                    <option value="{{ $c->id }}"
                        {{ old('category_id') == $c->id ? 'selected' : '' }}>

                        {{ $c->name }}

                    </option>

                @endforeach

            </select>

            @error('category_id')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        {{-- Harga dan Stok --}}
        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">
                    Harga
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        Rp
                    </span>

                    <input
                        type="number"
                        class="form-control rounded-end-3"
                        name="price"
                        placeholder="0"
                        value="{{ old('price') }}"
                        required
                    >

                </div>

                @error('price')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">
                    Stok
                </label>

                <input
                    type="number"
                    class="form-control rounded-3"
                    name="stock"
                    placeholder="Jumlah stok"
                    value="{{ old('stock') }}"
                    required
                >

                @error('stock')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>

        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">

            <label class="form-label fw-semibold">
                Deskripsi
            </label>

            <textarea
                class="form-control rounded-3"
                name="description"
                rows="3"
                placeholder="Masukkan deskripsi barang"
            >{{ old('description') }}</textarea>

            @error('description')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror

        </div>

        {{-- Status --}}
        <div class="mb-4">

            <label class="form-label fw-semibold">
                Status
            </label>

            <select class="form-select rounded-3"
                    name="status"
                    required>

                <option value="">
                    Pilih Status
                </option>

                <option value="Tersedia"
                    {{ old('status') == 'Tersedia' ? 'selected' : '' }}>
                    Tersedia
                </option>

                <option value="Habis"
                    {{ old('status') == 'Habis' ? 'selected' : '' }}>
                    Habis
                </option>

            </select>

            @error('status')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror

        </div>

        {{-- Tombol --}}
        <button type="submit"
                class="btn btn-success rounded-3 px-4">

            Simpan

        </button>

    </form>

</div>

@endsection
