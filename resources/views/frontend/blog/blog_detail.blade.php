@extends('frontend/layout.layout')

@section('left')
@endsection

@section('content')
                @if(Auth::check())
                    <input type="hidden" id="id_user" value="<?php echo Auth::id(); ?>">
                    <input type="hidden" id="avatar" value="<?php echo Auth::user()->avatar; ?>">
                    <input type="hidden" id="name" value="<?php echo Auth::user()->name; ?>">
                @endif
                <div class="col-sm-9">
					<div class="blog-post-area">
						<div class="single-blog-post">
                            <input type="hidden" id="id_blog" value="<?php echo $blog->id; ?>">
							<h3><?php echo $blog->title; ?></h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i><?php echo $blog->title; ?></li>
									<li><i class="fa fa-clock-o"></i><?php echo $blog->updated_at->format('H:i'); ?></li>
									<li><i class="fa fa-calendar"></i><?php echo $blog->updated_at->format('M d, y'); ?></li>
								</ul>
								<!-- <span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</span> -->
							</div>
							<a href="">
								<img src="{{ asset('/admin/blog/'.$blog->id.'/'.$blog->image) }}" alt="">
							</a>
							<p>{!! $blog->content !!}</p>
							<div class="pager-area">
								<ul class="pager pull-right">
                                    @if($blog->id == $id_max_updated_at)
                                        <li><a href="{{ url('/frontend/blog_detail', ['id_blog' => $id_next]) }}">Next</a></li>
                                    @elseif($blog->id == $id_min_updated_at)
                                        <li><a href="{{ url('/frontend/blog_detail', ['id_blog' => $id_previous]) }}">Pre</a></li>
                                    @else
									    <li><a href="{{ url('/frontend/blog_detail', ['id_blog' => $id_previous]) }}">Pre</a></li>
									    <li><a href="{{ url('/frontend/blog_detail', ['id_blog' => $id_next]) }}">Next</a></li>
                                    @endif
								</ul>
							</div>
						</div>
					</div><!--/blog-post-area-->

					<div class="rate">
                        <div class="vote">
                            @if($count_rate == 0)
                                <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                                <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                                <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                                <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                                <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                            @else 
                                @for($i = 1; $i <= 5; ++$i)
                                    @if($i <= $avg)
                                        <div class="star_1 ratings_stars ratings_over"><input value="<?php echo $i; ?>" type="hidden"></div>
                                    @else
                                        <div class="star_1 ratings_stars"><input value="<?php echo $i; ?>" type="hidden"></div>
                                    @endif 
                                @endfor
                            @endif
                            <!-- <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                            <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                            <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                            <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                            <div class="star_5 ratings_stars"><input value="5" type="hidden"></div> -->
                            <span class="rate-np" id="rate">Điểm trung bình: {!! $avg !!}</span>
                            <br></br>
                            <span class="rate-np" id="count_rate">{!! $count_rate !!} lượt đánh giá </span>
                        </div> 
                    </div><!--/rating-area-->

					<div class="socials-share">
						<a href=""><img src="images/blog/socials.png" alt=""></a>
					</div><!--/socials-share-->

					<!-- <div class="media commnets">
						<a class="pull-left" href="#">
							<img class="media-object" src="images/blog/man-one.jpg" alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading">Annie Davis</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							<div class="blog-socials">
								<ul>
									<li><a href=""><i class="fa fa-facebook"></i></a></li>
									<li><a href=""><i class="fa fa-twitter"></i></a></li>
									<li><a href=""><i class="fa fa-dribbble"></i></a></li>
									<li><a href=""><i class="fa fa-google-plus"></i></a></li>
								</ul>
								<a class="btn btn-primary" href="">Other Posts</a>
							</div>
						</div>
					</div> --><!--Comments-->
					<div class="response-area">
                        @if($count_cmt <= 1)
                            <h2>{!! $count_cmt !!} bình luận</h2>
                        @else
                            <h2>{!! $count_cmt !!} bình luận</h2>
                        @endif 
						<ul class="media-list">
							<!-- <li class="media">
								
								<a class="pull-left" href="#">
									<img class="media-object" src="images/blog/man-two.jpg" alt="">
								</a>
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>Janis Gallagher</li>
										<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
										<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
									<a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
								</div>
							</li> -->
							<!-- <li class="media second-media">
								<a class="pull-left" href="#">
									<img class="media-object" src="images/blog/man-three.jpg" alt="">
								</a>
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>Janis Gallagher</li>
										<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
										<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
									<a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
								</div>
							</li> -->
                            <?php
                                use App\Models\admin\Blog;
                                use App\Models\frontend\Blog_comment;
                                foreach($cmtCha as $key => $value)
                                {
                            ?>
                                    <li class="media" id="<?php echo $value->id; ?>">
                                        <a class="pull-left" href="#">
                                            <input type="hidden" id="id_user_cmtCha" value="<?php echo $value->id_user; ?>">
                                            <input type="hidden" id="id_cmtCha" value="<?php echo $value->id; ?>">
									        <img style="width:121px; height:86px" class="media-object" src="{{ asset('/frontend/avatar/'.$value->id_user.'/'.$value->avatar) }}" alt="">
								        </a>
								        <div class="media-body">
									        <ul class="sinlge-post-meta">
										        <li><i class="fa fa-user"></i><?php echo $value->name; ?></li>
										        <li><i class="fa fa-clock-o"></i><?php echo $value->updated_at->format('H:i'); ?></li>
										        <li><i class="fa fa-calendar"></i><?php echo $value->updated_at->format('M d,y'); ?></li>
									        </ul>
									        <p><?php echo $value->cmt; ?></p>
									        <a class="btn btn-primary" id="show_form_replay"><i class="fa fa-reply"></i>Replay</a>
                                            <div class="text-area" id="form_replay">
									            <textarea name="message" rows="5" id="replay"></textarea>
									            <a class="btn btn-primary" id="post_replay">Xác nhận</a>
								            </div>
								        </div>
                                    </li>
                            <?php
                                    foreach(Blog::findOrFail($value->id_blog)->comments_asc as $key1 => $value1)
                                    {
                                        if($value1->level == $value->id)
                                        {
                            ?>
                                            <li class="media second-media">
								                <a class="pull-left" href="#">
									                <img style="width:121px; 86px" class="media-object" src="{{ asset('/frontend/avatar/'.$value1->id_user.'/'.$value1->avatar) }}" alt="">
								                </a>
								                <div class="media-body">
									                <ul class="sinlge-post-meta">
										                <li><i class="fa fa-user"></i><?php echo $value1->name; ?></li>
										                <li><i class="fa fa-clock-o"></i><?php echo $value1->updated_at->format('H:i'); ?></li>
										                <li><i class="fa fa-calendar"></i><?php echo $value1->updated_at->format('M d, y'); ?></li>
									                </ul>
									                <p><?php echo $value1->cmt; ?></p>
									                <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
								                </div>
							                </li>
                            <?php
                                        }
                                    }
                                }
                            ?>
						</ul>					
					</div><!--/Response-area-->
					<div class="replay-box">
						<div class="row">
							<div class="col-sm-12">
								<h2>Bình luận của bạn</h2>
								
								<div class="text-area">
									<span>*</span>
									<textarea name="message" rows="11" id="cmtCha"></textarea>
									<a class="btn btn-primary" id="post_cmtCha">Xác nhận</a>
								</div>
							</div>
						</div>
					</div><!--/Repaly Box-->
				</div>	
@endsection

@section('js')
    <script>
    	
    	$(document).ready(function(){
            $.ajaxSetup({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
			//vote
			$('.ratings_stars').hover(
	            // Handles the mouseover
	            function() {
	                $(this).prevAll().andSelf().addClass('ratings_hover');
	                // $(this).nextAll().removeClass('ratings_vote'); 
	            },
	            function() {
	                $(this).prevAll().andSelf().removeClass('ratings_hover');
	                // set_votes($(this).parent());
	            }
	        );

			$('.ratings_stars').click(function(){
                var check_login = @json(Auth::check());
                if(check_login == false)
                {
                    alert("Vui lòng đăng nhập để tiếp tục");
                }
                else
                {
                    var id_blog = $("input#id_blog").val();
                    var id_user = $("input#id_user").val();
                    var Values =  $(this).find("input").val();
                    var count_rate = parseInt($("span#count_rate").text());
                    $.ajax({
                        method:"POST",
                        url:"{{ url('/frontend/blog_detail_rate') }}",
                        data:{
                            id_blog: id_blog,
                            id_user: id_user,
                            rate: Values,
                            count_rate: count_rate
                        },
                        success:function(response){
                            console.log(response);
                            $("span#rate").text("Điểm đánh giá: "+response.rate);
                            $("span#count_rate").text(response.count_rate+ " lượt đánh giá");
                        }
                    })
		    	    if ($(this).hasClass('ratings_over')) {
		                $('.ratings_stars').removeClass('ratings_over');
		                $(this).prevAll().andSelf().addClass('ratings_over');
		            } else {
		        	    $(this).prevAll().andSelf().addClass('ratings_over');
		            }
                }
				
		    });

            $("a#post_cmtCha").click(function(){
                var check_login = @json(Auth::check());
                if(check_login == false)
                {
                    alert("Vui lòng đăng nhập để tiếp tục");
                }
                else
                {
                    var id_blog = $("input#id_blog").val();
                    var id_user = $("input#id_user").val();
                    var avatar = $("input#avatar").val();
                    var name = $("input#name").val();
                    var cmt = $("textarea#cmtCha").val();
                    var count_cmt = parseInt($("div.response-area").find("h2").text());
                    if(cmt != "")
                    {
                        $.ajax({
                            method:"POST",
                            url:"{{ url('/frontend/blog_detail_cmt') }}",
                            data:{
                                id_blog: id_blog,
                                id_user: id_user,
                                avatar: avatar,
                                name: name,
                                cmt: cmt,
                                count_cmt: count_cmt
                            },
                            success:function(response){
                                console.log(response);
                                var img = "{{ asset('/frontend/avatar') }}" + "/" + response.id_user + "/" + response.avatar;
                                var cmt = '<li class="media" id="' + response.id_cmtCha + '">' + 
								            '<a class="pull-left" href="#">' + 
									            '<img style="width:121px; height:86px" class="media-object" src="' + img + '" alt="">' + 
								            '</a>' + 
								            '<div class="media-body">' + 
									            '<ul class="sinlge-post-meta">' + 
										            '<li><i class="fa fa-user"></i>' + response.name + '</li>' + 
										            '<li><i class="fa fa-clock-o"></i>' + response.time + '</li>' + 
										            '<li><i class="fa fa-calendar"></i>' + response.day + '</li>' + 
									            '</ul>' + 
									            '<p>' + response.cmt + '</p>' + 
									            '<a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>' + 
								            '</div>' + 
							            '</li>';
                                $("ul.media-list").append(cmt);
                                $("div.response-area").find("h2").text(response.count_cmt + " bình luận");
                                $("textarea#cmtCha").val("");
                            }
                        })
                    }
                }
            })

            $("div#form_replay").hide();

            $("a#show_form_replay").click(function(){
                $(this).closest("li").find("div#form_replay").show();
            })

            $("a#post_replay").click(function(){
                var check_login = @json(Auth::check());
                if(check_login == false)
                {
                    alert("Vui lòng đăng nhập để tiếp tục");
                }
                else
                {
                    var id_user_cmtCha = $(this).closest("li").find("input#id_user_cmtCha").val();
                    var id_user = $("input#id_user").val();
                    if(id_user == id_user_cmtCha)
                    {
                        alert("Không cho phép tự trả lời chính mình");
                    }
                    else
                    {
                        var id_blog = $("input#id_blog").val();
                        var id_user = $("input#id_user").val();
                        var avatar = $("input#avatar").val();
                        var name = $("input#name").val();
                        var cmt = $(this).closest("div#form_replay").find("textarea#replay").val();
                        var level = $(this).closest("li").find("input#id_cmtCha").val();
                        var count_cmt = parseInt($("div.response-area").find("h2").text());
                        $.ajax({
                            method:"POST",
                            url:"{{ url('/frontend/blog_detail_replay') }}",
                            data:{
                                id_blog: id_blog,
                                id_user: id_user,
                                avatar: avatar,
                                name: name,
                                cmt: cmt,
                                level: level,
                                count_cmt, count_cmt,
                            },
                            success:function(response){
                                console.log(response);
                                var img = "{{ asset('/frontend/avatar') }}" + "/" + response.id_user + "/" + response.avatar;
                                var replay = '<li class="media second-media">' + 
								                '<a class="pull-left" href="#">' + 
									            '<img style="width:121px; height:86px" class="media-object" src="' + img + '" alt="">' + 
								                '</a>' + 
								                '<div class="media-body">' + 
									                '<ul class="sinlge-post-meta">' + 
										                '<li><i class="fa fa-user"></i>' + response.name + '</li>' + 
										                '<li><i class="fa fa-clock-o"></i>' + response.time + '</li>' + 
										                '<li><i class="fa fa-calendar"></i>' + response.day + '</li>' + 
									                '</ul>' + 
									            '<p>' + response.cmt + '</p>' + 
									            '<a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>' + 
								                '</div>' + 
							                '</li>';
                                $("ul.media-list").find("li#" + response.level).after(replay);
                                $("div.response-area").find("h2").text(response.count_cmt + " bình luận");
                                $("ul.media-list").find("li#" + response.level).find("div#form_replay").find("textarea#replay").val("");
                                $("ul.media-list").find("li#" + response.level).find("div#form_replay").hide();
                            }
                        })
                    }
                }
            })
		});
    </script>
@endsection