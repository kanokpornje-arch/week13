@extends('layouts.app')

@section('title', 'บทความ')

@section('content')

    @if (count($blog2) > 0)

        <div class="d-flex justify-content-between align-items-center my-3">
            <h2 class="text-center">บทความทั้งหมด</h2>

            <a href="{{ route('form') }}" class="btn btn-success">
                + เขียนบทความใหม่
            </a>
        </div>

        <hr>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Control</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($blog2 as $item)
                    <tr>
                        <td>{{ $item->title }}</td>

                        <td>
                            @if ($item->status)
                                <a href="/change/{{ $item->id }}" class="btn btn-success">
                                    เผยแพร่
                                </a>
                            @else
                                <a href="/change/{{ $item->id }}" class="btn btn-danger">
                                    ไม่เผยแพร่
                                </a>
                            @endif
                        </td>

                        <td>
                            <a href="/edit/{{ $item->id }}" class="btn btn-warning">
                                แก้ไข
                            </a>

                            <a href="/delete/{{ $item->id }}" class="btn btn-danger"
                                onclick="return confirm('คุณต้องการลบบทความนี้ {{ $item->title }} จริงหรือไม่?')">
                                ลบ
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $blog2->links() }}
    @else
        <div class="text-center my-5">
            <h2>ไม่มีบทความ</h2>

            <a href="{{ route('form') }}" class="btn btn-success mt-3">
                + เขียนบทความใหม่
            </a>
        </div>

    @endif

@endsection
