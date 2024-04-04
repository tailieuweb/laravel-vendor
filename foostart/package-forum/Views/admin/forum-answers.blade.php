<div class="panel panel-info">
    <!--TITLE BAR-->
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin">
            {!! !empty($item->id)
                ?
                '<i class="fa fa-comments" aria-hidden="true"></i>&nbsp'.trans($plang_admin.'.pages.title-answer')
                :
                '<i class="fa fa-comments" aria-hidden="true"></i>&nbsp'.trans($plang_admin.'.pages.title-answer')
            !!}
        </h3>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <!--left col-->
                <ul class="list-group">
                    <li class="list-group-item text-muted" contenteditable="false">Các câu hỏi liên quan</li>
                    <li class="list-group-item text-left">1. Có nên gọi điện hỏi kết quả phỏng vấn không?</li>
                    <li class="list-group-item text-left">2. Thực tập tại công ty ở quê Bình Định có được không?</li>
                    <li class="list-group-item text-left">3. Thực tập tại công ty không phải CNTT có được không?</li>
                </ul>

            </div>
            <!--/col-9-->
            <div class="col-md-9 col-sm-9" style="" contenteditable="false">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span><strong>Admin</strong> đã trả lời câu hỏi </span>
                        <span class="pull-right">
                            <i class="fa fa-pencil-square-o" aria-hidden="true" data-target="#updateAnswer" data-toggle="modal"></i> chỉnh sửa
                            <i class="fa fa-trash" aria-hidden="true"></i> xóa
                            <i class="fa fa-calendar" aria-hidden="true"></i> 04/04/2024
                        </span>
                    </div>
                    <div class="panel-body">Tìm hiểu thông tin công ty thông qua các trang tuyển dụng để hiểu rõ về môi trường
                        làm việc cũng như công việc dự kiến sẽ làm khi vào công ty. Từ đó chuẩn bị đối ứng các câu hỏi liên quan
                        đến công việc trong buổi phỏng vấn.
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span><strong>Admin</strong> đã trả lời câu hỏi </span>
                        <span class="pull-right">
                            <i class="fa fa-pencil-square-o" aria-hidden="true" data-target="#updateAnswer" data-toggle="modal"></i> chỉnh sửa
                            <i class="fa fa-trash" aria-hidden="true"></i> xóa
                            <i class="fa fa-calendar" aria-hidden="true"></i> 03/04/2024
                        </span>
                    </div>
                    <div class="panel-body">Đi đến đúng giờ vào buổi phỏng vấn, tốt nhất là tới sớm tầm 30 phút để có sự thoải mái trong buổi phỏng vấn.
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span><strong>Admin</strong> đã trả lời câu hỏi </span>
                        <span class="pull-right">
                            <i class="fa fa-pencil-square-o" aria-hidden="true" data-target="#updateAnswer" data-toggle="modal"></i> chỉnh sửa
                            <i class="fa fa-trash" aria-hidden="true"></i> xóa
                            <i class="fa fa-calendar" aria-hidden="true"></i> 02/04/2024
                        </span>
                    </div>
                    <div class="panel-body">Trả lời tự tin các câu hỏi của doanh nghiệp
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span><strong>Admin</strong> đã trả lời câu hỏi </span>
                        <span class="pull-right">
                            <i class="fa fa-pencil-square-o" aria-hidden="true" data-target="#updateAnswer" data-toggle="modal"></i> chỉnh sửa
                            <i class="fa fa-trash" aria-hidden="true"></i> xóa
                            <i class="fa fa-calendar" aria-hidden="true"></i> 02/04/2024
                        </span>
                    </div>
                    <div class="panel-body">Tham gia phỏng vấn nhiều công ty rồi rút kinh nghiệm dần dần thôi
                    </div>
                </div>

            </div>

            <div id="push"></div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="updateAnswer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cập nhật câu trả lời</h4>
            </div>
            <div class="modal-body">
                <textarea class="form-control" rows="3"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary">Cập nhật</button>
            </div>
        </div>
    </div>
</div>
