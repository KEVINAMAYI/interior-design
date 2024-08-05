<!doctype html>
<html lang="en">

<head>
    <base href="{{ URL::to('/') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        body {
            margin-top: 20px;
            background: white;
        }


        .btn {
            appearance: none;
            -webkit-appearance: none;
            font-family: sans-serif;
            cursor: pointer;
            padding: 12px;
            min-width: 100px;
            border: 0px;
            -webkit-transition: background-color 100ms linear;
            -ms-transition: background-color 100ms linear;
            transition: background-color 100ms linear;
        }


        .btn:focus,
        .btn.focus {
            outline: 0;
        }

        .btn-round-1 {
            border-radius: 8px;
        }

        .btn-success {
            background: #2ecc71;
            color: #ffffff;
        }

        .btn-success:hover {
            background: #27ae60;
            color: #ffffff;
        }


        .icon-circle[class*=text-] [fill]:not([fill=none]),
        .icon-circle[class*=text-] svg:not([fill=none]),
        .svg-icon[class*=text-] [fill]:not([fill=none]),
        .svg-icon[class*=text-] svg:not([fill=none]) {
            fill: currentColor !important;
        }

        .svg-icon-xl > svg {
            width: 3.25rem;
            height: 3.25rem;
        }

        .mt-4 {
            margin-top: 1.5rem !important;
        }

        .w-100 {
            width: 100% !important;
        }

        .btn-group-lg > .btn,
        .btn-lg {
            padding: 0.8rem 1.85rem;
            font-size: 1.1rem;
            border-radius: 0.3rem;
        }


        .text-center {
            text-align: center !important;
        }

        /* Custom styles for the example */

        .container {
            max-width: 600px;
            /* Set a max-width for the email container */
        }

        .card {
            border: none;
            /* Remove the card border */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Add a subtle shadow effect */
        }

        .card-body {
            padding: 40px;
            /* Increase the card body padding */
        }

        .avatar {
            margin: 0 auto;
            /* Center the avatar image */
        }

        .h4,
        p {
            color: #333333;
            /* Use a darker color for the text */
            font-family: Arial, sans-serif;
            /* Use a more common font */
        }

        .h4 {
            font-weight: bold;
            /* Make the heading bold */
            font-size: 24px;
            /* Increase the heading font size */
            margin-bottom: 20px;
            /* Add some space below the heading */
        }

        p {
            font-size: 16px;
            /* Increase the paragraph font size */
            line-height: 1.5;
            /* Increase the paragraph line height */
            margin-bottom: 20px;
            /* Add some space below the paragraph */
        }

        .btn-success {
            background: #4CAF50;
            /* Use a more vibrant green color for the button */
            font-weight: bold;
            /* Make the button text bold */
            font-size: 18px;
            /* Increase the button font size */
        }

        .btn-success:hover {
            background: #46A049;
            /* Use a darker green color for the button hover */
        }

        .signature {
            margin-top: 40px;
            /* Add some space above the signature */
            border-top: 1px solid #EEEEEE;
            /* Add a light gray border above the signature */
            padding-top: 20px;
            /* Add some space below the signature */
            display: flex;
            /* Use flexbox to align the signature elements */
            align-items: center;
            /* Vertically center the signature elements */
            justify-content: space-between;
            /* Horizontally space out the signature elements */
        }

        .signature-logo {
            width: 100px;
            /* Set a fixed width for the logo image */
            height: auto;
            /* Preserve the logo image aspect ratio */
        }

        .signature-info {
            font-family: Arial, sans-serif;
            /* Use a more common font */
            font-size: 14px;
            /* Set a smaller font size for the signature info */
            color: #999999;
            /* Use a lighter color for the signature info */
        }

        .signature-info a {
            color: #999999;
            /* Use the same color for the signature links */
            text-decoration: none;
            /* Remove the underline from the signature links */
        }

        .signature-info a:hover {
            text-decoration: underline;
            /* Add an underline to the signature links on hover */
        }

        .unsubscribe {
            margin-top: 20px;
            /* Add some space above the unsubscribe button */
            text-align: center;
            /* Center the unsubscribe button */
        }

        .unsubscribe a {
            display: inline-block;
            /* Make the unsubscribe link a block element */
            padding: 10px 20px;
            /* Add some padding to the unsubscribe link */
            border: 1px solid #EEEEEE;
            /* Add a light gray border to the unsubscribe link */
            border-radius: 8px;
            /* Add some rounded corners to the unsubscribe link */
            font-family: Arial, sans-serif;
            /* Use a more common font */
            font-size: 14px;
            /* Set a smaller font size for the unsubscribe link */
            color: #999999;
            /* Use a lighter color for the unsubscribe link */
            text-decoration: none;
            /* Remove the underline from the unsubscribe link */
        }

        .unsubscribe a:hover {
            background: #EEEEEE;
            /* Add a light gray background to the unsubscribe link on hover */
        }

        @media (max-width: 600px) {

            /* Use media queries to make the email responsive */
            .container {
                width: 100%;
                /* Use the full width on small screens */
            }

            .card-body {
                padding: 20px;
                /* Reduce the card body padding on small screens */
            }

            .h4 {
                font-size: 20px;
                /* Reduce the heading font size on small screens */
            }

            p {
                font-size: 14px;
                /* Reduce the paragraph font size on small screens */
            }

            .btn-success {
                font-size: 16px;
                /* Reduce the button font size on small screens */
            }

            .signature {
                flex-direction: column;
                /* Stack the signature elements vertically on small screens */
                align-items: flex-start;
                /* Align the signature elements to the left on small screens */
            }

            .signature-logo {
                margin-bottom: 10px;
                /* Add some space below the logo image on small screens */
            }
        }
    </style>
</head>

<body>
@yield('content')
</body>
</html>
