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
                    @if (!empty($relatedQuestions))
                        @foreach($relatedQuestions as $key => $question)
                            <?php $in = $key + 1; ?>
                            <a href="{!! URL::route('forums.view', [   'id' => $question->forum_questions_id,
                                                            '_token' => csrf_token()
                                                        ])
                                    !!}">
                                <li class="list-group-item text-left">{!! "<b>".$in.'</b> '.$question->forum_questions_title !!}</li>
                            </a>
                        @endforeach

                    @endif
                </ul>

            </div>
            <!--/col-9-->
            <div class="col-md-9 col-sm-9" style="" contenteditable="false">
                @if (!empty($userAnswers))
                    @foreach($userAnswers as $userAnswer)
                        <?php $cl = 'style="background-color: antiquewhite;"' ?>
                        <div class="panel panel-default">
                            <div class="panel-heading" @if($userAnswer['is_best_answer'] == 1) {!! $cl !!} @endif>
                                <span><strong>{{$userAnswer['userinfo_fullname']}}</strong> đã trả lời câu hỏi </span>
                                <span class="pull-right">
                                    @if($item->status != 88)

                                        <a href="{!! URL::route('forums.like_answer',['qid' => $item->id,
                                                                                    '_token' => csrf_token(),
                                                                                    'aid' => $userAnswer['forum_discussions_id']]) !!}"><i class="fa fa-magic" aria-hidden="true"></i>Like
                                        </a>xóa

                                    <i class="fa fa-pencil-square-o" aria-hidden="true" data-target="#updateAnswer{!! $userAnswer['forum_discussions_id'] !!}" data-toggle="modal"></i> chỉnh sửa
                                    <a href="{!! URL::route('forums.delete_answer',['qid' => $item->id,
                                                                                    '_token' => csrf_token(),
                                                                                    'aid' => $userAnswer['forum_discussions_id']]) !!}"><i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>xóa
                                    @endif
                                    <i class="fa fa-calendar" aria-hidden="true"></i> {!! date('d-m-Y H:i',strtotime($userAnswer['updated_at'])) !!}
                                </span>
                            </div>
                            <div class="panel-body">
                                {!! $userAnswer['forum_discussions_description'] !!}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div id="push"></div>
        </div>

    </div>
</div>

<!-- Modal -->
@if (!empty($userAnswers))
    @foreach($userAnswers as $userAnswer)
        <div class="modal fade" id="updateAnswer{!! $userAnswer['forum_discussions_id'] !!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{!! URL::route('forums.update_answer',['qid' => $item->id,
                                                                                    'aid' => $userAnswer['forum_discussions_id']]) !!}">
                        {!! csrf_field(); !!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Cập nhật câu trả lời</h4>
                        </div>
                        <div class="modal-body">
                            <textarea class="form-control" rows="3" name="answer">{!! $userAnswer['forum_discussions_description'] !!}</textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif
