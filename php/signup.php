<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.5.2.js"></script>
        <link rel="stylesheet" href="../css/econ-style.css" type="text/css" media="screen" 
                  charset="utf-8"/></head>
                  <title>Trinity Game Theory</title>
<script type="text/javascript" src="../js/dropdowntabs.js">
</script>
<body>
<div class="main">

  <div class="header">
    <div class="header_resize">
      <div class="logo">
        <h1><a href="index.html">Trinity Game<span> Theory Website</span> <small><span>Trinity Game Theory</span></small></a></h1>
      </div>
      </div>
    </div>
    
    <div class="content">
    <div class="table">
    <form id="signform" action="signupback.php" method="post">
        <table border="0">
        <caption><h3>Create an Account</h3></caption>
                <tr><td>Full Name:</td><td><label><input type="text" name="fname" id = "fname"size="30"/></label></td></tr>
                <tr><td>Date of Birth<span class= "tabs">(mm/dd/yy)</span>:</td><td><label><input type="text" name="dob" id="dob" size="30"/></label></td></tr>
                <tr><td>Desired Username:</td><td><label><input type="text" name="username" id="uname" size="30"/></label></td></tr>
                <tr><td>Password:</td><td><label><input type="password" name="password" id="pw" size="30"/></label></td></tr>
                <tr><td>Retype Password:</td><td><label><input type="password" name="repassword" id="rpw" size="30"/></label></td></tr>
                <tr><td>Email:</td><td><label><input type="text" name="email" id="email" size="30"/></label></td></tr>
                <tr><td>Sex :</td><td><label><input type="radio" name="sex" id="sex" value="Male"/>Male</label><label><input type="radio"                         name="sex" value="Female"/>Female</label></td></tr>
                <tr><td><input type="submit" value="Submit" name="submit" onclick="validate()"></td><td><input type="reset" name="reset" value="Clear"></td></tr>
        </table>
        </form>
        <! /form>
        </div>
        <script type="text/javascript" charset="utf-8">

function validate(){
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        var mail = $('#email').val();
        var pw= $('#pw').val();
        var rp= $('#rpw').val();
        if ($('#fname').val()==''){                
                alert("Please provide your name!");
                return;                                
                               
        }
        if ($('#dob').val()==''){
                alert("Please provide your date of birth!");
                return;
        }
        if ($('#uname').val()== ''){
                alert("Please provide your username!");
                return;
                  
        }
        if ($('#dob').val()== ''){
                alert("Please provide your date of birth!");
                return;
        }
        
        if (pw==''){
                alert("Please provide your password!");
                return;
        }
        
        if (rp==''){
                alert("Please provide your retype password!");
                return;
        }        
        if (pw != rp){
                alert("Your passwords do not match!");
                return;                
        }
        
        if (reg.test(mail)==false){
                alert("Please type a valid email!");
                return;
        }
        else{
                return;
        }
        
        
};
                        
        </script>        
    </div>
</body>
</html>
