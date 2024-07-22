<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

    <!-- to not allowed user to inspect -->
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Disable right-click context menu
            document.addEventListener('contextmenu', function(e) {
                e.preventDefault();
                alert('Right-click is disabled.');
            });

            // Disable F12 key and other developer tools shortcuts
            document.addEventListener('keydown', function(e) {
                if (e.key === 'F12' || (e.ctrlKey && (e.key === 'U' || e.key === 'I' || e.key === 'J')) || (e.ctrlKey && e.shiftKey && e.key === 'C')) {
                    e.preventDefault();
                    alert('Developer tools are disabled.');
                }
            });

            // Detect developer tools open (does not work reliably in all browsers)
            function detectDevTools() {
                const threshold = 160;
                let devtoolsOpen = false;
                const onResize = () => {
                    const width = window.innerWidth;
                    const height = window.innerHeight;
                    if (width < threshold || height < threshold) {
                        devtoolsOpen = true;
                    } else {
                        devtoolsOpen = false;
                    }
                    if (devtoolsOpen) {
                        alert('Developer tools are open.');
                    }
                };
                window.addEventListener('resize', onResize);
                onResize(); // Initial check
            }
            detectDevTools();
        });
    </script>

</head>

<body>