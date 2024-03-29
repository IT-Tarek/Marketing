@extends('layouts.admin')
@section('content')

<div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">التعليقات</h6>
        </div>

        @include('backend.product_comments.filter.filter')

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>الصورة</th>
                    <th>الكاتب</th>
                    <th width="40%">التعليق</th>
                    <th>الحالة</th>
                    <th> التاريخ</th>
                    <th class="text-center" style="width: 30px;">لوحة التحكم</th>
                </tr>
                </thead>
                <tbody>
                @forelse($comments as $comment)
                    <tr>
                    <td><img src="{{ get_gravatar($comment->email, 50) }}" class="img-circle"></td>
                    <td><a href="{!! $comment->url != '' ? $comment->url : 'javascript:void(0);' !!}" target="_blank">{{ $comment->name }}</a> {{ $comment->user_id != '' ? '(Member)' : '' }}</td>
                    <td>
                            {!! $comment->comment !!}
                            <div class="text-muted">
                            <a href="">{{ $comment->product->title }}</a>
                            </div>
                        </td>
                        <td>{{ $comment->status() }}</td>
                        <td>{{ $comment->created_at->format('d-m-Y h:i a') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.product_comments.edit', $comment->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" onclick="if (confirm('عل تريد حذف التعليق') ) { document.getElementById('comment-delete-{{ $comment->id }}').submit(); } else { return false; }" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <form action="{{ route('admin.product_comments.destroy', $comment->id) }}" method="post" id="comment-delete-{{ $comment->id }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">لا يوجد تعليقات  </td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="6">
                        <div class="float-right">
                            {!! $comments->appends(request()->input())->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection
