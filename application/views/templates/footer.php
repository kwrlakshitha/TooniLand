<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Footer card styling */
        .card.fixed-bottom {
            background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent white */
            border-top: 1px solid #e0e0e0; /* Light line on the top border for separation */
            padding: 10px 0; /* Increased padding for better spacing */
            color: #6c757d; /* Text color */
            font-family: 'Arial', sans-serif; /* Ensuring consistent font usage */
        }

        /* Footer alignment and spacing */
        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-around; /* Space distribution around items */
        }

        /* Small text styling for copyright */
        small {
            font-size: 0.85em; /* Smaller text for legal and copyright notices */
            margin-right: 15px; /* Right margin for spacing between text and button */
        }

        /* Back to top button styling */
        #backToTop {
            padding: 8px 12px; /* Slightly larger padding for a more substantial button */
            border-radius: 50%; /* Circular button */
            border: 2px solid #007bff; /* Slightly thicker border with Bootstrap's primary color */
            color: #007bff; /* Text/icon color */
            background-color: transparent; /* Transparent background */
            text-align: center;
            display: inline-block;
            vertical-align: middle;
        }

        #backToTop:hover, #backToTop:focus {
            background-color: #007bff; /* Change background on hover/focus */
            color: white; /* Text color on hover/focus */
            text-decoration: none; /* Remove underline from focus */
        }
    </style>
</head>
<body>

<div class="card fixed-bottom text-center">
    <div class="card-footer text-muted">
        <small>&copy; Copyright 2024 | TooniLand</small>
        <a href="#" class="btn btn-outline-primary" id="backToTop"><i class="fa fa-chevron-circle-up" aria-hidden="true"></i></a>
    </div>
</div>

<!-- Bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<!-- Swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

</body>
</html>
