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
        <h1 class="mb-4">Chỉnh sửa vấn đề</h1>
        <form action="{{ route('issues.update', $issue->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="computer_id" class="form-label">Chọn máy tính</label>
                <select name="computer_id" id="computer_id" class="form-select">
                    @foreach($computers as $computer)
                        <option value="{{ $computer->id }}" {{ $computer->id == $issue->computer_id ? 'selected' : '' }}>{{ $computer->computer_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="reported_by" class="form-label">Người báo cáo</label>
                <input type="text" name="reported_by" id="reported_by" class="form-control" value="{{ $issue->reported_by }}" required>
            </div>
            <div class="mb-3">
                <label for="reported_date" class="form-label">Thời gian báo cáo</label>
                <input type="datetime-local" name="reported_date" id="reported_date" class="form-control" value="{{ $issue->reported_date }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea name="description" id="description" class="form-control" rows="3" required>{{ $issue->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="urgency" class="form-label">Mức độ</label>
                <select name="urgency" id="urgency" class="form-select">
                    <option value="Low" {{ $issue->urgency == 'Low' ? 'selected' : '' }}>Thấp</option>
                    <option value="Medium" {{ $issue->urgency == 'Medium' ? 'selected' : '' }}>Trung bình</option>
                    <option value="High" {{ $issue->urgency == 'High' ? 'selected' : '' }}>Cao</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select name="status" id="status" class="form-select">
                    <option value="Open" {{ $issue->status == 'Open' ? 'selected' : '' }}>Mở</option>
                    <option value="In Progress" {{ $issue->status == 'In Progress' ? 'selected' : '' }}>Đang xử lý</option>
                    <option value="Closed" {{ $issue->status == 'Closed' ? 'selected' : '' }}>Đã đóng</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>