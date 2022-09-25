
<div class="type-133">
    <!--MENU HOME-->

    <div class="navbar-default hidden-menutop" role="navigation">
        <div class="container menu">
            <nav class="topnav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed mobile" data-toggle="collapse" data-target="#maintop" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse" id="maintop">
                    <ul  class="nav navbar-nav">
                        <li class="active"><a href="{{ url('/') }}">Trang chủ</a></li>
                        <li><a href="{{ url('/gioi-thieu') }}">Giới thiệu</a></li>
                        <li><a href="{{ url('/tuyen-sinh') }}">Tuyển sinh</a></li>
                        <li><a href="{{ url('/brochure') }}">Brochure</a></li>
                        <li><a href="http://lib.tdc.edu.vn/Default.aspx?ModuleId=4981ae8d-1c44-4b94-913f-73b283c51351">Tài liệu chuyên ngành</a></li>
                        <li><a href="{{ url('/lien-he') }}">Liên hệ</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!--END MENU HOME-->
    <header id="scoll-top">
        <nav id="clear-navbar-fixed"class="navbar navbar-inverse navbar-static-top">
            <!--LIST OF HEADER -->
            <div class="container menu">
                <div class="left-bg">&nbsp;</div>
                <div class="container menu">
                    <div class="logo">
                        <a href="{{ url('/') }}"><img alt="TDC-Khoa CNTT logo" src="{{ url('/') }}/packages/foostart/package-front/images/logo.png"></a>
                        <span class="triangle-arrow">&nbsp;</span>
                    </div>

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainnav" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="navbar-collapse collapse" id="mainnav">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6 menutop clear_padding">
                            <ul  class="nav navbar-nav">
                                <li class=""><a href="{{ url('/') }}">Trang chủ</a></li>
                                <li><a href="{{ url('/gioi-thieu') }}">Giới thiệu</a></li>
                                <li><a href="{{ url('/tuyen-sinh') }}">Tuyển sinh</a></li>
                                <li><a href="{{ url('/brochure') }}">Brochure</a></li>
                                <li><a href="http://lib.tdc.edu.vn/Default.aspx?ModuleId=4981ae8d-1c44-4b94-913f-73b283c51351">Tài liệu chuyên ngành</a></li>
                                <li><a href="{{ url('/lien-he') }}">Liên hệ</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6 clear-left clear_padding">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="first parent"><a href="{{ url('/tin-tuc') }}">tin tức</a></li>
                                <li class="parent"><a href="{{ url('/giang-vien') }}">giảng viên</a></li>
                                <li class="parent"><a href="{{ url('/sinh-vien') }}">sinh viên</a></li>
                                <li class="parent"><a href="{{ url('/chuyen-de') }}">chuyên đề</a></li>
                                <li class="last parent"><a href="{{ url('/dao-tao') }}">đào tạo</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!--END MENU HEADER-->

</div>
