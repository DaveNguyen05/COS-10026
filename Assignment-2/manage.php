<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Home page with details of the company">
    <meta name="keywords" content="Assignment1 Manage">
    <meta name="author" content="DGD">
    <link href="styles/style.css" rel="stylesheet">
    <title>Assignment2 manage page</title>

    <style>
        /* Style the tab */
        .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #587082;
        }

        /* Style the buttons inside the tab */
        .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
        background-color: #62788a;
        }

        /* Create an active/current tablink class */
        .tab button.active {
        background-color: #91abbf;
        }

        /* Style the tab content */
        .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
        }
    </style>
</head>
<header>
    <?php include './inc/header.inc'; ?>
    <?php include './inc/menu.inc'; ?>
</header>

<body>
    <div class="bg-image"></div>
    <div class="tab">
        <button class="tablinks" onclick="openForm(event, 'Search')">Search</button>
        <button class="tablinks" onclick="openForm(event, 'Edit')">Edit</button>
        <button class="tablinks" onclick="openForm(event, 'Delete')">Delete</button>
    </div>

    <div id="Search" class="tabcontent">
        <form method="post" action="searchEOI.php">
            <fieldset><legend>Serach Details</legend>
                <p class="row">	<label for="JobReferenceNumber">Job reference number: </label>
                    <input type="text" name="JobReferenceNumber" id="JobReferenceNumber" /></p><br>
                <p class="row">	<label for="FirstName">First name: </label>
                    <input type="text" name="FirstName" id="FirstName" /></p><br>
                <p class="row">	<label for="LastName">Last name: </label>
                    <input type="text" name="LastName" id="LastName" /></p><br>
                <p>	<input type="submit" value="Search" /></p>
            </fieldset>
	    </form>
    </div>

    <div id="Edit" class="tabcontent">
        <form method="post" action="updateEOI.php">
            <fieldset><legend>Update Status Details</legend>
                <p class="row">	<label for="JobReferenceNumber">Job reference number: </label>
                    <input type="text" name="JobReferenceNumber" id="JobReferenceNumber" /></p><br>
                <p class="row">	<label for="FirstName">First name: </label>
                    <input type="text" name="FirstName" id="FirstName" /></p><br>
                <p class="row">	<label for="LastName">Last name: </label>
                    <input type="text" name="LastName" id="LastName" /></p><br><br>
                <div id="statud-dropdown">
                    <label for="Status">Status update to:</label>
                    <select name="Status" id="Status" required>
                        <option value="">Please Select</option>
                        <option id="Status" value="New">New</option>
                        <option id="Status" value="Current">Current</option>
                        <option id="Status" value="Final">Final</option>
                    </select>
                </div><br>
                <p>	<input type="submit" value="Update" /></p>
                
            </fieldset>
	    </form>
    </div>
    <div id="Delete" class="tabcontent">
        <form method="post" action="deleteEOI.php">
            <fieldset><legend>Serach Details</legend>
                <p class="row">	<label for="JobReferenceNumber">Job reference number: </label>
                    <input type="text" name="JobReferenceNumber" id="JobReferenceNumber" /></p><br>
                <p>	<input type="submit" value="Delete" /></p>
            </fieldset>
        </form>
    </div>

    <script>
        function openForm(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>

    <?php include './inc/footer.inc'; ?>
</body>

</html>