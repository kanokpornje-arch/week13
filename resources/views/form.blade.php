@extends('layouts.app')

@section('title', 'เขียนบทความใหม่')

@section('content')
    <h2 class="text text-center by-2">เขียนบทความใหม่</h2>
    <form method="POST" action="{{ route('blog.store') }}">
        @csrf
        <div class="form-group">
            <label for="title" class="form-label">หัวข้อบทความ</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        @error('title')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="form-group">
            <label for="content" class="form-label">เนื้อหาบทความ</label>
            <textarea class="form-control" id="content" name="content" cols="30" rows="10"></textarea>
        </div>
        @error('content')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="form-group">
            <label for="status" class="form-label">สถานะ</label>
            <select class="form-control" id="status" name="status">
                <option value="1">เผยแพร่</option>
                <option value="0">ไม่เผยแพร่</option>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-success">บันทึก</button>
    </form>
@endsection
