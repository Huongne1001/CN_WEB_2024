<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách vấn đề</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Danh sách vấn đề</h1>
        <a href="{{ route('issues.create') }}" class="btn btn-primary mb-3">Thêm vấn đề mới</a>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Mã vấn đề</th>
                    <th>Tên máy tính</th>
                    <th>Phiên bản</th>
                    <th>Người báo cáo</th>
                    <th>Thời gian báo cáo</th>
                    <th>Mức độ</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($issues as $issue)
                <tr>
                    <td>{{ $issue->id }}</td>
                    <td>{{ $issue->computer->computer_name ?? 'Không có dữ liệu' }}</td>
                    <td>{{ $issue->computer->model ?? 'Không có dữ liệu' }}</td>
                    <td>{{ $issue->reported_by }}</td>
                    <td>{{ $issue->reported_date }}</td>
                    <td>{{ $issue->urgency }}</td>
                    <td>{{ $issue->status }}</td>
                    <td>
                        <a href="{{ route('issues.edit', $issue->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('issues.destroy', $issue->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vấn đề này không?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Không có dữ liệu</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $issues->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>