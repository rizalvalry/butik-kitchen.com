
<!-- feature-product-area-start -->
<div class="feature-product-area ptb-80">	
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title mb-30 text-center">
                            <h2>Featured Products</h2>
                            <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum formas.</p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <!-- tab-menu-start -->
                        <div class="tab-menu mb-50 text-center">
                            <ul class="nav">

                            <?php
                                
                                while( $row1234 = $query1234->fetch_assoc() ){
                                  
                            ?>

                                <li><a href="#<?php echo $row1234['judul_galeri']; ?>" data-toggle="tab"><?php echo $row1234['judul_galeri']; ?></a></li>
                                <!-- <li><a href="#Handbags"  data-toggle="tab">Handbags</a></li>
                                <li><a href="#Shoes" data-toggle="tab">Shoes</a></li>
                                <li><a href="#Accessories" data-toggle="tab">Accessories</a></li> -->
                                    
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                        <!-- tab-menu-end -->
                    </div>
                </div>		

                
                <!-- tab-area-start -->
                <div class="tab-content">

                <?php
                $counter = 1;
				while( $rowimages = $query1231->fetch_assoc() ){
                    
			    ?>
                
                    <div class="tab-pane <?php if ($counter <= 1) {echo "active show";} else {echo "fade";}?>" id="<?php echo $rowimages['judul_galeri']; ?>">

                        <div class="product-active owl-carousel">
                          
                        <!-- product-wrapper-start -->
                            <div class="product-wrapper">
                                <div class="product-img">
                                    <a href="#">
                                    <img src="gambar/thumb_galeri/<?php echo $rowimages['gambar']; ?>" class="img-responsive" alt=""/>
                                    </a>
                                    <span class="sale">sale</span>
                                    <div class="product-icon">
                                        <a href="#" data-toggle="tooltip" title="Chat Kami"><i class="icon ion-bag"></i></a>
                                    </div>
                                </div>
                                <div class="product-content pt-20">
                                    <div class="manufacture-product">
                                        <a href="#">Armani</a>
                                     
                                    </div>
                                    <h2><a href="product-details.html">Aopo Designs Woolrich Klettersack Backpack</a></h2>
                                    <div class="price">
                                        <ul>
                                            <li class="new-price">$122.00</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- product-wrapper-end -->
                        </div>
                    </div>
                    
                    <?php
                        $counter++; }
                    ?>
                </div>
                <!-- tab-area-end -->
            </div>
       </div>
        <!-- feature-product-area-end -->