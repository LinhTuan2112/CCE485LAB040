@extends('layout.parent')

@section('title', 'Chi tiết phiếu mượn')

@section('content')
    <h1>Chi tiết phiếu mượn</h1>

    <div class="card">
        <div class="card-header">
            Mã phiếu: {{ $borrow->id }}
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Sách:</dt>
                <dd class="col-sm-9">{{ $borrow->book->title }}</dd>

                <dt class="col-sm-3">Tác giả:</dt>
                <dd class="col-sm-9">{{ $borrow->book->author }}</dd>

                <dt class="col-sm-3">Độc giả:</dt>
                <dd class="col-sm-9">{{ $borrow->reader->name }}</dd>

                <dt class="col-sm-3">Ngày mượn:</dt>
                <dd class="col-sm-9">{{ $borrow->borrow_date }}</dd>

                <dt class="col-sm-3">Ngày trả thực tế:</dt>
                <dd class="col-sm-9">
                    @if ($borrow->return_date)
                        {{ $borrow->return_date }}
                    @else
                        Chưa trả
                    @endif
                </dd>
            </dl>

            <a href="{{ route('borrows.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
@endsection