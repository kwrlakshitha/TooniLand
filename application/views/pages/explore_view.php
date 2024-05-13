<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<style>
    body, html {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #D7C3E4; /* Light grey background for the entire page */
    }
</style>
   
<div class="container-fluid py-3 " id="explore_page">
    <div class="helo">

    </div>
    <div class="row">
        <div class="col-9">
            <form class="d-flex">
                <input class="form-control me-2" id="searchby_tags" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary" id="searchBtn">Search</button>
            </form>

            <!-- POST IMAGES ARE DISPLAYED -->
            <div class="container text-center mt-5" id="all_user_posts">
                    <div class="row row-cols-md-4 g-3" id="post_imgs">
                    </div>
                </div>
            </div>

            <div class="col-3" id="explore_usercover_div" >
                <div class="w-100 explore_usercover_img d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center justify-content-center rounded-circle" style="overflow: hidden; background-color: black; width:150px; height:150px">
                        <img src="assets/images/p07.jpg" class="img-fluid" style="height:100%"  id="profPic">
                    </div>
                </div>
            <div class="text-center" id="uDetail"></div>
        </div>
    </div>
</div>

<!-- POPUP POST MODAL -->
<div class="modal fade bd-example-modal-xl" id="postModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center rounded-circle" style="overflow: hidden; background-color: black; width:90px; height:90px">
                        <img src="" class="post_card_userimg img-fluid" style="height:100%">
                    </div>
                    <div class="ms-4 mt-2" id="postUname">
                        <h5 class="mb-0" id="post_username"></h5>
                        <p id="postCreatedTime" class="m-0"></p>
                        <div class="d-flex" id="postloc"></div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4  text-center">
                        <img src="" class="img-fluid" id="post_img" style="height: 500px">
                        <div class="d-flex mt-2 justify-content-between">
                            <a id="likeBtn" class="me-3 text-dark my-auto" style="text-decoration: none; cursor: pointer" data-likedata="" data-postID="">
                                <i class="fa fa-heart-o fs-2"  aria-hidden="true" id="likechanger"></i>
                            </a>
                            <a href="#" class="me-3 text-dark">
                                <i class="fa fa-comment-o fs-2" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="me-3 text-dark">
                                <i class="fa fa-share-square-o fs-2" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div id="post_likes" style="font-weigth: bold; margin-top: 5px"></div>
                    </div>

                    <div class="col-8">
                        <h5 id="post_cap"></h5>
                        <div id="hashtags"></div>
                        <div class="bg-light mt-4 px-4 py-1 landing_card_txt" id="comSec" style="height: 400px;">
                            <div class="d-flex align-items-start my-3">
                            </div>
                        </div>
                        <div>
                        <form class="d-flex mt-3">
                        <input class="form-control me-2" placeholder="Comment..." id="inputComment">
                            <button type="button" class="btn btn-primary" id="commentBtn" data-postID="">Comment</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>

    //block user from routing to other pages
    document.addEventListener("DOMContentLoaded", function(event) {
       if(localStorage.getItem("token") == null){   
           window.location.href = '<?php echo base_url() ?>Login';
       }
   });

    var user_id = localStorage.getItem("userID");
    var user_name = localStorage.getItem("username");
    var userDescription = localStorage.getItem("userDescription") ? localStorage.getItem("userDescription") : "My bio...";
    var profileImage = localStorage.getItem("profileImage") != 'null' ? localStorage.getItem("profileImage") : "default.jpg";
    
    // LIKE THE POST
    $(document).on('click', '#likeBtn', function() {
        $('#post_likes').empty();

        var post_id = $(this).attr('data-postID');
        var likesCount = $(this).attr('data-likedata');

        var formData = new FormData();
        formData.append('postID', post_id);
        formData.append('userID', user_id);

        $.ajax({
            url: '<?php echo base_url() ?>api/Like',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
        }).done(function(data) {
            console.log("like data -- ",data.res);
            if(data.res.liked == 1){
                newlikesCount = parseInt(data.res[0].NumberOfLikes);
                $("#likechanger").attr("class", "fa fa-heart fs-2 text-danger");
                if (newlikesCount == 0) {
                    newlikesCount = 'No likes yet';
                }else if(newlikesCount == 1){
                    newlikesCount = newlikesCount + ' like';
                }else{
                    newlikesCount = newlikesCount + ' likes';
                }
            }else if(data.res.liked == 0){
                console.log("-- ++ --",data.res[0].NumberOfLikes);
                newlikesCount = parseInt(data.res[0].NumberOfLikes);
                $("#likechanger").attr("class", "fa fa-heart-o fs-2");
                if (newlikesCount == 0) {
                    newlikesCount = 'No likes yet';
                }else if(newlikesCount == 1){
                    newlikesCount = newlikesCount + ' like';
                }else{
                    newlikesCount = newlikesCount + ' likes';
                }
            }

            $('#post_likes').text(newlikesCount);
           }).fail(function(data) {
            console.log("error -- ",data);
        });
    });

    // INSERT A COMMENT TO A POST
        $(document).on('click', '#commentBtn', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var comment = $('#inputComment').val();
            var postID = $(this).attr('data-postID');
            
            $.ajax({
                url: '<?php echo base_url() ?>api/Comment/insertComment',
                type: 'POST',
                data: {
                    'postID': postID,
                    'comment': comment,
                    'userID': user_id
                },
            }).done(function(data) {
                if(data.status = true){
                    alert("Comment added successfully");
                    // CLOSE THE POPUP
                    $('#postModal').modal('hide');
                    window.location.reload();
                }else{
                    alert("Comment adding failed");
                }
            });
        });

    // OPEN POSTS POPUP AND LOAD POST AND COMMENTS
    $(document).on('click', '.postid_img', function() {
        var img_src = $(this).attr('src');
        var img_cap = $(this).attr('data-caption');
        var img_time = $(this).attr('data-cTime');
        var post_id = $(this).attr('id');
        var post_user_name = $(this).attr('data-uname');
        var hashtags = $(this).attr('data-hashtags');
        var location = $(this).attr('data-location');
        var profilePic = $(this).attr('data-profileImage');
        var likesCount = $(this).attr('data-likescount');

        if (likesCount == 0) {
            likesCount = 'No likes yet';
        }else if(likesCount == 1){
            likesCount = likesCount + ' like';
        }else{
            likesCount = likesCount + ' likes';
        }
        
        $('#comSec').text("");
        $('#postloc').text("");
        $('#hashtags').text(hashtags);
        $('#post_img').attr('src', img_src);
        $('#commentBtn').attr('data-postID', post_id);
        $('#likeBtn').attr('data-postID', post_id);
        $('#likeBtn').attr('data-likedata', likesCount);
        $('#post_cap').text(img_cap);
        $('#postCreatedTime').text(img_time);
        $('#post_username').text(post_user_name);
        $(".post_card_userimg").attr('src', "http://localhost/codeigniter-cw/uploads/profiles/" + profilePic);
        $('#post_likes').text(likesCount);

        if(location == 'null'){
            $('#postloc').css('display','none');
        }else{
            $('#postloc').append(
                `<i class="fa fa-map-marker mt-1 me-2" aria-hidden="true"></i><p id="post_location" class="m-0" style="font-style: italic">${location}</p>`
            );
        }

        $.ajax({
            url: '<?php echo base_url() ?>api/Comment/' + post_id,
            type: 'GET',
            data: {
                postID : post_id
            }
        }).done(function(response) {
            if(response.status == true){
                for(var i=0; i<response['data'].length; i++){
                    var profilePic = response['data'][i].profileImage !== null ? response['data'][i].profileImage : 'default.jpg';
                    $('#comSec').append(`
                        <div class="d-flex align-items-start my-3">
                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="overflow: hidden; background-color: black; width:70px; height:70px">
                            <img src="http://localhost/codeigniter-cw/uploads/profiles/${profilePic}" class="post_card_comment_userimg img-fluid" style="height:100%" id="main_prof_pic">
                        </div>
                        <div class="ms-3 w-100" >
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>`+response['data'][i].userName+`</h6>
                                    <h6>`+response['data'][i].createdTime+`</h6>
                                </div>
                                <p>`+response['data'][i].comment+`</p>
                            </div>
                        </div>
                    `);
                }
            }else{
                $('#comSec').append(`   
                    <p class="text-center my-5">`+ response['message'] +`</p>
                `);
            }
        }).fail(function(response) {
        })
        $('#postModal').modal('show');
    });

    // GET POSTS BY SEARCH TAGS
    $(document).on('click', '#searchBtn', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var tag = $('#searchby_tags').val();

        $.ajax({
            url: '<?php echo base_url() ?>api/Hashtags/' + tag,
            type: 'GET'
        }).done(function(response) {
            if(response.status == true){
                $('#post_imgs').text("");
                
                for(var i=0; i<response['data'].length; i++){
                    var posts = response['data'][i];
                    var hashtags = posts['hashtags'];
                    var location = posts['location'];
                    var profileImage = posts['profileImage'];
                    var likesCount = posts['NumberOfLikes'] !== undefined ? posts['NumberOfLikes'] : 0;

                    var hashtagsString = hashtags.join(" ");
                    $('#post_imgs').append(`
                    <div class="col">
                        <div class="card rounded shadow-lg ">
                            <img src="http://localhost/codeigniter-cw/uploads/`+response['data'][i].image+`" class="card-img postid_img" height=350 
                                id="`+response['data'][i].postID+`" data-caption="`+response['data'][i].caption+`" data-cTime="`+response['data'][i].createdTime+`" 
                                data-uname="`+response['data'][i].userName+`" data-hashtags="${hashtagsString}" data-location="`+response['data'][i].location+`"
                                data-profileImage="${profileImage}" data-likescount="${likesCount}">
                        </div>
                    </div>
                        `);
                }
            }else{
                $('#post_imgs').append(`   
                    <p class="text-center my-5">`+ response['message'] +`</p>
                `);
            }
        }).fail(function(response) {
            console.log("no  -- ",response);
        })
    });

    // GET ALL THE POSTS 
    var ProfilePostModel = Backbone.Model.extend({
        url: "<?php echo base_url() ?>api/Post/",
        defaults: {
            caption: "",
            createdTime: "",
            image: "",
            location: "",
            postID: null,
            userID: 1
        },
        initialize: function() {
            console.log("Profile Post Model Initialized", this.attributes.data);
        }
    });

    var ProfilePostCollection = Backbone.Collection.extend({
        model: ProfilePostModel,
        url: "<?php echo base_url() ?>api/Post/",
    });

    var allUserPosts = new ProfilePostCollection();
    allUserPosts.fetch({async: false}).done(() => {
        console.log("Profile Post Collection Fetched", allUserPosts);
    });

    var ProfilePostView = Backbone.View.extend({
        el: "#explore_page",
        initialize: function() {
            this.render();
            console.log("Profile Post View Initialized");
        },
        render: function() {
            if (allUserPosts.length == 0) {            
                $('#all_user_posts').append("<h1 class='py-5' style='color:#0066cc'>No posts uploaded yet!</h1>");
                $("#profPic").attr('src', "http://localhost/codeigniter-cw/uploads/profiles/" + profileImage);

            }else{
                var posts = allUserPosts['models'][0]['attributes']['data'];

                for (var i = 0; i < posts.length; i++) {
                    var post = posts[i];
                    var postImg = post['image'];
                    var postCaption = post['caption'];
                    var postLocation = post['location'];
                    var postCreatedTime = post['createdTime'];
                    var postID = post['postID'];
                    var userID = post['userID'];
                    var uName = post['userName'];
                    var hashtags = post['hashtags'];
                    var location = post['location'];
                    var profileImageU = post['profileImage'];
                    var likesCount = post['NumberOfLikes'] !== undefined ? post['NumberOfLikes'] : '0';

                    var hashtagsString = hashtags.join(" ");

                    var postCard = `
                    <div class="col">
                    <div class="card rounded shadow-lg ">
                    <img src="http://localhost/codeigniter-cw/uploads/${postImg}" class="card-img postid_img" height=350 
                        id="${postID}" data-caption="${postCaption}" data-cTime="${postCreatedTime}" data-uname="${uName}" 
                        data-hashtags="${hashtagsString}" data-location="${location}" data-profileImage="${profileImageU}" 
                        data-likescount="${likesCount}">
                    </div>
                    </div>
                    `;
                    $('#post_imgs').append(postCard);
                }

                $("#profPic").attr('src', "http://localhost/codeigniter-cw/uploads/profiles/" + profileImage);

                $('#uDetail').append(`
                <h5 class="mb-0">${user_name}</h5>
                <a href="Profile">
                    <button class="btn btn-primary mt-1">View Profile</button>
                </a>
                `);
            }
        }
    });

    var profilePostView = new ProfilePostView();


</script>

<div style="height:75px"></div>

<?php $this->load->view('templates/footer');?>