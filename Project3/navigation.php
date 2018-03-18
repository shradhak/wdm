
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Project  3</a>
                </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="default.php">Home</a></li>
                    <li><a href="About.php">About Us</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Pages
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="Part01_ArtistsDataList.php">Artists Data List (Part 1)</a></li>
                            <li><a href="Part02_SingleArtist.php?id=19">Single Artist (Part 2)</a></li>
                            <li><a href="Part03_SingleWork.php?workid=394">Single Work (Part 3)</a></li>
                            <li><a href="Part04_Search.php">Search (Part 4)</a></li>
                        </ul>
                    </li>
                </ul>


         
                 
                <form class="navbar-form navbar-right" method="GET" action="Part04_Search.php">
                 
                    <div class="form-group">
                      <b style="color: white"> Shradha Nagesh Karandikar</b>
                        <input type="text" class="form-control" id="st" name="title" placeholder="Search Paintings">
                        <input type="submit" class="btn btn-primary"  value="Search"  id="searchbtn">
                    </div>


                   
                </form> 
            </div>
            </div>
        </nav>

