$(document).ready(function () {
    $(".postConfirm").hide();
});

$(document).on('click', '#addPost', function () {
    var posts = $('#posts').val();
    var user_id = $('#user_id').val();
    var cat_id = $('#category').val();
    var _token = $('input[name=_token]').val();

    if (posts == '' || user_id == '') {
        $(".validation").show().delay(5000).fadeOut();
        $('.validation').text("Write something !!");
    } else {
        $.ajax({
            type: 'post',
            url: 'storePosts',
            data: {
                _token: _token,
                posts: posts,
                user_id: user_id,
                cat_id: cat_id
            },
            success: function (response) {
                $(".validation").hide();
                $(".postConfirm").show().delay(2000).fadeOut();
                $('.postConfirm').text(response['message']);
                document.getElementById("cform").reset();
                $('#postsTable').load(location.href + " #postsTable");
            },
        })
    }
});


$(document).ready(function () {
    $('.lik').click(function (event) {
        event.preventDefault();
        var postid = $(this).data('id');
        var is_lik = event.currentTarget.previousElementSibling == null;
        $.ajax({
            method: 'post',
            url: '/lik',
            data: {
                _token: token,
                post_id: postid,
                is_lik: is_lik
            },
        })
    });
});

$(document).ready(function () {
    $('#rept').click(function () {
        var rep_inu = $('#rep_inu').val();
        var poid = $('#poid').val();
        var coid = $('#coid').val();
        $.ajax({
            method: 'post',
            url: '/reply/store',
            data: {
                _token: token,
                re_inu: rep_inu,
                poid: poid,
                coid: coid,
            },
            success: function (response) {
                $("#rep-re").load(window.location.href + " #rep-re");
            }
        })
    });
});


$(document).ready(function () {
    $('#comm').click(function () {
        var com_inu = $('#cominu').val();
        var posts_id = $('#inu').val();
        $.ajax({
            method: 'post',
            url: '/comment/store',
            data: {
                _token: token,
                posts_id: posts_id,
                com_inu: com_inu,
            },
            success: function (response) {
                $("#inpu-re").load(window.location.href + " #inpu-re");
            }
        })
    });
});

$(document).ready(function () {
    $('.delete').click(function () {
        var id = $(this).data('id');
        $('#delepostInputField').val(id);
    });
});

$(document).ready(function () {
    $('.deletePost').click(function () {
        if ($('#delepostInputField').val() != '') {
            $.ajax({
                type: 'post',
                url: 'deletePost',
                data: {
                    _token: token,
                    id: $('#delepostInputField').val()
                },
                success: function (response) {
                    $('#myModal').modal('hide');
                    $('#delConfirm').text("Your post has been removed !!");
                    $('#delConfirm').css('margin-bottom', '10px');
                    $('#myConfessTable').load(location.href + ' #myConfessTable');
                }

            });
        }

    });
});



