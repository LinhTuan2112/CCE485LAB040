@extends('layout.parent')

@section('title', 'Chỉnh sửa phiếu mượn')

@section('content')
    <h1>Chỉnh sửa phiếu mượn</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('borrows.update', $borrow) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="book_id" class="form-label">Sách</label>
            <select class="form-select" id="book_id" name="book_id">
                @foreach ($books as $book)
                    <option value="{{ $book->id }}" {{ $borrow->book_id == $book->id ? 'selected' : '' }}>
                        {{ $book->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="reader_id" class="form-label">Độc giả</label>
            <select class="form-select" id="reader_id" name="reader_id">
                @foreach ($readers as $reader)
                    <option value="{{ $reader->id }}" {{ $borrow->reader_id == $reader->id ? 'selected' : '' }}>
                        {{ $reader->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="borrow_date" class="form-label">Ngày mượn</label>
            <input type="date" class="form-control" id="borrow_date" name="borrow_date" value="{{ old('borrow_date', $borrow->borrow_date) }}">
        </div>

        <div class="mb-3">
            <label for="return_date" class="form-label">Ngày trả</label>
            <input type="date" class="form-control" id="return_date" name="return_date" value="{{ $borrow->return_date }}">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('borrows.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection