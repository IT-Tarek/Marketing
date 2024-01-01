@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <div class="ml-auto">
                <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text"> إضافة صفحة جديدة </span>
                </a>
            </div>
        </div>

        @include('backend.pages.filter.filter')

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>العنوان</th>
                    <th>الحالة</th>
                    <th>الفئة</th>
                    <th>المستخدم</th>
                    <th> التاريخ</th>
                    <th class="text-center" style="width: 30px;">لوحة التحكم</th>
                </tr>
                </thead>
                <tbody>
                @forelse($pages as $page)
                    <tr>
                        <td><a href="{{ route('admin.pages.show', $page->id) }}">{{ $page->title }}</a></td>
                        <td>{{ $page->status() }}</td>
                        <td><a href="{{ route('admin.pages.index', ['category_id' => $page->category_id]) }}">{{ $page->category->name }}</a></td>
                        <td>{{ $page->user->name }}</td>
                        <td>{{ $page->created_at->format('d-m-Y h:i a') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" onclick="if (confirm('هل تريد حذف الصفحة ؟') ) { document.getElementById('page-delete-{{ $page->id }}').submit(); } else { return false; }" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <form action="{{ route('admin.pages.destroy', $page->id) }}" method="post" id="page-delete-{{ $page->id }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">لا يوجد تعليقات   </td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="6">
                        <div class="float-right">
                            {!! $pages->appends(request()->input())->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>


@endsection
