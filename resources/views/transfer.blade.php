<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo asset('css/banking.css')?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <header>
      <h1 id="header">Basic Banking System</h1>
    </header>
    <main>
      <h1 id="name1">Hi, <b id="name"></b></h1>
      <h2 id="welcome">Welcome To Money Transfer Portal</h2>
      <h3 id="cuba">Your Current balance is ₹ <b id="cb"></b></h3>
      <ol>
        <li><button type="button" onclick="currentbalance()" id="currentbalance">Check Your Current Balance</button></li><br>
        <li><button type="button" onclick="transfer()" id="transfer1">Money Transfer</button></li>
      </ol>
      <br>
      <div id="money_transfer">
        <h3 id="info" class="underline">Select Any One User From Below To Send Money:-</h3>
        <table id="customer" class="table table-hover"></table>
        <br>
        <h3 class="underline">Enter the Amount To be sent to the selected user below:-</h3><br>
        <div class="w3-container">
          <div class="w3-card-4">
            <form class="w3-container">
              <label for="amount">Enter the Amount:</label>
              <input type="number" name="amount" id="amount" class="w3-input"><br>
              <input type="submit" value="Transfer Money" id="transfer">
            </form>
           </div>
         </div>
       </div>
    </main>
    <br>
    <footer id="footer">
      <p>Designed and Developed for Basic Banking System &copy 2021 Harsh Gautam</p>
    </footer>
    <script>
      function transfer(){
        document.getElementById('money_transfer').style.display="inline-block";
      document.getElementById('footer').style.position="relative";}

      function currentbalance(){
          var x=document.getElementById('cb').innerHTML;
          alert('Your Current balance is ₹ '+x);}

      var x=checkid();
      function checkid(){
        var cookie_name='c_id';
        var x=document.cookie.split(';');
        for(var i=0;i<x.length;i++){
          c=x[i];
          while (c.charAt(0) == ' ') {
              c = c.substring(1);}
            if (c.indexOf(cookie_name) == 0) {
              document.cookie = "c_id=; expires="+new Date().toUTCString()+";path=/;";
              return(c.substring(cookie_name.length+1, c.length));}
          }
         alert("You have not selected your account,Kindly select Your Account and proceed further");
         window.location="../selectyouraccount";
         return;
        }
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
             		<th>Name</th>
                <th>Account Number</th>
                <th>Action<th>
             		</tr>`;
             	for (let r of out.customers) {
                if(r.c_id==x){
                    sessionStorage.setItem("current_balance",r.current_balance);
                    document.getElementById("cb").innerHTML = r.current_balance;
                    document.getElementById("name").innerHTML = r.name;
                    continue;
                  }
             		tab += `<tr>
               	<td>${r.name} </td>
               	<td>${r.account_number}</td>
                <td><button type="button" onclick="setid(${r.c_id},this)" class="button" id="select">Select This Customer</button></td>
               </tr>`;}

             	document.getElementById("customer").innerHTML = tab;
              }

             function setid(id,ele){
               for(var i=0;i<9;i++){
                 document.getElementsByClassName('button')[i].style.height="28px";
                 document.getElementsByClassName('button')[i].innerHTML='Select This Customer';}
               sessionStorage.setItem("receiver_id", id);
               ele.style.height="50px";
               ele.innerHTML="Selected This Customer";
             }

             $('#transfer').on('click',function(e){
                e.preventDefault();
               var $amount=$('#amount');
               if((parseInt(sessionStorage.getItem("current_balance"))-$amount.val())<0){
                 alert("Insufficient Balance to perform this transaction");
                 return;
               }
               var $s_id=x;
               if($s_id==null){
                 alert("You have not selected your account,Kindly select Your Account and proceed further");
                  window.location="../selectyouraccount";
                 return;
               }
               var $r_id=sessionStorage.getItem("receiver_id");
               if($r_id==null){
                 alert("You have not selected the customer you want to transfer money");
                 return;
               }
               var data={
                 sender_id:$s_id,
                 receiver_id:$r_id,
                 amount:$amount.val()
               };
               $.ajax(
                 {
                   type:'POST',
                   url:"/api/transaction",
                   data:data,
                   success:function(){
                     alert("Successfully Transferred The Money");
                     window.location="../selectyouraccount";
                     sessionStorage.removeItem("receiver_id");
                   },
                   error:function(){
                     alert("Money Not Transferred");
                      location.reload();
                   }
                 });
             });
    </script>

  </body>
</html>
