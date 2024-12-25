<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Book;
use App\Models\Reader;

class BorrowController extends Controller
{
    public function index(Request $request)
    {
        $borrows = Borrow::paginate(10); // Phân trang với 15 bản ghi mỗi trang
    
        return view('borrows.index', compact('borrows'));
    }

    public function create()
    {
        $books = Book::all();
        $readers = Reader::all();
        return view('borrows.create', compact('books', 'readers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'book_id' => 'required|integer|exists:books,id',
            'reader_id' => 'required|integer|exists:readers,id',
            'borrowed_date' => 'required|date',
            'expected_return_date' => 'required|date|after:borrowed_date',
        ]);

        $borrow = Borrow::create($validatedData);
        return redirect()->route('borrows.index')->with('success', 'Phiếu mượn sách đã được tạo!');
    }

    public function show(Borrow $borrow)
    {
        $borrow->load('book', 'reader'); // Eager loading (if not done in index)
        return view('borrows.show', compact('borrow'));
    }

    public function edit(Borrow $borrow)
    {
        $borrow->load('book', 'reader'); // Eager loading (if needed)
        $books = Book::all();
        $readers = Reader::all();
        return view('borrows.edit', compact('borrow', 'books', 'readers'));
    }

    public function update(Request $request, Borrow $borrow)
    {
        $validatedData = $request->validate([
            'book_id' => 'required|integer|exists:books,id',
            'reader_id' => 'required|integer|exists:readers,id',
            'borrow_date' => 'required|date', 
            'return_date' => 'nullable|date|after_or_equal:borrowed_date', // Thêm validation cho return_date
        ]);

        $borrow->update($validatedData);
        return redirect()->route('borrows.index')->with('success', 'Phiếu mượn sách đã được cập nhật!');
    }

    public function destroy(Borrow $borrow)
    {
        $borrow->delete();
        return redirect()->route('borrows.index')->with('success', 'Phiếu mượn sách đã được xóa!');
    }
}