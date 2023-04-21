/* AJAX获取第二页内容 */
$(document).on('click', '#loadmore a:not(.noajx)',
function (){
    var _this = $(this);
    var next = _this.attr("href").replace('?ajx=wrap', '');
		$(this).addClass("#loadmore").text("加载中...");
    $.ajax({
        url: next,
        beforeSend: function() {},
        success: function(data) {
            $('.auto-loadmore .auto-loading .auto-main').append($(data).find('.auto-list'));
            nextHref = $(data).find(".auto-loading .loadmore a").attr("href");
						$("#loadmore a").removeClass("loading").text("点击加载更多");
            if (nextHref != undefined) {
				$("#loadmore").removeClass("loading");
                $(".auto-loading .loadmore a").attr("href", nextHref);
            } else {
				$("#loadmore").removeClass("loading");
                $('#post_over').attr('href', 'javascript:;').text('我是有底线的!').attr('class', 'noajx load-more disabled');
            };
        },
        complete: function() {
			$(".auto-list img").lazyload({
				placeholder:bloghost+"zb_users/theme/infolee/style/nodel/images/grey.gif",
				failurelimit : 30
			});
		},
        error: function() {
            location.href = next;
        }
    });
    return false;
});