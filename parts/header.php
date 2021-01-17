<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HW 3&4</title>
</head>

<header class="bg-dark">
    <div class="container">
        <nav id="mainNav" class="navbar navbar-expand-md navbar-light fixed-top">
            <a class="navbar-brand" href="index.php">פתק</a>
            
            <button class="navbar-toggler custom-toggler darken-3" type="button" data-toggle="collapse"
            data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
            aria-label="Toggle navigation">
            <div class="animated-icon1"><span></span><span></span><span></span></div>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0 text-center">
                    <li class="nav-item">
                        <a class="nav-link " href="signup.php">Sign-Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <div class="theme-switch-wrapper">
                            <label class="theme-switch" for="checkbox">
                                <input type="checkbox" id="checkbox" />
                                <div class="slider round"></div>
                            </label>
                            <em id="em"></em>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>


<footer><p><strong>312233141</strong> - 316541374</p></footer>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
    const currentTheme = localStorage.getItem('theme');

    if (currentTheme) {
        document.documentElement.setAttribute('data-theme', currentTheme);
    
        if (currentTheme === 'dark') {
            toggleSwitch.checked = true;
            document.getElementById("em").innerHTML = "Dark<br>Mode";
        } else {
            document.getElementById("em").innerHTML = "Light<br>Mode";
        }
    }

    function switchTheme(e) {
        if (e.target.checked) {
            document.documentElement.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
            document.getElementById("em").innerHTML = "Dark<br>Mode";
        }
        else {
            document.documentElement.setAttribute('data-theme', 'light');
            localStorage.setItem('theme', 'light');
            document.getElementById("em").innerHTML = "Light<br>Mode";
        }    
    }

    toggleSwitch.addEventListener('change', switchTheme, false);

    $(document).ready(function () {
        $('.custom-toggler').on('click', function () {
            $('.animated-icon1').toggleClass('open');
        });
    });
</script>