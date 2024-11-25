<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Page for job application">
    <meta name="keywords" content="Assignment1 apply">
    <meta name="author" content="DGD">
    <link href="styles/style.css" rel="stylesheet">
    <title>Assignment2 apply page</title>
</head>
<div id="container">
    <header>
        <?php include './inc/header.inc'; ?>
        <?php include './inc/menu.inc'; ?>
    </header>

    <div class="bg-image"></div>

    <fieldset form="jobApplication">
        <legend>Application:</legend>
        <div class="content">
            <form id="jobApplication" action="processEOI.php" method="post" novalidate="novalidate">
                <label for="referenceNumber">Job Reference Number:</label>
                <input type="text" id="referenceNumber" name="referenceNumber" placeholder="Type here..." pattern=".{5}" value="" required><br><br><br>

                <label for="name">First Name:</label>
                <input type="text" id="firstname" name="firstName" maxlength="19" placeholder="<20 characters" value="" required><br><br><br>

                <label for="name">Last Name:</label>
                <input type="text" id="lastname" name="lastName" maxlength="19" placeholder="<20 characters" value="" required><br><br><br>

                <label for="date">Date of Birth:</label>
                <input type="date" id="dob" name="dob" value="" required><br><br><br>

                <label for="address">Address:</label>
                <input type="text" id="streetaddress" name="streetAddress" maxlength="39" placeholder="<40 characters" value="" required><br><br><br>

                <label for="address">City:</label>
                <input type="text" id="suburbtown" name="suburbTown" maxlength="39" placeholder="<40 characters" value="" required><br><br><br>

                <label for="postcode">Postcode:</label>
                <input type="text" id="postcode" name="postcode" placeholder="=4 digits" pattern=".{4}" value="" required><br><br><br>

                <label for="email">Personal email:</label>
                <input type="text" id="emailaddress" name="emailAddress" value="" required><br><br><br>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phonenumber" name="phoneNumber" pattern=^(\d{8}|\d{12})$ value="" required><br><br><br>




                <div id="gender-checkbox"> <!-- Don't know to require only one without JS/logic -->
                    <label>Gender</label>
                    <label for="male">male:&nbsp;&nbsp;&nbsp;</label>
                    <input type="radio" id="male" name="gender" value="male">
                    <label for="female">female:</label>
                    <input type="radio" id="female" name="gender" value="female">
                </div>

                <div id="state-dropdown">
                    <label for="state">Your State:</label>
                    <select name="state" id="state" required>
                        <option value="">Please Select</option>
                        <option id="act" value="act">ACT</option>
                        <option id="nsw" value="nsw">NSW</option>
                        <option id="nt" value="nt">NT</option>
                        <option id="qld" value="qld">QLD</option>
                        <option id="sa" value="sa">SA</option>
                        <option id="tas" value="tas">TAS</option>
                        <option id="vic" value="vic">VIC</option>
                        <option id="wa" value="wa">WA</option>
                    </select>
                </div>
                <br><br>

                <h3>Relevant Skills (if applicable)</h3>

                <div id="skills-checkbox">
                    <label>HTML<input type="checkbox" id="skill1" name="skill[]" value="html"></label>
                    <label>CSS<input type="checkbox" id="skill2" name="skill[]" value="css"></label>
                    <label>JavaScript<input type="checkbox" id="skill3" name="skill[]" value="javascript"></label>
                    <label>C#<input type="checkbox" id="skill4" name="skill[]" value="c#"></label>
                </div>
                

                <div>
                    <p><label for="otherskills"></label></p>
                    <label>Other skills:<input type="checkbox" id="otherskillscheckbox" name="otherSkillsCheckbox" value="selected"></label>
                    <textarea id="otherskills" name="otherSkills" rows="4" cols="50" placeholder="Please place any other skills you have here"></textarea>
                </div>

                <div id="buttons">
                    <input type="submit" value="Submit">
                    <input type="reset" value="Reset Form">
                </div>
            </form>
        </div>
    </fieldset>
    <?php include './inc/footer.inc'; ?>
</div>

</html>