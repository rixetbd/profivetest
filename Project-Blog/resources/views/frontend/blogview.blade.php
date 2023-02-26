@extends('frontend.master')

@section('page_title', $blog->name)

@section('custom_css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<style>
    .card {
        border: none;
        background-color: #e6e7ee !important;
    }

    .comment_single p {
        margin-bottom: 0;
        font-size: 13px;
        font-weight: 400;
        color: #000000;
    }

    .comment_single h4 {
        font-size: 15px;
    }

    .action_link {
        font-size: 12px;
        margin-top: 15px;
        cursor: pointer;
        margin-right: 15px;
    }

    .action_link.reply:hover {
        color: #ffa500;
    }

    .action_link.trash:hover {
        color: #ff0000;
    }

    .light_text {
        font-size: 11px;
    }

    .reply_field {
        font-size: 14px;
    }

</style>
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mt-5">
        <div>
            <h4 class="font_style_one font_30">{{$blog->name}}</h4>
        </div>
    </div>

    <div class="row my-3">
        <div class="col-sm-12 col-md-12 my-3">
            <div class="card shadow-soft px-4 py-2 my-3 border_radius_10">
                {{-- <img src="https://images.unsplash.com/photo-1561154464-82e9adf32764?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60" class="card-img-top" alt="..."> --}}
                <div class="card-body">
                    <h5 class="card-title">{{$blog->name}}</h5>
                    <h6 class="card-subtitle my-3 text-muted ">- {{$blog->category}}</h6>
                </div>
            </div>
            <div class="card shadow-soft p-4 my-3 border_radius_10">
                <div class="card-body">
                    {!! $blog['description'] !!}
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 my-3">
            <div class="card">
                {{-- <img src="https://images.unsplash.com/photo-1561154464-82e9adf32764?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60" class="card-img-top" alt="..."> --}}
                <div class="card-body shadow-soft px-4 py-4 my-3 border_radius_10">
                    <h2 class="card-title">Comments</h2>

                    <div class="my-4">
                        <form action="{{route('comment.store')}}" method="post" class="commentformSubmit custom-form">
                            @csrf
                            <input type="hidden" name="blog_id" value="{{$blog->id}}" required>
                            <input type="hidden" name="parent_comment">

                            <div class="col-sm-12 col-md-12 my-2">
                                <label class="mb-1" for="name">Name</label>
                                <input class="form-control empty_value" type="text" name="name"
                                    placeholder="Enter Your Name" required>
                            </div>
                            <div class="col-sm-12 col-md-12 my-2">
                                <label class="mb-1" for="comments">Comment</label>
                                <textarea class="form-control empty_value" name="comments" rows="3"
                                    placeholder="Type Comment..." required></textarea>
                            </div>
                            <button class="btn btn-sm btn-success my-2" type="submit"><i
                                    class="fas fa-comment-dots"></i>
                                Add
                                Cooment</button>
                        </form>
                    </div>
                </div>

                <div id="commentData"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script>
    function autoCommentData() {
        $.ajax({
            url: `{{route('comment.autoData')}}`,
            method: 'POST',
            data: {
                blog: `{{$blog->id}}`,
            },
            success: function (data) {
                let result = data.result;
                let commenthtml = '';
                $.each(result, function (i, value) {

                    let sub_commenthtml = '';

                    $.each(value['sub_comment'], function (i, sub_commentvalue) {
                        sub_commenthtml +=
                            `<div class="d-flex shadow-inset px-4 py-3 my-3 border_radius_10 comment_single animate__animated caommentid${sub_commentvalue.id}">` +
                            `<div><img src="{{asset('assets/img/male.png')}}" alt="" width="40" style="margin-right:20px;"></div>` +
                            `<div class="col-11"><h4>` + sub_commentvalue.name +
                            `<span class="light_text"> - ${sub_commentvalue.created_at}</span>` +
                            `</h4>` +
                            `<p>` + sub_commentvalue.comments + `</p>` +
                            `<div class="mt-2">` +
                            `<span class="action_link trash" onclick="comment_delete('${sub_commentvalue.id}', 'caommentid${sub_commentvalue.id}')"><i class="fas fa-trash"></i> Delete</span></div>` +
                            `</div></div>`;
                    });

                    commenthtml +=
                        `<div class="d-flex shadow-soft px-4 py-3 my-3 border_radius_10 comment_single animate__animated caommentid${value.id}">` +
                        `<div><img src="{{asset('assets/img/avatar.png')}}" alt="" width="40" style="margin-right:20px;"></div>` +
                        `<div class="col-11"><h4>` + value.name +
                        `<span class="light_text"> - ${value.created_at}</span>` + `</h4>` +
                        `<p>` + value.comments + `</p>` +
                        `<div class="my-3"><span class="action_link reply" onclick="comment_reply('replyfield${value.id}')"><i class="fas fa-reply"></i> Reply</span>` +
                        `<span class="action_link trash" onclick="comment_delete('${value.id}', 'caommentid${value.id}')"><i class="fas fa-trash"></i> Delete</span></div>` +
                        `<div class="col-12 d-none replyfield replyfield${value.id}">` +
                        `<form action="{{route('comment.store')}}" method="post" class="commentformSubmit custom-form">` +
                        `<input type="hidden" name="_token" value="{{ csrf_token() }}">` +
                        `<input type="hidden" name="blog_id" value="{{$blog->id}}">` +
                        `<input type="hidden" name="parent_comment" value="${value.id}">` +
                        `<input class="form-control reply_field" type="text" name="name" placeholder="Enter Your Name" required>` +
                        `<textarea class="form-control my-2 reply_field empty_value" name="comments" rows="2"
                        placeholder="Reply to ${value.name}..." required></textarea>` +
                        `<button type="submit" class="btn btn-sm btn-success">Reply</button>` +
                        `</form></div>` +
                        sub_commenthtml +
                        `</div></div>`;
                });

                $('#commentData').html(commenthtml);

            },
        });
    }

    autoCommentData();

</script>

<script>
    function comment_delete(id, caommentid) {
        $.ajax({
            url: `{{route('comment.destroy')}}`,
            method: 'POST',
            data: {
                comment_id: id,
            },
            success: function (data) {
                $(`.${caommentid}`).addClass('animate__fadeOut');

                $(`.${caommentid}`).remove();
            },
        });
    }

</script>

<script>
    function comment_reply(caommentid) {
        $(`.replyfield`).addClass('d-none');
        $(`.${caommentid}`).removeClass('d-none');
    }

</script>
@endsection
