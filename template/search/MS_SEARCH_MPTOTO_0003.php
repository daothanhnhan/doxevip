<link rel="stylesheet" href="/plugin/typeahead/css/main.css">
<div class="sticky-footer-wrapper">
    <div class="masthead">
        <div class="Demo">
            <form action="" method="get">
                <input type="hidden" name="mode" value="users">
                <div class="Typeahead Typeahead--twitterUsers gb-searchheader_minhphuong">
                    <div class="u-posRelative">
                        <input class="Typeahead-hint" type="text" tabindex="-1" readonly>
                        <input class="Typeahead-input" id="demo-input" type="text" name="q" placeholder="Tìm kiếm sản phẩm">
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
                <button class="u-hidden" type="submit">blah</button>
            </form>
        </div>
    </div>
    <div class="sticky-footer-push"></div>
</div>

<script id="result-template" type="text/x-handlebars-template">

    <div class="ProfileCard u-cf">
        <div class="row">
            <div class="col-sm-8">
                <img class="ProfileCard-avatar" src="{{profile_image_url_https}}">

                <div class="ProfileCard-details">
                    <div class="ProfileCard-realName">{{name}}</div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="ProfileCard-stats">
                    <div class="ProfileCard-stat giacu_typeahead"><span class="ProfileCard-stat-label">Tweets:</span> {{statuses_count}}</div>
                    <div class="ProfileCard-stat giamoi_typeahead"><span class="ProfileCard-stat-label">Following:</span> {{friends_count}}</div>
                </div>
            </div>
        </div>
    </div>
</script>

<script id="empty-template" type="text/x-handlebars-template">
    <!-- <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div> -->
</script>

<!-- <script src="/plugin/typeahead/js/handlebars.js"></script>
<script src="/plugin/typeahead/js/jquery.xdomainrequest.min.js"></script>
<script src="/plugin/typeahead/js/typeahead.bundle.js"></script>
<script src="/plugin/typeahead/js/main.js"></script> -->