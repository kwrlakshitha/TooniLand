<?php $this->load->view('templates/header'); ?>

<div class="container-fluid auth-cont">
    <div class="row h-100">
        <div class="col-7 my-auto text-center">
        <div id="slider">
                <img class="slide active" src="./../assets/images/p01.jpg" style="height: 600px; width: 600px;">
                <img class="slide" src="./../assets/images/p02.jpg" alt>
                <img class="slide" src="./../assets/images/p03.jpg" alt>
                <img class="slide" src="./../assets/images/p04.jpg" alt>
            </div>
        </div>
        <div class="col-5 px-5 form_sec">
            <div class="text-center mt-5 logo">
                <img src="./../assets/images/Logomain.png" class="img-fluid" class="logo_img" />
            </div>

            <form class="px-4">
                <div class="pt-4 pb-3 fw-bold login_name">Sign Up</div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="inputUserName" placeholder="Enter Username" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="inputEmail" placeholder="Enter Email" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 input-group" id="show_hide_password">
                    <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                    <div class="input-group-addon" style="background-color:#a3a3a3; border-radius: 0 10px 10px 0; padding: 5px">
                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="mb-3 input-group" id="show_hide_confirmpassword">
                    <input type="password" class="form-control" id="inputConfirmPassword" placeholder="Confirm Password">
                    <div class="input-group-addon" style="background-color:#a3a3a3; border-radius: 0 10px 10px 0; padding: 5px">
                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="d-md-flex justify-content-md-end">
                    <button class="btn btn-primary" type="button" id="signup">Signup</button>
                </div>
            </form>
            <p class="no_acc mt-4 text-center">Already have an account? <a href="Login" class="no_acc_signup">Log In</a></p>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password input').attr("type") == "text"){
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass( "fa-eye-slash" );
                $('#show_hide_password i').removeClass( "fa-eye" );
            }else if($('#show_hide_password input').attr("type") == "password"){
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass( "fa-eye-slash" );
                $('#show_hide_password i').addClass( "fa-eye" );
            }
        });
    });
    $(document).ready(function() {
        $("#show_hide_confirmpassword a").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_confirmpassword input').attr("type") == "text"){
                $('#show_hide_confirmpassword input').attr('type', 'password');
                $('#show_hide_confirmpassword i').addClass( "fa-eye-slash" );
                $('#show_hide_confirmpassword i').removeClass( "fa-eye" );
            }else if($('#show_hide_confirmpassword input').attr("type") == "password"){
                $('#show_hide_confirmpassword input').attr('type', 'text');
                $('#show_hide_confirmpassword i').removeClass( "fa-eye-slash" );
                $('#show_hide_confirmpassword i').addClass( "fa-eye" );
            }
        });
    });
    var SignupModel = Backbone.Model.extend({
        defaults: {
            userName: '',
            email: '',
            password: '',
            confirmPassword: ''
        }
    });
    
    var SignupView = Backbone.View.extend({
        el: '.form_sec',
        events: {
            'click #signup': 'signup'
        },
        initialize: function() {
            this.model = new SignupModel();
            this.listenTo(this.model, 'change', this.render);
        },
        render: function() {
            this.$el.find('#inputUserName').val(this.model.get('userName'));
            this.$el.find('#inputEmail').val(this.model.get('email'));
            this.$el.find('#inputPassword').val(this.model.get('password'));
        },
        signup: function() {
            this.model.set({
                userName: this.$el.find('#inputUserName').val(),
                email: this.$el.find('#inputEmail').val(),
                password: this.$el.find('#inputPassword').val(),
                confirmPassword: this.$el.find('#inputConfirmPassword').val(),
            });
            if(this.model.get('email') == "" ){
                alert('Please enter email');
                // Show an error message or take other necessary action
            }
            else if(this.model.get('password') == "" ){
                alert('Please enter password');
                // Show an error message or take other necessary action
            }
            else if(this.model.get('confirmPassword') == "" ){
                alert('Please confirm the password');
                // Show an error message or take other necessary action
            }
            else if(this.model.get('password') !== this.model.get('confirmPassword') ){
                alert('Password and Confirm Password must be same');
            }
            else{
                // Save the model
                console.log(" LINE 79 ", this.model.toJSON());
                $.ajax({
                    url: '<?php echo base_url() ?>api/Auth/login',
                    type: 'POST',
                    data: this.model.toJSON(),
                    
                }).done(function(response) {
                    console.log(" LINE 85 ", response);
                    if(response.status == true){
                        alert('User Registered Successfully');
                        window.location.href = '<?php echo base_url() ?>Login';
                    }
                    else{
                        alert('User Registration Failed');
                    }
                });
            }
        }
    });
    var signupView = new SignupView();
    
</script>
