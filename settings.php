<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet.css" rel="stylesheet">
    <?php
        require("start.php");
        ?>
    <title>Settings</title>
</head>
<body>
    <h1>Profile Settings</h1>
        <form>
            <fieldset class="fieldset">
                <legend>Base Data</legend>
                <table class="text-centered">
                    <tr>
                        <td class="lefttable">
                            <label for="fristName">First Name</label> 
                        </td>
                        <td class="righttable">
                            <input class="formularinput" type="text" name="firstName" id="firstName" placeholder="Your name">
                        </td>
                    </tr>
                    <tr>
                        <td class="lefttable">
                            <label for="fristName">Last Name</label>
                        </td>
                        <td class="righttable">
                            <input class="formularinput" type="text" name="lastName" id="lastName" placeholder="Your surname">
                        </td>
                    </tr>
                    <tr>
                        <td class="lefttable">
                            <label for="coffeeOrTea">Coffe or Tea?</label>
                        </td>
                        <td class="righttable">
                            <select class="settingSelect" name="coffeOrTea" id="coffeeOrTea">
                                <option value="Neither nor">Neither nor</option>
                                <option value="Coffe">Coffee</option>
                                <option value="Tea">Tea</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </fieldset> <br>
            <fieldset class="fieldset">
                <legend>Tell Something About You</legend>
                <textarea class="settingsTextArea"name="aboutMe" id="aboutMe" cols="20" rows="10" placeholder="Leave a comment here"></textarea>
            </fieldset> <br>
            <fieldset class="fieldset">
                <legend>Preferred Chat Layout</legend>
                <p><input type="radio" name="inOrOutline" id="inline">Username and message in one line</p>
                <p><input type="radio" name="inOrOutline" id="outline">Username and message in separated lines</p>
            </fieldset>
            <table class="text-centered">
                <tr>
                    <td>
                        <a href="friends.html"><input class="greybutton" type="button" value="Cancel"></a>
                    </td>
                    <td>
                        <button class="bluebutton" type="submit">Save</button>
                    </td>
                </tr>
            </table>
        </form>
</body>
</html>