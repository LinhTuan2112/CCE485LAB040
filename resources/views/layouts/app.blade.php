<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý thư viện</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Thư viện</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="{{ route('books.index') }}">Sách</a> <!-- Thêm màu cho văn bản -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('readers*') ? 'active' : '' }}" href="{{ route('readers.index') }}">Độc giả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('borrows*') ? 'active' : '' }}" href="{{ route('borrows.index') }}">Mượn sách</a>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>