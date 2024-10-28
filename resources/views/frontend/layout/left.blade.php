                        <h2>Danh mục</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<?php
								use App\Models\admin\Category;
								use App\Models\admin\Brand;
								use App\Models\frontend\Product;
								$categories = Category::where('level', 0)->get();
								foreach($categories as $key => $value)
								{
							?>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordian" href="#<?php echo $value->id; ?>">
													<span class="badge pull-right"><i class="fa fa-plus"></i></span>
													<?php
														echo $value->name;
													?>
												</a>
											</h4>
										</div>
										<div id="<?php echo $value->id; ?>" class="panel-collapse collapse">
											<div class="panel-body">
												<ul>
													<?php
														foreach(Category::where('level', $value->id)->get() as $key1 => $value1)
														{
													?>
															<li><a href="{{ url('/frontend/index/category', ['id_category' => $value1->id]) }}"><?php echo $value1->name; ?></a></li>
													<?php
														}
													?>
												</ul>
											</div>
										</div>
									</div>
							<?php
								}
							?>
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Thương hiệu</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<?php
										$brands = Brand::all();
										foreach($brands as $key => $value)
										{
									?>
											<li><a href="{{ url('/frontend/index/brand', ['id_brand' => $value->id]) }}"> <span class="pull-right"></span><?php echo $value->name; ?></a></li>
									<?php
										}
									?>
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								<?php
									$minPrice = $maxPrice = 0;
									foreach(Product::all() as $key => $value)
									{
										if($value->price > $maxPrice)
										{
											$maxPrice = $value->price;
										}

										if($value->price < $minPrice)
										{
											$minPrice = $value->price;
										}
									}
								?>
								<input type="text" class="span2" value="" data-slider-min="<?php echo $minPrice; ?>" data-slider-max="<?php echo $maxPrice;?>" data-slider-step="5" data-slider-value="[<?php echo $minPrice; ?>, <?php echo $maxPrice; ?>]" id="sl2" ><br />
								<b class="pull-left">0</b> <b class="pull-right"><?php echo $maxPrice; ?> VNĐ</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="{{ asset('/frontend/images/home/shipping.jpg') }}" alt="" />
						</div><!--/shipping-->