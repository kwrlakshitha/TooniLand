
<div>

    <nav class="navbar navbar-dark sticky-top" style="background-color: black;">
        <div class="container-fluid align-middle">
            <img src="./../assets/images/Logomain.png" class="img-fluid" style="height:45px">

            <form class="d-flex">
                <a href = "explore"><i class="fa fa-home mx-2" style="color: white; font-size: 45px; margin-top: 2px" aria-hidden="true"></i></a>
                <a href="" id="uploadPostOpen"><i class="fa fa-plus-circle mx-2" style="color: white; font-size: 45px; margin-top: 2px" aria-hidden="true"></i></a>
                <a href="" id="notification"><i class="fa fa-bell mx-2" style="color: white; font-size: 40px; margin-top: 5px" aria-hidden="true"></i></a>
                <a href = "profile"><img src="" class="img-fluid mx-2" id="profileImage" style="height:45px; width:45px; border-radius:100%; margin-top: 2px"></a>
            </form>
        </div>
    </nav>

    <!-- INSERT A POST -->
    <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create a post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column">
                    <div class="mb-3">
                        <input type="file" class="form-control" id="postImage">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" id="postCaption" placeholder="Caption"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="postHashtags" placeholder="Tags">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="postLocation" placeholder="Location">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="createPostBtn">Create</button>
                </div>
            </div>
        </div>
    </div>                    
</div>

<!-- modal -->
<div class="toast" id="element" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 100; right: 0;">
  <div class="toast-header">
    <img src="http://localhost/codeigniter-cw/uploads/profiles/default.jpg" class="rounded mr-2" style="height: 35px" alt="...">
    <strong class="mr-auto">John cena</strong>
    <small>&nbsp; 1 hour ago</small>
    <button type="button" class="ms-4 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    Please do share this message.
  </div>
</div>
<div class="toast" id="element" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 100; right: 0;">
  <div class="toast-header">
    <img src="http://localhost/codeigniter-cw/uploads/profiles/default.jpg" class="rounded mr-2" style="height: 35px" alt="...">
    <strong class="mr-auto">Ravindu Lakshitha</strong>
    <small>&nbsp;  4 hours ago</small>
    <button type="button" class="ms-4 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    Please do share this message.
  </div>
</div>
<div class="toast" id="element" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 100; right: 0;">
  <div class="toast-header">
    <img src="http://localhost/codeigniter-cw/uploads/profiles/default.jpg" class="rounded mr-2" style="height: 35px" alt="...">
    <strong class="mr-auto">Pasindu Max</strong>
    <small>&nbsp; 10 hours ago</small>
    <button type="button" class="ms-4 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    Please do share this message.
  </div>
</div>


<script>
        //OPEN UPLOAD POST MODAL
    $(document).on('click', '#uploadPostOpen', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $('#createPostModal').modal('show');
    });

    $(document).on('click', '#notification', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $('#element').toast('show');
    });


    var profileImage = localStorage.getItem("profileImage") !== 'null' ? localStorage.getItem("profileImage") : "default.jpg";

    // SET PROFILE IMAGE
    $('#profileImage').attr('src', 'http://localhost/codeigniter-cw/uploads/profiles/' + profileImage);

    // INSERT A POST
        $(document).on('click', '#createPostBtn', function(e) {
            // e.preventDefault();
            // e.stopPropagation();
            var caption = $('#postCaption').val();
            var image = $('#postImage').val();
            var hashtags = $('#postHashtags').val();
            var location = $('#postLocation').val();

            var postFormData = new FormData();
            postFormData.append('caption', caption);
            postFormData.append('image', $('#postImage')[0].files[0]);
            postFormData.append('hashtags', hashtags);
            postFormData.append('userID', user_id);
            postFormData.append('location', location);
            
            console.log("postFormData -- ",postFormData);

            $.ajax({
                url: '<?php echo base_url() ?>api/Post/',
                type: 'POST',
                data: postFormData,
                processData: false,
                contentType: false,
            }).done(function(data) {
                if(data.status = true){
                    console.log(data);
                    alert("Post added successfully");
                    $('#createPostModal').modal('hide');
                    window.location.reload();
                }
            }).fail(function(data) {
                console.log(data);
                alert("Post not added: " + data.responseJSON.message);
            })
        });

</script>