<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar-outside'); ?>

<style>
    .body{
        background-color: aqua;
    }

    .landing_cont {
        background-image: url('assets/images/background.jpg'); /* Update the path as needed */
        background-size: cover; /* Cover the entire page */
        background-position: center; /* Center the background image */
        
    }
    .landing_img {
        width: auto;
        height: auto;
    }
    .landing_img_txt {
        font-weight: bold;
        font-size: 80px; /* Adjust size as needed */
        text-align: center;
        font-family: Comic Sans MS;
        text-shadow: 2px 2px 5px white;
        
    }
    .landing_heading_1{
        font-size: 3rem;
        text-align: center;
        font-family: Trebuchet MS;
        color: #432646;
        text-shadow: 2px 2px 5px #9910F3;
    }
    .landing_heading_2{
        font-size: 1.5rem;
        text-align: center;
        font-family: 'Times New Roman', Times, serif;
        color: white;
        text-shadow: 5px 5px 5px black;
    }

    .container {
        padding: 0 1rem;
        max-width: 1200px; /* Adjust as needed */
        margin: auto;
    }
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }
    .col {
        padding-right: 15px;
        padding-left: 15px;
        flex: 1 0 0%; /* Adjust basis and grow/shrink as needed */
        max-width: 33.3333%; /* Three columns */
    }
    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        margin-bottom: 20px;
    }
    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.6);
    }
    .card-img {
        width: 100%;
        height: 300px; /* Fixed height for uniform cards */
        object-fit: cover; /* Ensures image covers the area without distorting aspect ratio */
    }
</style>

<div class="container-fluid landing_cont px-0 mb-5 pb-5">
    <img src="./../assets/images/logo2.png" class="landing_img" />
    <div class="landing_img_txt">Welcome to 
        <img src="assets/images/Logomain.png"  style="height:100px">
    </div>

    <div class="my-5">
        <p class="landing_heading_1">Dive into a World of Creativity and Color.</p>
        <p class="landing_heading_2">Join Now or Sign In to discover more and connect with cartoon enthusiasts around the globe!</p>
    </div>

    <div class="container text-center">
        <div class="row">
            <div class="col">
                <div class="card">
                    <img src="assets/images/p01.jpg" class="card-img">
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="assets/images/p02.jpg" class="card-img">
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="assets/images/p03.jpg" class="card-img">
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="assets/images/p04.jpg" class="card-img">
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="assets/images/p05.jpg" class="card-img">
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="assets/images/p06.jpg" class="card-img">
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>
