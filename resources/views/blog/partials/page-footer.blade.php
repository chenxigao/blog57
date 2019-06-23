<hr>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="https://weibo.com" title="新浪微博" data-toggle="tooltip">
                  <span class="fa-stack fa-lg">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fab fa-weibo fa-stack-1x fa-inverse"></i>
                  </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ url('sitemap.xml') }}" title="SiteMap" data-toggle="tooltip">
                  <span class="fa-stack fa-lg">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fa fa-sitemap fa-stack-1x fa-inverse"></i>
                  </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://github.com" title="GitHub" data-toggle="tooltip">
                  <span class="fa-stack fa-lg">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                  </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ url('rss') }}" data-toggle="tooltip" title="RSS feed">
                          <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-rss fa-stack-1x fa-inverse"></i>
                          </span>
                        </a>
                    </li>
                </ul>
                <p class="copyright text-muted">Copyright © {{ config('blog.author') }} 2019</p>
            </div>
        </div>
    </div>
</footer>