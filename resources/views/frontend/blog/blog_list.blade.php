@extends('frontend/layout.layout')

@section('left')
    @include('frontend/layout.left')
@endsection

@section('content')
                <div class="col-sm-9">
					<div class="blog-post-area">
						<?php
                            use App\Models\admin\Blog;
                            use App\Models\frontend\Rate;
                            foreach($blogs as $key => $value)
                            {
                                $count_rate = count(Blog::find($value->id)->rates);
                                if($count_rate == 0)
                                {
                                    $avg = "Chưa có lượt đánh giá";
                                }
                                else
                                {
                                    $tong = 0;
                                    foreach(Blog::find($value->id)->rates as $key1 => $value1)
                                    {
                                        $tong += $value1->rate;
                                    }
                                    $avg = round( $tong / $count_rate);
                                }
                        ?>
                                <div class="single-blog-post">
							        <h3><?php echo $value->title; ?></h3>
							        <div class="post-meta">
								        <ul>
									        <li><i class="fa fa-user"></i><?php echo $value->title; ?></li>
									        <li><i class="fa fa-clock-o"></i><?php echo $value->updated_at->format('H:i'); ?></li>
									        <li><i class="fa fa-calendar"></i><?php echo $value->updated_at->format('M d, y'); ?></li>
								        </ul>
								        <span>
										        <!-- <i class="fa fa-star"></i>
										        <i class="fa fa-star"></i>
										        <i class="fa fa-star"></i>
										        <i class="fa fa-star"></i>
										        <i class="fa fa-star-half-o"></i> -->
                                            @if($count_rate == 0)
                                                {!! $avg !!}
                                            @else 
                                                @for($i = 1; $i <= 5; ++$i)
                                                    @if($i <= $avg)
                                                        <i class="fa fa-star"></i>
                                                    @else 
                                                        <i class=""></i>
                                                    @endif 
                                                @endfor
                                            @endif
								        </span>
							        </div>
							        <a href="">
								        <img src="{{ asset('/admin/blog/'.$value->id.'/'.$value->image) }}" alt="">
							        </a>
							        <p>{!! Illuminate\Support\Str::limit($value->content, 100) !!}</p>
							        <a  class="btn btn-primary" href="{{ url('/frontend/blog_detail', ['id_blog' => $value->id]) }}">Xem thêm</a>
						        </div>
                        <?php
                            }
                        ?>
						<div class="pagination-area">
							<ul class="pagination">
								<!-- <li><a href="" class="active">1</a></li>
								<li><a href="">2</a></li>
								<li><a href="">3</a></li>
								<li><a href=""><i class="fa fa-angle-double-right"></i></a></li> -->
                                {{ $blogs->links('pagination::bootstrap-4') }}
							</ul>
						</div>
					</div>
				</div>
@endsection