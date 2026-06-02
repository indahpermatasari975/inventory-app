<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body text-center py-5">
                        <h1 class="display-1 text-danger">403</h1>
                        <h2 class="card-title mb-3">Akses Ditolak</h2>
                        <p class="card-text mb-4">
                            Anda tidak memiliki izin untuk mengakses halaman ini.
                            Silakan hubungi administrator jika Anda merasa ini adalah kesalahan.
                        </p>
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                ← Kembali
                            </a>
                            <a href="{{ route('home') }}" class="btn btn-primary">
                                Ke Halaman Utama
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
