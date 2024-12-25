@extends('layout.parent')

@section('title', 'Danh sách phiếu mượn sách')

@section('content')
    <h1>Danh sách phiếu mượn sách</h1>

    @if ($borrows->isEmpty())
        <div class="alert alert-info">Không tìm thấy phiếu mượn sách nào.</div>
    @else
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Mã phiếu</th>
                    <th scope="col">Sách</th>
                    <th scope="col">Độc giả</th>
                    <th scope="col">Ngày mượn</th>
                    <th scope="col">Ngày trả</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($borrows as $borrow)
                    <tr>
                        <td>{{ $borrow->id }}</td>
                        <td>{{ $borrow->book->title }}</td>
                        <td>{{ $borrow->reader->name }}</td>
                        <td>{{ $borrow->borrow_date->format('d/m/Y') }}</td> <td>
                            @if ($borrow->return_date)
                                {{ $borrow->return_date->format('d/m/Y') }}
                            @else
                                <span class="badge bg-warning text-dark">Chưa trả</span>
                            @endif
                        </td>
                        <td>
                            @if ($borrow->return_date)
                                <span class="badge bg-success">Đã trả</span>
                            @else
                                <span class="badge bg-warning text-dark">Chưa trả</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('borrows.show', $borrow) }}" class="btn btn-sm btn-primary" title="Xem chi tiết">
                            <i class="bi bi-eye"></i> </a>
                            <a href="{{ route('borrows.edit', $borrow) }}" class="btn btn-sm btn-primary" title="Sửa">
                            <i class="bi bi-pencil"></i> </a>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $borrow->id }}">
                            <i class="bi bi-trash"></i></button>
                        </td>
                    </tr>

                    <div class="modal fade" id="confirmDeleteModal{{ $borrow->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel{{ $borrow->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel{{ $borrow->id }}">Xác nhận xóa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Bạn có chắc chắn muốn xóa phiếu mượn sách này?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                    <form action="{{ route('borrows.destroy', $borrow) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        {{ $borrows->links('pagination::bootstrap-5') }}
    @endif
@endsection