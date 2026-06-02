@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Barang Inventaris</h1>
        @if(Auth::check() && Auth::user()->role === 'admin')
            <a href="{{ route('products.create') }}" class="btn btn-primary">+ Tambah Barang</a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            @if(Auth::check() && Auth::user()->role === 'admin')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $p)
                            <tr>
                                <td>{{ $products->firstItem() ? $products->firstItem() + $loop->index : $loop->iteration }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->category->name }}</td>
                                <td>Rp {{ number_format($p->price) }}</td>
                                <td>{{ $p->stock }}</td>
                                <td>{{ $p->description }}</td>
                                <td>
                                    <span class="badge {{ $p->status === 'active' ? 'bg-success' : 'bg-warning' }}">
                                        {{ $p->status }}
                                    </span>
                                </td>
                                @if(Auth::check() && Auth::user()->role === 'admin')
                                    <td class="text-nowrap">
                                        <a href="{{ route('products.edit', $p->id) }}" class="btn btn-warning btn-sm me-1 mb-1">
                                            Edit
                                        </a>
                                        <form action="{{ route('products.destroy', $p->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus data ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ Auth::check() && Auth::user()->role === 'admin' ? 8 : 7 }}" class="text-center text-muted py-3">
                                    Tidak ada data barang yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div class="text-muted small">
            @if($products->total())
                Menampilkan {{ $products->firstItem() }} sampai {{ $products->lastItem() }} dari {{ $products->total() }} hasil
            @else
                Tidak ada data produk untuk ditampilkan.
            @endif
        </div>
        <div>
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
