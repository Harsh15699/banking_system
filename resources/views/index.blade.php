<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link rel="stylesheet" href="<?php echo asset('css/banking.css')?>">
  </head>
  <body>
    <header>
      <h1 id="header">Basic Banking System</h1>
    </header>
    <main>
      <h3 class="underline" id="instruction">Read the instruction carefully on how to use this portal before proceeding:-</h3>
      <ol>
        <li>Click on the button at the bottom of this page</li><br>
        <li>You will be redirected to another page where you can select your account from a list of account</li><br>
        <li>Once You select your account you will be redirected to your dashboard where you can check your current balance</li><br>
        <li>Now you can click on money transfer button in order to transfer money</li><br>
        <li>Once You have clicked on above mentioned button You will be able to see a list to available customer</li><br>
        <li>Select the customer to whom you want to tranfer the money</li><br>
        <li>Once You have selected the customer fill the amount to be transferred in the box at the bottom of the page</li><br>
        <li>Once You have entered the amount click on transfer button</li><br>
        <li>Your money is successfully transferred</li><br>
      </ol>
      <h2 class="underline">Click On this Button To Select Your Account:-</h2>
      <form action="\selectyouraccount">
        <input type="submit" value="Select Your Account" id="hbutton">
      </form>
   </main>
   <br>
   <footer>
     <p>Designed and Developed for Basic Banking System &copy 2021 Harsh Gautam</p>
   </footer>
  </body>
</html>
