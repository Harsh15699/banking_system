<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>View All Customer</title>
    <link rel="stylesheet" href="<?php echo asset('css/banking.css')?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <header>
      <h1 id="header">Basic Banking System</h1>
    </header>
    <main>
      <h2 class="underline">Dear Customer, Please Select Your Account From Below:-</h2>
      <table id="customer" class="table table-hover"></table>
    </main>
    <br>
    <footer>
      <p>Designed and Developed for Basic Banking System &copy 2021 Harsh Gautam</p>
    </footer>
    <script>
    $.ajax({
            url: "/api/view_cust",
            type: "GET",
            dataType: 'json',
            ContentType: 'application/json',
            success: function(data) {
              show(data);
            }
         });

         function show(out) {
         	let tab =
         		`<tr>
         		<th>Customer Id</th>
         		<th>Name</th>
         		<th>Email</th>
         		<th>Phone Number</th>
            <th>Account Number</th>
            <th>Action<th>
         		</tr>`;
         	for (let r of out.customers) {
         		tab += `<tr>
            <td>${r.c_id}</td>
           	<td>${r.name} </td>
           	<td>${r.email}</td>
           	<td>${r.phone}</td>
           	<td>${r.account_number}</td>
            <td><form action="/dashboard"><input type="submit" value="Select" onclick="setid(${r.c_id})" class="button" /></form></td>
           </tr>`;}
         	document.getElementById("customer").innerHTML = tab;}

         function setid(id){
          document.cookie = "c_id="+id;}
    </script>
  </body>
</html>
