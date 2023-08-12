$(document).ready(function() {
    $('.like-btn').click(function() {
        var item_id = $(this).data('item');

        $.ajax({
            url: '/like', // ルートを適切なものに変更
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                item_id: item_id
            },
            success: function(response) {
                if (response.liked) {
                    $('.like-btn[data-item="' + item_id + '"]').text('いいね解除');
                } else {
                    $('.like-btn[data-item="' + item_id + '"]').text('いいね');
                }
            }
        });
    });
});
