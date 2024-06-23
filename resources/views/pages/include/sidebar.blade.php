<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Trending</span>
            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                <div class="popular-post">
                    @foreach ($hotmovie_sidebar as $key => $hot_sidebar)
                        <div class="item post-37176">
                            <a href="{{ route('movie', $hot_sidebar->slug) }}" title="{{ $hot_sidebar->title }}">
                                <div class="item-link">
                                    <img src="{{ asset('uploads/movie/' . $hot_sidebar->image) }}"
                                        class="lazy post-thumb" alt="{{ $hot_sidebar->title }}"
                                        title="{{ $hot_sidebar->title }}" />
                                    <span class="is_trailer">
                                        @if ($hot_sidebar->resolution == 0)
                                            2K
                                        @elseif($hot_sidebar->resolution == 1)
                                            Full HD
                                        @elseif($hot_sidebar->resolution == 2)
                                            HD
                                        @elseif($hot_sidebar->resolution == 3)
                                            SD
                                        @else
                                            Trailer
                                        @endif
                                    </span>
                                </div>
                                <p class="title">{{ $hot_sidebar->title }}</p>
                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                            <div style="float: left;">
                                <span class="user-rate-image post-large-rate stars-large-vang"
                                    style="display: block;/* width: 100%; */">
                                    <span style="width: 0%"></span>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
</aside>

<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Phim sắp chiếu</span>
            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                <div class="popular-post">
                    @foreach ($upcoming_movie as $key => $hot_sidebar)
                        <div class="item post-37176">
                            <a href="{{ route('movie', $hot_sidebar->slug) }}" title="{{ $hot_sidebar->title }}">
                                <div class="item-link">
                                    <img src="{{ asset('uploads/movie/' . $hot_sidebar->image) }}"
                                        class="lazy post-thumb" alt="{{ $hot_sidebar->title }}"
                                        title="{{ $hot_sidebar->title }}" />
                                    <span class="is_trailer">
                                        @if ($hot_sidebar->resolution == 0)
                                            2K
                                        @elseif($hot_sidebar->resolution == 1)
                                            Full HD
                                        @elseif($hot_sidebar->resolution == 2)
                                            HD
                                        @elseif($hot_sidebar->resolution == 3)
                                            SD
                                        @else
                                            Trailer
                                        @endif
                                    </span>
                                </div>
                                <p class="title">{{ $hot_sidebar->title }}</p>
                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                            <div style="float: left;">
                                <span class="user-rate-image post-large-rate stars-large-vang"
                                    style="display: block;/* width: 100%; */">
                                    <span style="width: 0%"></span>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
</aside>

{{-- <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Top Views</span>
                <ul class="halim-popular-tab" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#day-pane" class="filter-sidebar" role="tab" data-toggle="tab" data-showpost="10"
                            data-type="today">Day</a>
                    </li>
                    <li role="presentation">
                        <a href="#week-pane" class="filter-sidebar" role="tab" data-toggle="tab" data-showpost="10"
                            data-type="week">Week</a>
                    </li>
                    <li role="presentation">
                        <a href="#month-pane" class="filter-sidebar" role="tab" data-toggle="tab" data-showpost="10"
                            data-type="month">Month</a>
                    </li>
                </ul>
            </div>
        </div>
        <section class="tab-content">
           
            <div id="day-pane" class="tab-pane active halim-ajax-popular-post">
                <div class="popular-post" id="show0">
                   
                </div>
            </div>
           
            <div id="week-pane" class="tab-pane halim-ajax-popular-post">
                <div class="popular-post" id="show1">
                    
                </div>
            </div>
          
            <div id="month-pane" class="tab-pane halim-ajax-popular-post">
                <div class="popular-post" id="show2">
                  
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
</aside> --}}
