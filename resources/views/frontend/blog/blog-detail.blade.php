@extends('frontend.layouts.frontend')
@section('content')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Sportswear
										</a>
									</h4>
								</div>
								<div id="sportswear" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="">Nike </a></li>
											<li><a href="">Under Armour </a></li>
											<li><a href="">Adidas </a></li>
											<li><a href="">Puma</a></li>
											<li><a href="">ASICS </a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#mens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Mens
										</a>
									</h4>
								</div>
								<div id="mens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="">Fendi</a></li>
											<li><a href="">Guess</a></li>
											<li><a href="">Valentino</a></li>
											<li><a href="">Dior</a></li>
											<li><a href="">Versace</a></li>
											<li><a href="">Armani</a></li>
											<li><a href="">Prada</a></li>
											<li><a href="">Dolce and Gabbana</a></li>
											<li><a href="">Chanel</a></li>
											<li><a href="">Gucci</a></li>
										</ul>
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#womens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Womens
										</a>
									</h4>
								</div>
								<div id="womens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="">Fendi</a></li>
											<li><a href="">Guess</a></li>
											<li><a href="">Valentino</a></li>
											<li><a href="">Dior</a></li>
											<li><a href="">Versace</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Kids</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Fashion</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Households</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Interiors</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Clothing</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Bags</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Shoes</a></h4>
								</div>
							</div>
						</div><!--/category-products-->

						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<li><a href=""> <span class="pull-right">(50)</span>Acne</a></li>
									<li><a href=""> <span class="pull-right">(56)</span>Grüne Erde</a></li>
									<li><a href=""> <span class="pull-right">(27)</span>Albiro</a></li>
									<li><a href=""> <span class="pull-right">(32)</span>Ronhill</a></li>
									<li><a href=""> <span class="pull-right">(5)</span>Oddmolly</a></li>
									<li><a href=""> <span class="pull-right">(9)</span>Boudestijn</a></li>
									<li><a href=""> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
								</ul>
							</div>
						</div><!--/brands_products-->

						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well">
								<input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
									data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
								<b>$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->

						<div class="shipping text-center"><!--shipping-->
							<img src="{{ asset('frontend/images/home/shipping.jpg') }}" alt="" />
						</div><!--/shipping-->
					</div>
				</div>
				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						<div class="single-blog-post">
							<h3>{{ $blogs->title }}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> Mac Doe</li>
									<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
									<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
								</ul>

							</div>
							<a href="">
								<img src="{{ asset('admin/assets/images/blogs/' . $blogs->image) }}" alt="">
							</a>
							<p> {{ $blogs->description }}</p> <br>

							<p> {!! $blogs->content !!}</p>
							<div class="blog-navigation">
								@if($prevBlog)
									<a href="{{ route('member.blog.detail', $prevBlog->id) }}" class="btn btn-default">
										« {{ $prevBlog->title }}
									</a>
								@endif

								@if($nextBlog)
									<a href="{{ route('member.blog.detail', $nextBlog->id) }}"
										class="btn btn-default pull-right">
										{{ $nextBlog->title }} »
									</a>
								@endif
							</div>
						</div>
					</div><!--/blog-post-area-->

					<div class="rating-area">
						<ul class="ratings">
							<div class="rate">
								<div class="vote" data-auth="{{ auth()->check() ? "true" : "false" }}"
									data-blog="{{ $blogs->id }}">
									<div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
									<div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
									<div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
									<div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
									<div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
									{{-- Hiện điểm trung bình + tổng lượt vote --}}
									@php
										$avgRate = App\Models\BlogRate::where('id_blog', $blogs->id)->avg('rate');
										$totalVote = App\Models\BlogRate::where('id_blog', $blogs->id)->count();
									@endphp

									<span class="rate-np">
										{{ $avgRate ? number_format($avgRate, 1) : '0' }}
										<small style="color: #999; font-weight: normal;">({{ $totalVote }} lượt)</small>
									</span>
								</div>
							</div>
						</ul>

						<ul class="tag">
							<li>TAG:</li>
							<li><a class="color" href="">Pink <span>/</span></a></li>
							<li><a class="color" href="">T-Shirt <span>/</span></a></li>
							<li><a class="color" href="">Girls</a></li>
						</ul>
					</div><!--/rating-area-->

					<div class="socials-share">
						<a href=""><img src="{{ asset('frontend/images/blog/socials.png') }}" alt=""></a>
					</div><!--/socials-share-->


					<div id="comment-section" style="margin-top:30px;">
						<h4>
							<i class="fa fa-comments"></i>
							Bình luận <span id="cmt-count" style="font-size:14px;color:#999;"></span>
						</h4>
						<div id="cmt-list"></div>
						<div id="load-more" style="display:none;text-align:center;margin-top:10px;">
							<button onclick="loadMore()" class="btn btn-default">Xem thêm</button>
						</div>
					</div>
					<div class="replay-box">
						<div class="row">
							<div class="col-sm-12">

								<div class="comment-header">
									<h2><i class="ti ti-message-circle"></i> Bình luận</h2>
								</div>

								@auth
									{{-- Đã đăng nhập: hiện form --}}
									<div id="comment-form-area">
										<textarea id="cmt-input"
											style="width:100%;height:100px;padding:10px;border:1px solid #ddd;border-radius:4px;"
											placeholder="Viết bình luận của bạn..."></textarea>
										<input type="hidden" id="parent-id" value="">
										<div id="reply-notice" style="display:none;font-size:13px;color:#888;margin:5px 0;">
											Đang reply: <span id="reply-to-name" style="font-weight:bold;"></span>
											<a href="#" onclick="cancelReply()" style="margin-left:8px;color:red;">Huỷ</a>
										</div>
										<div style="margin-top:8px;">
											<button onclick="submitComment()" class="btn btn-primary">
												<i class="fa fa-send"></i> Gửi bình luận
											</button>
										</div>
									</div>
								@else
									{{-- Chưa đăng nhập: hiện thông báo --}}
									<div class="login-gate">
										<i class="ti ti-lock"></i>
										<p>Bạn cần đăng nhập để để lại bình luận.</p>
										<a href="{{ route('login') }}" class="btn-login">
											<i class="ti ti-login"></i> Đăng nhập
										</a>
									</div>
								@endauth

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        // ── RATING ──────────────────────────────────────────
        var isAuth = '{{ auth()->check() ? "true" : "false" }}';
        var idBlog = $('.vote').data('blog');
        var voted = {{ auth()->check() ? (App\Models\BlogRate::where('id_blog', $blogs->id)->where('id_user', auth()->id())->value('rate') ?? 'null') : 'null' }};

        if (voted) {
            $('.ratings_stars').each(function () {
                var val = parseInt($(this).find('input').val());
                if (val <= voted) $(this).addClass('ratings_over');
            });
        }

        $('.ratings_stars').hover(
            function () {
                if (isAuth !== 'true' || voted) return;
                var index = $('.ratings_stars').index(this);
                $('.ratings_stars').each(function (i) {
                    if (i <= index) $(this).addClass('ratings_hover');
                    else $(this).removeClass('ratings_hover');
                });
            },
            function () {
                if (isAuth !== 'true' || voted) return;
                $('.ratings_stars').removeClass('ratings_hover');
            }
        );

        $('.ratings_stars').click(function () {
            if (isAuth !== 'true') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Bạn chưa đăng nhập',
                    text: 'Vui lòng đăng nhập để đánh giá bài viết này.',
                    confirmButtonText: 'Đăng nhập',
                    confirmButtonColor: '#f59e0b',
                    showCancelButton: true,
                    cancelButtonText: 'Để sau',
                }).then((result) => {
                    if (result.isConfirmed) window.location.href = '{{ route("login") }}';
                });
                return;
            }

            if (voted) {
                Swal.fire({
                    icon: 'info',
                    title: 'Bạn đã đánh giá rồi!',
                    text: 'Mỗi người chỉ được đánh giá một lần.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#f59e0b',
                });
                return;
            }

            var rate = $(this).find('input').val();
            var index = $('.ratings_stars').index(this);

            $('.ratings_stars').removeClass('ratings_over');
            $('.ratings_stars').each(function (i) {
                if (i <= index) $(this).addClass('ratings_over');
            });

            $.ajax({
                url: '{{ route("blog.rate") }}',
                method: 'POST',
                data: { rate: rate, id_blog: idBlog, _token: '{{ csrf_token() }}' },
                success: function (res) {
                    voted = rate;
                    $('.rate-np').html(res.avg_rate + ' <small style="color:#999;font-weight:normal;">(' + res.total_vote + ' lượt)</small>');
                    Swal.fire({
                        icon: 'success',
                        title: 'Cảm ơn bạn!',
                        text: 'Đánh giá của bạn đã được ghi nhận.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#f59e0b',
                        timer: 2000,
                        timerProgressBar: true,
                    });
                },
                error: function () {
                    Swal.fire({ icon: 'error', title: 'Có lỗi xảy ra!', confirmButtonText: 'OK' });
                }
            });
        });
    });

    // ── COMMENT ────────────────────────
    const blogId = {{ $blogs->id }};
    const baseUrl = "{{ url('/') }}";
    const isAuthComment = {{ auth()->check() ? 'true' : 'false' }}; // đổi tên tránh xung đột
    const csrfToken = "{{ csrf_token() }}";
    let page = 1;

    function renderComment(c, isReply = false) {
        const initials = c.name_user ? c.name_user.substring(0, 2).toUpperCase() : 'NA';
        const avatarHtml = c.avatar
            ? `<img src="${c.avatar}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">`
            : `<div style="width:36px;height:36px;border-radius:50%;background:#E6F1FB;color:#185FA5;
                display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:500;">
                ${initials}</div>`;

        const repliesHtml = (!isReply && c.replies && c.replies.length > 0)
            ? c.replies.map(r => renderComment(r, true)).join('') : '';

        return `<div id="cmt-${c.id}" style="display:flex;gap:10px;margin-bottom:14px;
            ${isReply ? 'margin-left:46px;padding-left:12px;border-left:2px solid #eee;' : ''}">
            ${avatarHtml}
            <div style="flex:1;">
                <div style="background:#f7f7f7;border-radius:8px;padding:10px 14px;">
                    <div style="font-size:14px;font-weight:600;margin-bottom:2px;">${c.name_user ?? 'Ẩn danh'}</div>
                    <div style="font-size:14px;">${c.cmt}</div>
                </div>
                <div style="font-size:12px;color:#aaa;margin-top:4px;display:flex;gap:12px;align-items:center;">
                    <span>${c.created_at}</span>
                    ${!isReply ? `<a href="#" style="color:#888;" onclick="startReply(${c.id}, '${c.name_user}'); return false;">
                        <i class="fa fa-reply"></i> Reply
                    </a>` : ''}
                </div>
                <div id="replies-${c.id}">${repliesHtml}</div>
            </div>
        </div>`;
    }

    function loadComments(reset = true) {
        fetch(`${baseUrl}/comment?id_blog=${blogId}&page=${page}`)
            .then(res => { if (!res.ok) throw new Error('HTTP ' + res.status); return res.json(); })
            .then(data => {
                if (reset) document.getElementById('cmt-list').innerHTML = '';
                if (!data.data || data.data.length === 0) {
                    document.getElementById('cmt-list').innerHTML = '<p>Chưa có bình luận nào.</p>';
                    return;
                }
                data.data.forEach(c => {
                    document.getElementById('cmt-list').innerHTML += renderComment(c);
                });
                document.getElementById('cmt-count').textContent = `(${data.total})`;
            })
            .catch(err => console.error(err));
    }

    function loadMore() { page++; loadComments(false); }

    function startReply(parentId, parentName) {
        document.getElementById('parent-id').value = parentId;
        document.getElementById('reply-to-name').textContent = parentName;
        document.getElementById('reply-notice').style.display = 'block';
        document.getElementById('cmt-input').focus();
        document.getElementById('cmt-input').placeholder = `Reply ${parentName}...`;
    }

    function cancelReply() {
        document.getElementById('parent-id').value = '';
        document.getElementById('reply-notice').style.display = 'none';
        document.getElementById('cmt-input').placeholder = 'Viết bình luận của bạn...';
    }

    function submitComment() {
        if (!isAuthComment) { //  dùng tên mới
            if (confirm('Bạn chưa đăng nhập. Đến trang đăng nhập?')) {
                window.location.href = "{{ route('login') }}";
            }
            return;
        }

        const cmt = document.getElementById('cmt-input').value.trim();
        const parentId = document.getElementById('parent-id').value;

        if (!cmt) {
            Swal.fire({
                icon: 'warning', title: 'Chưa nhập nội dung',
                text: 'Vui lòng nhập nội dung bình luận.',
                confirmButtonText: 'Đã hiểu', confirmButtonColor: '#3085d6'
            });
            return;
        }

        const btn = document.querySelector('#comment-form-area .btn-primary');
        btn.disabled = true;
        btn.textContent = 'Đang gửi...';

        fetch(`{{ route('comment.store') }}`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
            body: JSON.stringify({ cmt: cmt, id_blog: blogId, parent_id: parentId || null })
        })
            .then(res => { if (!res.ok) throw new Error('HTTP ' + res.status); return res.json(); })
            .then(data => {
                if (data.success) {
                    const c = data.comment;
                    if (c.parent_id) {
                        const replyBox = document.getElementById(`replies-${c.parent_id}`);
                        if (replyBox) replyBox.innerHTML += renderComment(c, true);
                        cancelReply();
                    } else {
                        document.getElementById('cmt-list').insertAdjacentHTML('afterbegin', renderComment(c));
                        const countEl = document.getElementById('cmt-count');
                        const current = parseInt(countEl.textContent.replace(/\D/g, '')) || 0;
                        countEl.textContent = `(${current + 1})`;
                    }
                    document.getElementById('cmt-input').value = '';
                }
            })
            .catch(err => alert('Gửi thất bại: ' + err.message))
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fa fa-send"></i> Gửi bình luận';
            });
    }

    loadComments();
</script>
@endpush